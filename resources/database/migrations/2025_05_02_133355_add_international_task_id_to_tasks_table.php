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

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignId('international_task_id')
                ->nullable()
                ->constrained('status_international_tasks')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['international_task_id']);
            $table->dropColumn('international_task_id');
        });
    }
};
