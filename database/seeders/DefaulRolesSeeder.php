<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DefaulRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->create([
            'name'=>'admin',
            'slug'=>'admin'
           ]);
        Role::factory()->create([
            'name'=>'customer',
            'slug'=>'customer'
        ]);
    }
}
