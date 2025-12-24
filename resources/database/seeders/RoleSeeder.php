<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create( ['name' => 'Hospital Account'] );
        Role::create( ['name' => 'Hospital Administration Account'] );
//        Role::create( ['name' => 'Role three'] );


    }
}
