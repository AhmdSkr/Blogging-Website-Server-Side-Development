<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCreationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private Blog $blog;
    private array $data;

    public function setUp(): void
    {
        parent::setUp();
        $this->blog = Blog::factory()->count(1)->createQuietly()->first();
        $this->data = [
            'title'     => $this->faker()->text(70),
            'excerpt'   => $this->faker()->text(100),
            'body'      => $this->faker()->text(1000),
        ];
    }

    // *Blog Post Creation Testing

    public function test_form_route_not_changed(): void
    {
        // Arrange
        $expected =  implode('/', [env('APP_URL','127.0.0.1:8000'), 'blogs', $this->blog->id, 'posts', 'create']);
        // Act
        $actual = route('post.create', $this->blog->id);
        // Assert
        $this->assertEquals($expected, $actual, "The post creation form route must not change!");
    }

    public function test_form_status_is_ok(): void
    {
        // Arrange
        $route = route('post.create', $this->blog->id);
        // Act
        $response = $this->get($route);
        // Assert
        $response->assertOk();
    }

    // TODO: test form components.

    public function test_creation_route_not_changed(): void
    {
        // Arrange
        $expected = implode('/', [env('APP_URL', '127.0.0.1:8000'), 'blogs', $this->blog->id, 'posts']);
        // Act
        $actual = route('post.store', $this->blog->id);
        // Assert
        $this->assertEquals($expected, $actual, "The post creation route must not change");
    }

    public function test_on_success_creation_status_is_created(): void
    {
        // Arrange
        $route = route('post.store', $this->blog->id);
        // Act
        $response = $this->post($route, $this->data);
        // Assert
        $response->assertCreated();
    }

    public function test_on_success_creation_redirection_link_not_changed(): void
    {
        // Arrange
        $route = route('post.store', $this->blog->id);
        // Act
        $response = $this->post($route, $this->data);
        $post = Post::all()->first();
        // Assert
        $response->assertRedirectToRoute('post.show', ['post' => $post->id]);
    }
    
    // *Personal Post Creation Testing

    public function test_personal_form_route_not_changed(): void 
    {
        // Arrange
        $expected =  implode('/', [env('APP_URL','127.0.0.1:8000'), 'posts', 'create']);
        // Act
        $actual = route('post.personal.create');
        // Assert
        $this->assertEquals($expected, $actual, "The post personal creation form route must not change!");
    }

    public function test_personal_form_status_is_ok(): void
    {
        // Arrange
        $route = route('post.personal.create');
        // Act
        $response = $this->get($route);
        // Assert
        $response->assertOk();
    }


    public function test_personal_creation_route_not_changed(): void
    {
        // Arrange
        $expected = implode('/', [env('APP_URL', '127.0.0.1:8000'), 'posts']);
        // Act
        $actual = route('post.personal.store');
        // Assert
        $this->assertEquals($expected, $actual, "The personal post creation route must not change");
    }

    public function test_on_success_personal_creation_status_is_created(): void
    {
        // Arrange
        $route = route('post.personal.store');
        // Act
        $response = $this->post($route, $this->data);
        // Assert
        $response->assertCreated();
    }

    public function test_on_success_personal_creation_redirection_link_not_changed(): void
    {
        // Arrange
        $route = route('post.personal.store');
        // Act
        $response = $this->post($route, $this->data);
        $post = Post::all()->first();
        // Assert
        $response->assertRedirectToRoute('post.show', ['post' => $post->id]);
    }

    // TODO: test validation error responses
    // TODO: test validation error messages
}
