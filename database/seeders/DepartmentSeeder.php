<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Department::factory()->create([
            'name' => 'Physics'
        ]);
        Department::factory()->create([
            'name' => 'Chemistry'
        ]);
        Department::factory()->create([
            'name' => 'Biology'
        ]);
        Department::factory()->create([
            'name' => 'Mathematics'
        ]);
        Department::factory()->create([
            'name' => 'Accounting'
        ]);
    }
}
