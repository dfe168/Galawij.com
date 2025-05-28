<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_home_page_is_up(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_about_page_is_up(): void
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
    }

    public function test_gallery_page_is_up(): void
    {


        $response = $this->get('/gallery');

        $response->assertStatus(200);
    }

    public function test_contact_page_is_up(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }
}
