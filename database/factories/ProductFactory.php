<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = fake()->name;
        $slug = Str::slug($name);
        $arrayCategoryIds = ProductCategory::all()->pluck('id');//select id from product
        $productCategoryId = fake()->randomElement($arrayCategoryIds);
        return [
            'product_category_id'=>$productCategoryId,
            'slug'=>$slug,
            'name'=>$name,
            'price'=>fake()->numberBetween(10,1000),
            'discount_price'=> fake()->numberBetween(10,1000),
            'short_desscription' => fake()->text,
            'qty'=> fake()->numberBetween(10,100),
            'shipping'=> fake()->text,
            'weight'=> fake()->numberBetween(10,1000),
            'description'=> fake()->text,
            'information'=> fake()->text,
            'image_url'=> 'empty',
            'status' => fake()->numberBetween(10,1000)
        ];
    }
}
