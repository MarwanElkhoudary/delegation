<?php

namespace Database\Seeders;

use App\Models\HumanType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HumanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        HumanType::create( ['name' => 'Doctors'] );
        HumanType::create( ['name' => 'Nurses'] );
        HumanType::create( ['name' => 'Others'] );
    }
}
