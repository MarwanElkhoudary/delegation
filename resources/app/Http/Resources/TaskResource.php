<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {



        return [
            'id' => $this->id,
            'hospital_id' => $this->hospital_id,
            'hospital' => $this->hospital->name,
            'contact_name' => $this->contact_name,
            'contact_phone' => $this->contact_phone,
            'note' => $this->note,
            'target' => $this->target->name,
            'requestTarget' => $this->requestTarget->name,
            'priority' => $this->priority,
            'status' => $this->status->name,
            'status_international' => $this->statusInternationalTask->name,
//            'medicalNeeds' => $this->whenLoaded('medicalNeeds',function (){
//                // return  $this->medicalNeeds;
//                return 'ddd';
//            }),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,

            'recommendation_team' => $this->recommendation_team,
            'recommendation_doctor' => $this->recommendation_doctor,
        ];
    }
}
