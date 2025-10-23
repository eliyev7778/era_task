<?php

namespace Modules\Campaign\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Campaign\App\Models\Campaign;
use Modules\Segment\App\Models\Segment;

class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'subject' => $this->faker->sentence(6),
            'template_key' => $this->faker->randomElement(['promotion', 'discount']),
            'from_email' => $this->faker->optional()->safeEmail(),
            'segment_id' => Segment::inRandomOrder()->first()?->id,
            'filter_json' => null,
            'status' => 'draft',
            'total_recipients' => 0,
            'sent_count' => 0,
            'error_count' => 0,
        ];
    }
}
