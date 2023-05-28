<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryAssets>
 */
class CategoryAssetsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->firstName(),
            'user_create' => rand(1,100),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
    }
}
