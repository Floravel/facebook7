<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostToTimelineTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_post_a_text_post()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $response = $this->post('/api/posts', [
            'data' => [
                'type' => 'posts',
                'attributes' => [
                    'user_id' => $user->id,
                    'title' => 'testtitle',
                    'body' => 'Testing Body'
                ]
            ]
        ]);


        $post = Post::first();


        $this->assertCount(1, Post::all());
        $this->assertEquals($user->id, $post->user_id);
        $this->assertEquals('Testing Body', $post->body);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'posts',
                    'post_id' => $post->id,
                    'attributes' => [
                        'posted_by' => [
                            'data' => [
                                'type' => 'users',
                                'user_id' => $user->id,
                                'attributes' => [
                                    'name' => $user->name,
                                    'email' => $user->email,
                                    'password' => $user->password,
                                ],
                            ],
                            'links' => [
                                'self' => url('/users/'.$user->id),
                            ]
                        ],
                        'title' => $post->title,
                        'body' => $post->body,
                        ],
                    ],
                'links' => [
                    'self' => url('/posts/'.$post->id)
                ]
            ]);
    }
}
