<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProductFactory extends Factory
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
        return [
            'sku' => 'pr_' . Str::uuid(),
            'name' => fake()->words(rand(2,4), true) . ' Product',
            'description' => fake()->text(),
            'price' => rand(5,999) . '.' . rand(0,9) . rand(0,9),
            'quantity' => rand(1,99)
        ];
    }
}
