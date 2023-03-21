<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => mt_rand(13,25),
            'position_id' => mt_rand(1,4),
            'division_id' => mt_rand(1,3),
            'phone' => $this->faker->phoneNumber(),
            'join_at' => now()
        ];
    }
    
}