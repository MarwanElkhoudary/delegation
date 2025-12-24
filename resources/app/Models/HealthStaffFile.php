<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HealthStaffFile extends Model
{
    use HasFactory;

    protected $table = 'health_staff_files';

    protected $fillable = [
        'health_staff_id',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    // Relationships
    public function healthStaff()
    {
        return $this->belongsTo(HealthStaff::class, 'health_staff_id');
    }

    // Accessors
    public function getFileSizeHumanAttribute()
    {
        $bytes = $this->file_size;

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    public function getFileExtensionAttribute()
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }

    // Methods
    public function deleteFile()
    {
        if (Storage::disk('public')->exists($this->file_path)) {
            Storage::disk('public')->delete($this->file_path);
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($file) {
            $file->deleteFile();
        });
    }
}
