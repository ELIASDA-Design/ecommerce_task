<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random_float = fake()->randomFloat(2,5,200);
        $random_string_float = strval($random_float);

        $random_quantity = fake()->numberBetween(0,1000);
        $random_string_quantity = strval($random_quantity);
        return [
            "name" => fake()->word() . " " . fake()->word(),
            "price" => $random_string_float,
            "stock_quantity" => $random_string_quantity,
        ];
    }
}
