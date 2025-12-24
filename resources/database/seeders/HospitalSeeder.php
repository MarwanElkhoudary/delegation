<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Hospital::create( ['name' => 'Nasser Medical Complex'] );
        Hospital::create( ['name' => 'Gaza European Hospital'] );
        Hospital::create( ['name' => 'Al-Aqsa Martyrs Hospital'] );

    }
}
