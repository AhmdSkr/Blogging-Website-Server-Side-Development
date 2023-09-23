<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Services\FileCollectionService;
use Illuminate\Http\Response;

class BlogController extends Controller
{

    public function __construct(
        private FileCollectionService $fileService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::query()->paginate(8);
        return response()->view('blog.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $validAttributes = $request->validated();
        $blog = new Blog();
        $response = redirect();
        
        /* filling blog model fields */
        {
            $result = null;
            if(isset($validAttributes['image']) && $validAttributes['image'] !== null)
            {
                $result = $this->fileService->upload($validAttributes['image']);
                if($result === false)
                {
                    $response->with('image_upload_status', 'Unable to store image!');
                    $result = null;
                    /* Continue uploading blog, normally. */
                }
            }

            $blog->fill($validAttributes);
            $blog->image_url = $result;
        }
        
        if(!$blog->save())
        /* Handle database storage failure here... */
        {
            if($blog->image_url !== null)
            {
                $this->fileService->remove($blog->image_url);
            }
            // Try flashing data
            abort(Response::HTTP_INTERNAL_SERVER_ERROR,"Unable to upload posted content.");
        }
        
        return $response->to(
            path:   route('blog.show', ['blog' => $blog->id]),
            status: Response::HTTP_CREATED,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return response()->view('blog.view', ['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return response()->view('blog.edit', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $response  = redirect();
        $previous_image_url = $blog->image_url;
        $current_image_url = null;
        $validAttributes = $request->validated();

        /* filling blog model fields */
        {
            if(isset($validAttributes['image']) && $validAttributes['image'] !== null)
            {
                $current_image_url = $this->fileService->upload($validAttributes['image']);
                if($current_image_url === false)
                {
                    $response->with('image_upload_status', 'Unable to store image!');
                    $current_image_url = null;
                    /* Continue uploading blog, normally.*/ 
                }
                else
                {
                    $blog->image_url = $current_image_url;
                }
            }
            $blog->fill($validAttributes);
        }

        if($blog->isDirty())
        {
            if(!$blog->save())
            /* Handle database storage failure here... */
            {
                $this->fileService->remove($current_image_url);
                abort(Response::HTTP_INTERNAL_SERVER_ERROR, 'Unable to upload posted content.');
            }
            else
            /* Clean up */
            {
                if($current_image_url !== null)
                {
                    $this->fileService->remove($previous_image_url);
                }
            }
        }
        return $response->to(route('blog.show', ['blog' => $blog->id]));
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $image_url = $blog->image_url;
        if($blog->delete() === false)
        {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if(!$this->fileService->remove($image_url))
        {
            // TODO: handle failure
        }

        return redirect(to: route("blog.index"));
    }

    public function uncover(Blog $blog)
    {
        if(!$this->fileService->remove($blog->image_url))
        {
            // TODO: handle failure
            return back();
        }
        $blog->image_url = null;
        if(!$blog->save())
        {
            // TODO:handle failure
        }

        return redirect(to: route("blog.edit", ['blog' => $blog->id]));
    }
}
