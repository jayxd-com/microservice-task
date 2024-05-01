<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class UserAdminTest extends TestCase
{

    /** @test */
    use DatabaseTransactions;

    public function testAdminCanCreateUser()
    {
        // Ensure that your user factory setup matches the expected 'admin' attributes
        $admin = User::factory()->create([
            'role_id' => 1, // Assuming role_id 1 is the Admin role
            'password' => Hash::make('password') // Example; adjust as needed
        ]);

        // Simulating admin login using Passport
        Passport::actingAs($admin);

        // Post request to create a new user
        $response = $this->postJson('/api/user', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password', // Normally you'd hash this in your actual app controller
            'password_confirmation' => 'password',
            'role_id' => rand(1,3) // Any role
        ]);

        // Assertions
        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function testAdminCanUpdateUser()
    {
        $admin = User::factory()->create(['role_id' => 1]);
        $user = User::factory()->create();

        Passport::actingAs($admin);

        $updateData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => 'newpassword', // Assume your controller handles hashing
            'password_confirmation' => 'newpassword'
        ];

        $response = $this->putJson('/api/user/' . $user->id, $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com'
        ]);
    }

    public function testAdminCanDeleteUser()
    {
        $admin = User::factory()->create(['role_id' => 1]);
        $user = User::factory()->create();

        Passport::actingAs($admin);

        $response = $this->deleteJson('/api/user/' . $user->id);

        $response->assertStatus(200); // Assuming no content is returned
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

}
