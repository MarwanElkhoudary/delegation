<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'human_type_id',
    ];
    public function humanType()
    {
        return $this->belongsTo(HumanType::class);
    }

    public function medicalNeed()
    {
        return $this->hasMany(MedicalNeed::class);
    }



}
