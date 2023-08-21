<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogPresentationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private Blog $blog;

    public function setUp(): void
    {
        parent::setUp();
        $this->blog = Blog::factory()->createOneQuietly();
    }

    public function test_presentation_route_not_changed(): void
    {
        // Arrange
        $expected =  implode('/', [env('APP_URL','127.0.0.1:8000'), 'blogs', $this->blog->id]);
        // Act
        $actual = route('blog.show', $this->blog->id);
        // Assert
        $this->assertEquals($expected, $actual, "The blog presentation route must not change!");
    }

    public function test_presentation_status_is_ok():void
    {
        // Arrange
        $url = route('blog.show', $this->blog->id);
        // Act
        $response = $this->get($url);
        // Assert
        $response->assertOk();
    }
}
