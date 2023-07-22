<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostPresentationTest extends TestCase
{

    use RefreshDatabase;

    public Post $post;

    public function setup(): void
    {
        parent::setUp();
        $this->post = Post::factory()->count(1)->createQuietly()->first();
    }

    public function test_presentation_route_not_changed(): void
    {
        $expected =  implode('/', [env('APP_URL','127.0.0.1:8000'), 'post', $this->post->id]);

        $actual = route('post.show',$this->post->id);

        $this->assertEquals($expected, $actual, "The post presentation must not change!");
    }

    public function test_status_code_is_ok(): void
    {
        $url = route('post.show',$this->post->id);

        $response = $this->get($url);
        
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_content_contains_title(): void
    {
        $url = route('post.show',$this->post->id);

        $response = $this->get($url);
        
        $response->assertSee($this->post->title);
    }

    public function test_content_contains_excerpt(): void
    {
        $url = route('post.show',$this->post->id);

        $response = $this->get($url);
        
        $response->assertSee($this->post->excerpt);
    }

    public function test_content_contains_body(): void
    {
        $url = route('post.show',$this->post->id);

        $response = $this->get($url);
        
        $response->assertSee($this->post->body);
    }

    public function test_content_contains_minutes_to_read(): void
    {
        $url = route('post.show',$this->post->id);

        $response = $this->get($url);
        
        // TODO: Should find a stable procedure to find the number of minutes to read the post.
        // ?How can I see if the minutes to read number is marked with Minutes to Read?
        $response->assertSeeText($this->post->minutes_to_read);
    }
}
