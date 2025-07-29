<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
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
             'name' => fake()->slug,
            'desc' => fake()->paragraph,
            'duration' => fake()->time(),
            'price' => fake()->randomFloat(2, 10, 200),
            'is_avaliable' => true,
        ];
    }
}
