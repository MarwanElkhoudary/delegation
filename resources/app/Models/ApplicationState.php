<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationState extends Model
{
    use HasFactory;

    protected $table = 'application_states';

    protected $fillable = [
        'name',
        'color',
        'description',
    ];

    /**
     * Get all health staff applications with this state
     */
    public function healthStaff()
    {
        return $this->hasMany(HealthStaff::class, 'state_application');
    }
}
