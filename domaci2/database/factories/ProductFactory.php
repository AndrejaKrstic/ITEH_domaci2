<?php

namespace Database\Factories;

use App\Models\ProductType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition()
    {
        $decimals = 2;
        $min = 20;
        $max = 2000;
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat($decimals,$min,$max),
            'user_id' => User::factory(), 
            'product_type' => ProductType::factory(), 
        ];
    }
}