<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 *
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->jobTitle(),
            'specialty_code' => fake()->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'start_date' => $start_date = fake()->dateTimeBetween('now', '+1 year')->format('d-m-Y'),
            'finish_date' => fake()->dateTimeBetween($start_date, '+2 years')->format('d-m-Y'),
            'active' => fake()->boolean(80), // 80% activos
            'theorical_hours' => fake()->numberBetween(180, 500),
            'practice_hours' => fake()->numberBetween(30, 100),

        ];
    }
}
