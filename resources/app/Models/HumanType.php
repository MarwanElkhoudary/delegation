<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HumanType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function specifications()
    {
        return $this->hasMany(specifications::class, 'human_type_id');
    }

}
