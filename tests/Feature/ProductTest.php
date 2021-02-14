<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Faker\Factory;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_displaying_product_page()
    {
        $product = Product::first();

        $response = $this->get("product/{$product->id}");

        $response->assertStatus(200)
            ->assertViewIs('product.show')
            ->assertSee($product->title)
            ->assertSee($product->price)
            ->assertSee($product->docket);
    }

    public function test_unable_to_update_product_with_invalid_data()
    {
        $user = User::factory()->create();
        $product = Product::first();
        $faker = Factory::create('en_US');

        $response = $this->actingAs($user)->put("product/{$product->id}", [
            'title' => '',
            'brand' => $faker->sentence(69),
            'price' => 'LinkUp',
            'docket' => $faker->sentence(777)
        ]);

        $response->assertSessionHasErrors(['title', 'brand', 'price', 'docket'])
            ->assertRedirect("product/{$product->id}/edit");
    }

    public function test_successful_update_product_with_valid_data()
    {
        $user = User::factory()->create();
        $product = Product::first();

        $response = $this->actingAs($user)->put("product/{$product->id}", $product->toArray());

        $response->assertStatus(302)->assertRedirect("product/{$product->id}");
    }

    public function test_unable_to_delete_product_without_auth()
    {
        $response = $this->delete("product/1");
        $response->assertRedirect("login");
    }
}
