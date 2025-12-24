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
        // تحقق من وجود الأعمدة قبل الإضافة
        $columns = Schema::getColumnListing('health_staff');
        
        if (!in_array('email', $columns)) {
            Schema::table('health_staff', function (Blueprint $table) {
                $table->string('email')->nullable()->after('phone');
            });
        }
        
        if (!in_array('username', $columns)) {
            Schema::table('health_staff', function (Blueprint $table) {
                $table->string('username')->nullable()->after('email');
            });
        }
        
        if (!in_array('password', $columns)) {
            Schema::table('health_staff', function (Blueprint $table) {
                $table->string('password')->nullable()->after('username');
            });
        }
        
        if (!in_array('remember_token', $columns)) {
            Schema::table('health_staff', function (Blueprint $table) {
                $table->rememberToken()->after('password');
            });
        }
        
        if (!in_array('email_verified_at', $columns)) {
            Schema::table('health_staff', function (Blueprint $table) {
                $table->timestamp('email_verified_at')->nullable()->after('remember_token');
            });
        }

        // تحديث الصفوف القديمة
        $existingRecords = DB::table('health_staff')
            ->where(function($query) {
                $query->whereNull('email')
                      ->orWhere('email', '');
            })
            ->get();

        foreach ($existingRecords as $record) {
            DB::table('health_staff')
                ->where('id', $record->id)
                ->update([
                    'email' => 'old_applicant_' . $record->id . '@temp.local',
                    'username' => 'old_applicant_' . $record->id,
                    'password' => bcrypt('temporary_password_' . $record->id),
                ]);
        }

        // إضافة unique constraints إذا لم تكن موجودة
        $indexes = DB::select("SHOW INDEX FROM health_staff WHERE Column_name = 'email'");
        if (empty($indexes)) {
            Schema::table('health_staff', function (Blueprint $table) {
                $table->unique('email');
            });
        }
        
        $indexes = DB::select("SHOW INDEX FROM health_staff WHERE Column_name = 'username'");
        if (empty($indexes)) {
            Schema::table('health_staff', function (Blueprint $table) {
                $table->unique('username');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('health_staff', function (Blueprint $table) {
            if (Schema::hasColumn('health_staff', 'email')) {
                $table->dropUnique(['email']);
                $table->dropColumn('email');
            }
            
            if (Schema::hasColumn('health_staff', 'username')) {
                $table->dropUnique(['username']);
                $table->dropColumn('username');
            }
            
            if (Schema::hasColumn('health_staff', 'password')) {
                $table->dropColumn('password');
            }
            
            if (Schema::hasColumn('health_staff', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
            
            if (Schema::hasColumn('health_staff', 'email_verified_at')) {
                $table->dropColumn('email_verified_at');
            }
        });
    }
};
