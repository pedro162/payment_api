<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroceryList>
 */
class GroceryListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(50),
            'total_gros_price' => $tot = fake()->randomNumber(2),
            'total_discount_amount' => $discount = fake()->randomNumber(2),
            'total_net_price' => $net = fake()->randomNumber(2),
            'users_create_id' => User::factory(),
            'users_update_id' => null,
        ];
    }
}
