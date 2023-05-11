<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Post;

class StorePostRequest extends FormRequest
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
     * Retrieves the post instance submitted through the form request
     */
    public function getPostInstance() : Post {

        if($this->instance === null) {
            /* Post contruction code here... */
            $attributes = [
                'title'             => $this->input('title'),
                'excerpt'           => $this->input('excerpt'),
                'body'              => $this->input('body'),
                'minutes_to_read'   => 1,       /* calculate minutes to read */
                'image_url'         => null,    /* request to store image on server */
            ];
            $this->instance = (new Post())->fill($attributes);
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
