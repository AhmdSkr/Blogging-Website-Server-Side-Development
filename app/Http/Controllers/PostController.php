<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;


class PostController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->view('post.view', ['post' => $post]);
    }

}
