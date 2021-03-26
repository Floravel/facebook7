<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RetrievePostTest extends TestCase
{
    /** @test*/
    public function a_user_can_retrieve_posts()
    {
        $this->actingAs(User::factory()->create());
        $posts = factory(Post::factory(2)->create());

        $response = $this->get('/posts');
        $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'type' => 'posts',
                'post_id' => $posts->first()->id,
                'attributes' => [
                    'body' => $posts->first()->body
                ]
            ]
        ]);
    }
}
