<?php

namespace Database\Factories;

use App\Models\GroceryList;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroceryListItem>
 */
class GroceryListItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => $quantity = rand(1, 100),
            'unit_gross_price' => $unitPrice = fake()->randomFloat(2, 1, 100),
            'total_gros_price' => $unitPrice * $quantity,
            'unit_net_price' => $unitPrice,
            'total_net_price' => $unitPrice,
            'unit_discount_amount' => 0,
            'total_discount_amount' => 0,
            'grocery_list_id' => GroceryList::factory(),
            'product_id' => Product::factory(),
            'users_create_id' => User::factory(),
            'users_update_id' => null,
        ];
    }
}
