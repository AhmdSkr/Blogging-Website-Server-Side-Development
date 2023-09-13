<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    /**
     * Indicates to which blog the post(s) belong(s) to
     */
    public function withBlog(Blog $blog): Factory
    {
        return $this->state(function(array $attributes) use($blog) {
            return [
                'blog_id' => $blog->id
            ];
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'             =>  fake()->text(64),
            'excerpt'           =>  fake()->text(256),
            'body'              =>  fake()->text(1000),
            'minutes_to_read'   =>  fake()->numberBetween(1,100),
            'blog_id'           =>  null,
            'image_url'         =>  null,
        ];
    }
}
