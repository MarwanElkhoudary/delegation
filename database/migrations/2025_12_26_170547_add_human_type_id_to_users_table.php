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
        Schema::table('users', function (Blueprint $table) {
            // Add human_type_id as foreign key
            $table->foreignId('human_type_id')
                ->nullable()
                ->after('role_id')
                ->constrained('human_types')
                ->nullOnDelete();

            // Add email field if not exists
            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email')->nullable()->unique()->after('username');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['human_type_id']);
            $table->dropColumn('human_type_id');
        });
    }
};
