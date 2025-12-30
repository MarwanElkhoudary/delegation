<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Device;
use App\Models\Disposable;
use App\Models\Drug;
use App\Models\HumanType;
use App\Models\MedicalNeed;
use App\Models\Publication;
use App\Models\Recommendation;
use App\Models\Requirement;
use App\Models\RequirementNeed;
use App\Models\Specialization;
use App\Models\statusInternationalTask;
use App\Models\StatusTask;
use App\Models\Target;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vtiful\Kernel\Excel;
use App\Exports\TasksExport;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospital = null;
        if (Auth()->user()->role_id == 1) {
            return view('task.index');
        } elseif (Auth()->user()->role_id == 2) {
            return view('task.administration.index');
        } elseif (Auth()->user()->role_id == 3) {
            return view('task.International_Cooperation.index');
        }elseif (Auth()->user()->role_id == 6) {
            return redirect()->route('calendar'); // توديه على الـ calendar
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $targets = Target::all();
        $human_types = HumanType::all();
        $specializations = Specialization::all();
        $requirements = Requirement::all();
//       dd($targets);
        return view('task.add', compact(array('targets', 'human_types', 'specializations', 'requirements')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Do validation later
        $validated = $request->validate([
            'specialization' => 'required|exists:specializations,id',
            'specialization_target' => 'required|exists:specializations,id',
            'contact_name' => 'required|string|max:255|min:10',
            'contact_phone' => 'phone',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ], [
                'contact_phone.phone' => 'Please enter a valid mobile number',
            ]
        );


        $input = $request->only('specialization', 'contact_name', 'contact_phone', 'specialization_target', 'start_date',
            'end_date', 'medical_needs_list', 'priority', 'additional_requirements_list', 'recommendation_team', 'recommendation_doctor');

        $startDate = Carbon::createFromFormat('Y-m-d', $input['start_date']);
        $endDate = Carbon::createFromFormat('Y-m-d', $input['end_date']);


        $input['hospital_id'] = Auth()->user()->hospital_id;
        $input['target_id'] = $request['specialization']; //temp
        $input['request_target_id'] = $request['specialization_target']; //temp
        $input['status_id'] = 1;
        $input['international_task_id'] = 3;
//        dd($input);

        if (array_key_exists('recommendation_team', $input)) {
            $input['recommendation_team'] = $input['recommendation_team'];
        } else {
            $input['recommendation_team'] = null;
        }

        if (array_key_exists('recommendation_doctor', $input)) {
            $input['recommendation_doctor'] = $input['recommendation_doctor'];
        } else {
            $input['recommendation_doctor'] = null;
        }

//        dd($input['recommendation_team']);
//        dd($input['recommendation_doctor']);

        $task = Task::create($input);
//        dd($request->additional_requirements_list);

        $task->medicalNeeds()->createMany($request->medical_needs_list);
        $task->RequirementNeeds()->createMany($request->additional_requirements_list);

        $recommendation_team = $input['recommendation_team'];
        $recommendation_doctor = $input['recommendation_doctor'];

        if (!is_null($recommendation_team) && $recommendation_team !== '' && !is_null($recommendation_doctor) && $recommendation_doctor !== '') {
            $recom = [
                'recommendation_team' => $input['recommendation_team'],
                'recommendation_doctor' => $input['recommendation_doctor'],
                'user_id' => auth()->user()->id,
                'task_id' => $task->id,
            ];

            Recommendation::create($recom);

        }

        return redirect('/missions/')->with('message', 'Your data has been saved successfully!');
        // dd($task->load('medicalNeeds'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $statuses = StatusTask::all();
        $international_statuses = statusInternationalTask::all();
        $task = Task::where('id', $id)->first();
        $publications = Publication::where('task_id', $id)->get();
        $publication = $publications->last();
//        dd($publication);
        return view('task.show_task',
            compact('task', 'statuses', 'international_statuses', 'publication'));
    }

    public function show_events()
    {

        return view('task.show_events');
    }

    public function get_events()
    {
        $colors = ['#FF5733', '#33B5FF', '#33FF57', '#FF33A1', '#F39C12', '#8E44AD'];
        $events = Task::with('hospital')->get()->map(function ($task, $index) use ($colors) {
            return [
                'id' => $task->id,
                'title' => optional($task->hospital)->name ?? 'No Hospital',
                'start' => $task->start_date,
                'end' => $task->end_date,
                'contact_name' => $task->contact_name,
                'contact_phone' => $task->contact_phone,
                'color' => $colors[$index % count($colors)], // rotates colors

            ];
        });

        return response()->json($events);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $targets = Target::all();
        $human_types = HumanType::all();
        $specializations = Specialization::all();
        $task = Task::with('recommendation')->findOrFail($id);
        $requirements = Requirement::all();
//        dd($human_types);

//        $task = Task::with('device')->findOrFail($id);
//        $task = Task::with('drug')->findOrFail($id);
//        $task = Task::with('disposable')->findOrFail($id);
//        dd($task);
//        $task->hospital_id = 2;

        if (Auth::user()->hospital_id != $task->hospital_id) {
            abort(403, 'You do not have permission to edit this task.');
        }
//        dd($task->hospital_id);
        return view('task.edit_task', compact(array('targets', 'requirements', 'human_types', 'specializations', 'task')));
    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(Request $request, Task $task)
    public function update(Request $request, $id)
    {
//        $input = $request->only('contact_name', 'contact_phone', 'start_date',
//            'end_date', 'priority');

        $input = $request->only('contact_name', 'contact_phone', 'start_date', 'end_date', 'priority');
        $input['hospital_id'] = Auth()->user()->hospital_id;
        $input['target_id'] = $request['specialization']; //temp
        $input['request_target_id'] = $request['specialization_target']; //temp
        $input['status_id'] = 1;

        $medicalNeedList_array = $request->only('medical_needs_list');
        $additionalRequirementsList_array = $request->only('additional_requirements_list');
        $recom_array = $request->only('recommendation_team', 'recommendation_doctor');

        $flaq_update = Task::where('id', $id)->update($input);
        if ($flaq_update) {
            $task = Task::findOrFail($id);
            $rowsDeleted1 = MedicalNeed::where('task_id', $id)->delete();
            $task->medicalNeeds()->createMany($medicalNeedList_array['medical_needs_list']);

            $rowsDeleted2 = RequirementNeed::where('task_id', $id)->delete();
            $task->requirementNeeds()->createMany($additionalRequirementsList_array['additional_requirements_list']);
        }
        $recommendatons_task = Recommendation::where('task_id', $id)->get();

        if ($recommendatons_task->isEmpty()) {
            $recommendatons = Recommendation::where('task_id', $id)->updateOrCreate(['recommendation_team' => $recom_array['recommendation_team'], 'recommendation_doctor' => $recom_array['recommendation_doctor'], 'task_id' => $id, 'user_id' => Auth::user()->id]);
        } else {
            $recommendatons = Recommendation::where('task_id', $id)->update(['recommendation_team' => $recom_array['recommendation_team'], 'recommendation_doctor' => $recom_array['recommendation_doctor'], 'task_id' => $id, 'user_id' => Auth::user()->id]);
        }


        return redirect('/missions/')->with('message_edit', 'Your data has been saved successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete_task = Task::destroy($id);

//        dd($delete_task);

        if ($delete_task) {

            return redirect('/missions/')->with('message_delete', 'The task has been deleted successfully!');

        }
    }

    public function edit_task_status(Request $request, $id)
    {
//        echo 'this is id staus tasks function : '. $id;
        $task_status = $request->input('task_status');
        $reason = $request->input('reason');
        $priority = $request->input('priority');

        $task = Task::findOrFail($id);
        $task->priority = $request->input('priority');
        $task->note = $request->input('reason');
        $task->status_id = $request->input('task_status');

        $task->save();

//        return response()->json(['message' => 'Task status updated successfully!']);
        return redirect('missions/view_mission/' . $id)->with('message', 'Task status updated successfully!');

    }

    public function edit_task_internation(Request $request, $id)
    {

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $international_task_id = $request->input('international_task_id');
        $publication_state = $request->input('publication_state');

        $task = Task::findOrFail($id);
        $task->start_date = $request->input('start_date');
        $task->end_date = $request->input('end_date');
        $task->international_task_id = $request->input('international_task_id');
        $task->save();

        if ($publication_state == 0) {
            $publication = [
                'task_id' => $id,
                'publication_state' => $publication_state,
                'start_publication' => null,
                'end_publication' => Carbon::now()->format('Y-m-d'), // also gives "2025-05-06"
                'publisher' => null,
            ];
        } else {
            $publication = [
                'task_id' => $id,
                'publication_state' => $publication_state,
                'start_publication' => Carbon::now()->format('Y-m-d'), // also gives "2025-05-06",
                'end_publication' => null,
                'publisher' => null,
            ];/**/
        }
        Publication::create($publication);

//        return response()->json(['message' => 'Task status updated successfully!']);
        return redirect('missions/view_mission/' . $id)->with('message', 'Task status updated successfully!');

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

    public function list()
    {
        //  $tasks = Task::with('medicalNeeds'  , 'RequestTarget' ,'target')->get();
        if (Auth()->user()->role_id == 2) {

            $tasks = Task::all();
            return response()->json([
                'data' => TaskResource::collection($tasks)
            ]);
        } elseif (Auth()->user()->role_id == 1) {

            $tasks = Task::where('hospital_id', (Auth()->user()->hospital_id))->get();
            return response()->json([
                'data' => TaskResource::collection($tasks)
            ]);
        } elseif (Auth()->user()->role_id == 3) {
//            $tasks = Task::where('status_id', 3)->get();
            $tasks = Task::all();
//            dd($tasks);
            return response()->json([
                'data' => TaskResource::collection($tasks)
            ]);
        }

    }

    public function medical_needs($id)
    {
//        $task_id = $request->input('TASK_ID'); // Replace 'param1' with your actual parameter name
//        dd('dsfsfsfs: ' . $id);
        $medicalNeeds = MedicalNeed::where('task_id', $id)->get();
//        print_r($medicalNeeds);
        return response()->json($medicalNeeds);
    }


//    public function export_excel()
//    {
//        return Excel::download(new ExportTask, 'tasks.xlsx');
//    }

    public function export()
    {

        return \Maatwebsite\Excel\Facades\Excel::download(new TasksExport(Auth()->user()->hospital_id), 'tasks' . time() . '.xlsx');

    }
}
