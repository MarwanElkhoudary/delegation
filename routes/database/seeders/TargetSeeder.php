<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('targets')->insert([
            ['name' => 'General Surgery'],
            ['name' => 'Orthopedic Surgery'],
            ['name' => 'Plastic Surgery'],
            ['name' => 'Cardiothoracic surgery'],
            ['name' => 'Neurosurgery'],
            ['name' => 'Pediatric surgery'],
            ['name' => 'Vascular surgery'],
            ['name' => 'Accident and emergency medicine'],
            ['name' => 'Intensive care medicine'],
            ['name' => 'Anesthesiology'],
            ['name' => 'Oral and maxillofacial surgery'],
            ['name' => 'Urology'],
        ]);
    }
}
