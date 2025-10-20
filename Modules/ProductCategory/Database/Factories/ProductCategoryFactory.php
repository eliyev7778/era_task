<?php

namespace Modules\ProductCategory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\ProductCategory\App\Models\ProductCategory::class;

    /**
     * Define the model's default state.
     */

    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'status' => $this->faker->boolean(90),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

