<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddtionalTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_logged_in_user_can_visit_site()
    {
        $users = User::factory(5)->create();
        $user = $users->first();
        $this->actingAs($user);

        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
