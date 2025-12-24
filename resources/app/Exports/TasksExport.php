<?php

namespace App\Exports;

use App\Models\Hospital;
use App\Models\Specialization;
use App\Models\Target;
use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TasksExport implements FromCollection, WithHeadings, WithMapping

{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $id;

    function __construct($id) {

        $this->id = $id;

    }

    public function collection()
    {
        if($this->id > 0){

            $tasks = Task::where('hospital_id', $this->id)->with('target', 'requestTarget', 'hospital', 'status')->get();
        }else{
            $tasks = Task::with('target', 'requestTarget', 'hospital', 'status')->get();
        }

        return $tasks;
    }

    public function headings(): array
    {
        return [
            'Task ID',
            'Hospital Name',
            'Specialization',
            'Priority',
            'Target Specialization',
            'Contact Person',
            'Contact Phone',
            'Start Date',
            'End Date',
        ];
    }


    public function map($tasks): array
    {
        $rows = [];

        $rows[] = [

            $tasks->id,
            $tasks->hospital->name,
            $tasks->target->name,
            $tasks->priority,
            $tasks->requestTarget->name,
            $tasks->contact_name,
            $tasks->contact_phone,
            $tasks->start_date,
            $tasks->end_date,

        ];
        return $rows;
    }
}
