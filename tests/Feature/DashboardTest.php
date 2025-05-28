<?php

namespace Tests\Feature;

use App\Models\Paintings;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    private $user;


    public function setup(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * A basic feature test example.
     */
    public function test_dashboard_is_up(): void
    {
        $this->actingAs($this->user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_add_new_painting_page_is_up()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('dashboard.add'));

        $response->assertStatus(200);
    }

    public function test_contact_messages_page_is_up()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('dashboard.contacts'));

        $response->assertStatus(200);
    }

    public function test_register_new_admin_page_is_up()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('dashboard.register'));

        $response->assertStatus(200);
    }

    public function test_user_profile_page_is_up()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('dashboard.user'));

        $response->assertStatus(200);
    }

    public function test_dashboard_paintings_are_loaded(): void
    {
        $this->actingAs($this->user);
        Paintings::factory(5)->create();

        $response = $this->get(route('dashboard.home'));

        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Dashboard/Home')->has('paintings.data', 5);
        });
    }

    public function test_user_can_add_new_painting()
    {
        $this->actingAs($this->user);

        $fakeImg = UploadedFile::fake()->image('test.jpg');
        $data = [
            'name' => 'Test Painting',
            'medium' => 'Oil',
            'width' => 40,
            'length' => 60,
            'img' => $fakeImg,
        ];
        $response = $this->post(route('paintings.create'), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('paintings', [
            'name' => 'Test Painting',
            'medium' => 'Oil',
            'width' => 40,
            'length' => 60,
            'img' => 'test.jpg'
        ]);
    }
}
