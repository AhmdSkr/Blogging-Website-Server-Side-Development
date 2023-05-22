<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Post;
use Illuminate\Support\Facades\File;

abstract class PostFormRequest extends FormRequest
{
    private Post|null $instance = null;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    
    /**
     * Creates the post instance from form request
     */
    public abstract function createPostInstance() : Post;

    public function getImageURL($image) : string|null
    {
        return null;
    }

    public function getMinutesToRead() : int 
    {
        return 1;
    }

    public function getValidatedData() : array|null
    {
        $attributes = $this->validated();
        $image = $attributes['image'];
        unset($attributes['image']);
        $attributes = array_merge(
            $attributes, 
            [
                'image_url' => $this->getImageURL($image),
                'minutes_to_read' => $this->getMinutesToRead(),
            ]
        );
        return $attributes;
    }

    /**
     * Retrieves the post instance submitted through the form request.
     */
     public final function getPostInstance() : Post 
    {
        if($this->instance === null) {
            $this->instance = $this->createPostInstance();
        }
        return $this->instance;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'     => 'required|filled|string|max:70',
            'excerpt'   => 'nullable|string|max:100',
            'body'      => 'required|filled|string',
            'image'     => 'nullable|image|size:1024',
        ];
    }
}
