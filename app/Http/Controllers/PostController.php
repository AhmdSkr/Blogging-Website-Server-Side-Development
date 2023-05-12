<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

use App\Models\Post;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return response()->view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = $request->getPostInstance();
        if(!$post->save())
        {
            /* Handle database storage failure here... */
            // e.g. abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return redirect(
            to: route('post.show', ['post' => $post->id]),
            status: Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->view('post.view', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return response()->view('post.create', ['post' => $post]);
    }
    

    /**
     * Update the specified resource in storage.
     */ 
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post = $request->getPostInstance();
        if($post->isDirty()){
            if(!$post->save())
            {
                /* Handle database storage failure here... */
                // e.g. abort(Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        
        return redirect(to: route('post.show', ['post' => $post->id]));
    }
}
