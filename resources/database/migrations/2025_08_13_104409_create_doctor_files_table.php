<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctor_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->string('file_path')->comment('Path to the uploaded file (e.g., uploads/doctor_files/12345.pdf)');
            $table->string('file_name')->comment('Original file name (e.g., certificate.pdf)');
            $table->integer('file_size')->comment('File size in bytes');
            $table->string('file_type', 100)->comment('File MIME type (e.g., application/pdf)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_files');
    }
};
