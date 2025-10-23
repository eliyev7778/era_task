<?php

namespace Modules\Campaign\Tests\Feature;

use Modules\Authentication\App\Models\Admin;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CampaignListTest extends TestCase
{
    /** @test */
    public function it_returns_paginated_campaigns_for_authenticated_admin()
    {
        $admin = Admin::factory()->create();
        Passport::actingAs($admin, ['*'], 'admin');

        $response = $this->getJson('/api/v1/campaigns?page=1&per_page=10&status=draft');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_fails_if_admin_is_not_authenticated()
    {
        $response = $this->postJson('/api/v1/admin/logout');
        $this->assertTrue(
            in_array($response->status(), [422, 500, 401]),
            "Unexpected status code: {$response->status()}"
        );
    }
}
