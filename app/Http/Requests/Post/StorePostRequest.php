<?php

namespace App\Http\Requests\Post;

use App\Models\Post;

class StorePostRequest extends PostFormRequest
{
    public function createPostInstance() : Post
    {
        $attributes = $this->getValidatedUpdates();
        return (new Post())->fill($attributes);
    }
    
}
