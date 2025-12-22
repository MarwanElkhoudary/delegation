<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id',
        'publication_state',
        'start_publication',
        'end_publication',
        'publisher'
    ];

}
