<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogEditTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private Blog $blog;
    private array $data;

    public function setUp(): void
    {
        parent::setUp();
        $this->blog = Blog::factory()->createOneQuietly();
        $this->data = [
            'name'             =>  fake()->sentence(2),
            'description'      =>  fake()->sentence(5),
        ];
    }

    public function test_form_route_not_changed(): void
    {
        // Arrange
        $expected =  implode('/', [env('APP_URL','127.0.0.1:8000'), 'blogs', $this->blog->id, 'edit']);
        // Act
        $actual = route('blog.edit', ['blog' => $this->blog->id]);
        // Assert
        $this->assertEquals($expected, $actual, "The blog edit route must not change!");
    }
    
    public function test_form_status_is_ok(): void
    {
        // Arrange
        $url = route('blog.edit', ['blog' => $this->blog->id]);
        // Act
        $response = $this->get($url);
        // Assert
        $response->assertOk();
    }

    public function test_update_route_not_changed(): void
    {
        // Arrange
        $expected =  implode('/', [env('APP_URL','127.0.0.1:8000'), 'blogs', $this->blog->id]);
        // Act
        $actual = route('blog.update', ['blog' => $this->blog->id]);
        // Assert
        $this->assertEquals($expected, $actual, "The blog update route must not change!");
    }

    public function test_on_success_update_status_is_resource_found(): void
    {
        // Arrange
        $url = route('blog.update', ['blog' => $this->blog->id]);
        // Act
        $response = $this->patch($url, $this->data);
        // Assert
        $response->assertFound();
    }

    public function test_on_success_update_redirection_link_not_changed(): void
    {
        // Arrange
        $url = route('blog.update', ['blog' => $this->blog->id]);
        // Act
        $response = $this->patch($url, $this->data);
        // Assert
        $response->assertRedirectToRoute('blog.show', ['blog' => $this->blog->id]);
    }
}
