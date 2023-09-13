<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostFormRequest extends FormRequest
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
            'title'     => 'required|filled|string|max:64',
            'excerpt'   => 'nullable|string|max:256',
            'body'      => 'required|filled|string|max:65535',
            'image'     => 'nullable|image|max:2048',
            'target_id' => ['nullable', Rule::exists('posts', 'id')],
        ];
    }
}
