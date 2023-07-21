<?php

namespace App\Http\Controllers;

use App\Services\FileCollectionService;
use Illuminate\Http\Response;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;


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
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->view('post.view', ['post' => $post]);
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
    public function store(StorePostRequest $request, FileCollectionService $fileCollect)
    {
        $validAttributes = $request->validated();
        $post = new Post();
        
        /* filling post model fields */
        {
            $result = null;
            if(isset($validAttributes['image']) && $validAttributes['image'] !== null)
            {
                $result = $fileCollect->upload($validAttributes['image']);
                if($result === false)
                {
                    // Message: failed to uplaod image!
                    // Continue uploading post, normally.
                    $result = null;
                }
            }

            $post->fill($validAttributes);
            $post->image_url = $result;
            $post->minutes_to_read = 1;
        }
        
        if(!$post->save())
        /* Handle database storage failure here... */
        {
            
            if($post->image_url !== null)
            {
                $fileCollect->remove($post->image_url);
            }
            abort(Response::HTTP_INTERNAL_SERVER_ERROR,"Unable to upload posted content.");
        }
        
        return redirect(
            to: route('post.show', ['post' => $post->id]),
            status: Response::HTTP_CREATED
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return response()->view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */ 
    public function update(UpdatePostRequest $request, FileCollectionService $fileService, Post $post)
    {
        $previous_image_url = $post->image_url;
        $current_image_url = null;
        $validAttributes = $request->validated();
        
        /* filling post model fields */
        {
            if(isset($validAttributes['image']) && $validAttributes['image'] !== null)
            {
                $current_image_url = $fileService->upload($validAttributes['image']);
                if($current_image_url === false)
                {
                    // TODO: message: failed to uplaod image!
                    $current_image_url = null;
                    /* Continue uploading post, normally.*/ 
                }
            }
            
            $post->fill($validAttributes);
            if($current_image_url !== null) $post->image_url = $current_image_url;
            $post->minutes_to_read = 1; // TODO: estimate minutes to read
        }

        if($post->isDirty())
        {
            if(!$post->save())
            /* Handle database storage failure here... */
            {
                if($current_image_url !== null) $fileService->remove($current_image_url);
                abort(Response::HTTP_INTERNAL_SERVER_ERROR,"Unable to upload posted content.");
            }
            else
            /* Clean up */
            {
                if($current_image_url !== null) $fileService->remove($previous_image_url);
            }
        }

        return redirect(to: route('post.show', ['post' => $post->id]));
    }
    
}
