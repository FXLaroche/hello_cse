<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class ProfileFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /* Impossible to add random pictures as the picture source for the faker is down and has not been replaced */
        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'status' => fake()->randomElement(['inactive', 'awaiting', 'active']),
        ];
    }
}
