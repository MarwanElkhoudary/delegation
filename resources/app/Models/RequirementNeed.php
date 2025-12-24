<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequirementNeed extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id',
        'requirement_id',
        'category_name',
        'count',
        'priority'
    ];

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function requirement(){
        return $this->belongsTo(Requirement::class);
    }



}
