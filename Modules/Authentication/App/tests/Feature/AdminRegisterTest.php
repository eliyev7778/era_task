<?php

namespace Modules\Authentication\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_new_admin_successfully()
    {
        $data = [
            'name' => 'Test Admin',
            'email' => 'test@example.com',
            'password' => 'password1234',
            'password_confirmation' => 'password123',
        ];


        $response = $this->postJson('/api/v1/admin/register', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'name',
                    'email'
                ]
            ]);

        $this->assertDatabaseHas('admins', [
            'email' => 'admin@example.com'
        ]);
    }

    /** @test */
    public function it_fails_if_required_fields_are_missing()
    {
        $response = $this->postJson('/api/v1/admin/register', []);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }
}
