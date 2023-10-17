<?php

namespace Database\Factories;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model
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
       
        return [
            //
            'name' => fake()->name(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
             'image' => $this->faker->image(public_path('images/products_images'),400,300, null, false),
 
        ];
    }
}
