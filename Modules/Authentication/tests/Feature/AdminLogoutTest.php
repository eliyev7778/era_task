<?php

namespace Modules\Authentication\Tests\Feature;

use Laravel\Passport\Passport;
use Tests\TestCase;
use Modules\Authentication\App\Models\Admin;

class AdminLogoutTest extends TestCase
{

    /** @test */
    public function it_logs_out_an_authenticated_admin()
    {
        $admin = Admin::factory()->create();
        Passport::actingAs($admin, ['*'], 'admin');
        $response = $this->postJson('/api/v1/admin/logout');
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
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
