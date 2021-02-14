<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function test_redirect_from_root_to_category_page()
    {
        $category = Category::first();

        $response = $this->get('/');

        $response->assertRedirect("/category/{$category->rozetka_id}");
    }

    public function test_displaying_of_products_on_category_page()
    {
        $category = Category::first();
        $products = $category->products()->take(10)->get();

        $response = $this->get("/category/{$category->rozetka_id}");

        $response->assertStatus(200)->assertViewIs('category.show');
        foreach ($products as $product) {
            $response->assertSee($product->title);
        }
    }
}
