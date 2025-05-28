<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'email' => 'cristian.lopez@dicampus.com',
            'password' => bcrypt('password'),
        ]);
        Student::factory(10)->create();
        Course::factory(10)->create();
        Enrollment::factory(6)->create();
    }
}
