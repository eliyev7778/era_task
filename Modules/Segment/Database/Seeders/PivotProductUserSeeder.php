<?php

namespace Modules\Segment\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Product\App\Models\Product;
use Modules\Segment\App\Models\PivotProductUser;

class PivotProductUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['purchased', 'wishlisted', 'subscribed'];
        $users = User::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();

        foreach (range(1, 1000) as $i) {
            PivotProductUser::create([
                'user_id' => fake()->randomElement($users),
                'product_id' => fake()->randomElement($products),
                'type' => fake()->randomElement($types),
            ]);
        }
    }
}
