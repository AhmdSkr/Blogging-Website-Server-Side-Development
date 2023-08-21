<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostEditTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private Blog $blog;
    private Post $post;

    private array $data;

    public function setUp():void
    {
        parent::setUp();
        $this->blog = Blog::factory()->createOneQuietly();
        $this->post = Post::factory()->withBlog($this->blog)->createOneQuietly();
        $this->data = [
            'title'     => $this->faker()->sentence(),
            'excerpt'   => $this->faker()->sentence(2),
            'body'      => $this->faker()->text(1000),
        ];
    }

    public function test_form_route_is_not_changed(): void
    {
        // Arrange
        $expected =  implode('/', [env('APP_URL','127.0.0.1:8000'), 'posts', $this->post->id, 'edit']);
        // Act
        $actual = route('post.edit', $this->post->id);
        // Assert
        $this->assertEquals($expected, $actual, "The post edit form route must not change!");
    }

    public function test_form_status_is_ok(): void
    {
        // Arrange
        $url = route('post.edit', $this->post->id);
        // Act
        $response = $this->get($url);
        // Assert
        $response->assertOk();
    }

    public function test_update_route_not_changed(): void
    {
        // Arrange
        $expected =  implode('/', [env('APP_URL','127.0.0.1:8000'), 'posts', $this->post->id]);
        // Act
        $actual = route('post.update', $this->post->id);
        // Assert
        $this->assertEquals($expected, $actual);
    }

    public function test_on_success_update_status_is_resource_found(): void
    {
        // Arrange
        $url = route('post.update', ['post' => $this->post->id]);
        // Act
        $response = $this->patch($url, $this->data);
        // Assert
        $response->assertFound();
    }

    public function test_on_success_update_redirection_link_not_changed(): void
    {
        // Arrange
        $url = route('post.update', ['post' => $this->blog->id]);
        // Act
        $response = $this->patch($url, $this->data);
        // Assert
        $response->assertRedirectToRoute('post.show', ['post' => $this->blog->id]);
    }
}
