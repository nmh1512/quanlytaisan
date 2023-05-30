<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeAssets>
 */
class TypeAssetsFactory extends Factory
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
            'category_asset_id' => rand(1,100),
            'model' => Str::random(32),
            'brand' => fake()->company(),
            'year_create' => fake()->year(),
            'unit' => fake()->lastName(),
            'image' => fake()->image(),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
    }
}
