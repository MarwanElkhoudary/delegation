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
            // تحقق إذا العمود user_id مش موجود
            if (!Schema::hasColumn('health_staff', 'user_id')) {
                // إضافة user_id بعد id مباشرة
                $table->unsignedBigInteger('user_id')->nullable()->after('id');

                // إضافة foreign key للربط مع جدول users
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            }

            // ملاحظة: email موجود مسبقاً في الجدول، لا حاجة لإضافته
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('health_staff', function (Blueprint $table) {
            // حذف الـ foreign key أولاً
            if (Schema::hasColumn('health_staff', 'user_id')) {
                $table->dropForeign(['user_id']);

                // ثم حذف user_id
            }

            // لا نحذف email لأنه كان موجود مسبقاً
        });
    }
};
