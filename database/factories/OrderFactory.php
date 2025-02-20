<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'product_id' => Product::inRandomOrder()->value('id'),
            'quantity' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['Новый', 'Выполнен']),
            'comment' => $this->faker->sentence,
        ];
    }
}
