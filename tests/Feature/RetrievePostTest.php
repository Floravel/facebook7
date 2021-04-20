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


        $posts->skip(1)->first()->image = null;
        $post = $posts->skip(1)->first();
        $post->save();

        $response = $this->get('/api/posts/');



        $response->assertStatus(200)
        ->assertJson([
            'data' => [
                [
                    'data' => [
                        'type' => 'posts',
                        'post_id' => $posts->last()->id,
                        'attributes' => [
                            'title' => $posts->last()->title,
                            'body' => $posts->last()->body,
                            'image' => $posts->last()->image,
                            'posted_at' => $posts->last()->created_at->DiffForHumans(),
                        ]
                    ]
                ],
                [
                    'data' => [
                        'type' => 'posts',
                        'post_id' => $posts->skip(1)->first()->id,
                        'attributes' => [
                            'title' => $posts->skip(1)->first()->title,
                            'body' => $posts->skip(1)->first()->body,
                            'image' => null,
                            'posted_at' => $posts->skip(1)->first()->created_at->DiffForHumans(),
                        ]
                    ]
                ],
                [
                    'data' => [
                        'type' => 'posts',
                        'post_id' => $posts->first()->id,
                        'attributes' => [
                            'title' => $posts->first()->title,
                            'body' => $posts->first()->body,
                            'image' => $posts->first()->image,
                            'posted_at' => $posts->first()->created_at->DiffForHumans(),
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
