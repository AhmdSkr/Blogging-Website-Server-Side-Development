<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;

use App\Models\Post;

abstract class PostFormRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'image'     => 'nullable|image|max:1024',
        ];
    }
}
