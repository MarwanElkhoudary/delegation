<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalNeed extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id',
        'human_type_id',
        'specialization_id',
        'count',
        'note'
    ];

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function specialization(){
//        return $this->hasMany(Specialization::class);
        return $this->belongsTo(Specialization::class);

    }
}
