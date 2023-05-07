<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'             =>  fake()->sentence(),
            'excerpt'           =>  fake()->sentence(10),
            'body'              =>  fake()->text(1000),
            'minutes_to_read'   =>  fake()->numberBetween(),
            'image_url'         =>  null,
        ];
    }
}
