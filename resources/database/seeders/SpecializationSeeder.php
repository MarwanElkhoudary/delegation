<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('specializations')->insert([
            ['name' => 'General Surgery', 'human_type_id' => 1],
            ['name' => 'Orthopedic Surgery', 'human_type_id' => 1],
            ['name' => 'Cardiothoracic surgery', 'human_type_id' => 1],
            ['name' => 'Neurosurgery', 'human_type_id' => 1],
            ['name' => 'Vascular surgery', 'human_type_id' => 1],
            ['name' => 'Accident and emergency medicine', 'human_type_id' => 1],
            ['name' => 'Intensive care medicine', 'human_type_id' => 1],
            ['name' => 'Anesthesiology', 'human_type_id' => 1],

            ['name' => 'Burn nursing', 'human_type_id' => 2],
            ['name' => 'Emergency nursing', 'human_type_id' => 2],
            ['name' => 'Wound care', 'human_type_id' => 2],
            ['name' => 'Rehabilitation nursing', 'human_type_id' => 2],

            ['name' => 'Pharmacy technician', 'human_type_id' => 3],
            ['name' => 'Laboratory technician', 'human_type_id' => 3],
            ['name' => 'Radiology technician', 'human_type_id' => 3],
            ['name' => 'Anesthesia technician', 'human_type_id' => 3],
        ]);

    }
}
