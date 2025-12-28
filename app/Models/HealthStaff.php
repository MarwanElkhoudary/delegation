<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class HealthStaff extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'health_staff';

    protected $fillable = [
        'user_id',
        'email',
        'username',
        'password',
        'task_id',
        'human_type_id',
        'specialization_id',
        'full_name',
        'gender',
        'birth_date',
        'nationality',
        'phone',
        'highest_qualification',
        'granting_university',
        'degree_granting_country',
        'date_of_graduation',
        'clinical_experience_years',
        'countries_previously_served',
        'previous_employers',
        'disaster_experience',
        'disaster_experience_description',
        'volunteer_experience',
        'volunteer_experience_description',
        'visited_gaza',
        'place_of_work_previous_visit',
        'educational_contributions',
        'published_scientific_papers',
        'conference_participation',
        'application_status',
        'state_application',
        'reason',
        'state_date',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'date_of_graduation' => 'date',
        'state_date' => 'datetime',
        'clinical_experience_years' => 'integer',
        'gender' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function humanType()
    {
        return $this->belongsTo(HumanType::class, 'human_type_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    public function applicationState()
    {
        return $this->belongsTo(ApplicationState::class, 'state_application');
    }

    public function languages()
    {
        return $this->belongsToMany(
            Language::class,
            'health_staff_language',
            'health_staff_id',
            'language_id'
        )->withTimestamps();
    }

    public function files()
    {
        return $this->hasMany(HealthStaffFile::class, 'health_staff_id');
    }

    public function workedWith()
    {
        return $this->hasMany(HealthStaffWorkedWith::class, 'health_staff_id');
    }

    // Alias for better naming
    public function workedWithDoctors()
    {
        return $this->hasMany(HealthStaffWorkedWith::class, 'health_staff_id');
    }

    // Accessors
    public function getGenderTextAttribute()
    {
        return $this->gender == 1 ? 'Male' : 'Female';
    }

    public function getStatusColorAttribute()
    {
        return match($this->application_status) {
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'secondary',
        };
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('application_status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('application_status', 'approved');
    }

    public function scopeForTask($query, $taskId)
    {
        return $query->where('task_id', $taskId);
    }
}
