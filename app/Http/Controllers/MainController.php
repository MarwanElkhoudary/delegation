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
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    //
    public function index()
    {
//        $languages = Language::all();
//        $humanTypes = HumanType::all();
        return view('unauthorized.pages.home');
    }

    public function showApplyPage($id)
    {
        // Get mission details
        $mission = Task::findOrFail($id);

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
        if ($request->has('languages_spoken') && !is_array($request->languages_spoken)) {
            $request->merge(['languages_spoken' => [$request->languages_spoken]]);
        }

        // 1. التحقق من البيانات (Validation)
        $validator = Validator::make($request->all(), [
            'mission_id' => 'required|exists:tasks,id',
            'human_type' => 'required|exists:human_types,id',
            'specialization' => 'required|exists:specializations,id',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:1,2',
            'birth_date' => 'required|date|before:today',
            'nationality' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'languages_spoken' => 'required|array|min:1',
            'languages_spoken.*' => 'integer|exists:languages,id',
            'highest_qualification' => 'required|string|max:255',
            'granting_university' => 'required|string|max:255',
            'degree_granting_country' => 'required|string|max:100',
            'date_of_graduation' => 'required|date',
            'clinical_experience_years' => 'required|integer|min:0',
            'countries_previously_served' => 'required|string',
            'previous_employers' => 'required|string',
            'disaster_experience' => 'required|in:yes,no',
            'disaster_experience_description' => 'required_if:disaster_experience,yes|nullable|string',
            'volunteer_experience' => 'required|in:yes,no',
            'volunteer_experience_description' => 'required_if:volunteer_experience,yes|nullable|string',
            'visited_gaza' => 'required|in:yes,no',
            'place_of_work_previous_visit' => 'nullable|string|max:255',
            'educational_contributions' => 'required|string',
            'published_scientific_papers' => 'required|string',
            'conference_participation' => 'required|string',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'doctors.*.doctor_name' => 'nullable|string|max:255',
            'doctors.*.visited_date' => 'nullable|date',
        ]);

        // 2. إذا في أخطاء validation، ارجع response مع الأخطاء
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
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
                'trace' => $e->getTraceAsString()
            ]);

            // 12. ارجع response بالخطأ
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while submitting your application. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function applicationSuccess($id)
    {
        $application = HealthStaff::with(['task', 'humanType', 'specialization'])
            ->findOrFail($id);

        return view('unauthorized.pages.application-success', compact('application'));
    }
}
