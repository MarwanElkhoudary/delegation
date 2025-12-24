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
        Schema::table('health_staff', function (Blueprint $table) {
            // حذف الحقول المكررة من نظام authentication القديم
            // هذه الحقول موجودة في جدول users ولا حاجة لتكرارها

            if (Schema::hasColumn('health_staff', 'username')) {
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('health_staff', function (Blueprint $table) {
            // إرجاع الحقول في حالة الـ rollback
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
        });
    }
};
