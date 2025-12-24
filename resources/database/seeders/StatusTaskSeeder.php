<?php

namespace Database\Seeders;

use App\Models\StatusTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        StatusTask::create(['name' => 'Recently']);
        StatusTask::create(['name' => 'Suspended']);
    }
}
