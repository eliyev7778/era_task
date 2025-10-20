<?php

namespace Modules\ProductCategory\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\ProductCategory\App\Models\ProductCategory;

class ProductCategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::factory()->count(50)->create();
    }
}
