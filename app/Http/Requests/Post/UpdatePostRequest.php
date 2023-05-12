<?php

namespace App\Http\Requests\Post;

use App\Models\Post;

class UpdatePostRequest extends PostFormRequest
{
    public function createPostInstance() : Post
    {
        $post = $this->route('post');
        $attributes = $this->getValidatedUpdates();
        return $post->fill($attributes);
    }
}
