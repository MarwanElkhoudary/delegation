<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'target_id',
        'request_target_id',
        'contact_name',
        'contact_phone',
        'start_date',
        'end_date',
        'priority',
        'note',
        'status_id',
        'international_task_id',
    ];

    public function medicalNeeds(){
        return $this->hasMany(MedicalNeed::class);
    }

    public function publications(){
        return $this->hasMany(Publication::class);
    }

    public function latestPublication()
    {
        return $this->hasOne(Publication::class)->latestOfMany();
    }

    public function requirementNeeds(){
        return $this->hasMany(RequirementNeed::class );
    }

    public function target(){
        return $this->hasOne(Target::class ,'id' ,'target_id');
    }
    public function requestTarget(){
        return $this->hasOne(Target::class ,'id' , 'request_target_id');
    }
    public function status(){
        return $this->hasOne(StatusTask::class ,'id' , 'status_id');
    }

    public function statusInternationalTask(){
        return $this->hasOne(statusInternationalTask::class ,'id' , 'international_task_id');
    }

    public function recommendation(){
        return $this->belongsTo(Recommendation::class ,'id' , 'task_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
