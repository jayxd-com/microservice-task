<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductAdminTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        // Set up routine that runs before each test method
    }

    public function testCreateProduct()
    {
        // Ensure that your user factory setup matches the expected 'admin' attributes
        $admin = User::factory()->create([
            'role_id' => 1, // Assuming role_id 1 is the Admin role
            'password' => Hash::make('password') // Example; adjust as needed
        ]);

        Passport::actingAs($admin);

        $productData = [
            'sku' => 'pr_11786718-8cf7-4a0a-b597-e4cac608ac19',
            'name' => 'Test asas Product',
            'description' => 'Reiciendis qui vitae nam ipsum quo beatae veritatis. Sint voluptatem delectus sed vero quis et. Quia reprehenderit perferendis qui voluptatem dolores. Quisquam culpa quam quaerat nihil ipsam.',
            'price' => 99.99,
            'quantity' => 50
        ];

        $response = $this->postJson('/api/product', $productData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('products', [
            'name' => 'Test asas Product',
            'description' => 'Reiciendis qui vitae nam ipsum quo beatae veritatis. Sint voluptatem delectus sed vero quis et. Quia reprehenderit perferendis qui voluptatem dolores. Quisquam culpa quam quaerat nihil ipsam.',
            'price' => 99.99,
            'quantity' => 50
        ]);
    }

    public function testReadProduct()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $product = Product::factory()->create();

        $response = $this->getJson('/api/product/' . $product->id);
        $response->assertStatus(200);
        $response->assertJson([
            'sku' => $product->sku,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'quantity' => $product->quantity
        ]);
    }

    public function testUpdateProduct()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $product = Product::factory()->create();
        $updatedData = [
            'name' => 'Updated Product Name',
            'price' => 99.99
        ];

        $response = $this->putJson('/api/product/' . $product->id, $updatedData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Name',
            'price' => 99.99
        ]);
    }

    public function testDeleteProduct()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $product = Product::factory()->create();

        $response = $this->deleteJson('/api/product/' . $product->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

}
