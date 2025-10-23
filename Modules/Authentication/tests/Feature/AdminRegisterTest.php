<?php

namespace Modules\Authentication\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRegisterTest extends TestCase
{
    /** @test */
    public function it_registers_a_new_admin_successfully()
    {
        $data = [
            'name' => 'Test Admin',
            'email' => 'test'.rand(0,99).'@example.com',
            'password' => 'password1234',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/v1/admin/register', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('admins', [
            'email' => 'test@example.com'
        ]);
    }

    /** @test */
    public function it_fails_if_required_fields_are_missing()
    {
        $response = $this->postJson('/api/v1/admin/register', []);

        $this->assertTrue(
            in_array($response->status(), [422, 500]),
            "Unexpected status code: {$response->status()}"
        );
    }
}
