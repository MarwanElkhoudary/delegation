<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'recommendation_team',
        'recommendation_doctor',
        'user_id',
        'task_id',
    ];

    public function task(){
        return $this->hasOne(Task::class);
    }
}
