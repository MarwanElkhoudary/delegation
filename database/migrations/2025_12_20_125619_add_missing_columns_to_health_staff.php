<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('health_staff')) {

            // Add human_type_id
            if (!Schema::hasColumn('health_staff', 'human_type_id')) {
                DB::statement('ALTER TABLE `health_staff` ADD COLUMN `human_type_id` bigint unsigned NULL AFTER `task_id`');
            }

            // Add specialization_id
            if (!Schema::hasColumn('health_staff', 'specialization_id')) {
                DB::statement('ALTER TABLE `health_staff` ADD COLUMN `specialization_id` bigint unsigned NULL AFTER `human_type_id`');
            }

            // Add application_status
            if (!Schema::hasColumn('health_staff', 'application_status')) {
                DB::statement('ALTER TABLE `health_staff` ADD COLUMN `application_status` enum("pending","approved","rejected") NOT NULL DEFAULT "pending" AFTER `conference_participation`');
            }

            // Modify columns
            DB::statement('ALTER TABLE `health_staff` MODIFY COLUMN `gender` tinyint NULL COMMENT "1=Male, 2=Female"');
            DB::statement('ALTER TABLE `health_staff` MODIFY COLUMN `disaster_experience` varchar(3) NULL COMMENT "yes or no"');
            DB::statement('ALTER TABLE `health_staff` MODIFY COLUMN `volunteer_experience` varchar(3) NULL COMMENT "yes or no"');
            DB::statement('ALTER TABLE `health_staff` MODIFY COLUMN `visited_gaza` varchar(3) NULL COMMENT "yes or no"');

            // Add indexes
            $indexes = DB::select("SHOW INDEX FROM health_staff WHERE Key_name = 'health_staff_human_type_id_foreign'");
            if (empty($indexes)) {
                DB::statement('ALTER TABLE `health_staff` ADD INDEX `health_staff_human_type_id_foreign` (`human_type_id`)');
            }

            $indexes = DB::select("SHOW INDEX FROM health_staff WHERE Key_name = 'health_staff_specialization_id_foreign'");
            if (empty($indexes)) {
                DB::statement('ALTER TABLE `health_staff` ADD INDEX `health_staff_specialization_id_foreign` (`specialization_id`)');
            }

            // Add foreign keys
            try {
                DB::statement('ALTER TABLE `health_staff` ADD CONSTRAINT `health_staff_human_type_id_foreign` FOREIGN KEY (`human_type_id`) REFERENCES `human_types` (`id`) ON DELETE CASCADE');
            } catch (\Exception $e) {}

            try {
                DB::statement('ALTER TABLE `health_staff` ADD CONSTRAINT `health_staff_specialization_id_foreign` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`) ON DELETE CASCADE');
            } catch (\Exception $e) {}
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('health_staff')) {
            if (Schema::hasColumn('health_staff', 'human_type_id')) {
                try {
                    DB::statement('ALTER TABLE `health_staff` DROP FOREIGN KEY `health_staff_human_type_id_foreign`');
                } catch (\Exception $e) {}
                DB::statement('ALTER TABLE `health_staff` DROP COLUMN `human_type_id`');
            }

            if (Schema::hasColumn('health_staff', 'specialization_id')) {
                try {
                    DB::statement('ALTER TABLE `health_staff` DROP FOREIGN KEY `health_staff_specialization_id_foreign`');
                } catch (\Exception $e) {}
                DB::statement('ALTER TABLE `health_staff` DROP COLUMN `specialization_id`');
            }

            if (Schema::hasColumn('health_staff', 'application_status')) {
                DB::statement('ALTER TABLE `health_staff` DROP COLUMN `application_status`');
            }
        }
    }
};
