<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Authenticatable implements AuthenticatableContract{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
        'hospital_id',
        'human_type_id'
    ];


    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function hospital(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
    public function humanType() {
        return $this->belongsTo(HumanType::class, 'human_type_id');
    }
}
