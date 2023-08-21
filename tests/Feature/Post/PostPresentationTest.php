<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use SebastianBergmann\Type\VoidType;
use Tests\TestCase;

/**
 * A post presentation should:
 * - have route http://{APP_URL}/post/{postId}
 * - have status code of HTTP_OK.
 * - contain post's title.
 * - contain post's excerpt.
 * - contain post's body.
 * - contain post's minutes to read.
 * - contain post's creation date
 * - contain post's update date
 *
 * - contain post's cover image
 * - contain post's blog link.
 */
class PostPresentationTest extends TestCase
{

    use RefreshDatabase;

    private Blog $blog;
    private Post $post;

    public function setUp(): void
    {
        parent::setUp();
        $this->blog = Blog::factory()->count(1)->createQuietly()->first();
        $this->post = Post::factory()->count(1)->withBlog($this->blog)->createQuietly()->first();
    }

    public function test_route_not_changed(): void
    {
        // Arrange
        $expected =  implode('/', [env('APP_URL','127.0.0.1:8000'), 'posts', $this->post->id]);
        // Act
        $actual = route('post.show',$this->post->id);
        // Assert
        $this->assertEquals($expected, $actual, "The post presentation must not change!");
    }

    public function test_status_code_is_ok(): void
    {
        // Arrange
        $url = route('post.show',$this->post->id);
        // Act
        $response = $this->get($url);
        // Assert
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_contains_title(): void
    {
        // Arrange
        $url = route('post.show',$this->post->id);
        // Act
        $response = $this->get($url);
        // Assert
        $response->assertSee($this->post->title);
    }

    public function test_contains_excerpt(): void
    {
        // Arrange
        $url = route('post.show',$this->post->id);
        // Act
        $response = $this->get($url);
        // Assert
        $response->assertSee($this->post->excerpt);
    }

    public function test_contains_body(): void
    {
        // Arrange
        $url = route('post.show',$this->post->id);
        // Act
        $response = $this->get($url);
        // Assert
        $response->assertSee($this->post->body);
    }

    public function test_contains_minutes_to_read(): void
    {
        // Arrange
        $url = route('post.show',$this->post->id);
        // Act
        $response = $this->get($url);
        // Assert
        // TODO: Should find a stable procedure to find the number of minutes to read the post.
        // ?How can I see if the minutes to read number is marked with Minutes to Read?
        $response->assertSeeText($this->post->minutes_to_read);
    }

    public function test_contains_creation_date(): void
    {
        // Arrange
        $url = route('post.show',$this->post->id);
        // Act
        $response = $this->get($url);
        // Assert
        // TODO: Should find a stable procedure to find the post's creation date.
        // ?How can I see if the creation date is marked with "Creation Date" label?
        $response->assertSeeText($this->post->created_at);
    }

    public function test_contains_update_date(): void
    {
        // Arrange
        $url = route('post.show',$this->post->id);
        // Act
        $response = $this->get($url);
        // Assert
        // TODO: Should find a stable procedure to find the post's update date.
        // ?How can I see if the update date is marked with "Update Date" label?
        $response->assertSeeText($this->post->updated_at);
    }

    // TODO: test if image is displayed (test if image tag with src of the image is in response content).
    // TODO: test if blog link is shown.
    // TODO: test if card view is working.
}
