<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 *
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dni_letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $nie_first_letters = 'XYZ';  // Letras válidas para NIE

        // 50% probabilidad de DNI, 50% de NIE
        $isNIE = fake()->boolean();

        if ($isNIE) {
            $idcard = sprintf("%s%07d%s",
                $nie_first_letters[fake()->numberBetween(0, 2)],  // X, Y o Z
                fake()->numberBetween(0000000, 9999999),  // 7 números
                $dni_letters[fake()->numberBetween(0, 22)]  // Letra final
            );
        } else {
            $idcard = sprintf("%08d%s",
                fake()->numberBetween(10000000, 99999999),  // 8 números
                $dni_letters[fake()->numberBetween(0, 22)]  // Letra final
            );
        }

        return [
            'name' => substr(fake()->firstName(), 0, 100),
            'lastname' => substr(fake()->lastName(), 0, 100),
            'idcard' => $idcard,
            'email' => fake()->unique()->safeEmail(),
            'birthday' => fake()->dateTimeBetween('-50 years', '-16 years')->format('d-m-Y'), // Fecha de nacimiento entre 18 y 50 años atrás
            'disability' => fake()->boolean(20), // 20% de probabilidad de tener discapacidad
            'address' => fake()->address(), // La dirección es requerida
        ];
    }
}
