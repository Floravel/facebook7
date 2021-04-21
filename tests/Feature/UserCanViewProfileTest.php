<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCanViewProfileTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_user_profiles()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->create(), 'api');
        $posts = Post::factory()->create();

        $response = $this->get('/api/users/'. $user->id);

        $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'type' => 'users',
                'user_id' => $user->id,
                'attributes' => [
                    'name' => $user->name,
                ]
            ],
            'links' => [
                'self' => url('/users/'.$user->id)
            ]
        ]);
    }

    /** @test */
    public function a_user_can_fetch_post_for_a_profile()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->create(), 'api');
        $post = Post::factory()->create([
            'user_id' => $user->id
            ]
        );

        $response = $this->get('/api/users/'. $user->id.'/posts');

        // dd(json_decode($response->content()));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'posts',
                            'post_id' => $post->id,
                            'attributes' => [
                                'title' => $post->title,
                                'body' => $post->body,
                                'image' => $post->image,
                                'posted_at' => $post->created_at->DiffForHumans(),
                                'posted_by' => [
                                    'data' => [
                                        'attributes' => [
                                            'name' => $user->name,
                                            'email' => $user->email,
                                            'varified_at' => $user->varified_at,
                                            'password' => $user->password,
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        'links' => [
                            'self' => url('/posts/'.$post->id)
                        ]
                    ]
                ]
            ]);
    }
}
