<?php

namespace Database\Factories;
use App\Models\Category;
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
       
        $imagePath = 'public/images';
        $imageFilename = fake()->image($imagePath, 200, 200, 'category', false);
        return [
        'name' => fake()->word,
        'price'=> fake()->randomFloat(2, 1, 100),
        'image' => $imageFilename,
        'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
