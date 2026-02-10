<?php

namespace Tests\Feature;

use App\Models\Products;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_access_product_create_page(): void
    {
        $user = User::factory()->create(['is_admin' => 0]);

        $response = $this->actingAs($user)->get('/products/create');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_product_create_page(): void
    {
        $admin = User::factory()->create(['is_admin' => 1]);

        $response = $this->actingAs($admin)->get('/products/create');

        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_create_product(): void
    {
        $user = User::factory()->create(['is_admin' => 0]);

        $payload = [
            'sku' => 'SKU-10001',
            'name' => 'Test Product',
            'price' => 99.99,
            'stock' => 10,
            'status' => 'active',
        ];

        $response = $this->actingAs($user)->post('/products', $payload);

        $response->assertStatus(403);
    }

    public function test_admin_can_create_product_and_created_by_is_set(): void
    {
        $admin = User::factory()->create(['is_admin' => 1]);

        $payload = [
            'sku' => 'SKU-20001',
            'name' => 'Admin Product',
            'price' => 199.99,
            'stock' => 5,
            'status' => 'active',
        ];

        $response = $this->actingAs($admin)->post('/products', $payload);

        $response->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'sku' => 'SKU-20001',
            'created_by' => $admin->id,
        ]);
    }

    public function test_owner_can_update_their_product(): void
    {
        $owner = User::factory()->create(['is_admin' => 0]);

        $product = Products::factory()->create([
            'created_by' => $owner->id,
            'name' => 'Old Name',
        ]);

        $response = $this->actingAs($owner)->patch("/products/{$product->id}", [
            'sku' => $product->sku,
            'name' => 'New Name',
            'price' => $product->price,
            'stock' => $product->stock,
            'status' => 'active',
        ]);

        $response->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'New Name',
        ]);
    }

        public function test_non_owner_cannot_update_someone_elses_product(): void
        {
            $owner = User::factory()->create(['is_admin' => 0]);
            $other = User::factory()->create(['is_admin' => 0]);

            $product = Products::factory()->create([
                'created_by' => $owner->id,
                'name' => 'Owner Product',
            ]);

            $response = $this->actingAs($other)->patch("/products/{$product->id}", [
                'sku' => $product->sku,
                'name' => 'Hacked Name',
                'price' => $product->price,
                'stock' => $product->stock,
                'status' => 'active',
            ]);

            $response->assertStatus(403);
        }

        public function test_admin_can_update_any_product(): void
        {
            $owner = User::factory()->create(['is_admin' => 0]);
            $admin = User::factory()->create(['is_admin' => 1]);

            $product = Products::factory()->create([
                'created_by' => $owner->id,
                'name' => 'Owner Product',
            ]);

            $response = $this->actingAs($admin)->patch("/products/{$product->id}", [
                'sku' => $product->sku,
                'name' => 'Admin Updated',
                'price' => $product->price,
                'stock' => $product->stock,
                'status' => 'active',
            ]);

            $response->assertRedirect('/products');

            $this->assertDatabaseHas('products', [
                'id' => $product->id,
                'name' => 'Admin Updated',
            ]);
        }

        public function test_admin_can_soft_delete_and_restore_product(): void
        {
            $admin = User::factory()->create(['is_admin' => 1]);

            $product = Products::factory()->create(['created_by' => $admin->id]);

            $this->actingAs($admin)->delete("/products/{$product->id}")
                ->assertRedirect('/products');

            $this->assertSoftDeleted('products', ['id' => $product->id]);

            $this->actingAs($admin)->patch("/products/{$product->id}/restore")
                ->assertRedirect('/products'); // match your controller redirect

            $this->assertDatabaseHas('products', [
                'id' => $product->id,
                'deleted_at' => null,
            ]);
        }

        public function test_admin_can_soft_delete_and_force_delete_product(): void
        {
            $admin = User::factory()->create(['is_admin' => 1]);

            $product = Products::factory()->create(['created_by' => $admin->id]);

            $this->actingAs($admin)->delete("/products/{$product->id}")
                ->assertRedirect('/products');

            $this->assertSoftDeleted('products', ['id' => $product->id]);

            $this->actingAs($admin)->delete("/products/{$product->id}/permanentdelete")
                ->assertRedirect('/products/trash'); // adjust if your controller redirects elsewhere

            $this->assertDatabaseMissing('products', ['id' => $product->id]);
        }

}
