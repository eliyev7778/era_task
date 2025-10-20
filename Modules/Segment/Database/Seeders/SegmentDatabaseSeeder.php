<?php

namespace Modules\Segment\Database\Seeders;

use Illuminate\Database\Seeder;

class SegmentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call([PivotProductUserSeeder::class]);
    }
}
