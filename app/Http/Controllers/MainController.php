<?php

namespace App\Http\Controllers;

use App\Models\HumanType;
use App\Models\Language;
use App\Models\Specialization;
use App\Models\Task;
use App\Models\HealthStaff;
use App\Models\HealthStaffFile;
use App\Models\HealthStaffWorkedWith;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    //
    public function index()
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('unauthorized.pages.home');
    }

    public function showApplyPage($id)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Get mission details
        $mission = Task::findOrFail($id);

        // Check if user is logged in
        $user = Auth::user();

        \Log::info('ShowApplyPage called', [
            'mission_id' => $id,
            'user_id' => $user ? $user->id : 'not logged in',
            'user_email' => $user ? $user->email : 'N/A'
        ]);

        // Check if user already applied to this mission
        $existingApplication = null;
        if ($user && $user->email) {
            $existingApplication = HealthStaff::where('task_id', $id)
                ->where('email', $user->email)
                ->first();

            \Log::info('Existing application check', [
                'found' => $existingApplication ? 'yes' : 'no',
                'application_id' => $existingApplication ? $existingApplication->id : 'N/A'
            ]);
        }

        // If user already applied, redirect to view/edit application
        if ($existingApplication) {
            \Log::info('Redirecting to application view', [
                'application_id' => $existingApplication->id
            ]);
            return redirect()->route('application.view', ['id' => $existingApplication->id]);
        }

        // Check if mission is active
//        if ($mission->duration_state !== 1) {
//            return redirect()->route('calendar')
//                ->with('error', 'This mission is not currently accepting applications.');
//        }

        // Get form data
        $humanTypes = HumanType::all();
        $languages = Language::all();

        return view('unauthorized.pages.apply-mission', compact('mission', 'humanTypes', 'languages'));
    }

    public function get_specialization(Request $request)
    {

        $data = $request->all();
        $data = $data['HUMAN_TYPE'];

        // echo "<pre>";print_r($data);die;
        $spec = Specialization::where('human_type_id', $data)->get();

        return response()->json([
            'status' => 'success',
            'data' => $spec,
//        'data' =>$data,
            'message' => 'Information saved successfully!'
        ], 200);

    }

    public function getPublishTasks(Request $request)
    {
        $events = Task::with([
            'publications' => function ($query) {
                $query->where('publication_state', 1)
                    ->orderBy('created_at', 'desc')
                    ->take(1); // Get only the latest publication with publication_state = 1
            },
            'medicalNeeds.specialization.humanType',
            'requirementNeeds',
//            'target',
//            'requestTarget'
        ])
            ->whereHas('publications', function ($query) {
                $query->where('publication_state', 1);
            })
            ->get();

        $formattedEvents = $events->map(function ($task) {
            $today = now(); // Get today's date and time
            $durationState = $today > $task->end_date ? 0 : 1; // 0 if today is past end_date, 1 otherwise

            return [
                'id' => $task->id,
                'title' => 'Apply for the mission ' . $task->id,
                'start' => $task->start_date,
                'end' => $task->end_date,
                'medicalNeeds' => $task->medicalNeeds,
                'requirementNeeds' => $task->requirementNeeds,
                'contact_name' => $task->contact_name,
                'contact_phone' => $task->contact_phone,
                'duration_state' => $durationState,
            ];
        });
        return response()->json($formattedEvents);


    }

    public function applyToMission(Request $request)
    {
        // جلب بيانات المستخدم المسجل
        $user = Auth::user();
        $healthStaffData = Session::get('health_staff_data', []);

        if ($request->has('languages_spoken') && !is_array($request->languages_spoken)) {
            $request->merge(['languages_spoken' => [$request->languages_spoken]]);
        }

        // Pre-fill email and human_type from registration if available
        if ($user && !$request->has('email')) {
            $request->merge(['email' => $user->email]);
        }

        if (isset($healthStaffData['human_type_id']) && !$request->has('human_type')) {
            $request->merge(['human_type' => $healthStaffData['human_type_id']]);
        }

        // 1. التحقق من البيانات (Validation)
        $validator = Validator::make($request->all(), [
            // Required: Mission & Basic Info
            'mission_id' => 'required|exists:tasks,id',
            'human_type' => 'required|exists:human_types,id',
            'specialization' => 'required|exists:specializations,id',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:1,2',
            'birth_date' => 'required|date|before:today',
            'nationality' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'languages_spoken' => 'required|array|min:1',
            'languages_spoken.*' => 'integer|exists:languages,id',

            // Required: Academic Qualifications
            'highest_qualification' => 'required|string|max:255',
            'granting_university' => 'required|string|max:255',
            'degree_granting_country' => 'required|string|max:100',
            'date_of_graduation' => 'required|date',

            // Optional: Professional Experience (nullable)
            'clinical_experience_years' => 'nullable|integer|min:0',
            'countries_previously_served' => 'nullable|string',
            'previous_employers' => 'nullable|string',

            // Optional: Additional Experience (nullable)
            'disaster_experience' => 'nullable|in:yes,no',
            'disaster_experience_description' => 'required_if:disaster_experience,yes|nullable|string',
            'volunteer_experience' => 'nullable|in:yes,no',
            'volunteer_experience_description' => 'required_if:volunteer_experience,yes|nullable|string',
            'visited_gaza' => 'nullable|in:yes,no',
            'place_of_work_previous_visit' => 'nullable|string|max:255',

            // Optional: Academic Contributions (nullable)
            'educational_contributions' => 'nullable|string',
            'published_scientific_papers' => 'nullable|string',
            'conference_participation' => 'nullable|string',

            // Optional: Files
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'doctors.*.doctor_name' => 'nullable|string|max:255',
            'doctors.*.visited_date' => 'nullable|date',
        ]);

        // 2. إذا في أخطاء validation، ارجع response مع الأخطاء بطريقة منظمة
        if ($validator->fails()) {
            $errors = $validator->errors();

            // تنظيم الأخطاء حسب الأقسام
            $organizedErrors = [
                'basic_info' => [],
                'qualifications' => [],
                'experience' => [],
                'other' => []
            ];

            // حقول المعلومات الأساسية
            $basicFields = ['human_type', 'specialization', 'full_name', 'gender', 'birth_date', 'nationality', 'phone', 'email', 'languages_spoken'];
            // حقول المؤهلات
            $qualificationFields = ['highest_qualification', 'granting_university', 'degree_granting_country', 'date_of_graduation'];
            // حقول الخبرة
            $experienceFields = ['clinical_experience_years', 'countries_previously_served', 'previous_employers', 'disaster_experience', 'volunteer_experience', 'visited_gaza', 'educational_contributions', 'published_scientific_papers', 'conference_participation'];

            foreach ($errors->messages() as $field => $messages) {
                if (in_array($field, $basicFields) || strpos($field, 'languages_spoken') !== false) {
                    $organizedErrors['basic_info'] = array_merge($organizedErrors['basic_info'], $messages);
                } elseif (in_array($field, $qualificationFields)) {
                    $organizedErrors['qualifications'] = array_merge($organizedErrors['qualifications'], $messages);
                } elseif (in_array($field, $experienceFields) || strpos($field, 'disaster') !== false || strpos($field, 'volunteer') !== false) {
                    $organizedErrors['experience'] = array_merge($organizedErrors['experience'], $messages);
                } else {
                    $organizedErrors['other'] = array_merge($organizedErrors['other'], $messages);
                }
            }

            // إزالة الأقسام الفاضية
            $organizedErrors = array_filter($organizedErrors, function($section) {
                return !empty($section);
            });

            return response()->json([
                'status' => 'error',
                'message' => 'Please complete all required fields',
                'errors' => $organizedErrors,
                'all_errors' => $errors->all() // للاستخدام في حالة العرض البسيط
            ], 422);
        }

        // 2.5. فحص إذا المستخدم قدّم على نفس الـ mission قبل كده
        $existingApplication = HealthStaff::where('task_id', $request->mission_id)
            ->where('email', $request->email ?? ($user ? $user->email : null))
            ->first();

        if ($existingApplication) {
            return response()->json([
                'status' => 'error',
                'message' => 'You have already submitted an application for this mission. Please check your email for application status.',
                'duplicate' => true
            ], 409); // 409 = Conflict
        }

        // 3. ابدأ Transaction (عشان لو صار خطأ نرجع كل شي)
        DB::beginTransaction();

        try {
            // 4. احفظ البيانات الأساسية في health_staff
            $healthStaff = HealthStaff::create([
                'task_id' => $request->mission_id,
                'human_type_id' => $request->human_type,
                'specialization_id' => $request->specialization,
                'full_name' => $request->full_name,
                'email' => $request->email ?? ($user ? $user->email : null),
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'nationality' => $request->nationality,
                'phone' => $request->phone,
                'highest_qualification' => $request->highest_qualification,
                'granting_university' => $request->granting_university,
                'degree_granting_country' => $request->degree_granting_country,
                'date_of_graduation' => $request->date_of_graduation,
                'clinical_experience_years' => $request->clinical_experience_years,
                'countries_previously_served' => $request->countries_previously_served,
                'previous_employers' => $request->previous_employers,
                'disaster_experience' => $request->disaster_experience,
                'disaster_experience_description' => $request->disaster_experience_description,
                'volunteer_experience' => $request->volunteer_experience,
                'volunteer_experience_description' => $request->volunteer_experience_description,
                'visited_gaza' => $request->visited_gaza,
                'place_of_work_previous_visit' => $request->place_of_work_previous_visit,
                'educational_contributions' => $request->educational_contributions,
                'published_scientific_papers' => $request->published_scientific_papers,
                'conference_participation' => $request->conference_participation,
                'application_status' => 'pending',
                'state_application' => 1, // 1 = Pending من جدول application_states
            ]);

            // 5. احفظ اللغات (many-to-many)
            if ($request->has('languages_spoken')) {
                $healthStaff->languages()->sync($request->languages_spoken);
            }

            // 6. احفظ الملفات
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('health_staff_files', $filename, 'public');

                    HealthStaffFile::create([
                        'health_staff_id' => $healthStaff->id,
                        'file_path' => $path,
                        'file_name' => $originalName,
                        'file_size' => $file->getSize(),
                        'file_type' => $file->getMimeType(),
                    ]);
                }
            }

            // 7. احفظ الأطباء الي اشتغل معاهم
            if ($request->has('doctors') && is_array($request->doctors)) {
                foreach ($request->doctors as $doctor) {
                    if (!empty($doctor['doctor_name']) && !empty($doctor['visited_date'])) {
                        HealthStaffWorkedWith::create([
                            'health_staff_id' => $healthStaff->id,
                            'doctor_name' => $doctor['doctor_name'],
                            'visited_date' => $doctor['visited_date'],
                        ]);
                    }
                }
            }

            // 8. خلص كل شي بنجاح - اعمل Commit
            DB::commit();

            // 9. ارجع response ناجح
            return response()->json([
                'status' => 'success',
                'message' => 'Application submitted successfully!',
                'redirect' => url('/application/success/' . $healthStaff->id)
            ], 200);

        } catch (\Exception $e) {
            // 10. إذا صار خطأ - ارجع كل شي (Rollback)
            DB::rollBack();

            // 11. سجل الخطأ في الـ log
            \Log::error('Mission Application Error: ' . $e->getMessage(), [
                'mission_id' => $request->mission_id ?? 'N/A',
                'email' => $request->email ?? 'N/A',
                'trace' => $e->getTraceAsString()
            ]);

            // 12. تحديد نوع الخطأ ورسالة واضحة
            $errorMessage = 'An error occurred while submitting your application. Please try again.';

            // إذا كان الخطأ متعلق بـ database constraint (تقديم مكرر)
            if (strpos($e->getMessage(), 'Duplicate entry') !== false ||
                strpos($e->getMessage(), 'UNIQUE constraint') !== false) {
                $errorMessage = 'You have already submitted an application for this mission.';
            }

            // إذا كان الخطأ متعلق بالملفات
            if (strpos($e->getMessage(), 'file') !== false ||
                strpos($e->getMessage(), 'storage') !== false) {
                $errorMessage = 'Error uploading files. Please check file size and format.';
            }

            return response()->json([
                'status' => 'error',
                'message' => $errorMessage,
                'error' => config('app.debug') ? $e->getMessage() : null,
                'debug_info' => config('app.debug') ? [
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ] : null
            ], 500);
        }
    }

    public function applicationSuccess($id)
    {
        $application = HealthStaff::with(['task', 'humanType', 'specialization'])
            ->findOrFail($id);

        return view('unauthorized.pages.application-success', compact('application'));
    }

    public function viewApplication($id)
    {
        $application = HealthStaff::with([
            'task',
            'humanType',
            'specialization',
            'languages',
            'files',
            'workedWithDoctors'
        ])->findOrFail($id);

        // Check if user owns this application
        $user = Auth::user();
        if ($user && $application->email !== $user->email) {
            abort(403, 'Unauthorized access to this application.');
        }

        return view('unauthorized.pages.view-application', compact('application'));
    }

    public function editApplication($id)
    {
        $application = HealthStaff::with([
            'task',
            'humanType',
            'specialization',
            'languages',
            'files',
            'workedWithDoctors'
        ])->findOrFail($id);

        // Check if user owns this application
        $user = Auth::user();
        if ($user && $application->email !== $user->email) {
            abort(403, 'Unauthorized access to this application.');
        }

        // Get form data
        $humanTypes = HumanType::all();
        $languages = Language::all();
        $mission = $application->task;

        return view('unauthorized.pages.edit-application', compact('application', 'mission', 'humanTypes', 'languages'));
    }

    public function updateApplication(Request $request, $id)
    {
        $application = HealthStaff::findOrFail($id);

        // Check if user owns this application
        $user = Auth::user();
        if ($user && $application->email !== $user->email) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized access to this application.'
            ], 403);
        }

        if ($request->has('languages_spoken') && !is_array($request->languages_spoken)) {
            $request->merge(['languages_spoken' => [$request->languages_spoken]]);
        }

        // Validation - same rules as applyToMission
        $validator = Validator::make($request->all(), [
            // Required: Mission & Basic Info
            'human_type' => 'required|exists:human_types,id',
            'specialization' => 'required|exists:specializations,id',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:1,2',
            'birth_date' => 'required|date|before:today',
            'nationality' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'languages_spoken' => 'required|array|min:1',
            'languages_spoken.*' => 'integer|exists:languages,id',

            // Required: Academic Qualifications
            'highest_qualification' => 'required|string|max:255',
            'granting_university' => 'required|string|max:255',
            'degree_granting_country' => 'required|string|max:100',
            'date_of_graduation' => 'required|date',

            // Optional: Professional Experience (nullable)
            'clinical_experience_years' => 'nullable|integer|min:0',
            'countries_previously_served' => 'nullable|string',
            'previous_employers' => 'nullable|string',

            // Optional: Additional Experience (nullable)
            'disaster_experience' => 'nullable|in:yes,no',
            'disaster_experience_description' => 'required_if:disaster_experience,yes|nullable|string',
            'volunteer_experience' => 'nullable|in:yes,no',
            'volunteer_experience_description' => 'required_if:volunteer_experience,yes|nullable|string',
            'visited_gaza' => 'nullable|in:yes,no',
            'place_of_work_previous_visit' => 'nullable|string|max:255',

            // Optional: Academic Contributions (nullable)
            'educational_contributions' => 'nullable|string',
            'published_scientific_papers' => 'nullable|string',
            'conference_participation' => 'nullable|string',

            // Optional: Files
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'doctors.*.doctor_name' => 'nullable|string|max:255',
            'doctors.*.visited_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please complete all required fields',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        DB::beginTransaction();

        try {
            // Update basic data
            $application->update([
                'human_type_id' => $request->human_type,
                'specialization_id' => $request->specialization,
                'full_name' => $request->full_name,
                'email' => $request->email ?? $application->email,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'nationality' => $request->nationality,
                'phone' => $request->phone,
                'highest_qualification' => $request->highest_qualification,
                'granting_university' => $request->granting_university,
                'degree_granting_country' => $request->degree_granting_country,
                'date_of_graduation' => $request->date_of_graduation,
                'clinical_experience_years' => $request->clinical_experience_years,
                'countries_previously_served' => $request->countries_previously_served,
                'previous_employers' => $request->previous_employers,
                'disaster_experience' => $request->disaster_experience,
                'disaster_experience_description' => $request->disaster_experience_description,
                'volunteer_experience' => $request->volunteer_experience,
                'volunteer_experience_description' => $request->volunteer_experience_description,
                'visited_gaza' => $request->visited_gaza,
                'place_of_work_previous_visit' => $request->place_of_work_previous_visit,
                'educational_contributions' => $request->educational_contributions,
                'published_scientific_papers' => $request->published_scientific_papers,
                'conference_participation' => $request->conference_participation,
            ]);

            // Update languages
            if ($request->has('languages_spoken')) {
                $application->languages()->sync($request->languages_spoken);
            }

            // Add new files if provided
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('health_staff_files', $filename, 'public');

                    HealthStaffFile::create([
                        'health_staff_id' => $application->id,
                        'file_path' => $path,
                        'file_name' => $originalName,
                        'file_size' => $file->getSize(),
                        'file_type' => $file->getMimeType(),
                    ]);
                }
            }

            // Update doctors worked with
            if ($request->has('doctors') && is_array($request->doctors)) {
                // Delete old records
                $application->workedWithDoctors()->delete();

                // Add new records
                foreach ($request->doctors as $doctor) {
                    if (!empty($doctor['doctor_name']) && !empty($doctor['visited_date'])) {
                        HealthStaffWorkedWith::create([
                            'health_staff_id' => $application->id,
                            'doctor_name' => $doctor['doctor_name'],
                            'visited_date' => $doctor['visited_date'],
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Application updated successfully!',
                'redirect' => route('application.view', ['id' => $application->id])
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Application Update Error: ' . $e->getMessage(), [
                'application_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating your application.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function deleteApplicationFile($fileId)
    {
        $file = HealthStaffFile::findOrFail($fileId);

        // Check if user owns this file's application
        $user = Auth::user();
        if ($user && $file->healthStaff->email !== $user->email) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized access.'
            ], 403);
        }

        // Delete file from storage
        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }

        // Delete record
        $file->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'File deleted successfully!'
        ], 200);
    }
}
