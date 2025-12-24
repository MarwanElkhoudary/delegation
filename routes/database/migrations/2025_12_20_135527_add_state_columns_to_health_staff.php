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
        // Add new columns to health_staff table
        if (Schema::hasTable('health_staff')) {

            // Add state_application column (foreign key to application states table)
            if (!Schema::hasColumn('health_staff', 'state_application')) {
                DB::statement('ALTER TABLE `health_staff` ADD COLUMN `state_application` bigint unsigned NULL AFTER `application_status`');
            }

            // Add reason column
            if (!Schema::hasColumn('health_staff', 'reason')) {
                DB::statement('ALTER TABLE `health_staff` ADD COLUMN `reason` text NULL AFTER `state_application`');
            }

            // Add state_date column
            if (!Schema::hasColumn('health_staff', 'state_date')) {
                DB::statement('ALTER TABLE `health_staff` ADD COLUMN `state_date` timestamp NULL AFTER `reason`');
            }

            // Add index for state_application
            $indexes = DB::select("SHOW INDEX FROM health_staff WHERE Key_name = 'health_staff_state_application_foreign'");
            if (empty($indexes)) {
                DB::statement('ALTER TABLE `health_staff` ADD INDEX `health_staff_state_application_foreign` (`state_application`)');
            }

            // Add foreign key to application_states table (if it exists)
            // Note: Uncomment this after creating the application_states table
            /*
            try {
                DB::statement('ALTER TABLE `health_staff` ADD CONSTRAINT `health_staff_state_application_foreign` FOREIGN KEY (`state_application`) REFERENCES `application_states` (`id`) ON DELETE SET NULL');
            } catch (\Exception $e) {
                // Foreign key might already exist or referenced table doesn't exist
            }
            */
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('health_staff')) {
            // Drop foreign key if exists
            try {
                DB::statement('ALTER TABLE `health_staff` DROP FOREIGN KEY IF EXISTS `health_staff_state_application_foreign`');
            } catch (\Exception $e) {
                // Foreign key might not exist
            }

            // Drop columns
            if (Schema::hasColumn('health_staff', 'state_application')) {
                DB::statement('ALTER TABLE `health_staff` DROP COLUMN `state_application`');
            }

            if (Schema::hasColumn('health_staff', 'reason')) {
                DB::statement('ALTER TABLE `health_staff` DROP COLUMN `reason`');
            }

            if (Schema::hasColumn('health_staff', 'state_date')) {
                DB::statement('ALTER TABLE `health_staff` DROP COLUMN `state_date`');
            }
        }
    }
};
