<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\ProductCategory\App\Models\ProductCategory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Product\App\Models\Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $category = ProductCategory::inRandomOrder()->first();

        return [
            'name' => $this->faker->unique()->words(3, true),
            'sku' => strtoupper(Str::random(8)),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 5, 500),
            'stock' => $this->faker->numberBetween(0, 100),
            'discontinued' => $this->faker->boolean(10),
            'category_id' => $category ? $category->id : null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

