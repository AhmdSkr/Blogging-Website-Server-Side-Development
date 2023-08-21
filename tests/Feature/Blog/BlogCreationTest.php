<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogCreationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private Blog $blog;
    private array $data;

    public function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'name'          => $this->faker()->sentence(2),
            'description'   => $this->faker()->sentence(5),
        ];
    }

    public function test_form_route_not_changed(): void
    {
        // Arrange
        $expected =  implode('/', [env('APP_URL','127.0.0.1:8000'), 'blogs', 'create']);
        // Act
        $actual = route('blog.create');
        // Assert
        $this->assertEquals($expected, $actual, "The blog creation route must not change!");
    }
    
    public function test_form_status_is_ok():void
    {
        // Arrange
        $url = route('blog.create');
        // Act
        $response = $this->get($url);
        // Assert
        $response->assertOk();
    }

    public function test_creation_route_not_changed(): void
    {
        // Arrange
        $expected =  implode('/', [env('APP_URL','127.0.0.1:8000'), 'blogs']);
        // Act
        $actual = route('blog.store');
        // Assert
        $this->assertEquals($expected, $actual, "The blog storing route must not change!");
    }

    public function test_on_success_creation_status_is_created(): void
    {
        // Arrange
        $url = route('blog.store');
        // Act
        $response = $this->post($url, $this->data);
        // Assert
        $response->assertCreated();
    }

    public function test_on_success_creation_redirection_link_not_changed(): void
    {
        // Arrange
        $url = route('blog.store');
        // Act
        $response = $this->post($url, $this->data);
        $created = Blog::all()->first();
        // Assert
        $response->assertRedirectToRoute('blog.show', $created->id);
    }
}
