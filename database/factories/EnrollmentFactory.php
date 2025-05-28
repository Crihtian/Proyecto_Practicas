<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $student_id = Student::inRandomOrder()->first()->id;
        $course_id = Course::inRandomOrder()->first()->id;

        return [
            'enrollment_date' => fake()->dateTimeBetween('-2 year', 'now')->format('d-m-Y'),
            'student_id' => $student_id,
            'course_id' => $course_id,
        ];
    }
}
