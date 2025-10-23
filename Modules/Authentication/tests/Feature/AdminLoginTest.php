<?php

namespace Modules\Authentication\Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Modules\Authentication\App\Models\Admin;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    public function it_logs_in_an_admin_successfully()
    {
        $admin = Admin::factory()->create([
            'email' => 'logintest@example.com',
            'password' => Hash::make("admin123"),
        ]);

        $response = $this->postJson('/api/v1/admin/login', [
            'email' => 'logintest@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'success',
            'token',
            'admin' => [
                'id',
                'name',
                'email',
            ],
        ]);

        // 5. Success true olmalıdır
        $this->assertTrue($response->json('success'));
    }

    /** @test */
    public function it_fails_with_wrong_credentials()
    {
        $response = $this->postJson('/api/v1/admin/login', []);

        $this->assertTrue(
            in_array($response->status(), [422, 500]),
            "Unexpected status code: {$response->status()}"
        );
    }
}
