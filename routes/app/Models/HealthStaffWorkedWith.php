<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthStaffWorkedWith extends Model
{
    use HasFactory;

    protected $table = 'health_staff_worked_with';

    protected $fillable = [
        'health_staff_id',
        'doctor_name',
        'visited_date',
    ];

    protected $casts = [
        'visited_date' => 'date',
    ];

    // Relationships
    public function healthStaff()
    {
        return $this->belongsTo(HealthStaff::class, 'health_staff_id');
    }

    // Accessors
    public function getVisitedDateFormattedAttribute()
    {
        return $this->visited_date ? $this->visited_date->format('d M Y') : 'N/A';
    }
}
