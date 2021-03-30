<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RetrievePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test*/
    public function a_user_can_retrieve_posts()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($users = User::factory(3)->create()->first(), 'api');

        $posts = Post::factory(3)->create(['user_id' => $users->id]);

        $response = $this->get('/api/posts/');

        $response->assertStatus(200)
        ->assertJson([
            'data' => [
                [
                    'data' => [
                        'type' => 'posts',
                        'post_id' => $posts->last()->id,
                        'attributes' => [
                            'body' => $posts->last()->body
                        ]
                    ]
                ],
                [
                    'data' => [
                        'type' => 'posts',
                        'post_id' => $posts->skip(1)->first()->id,
                        'attributes' => [
                            'body' => $posts->skip(1)->first()->body
                        ]
                    ]
                ],
                [
                    'data' => [
                        'type' => 'posts',
                        'post_id' => $posts->first()->id,
                        'attributes' => [
                            'body' => $posts->first()->body
                        ]
                    ]
                ]
            ],
        ]);
    }


    /** @test*/
    public function a_user_can_only_retrieve_their_posts()
    {
        $this->actingAs($user = User::factory()->create(), 'api');

        $post = Post::factory()->create();

        $response = $this->get('/api/posts/');

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [],
                'links' => [
                    'self' => url('/posts')
                ]
            ]);
    }
}
