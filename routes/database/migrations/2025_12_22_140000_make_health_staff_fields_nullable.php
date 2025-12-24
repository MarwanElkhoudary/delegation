<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // تعديل الأعمدة لتكون nullable
        DB::statement('ALTER TABLE health_staff MODIFY full_name VARCHAR(255) NULL');
        DB::statement('ALTER TABLE health_staff MODIFY birth_date DATE NULL');
        DB::statement('ALTER TABLE health_staff MODIFY nationality VARCHAR(100) NULL');
        DB::statement('ALTER TABLE health_staff MODIFY phone VARCHAR(20) NULL');
        DB::statement('ALTER TABLE health_staff MODIFY highest_qualification VARCHAR(255) NULL');
        DB::statement('ALTER TABLE health_staff MODIFY granting_university VARCHAR(255) NULL');
        DB::statement('ALTER TABLE health_staff MODIFY degree_granting_country VARCHAR(100) NULL');
        DB::statement('ALTER TABLE health_staff MODIFY date_of_graduation DATE NULL');
        DB::statement('ALTER TABLE health_staff MODIFY specialization_id BIGINT UNSIGNED NULL');
    }

    public function down(): void
    {
        // عكس العملية
        DB::statement('ALTER TABLE health_staff MODIFY full_name VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE health_staff MODIFY birth_date DATE NOT NULL');
        DB::statement('ALTER TABLE health_staff MODIFY nationality VARCHAR(100) NOT NULL');
        DB::statement('ALTER TABLE health_staff MODIFY phone VARCHAR(20) NOT NULL');
        DB::statement('ALTER TABLE health_staff MODIFY highest_qualification VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE health_staff MODIFY granting_university VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE health_staff MODIFY degree_granting_country VARCHAR(100) NOT NULL');
        DB::statement('ALTER TABLE health_staff MODIFY date_of_graduation DATE NOT NULL');
        DB::statement('ALTER TABLE health_staff MODIFY specialization_id BIGINT UNSIGNED NOT NULL');
    }
};
