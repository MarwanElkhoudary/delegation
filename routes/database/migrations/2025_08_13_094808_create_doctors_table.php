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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnDelete();
            $table->string('full_name');
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date');
            $table->string('nationality', 100);
            $table->string('phone', 20);
            $table->string('highest_qualification');
            $table->string('granting_university');
            $table->string('degree_granting_country', 100);
            $table->date('date_of_graduation');
            $table->integer('clinical_experience_years')->default(0);
            $table->text('countries_previously_served')->nullable();
            $table->text('previous_employers')->nullable();
            $table->boolean('disaster_experience')->default(false);
            $table->text('disaster_experience_description')->nullable();
            $table->boolean('volunteer_experience')->default(false);
            $table->text('volunteer_experience_description')->nullable();
            $table->boolean('visited_gaza')->default(false);
            $table->text('place_of_work_previous_visit')->nullable();
            $table->text('educational_contributions')->nullable();
            $table->text('published_scientific_papers')->nullable();
            $table->text('conference_participation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
