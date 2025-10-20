<?php

namespace Modules\Segment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PivotProductUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Segment\App\Models\PivotProductUser::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

