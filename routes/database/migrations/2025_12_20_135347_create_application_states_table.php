<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create application_states table
        if (!Schema::hasTable('application_states')) {
            Schema::create('application_states', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // e.g., "Pending", "Under Review", "Approved", "Rejected"
                $table->string('color', 50)->nullable(); // e.g., "success", "warning", "danger"
                $table->text('description')->nullable();
                $table->timestamps();
            });

            // Insert default states
            DB::table('application_states')->insert([
                [
                    'name' => 'Pending',
                    'color' => 'warning',
                    'description' => 'Application received and pending review',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Under Review',
                    'color' => 'info',
                    'description' => 'Application is currently being reviewed',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Approved',
                    'color' => 'success',
                    'description' => 'Application has been approved',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Rejected',
                    'color' => 'danger',
                    'description' => 'Application has been rejected',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Shortlisted',
                    'color' => 'primary',
                    'description' => 'Candidate has been shortlisted for interview',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Interview Scheduled',
                    'color' => 'info',
                    'description' => 'Interview has been scheduled',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Withdrawn',
                    'color' => 'secondary',
                    'description' => 'Application has been withdrawn by applicant',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_states');
    }
};
