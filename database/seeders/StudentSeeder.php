<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Student::factory()->create([
            'name' => 'Peter Eriksson',
            'batch_name' => '2010'
        ]);
        Student::factory()->create([
            'name' => 'Jane Austin',
            'batch_name' => '2014'
        ]);
        Student::factory()->create([
            'name' => 'Charles Best',
            'batch_name' => '2015'
        ]);
        Student::factory()->create([
            'name' => 'Elizabeth Bennet',
            'batch_name' => '2020'
        ]);
    }
}
