<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateBlogRequest extends BlogFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $result = parent::rules();
        
        /* Uniqueness of Blog name is done on distinct blogs */
        /* it does not apply if the blog acquires the same name as its previous version */
        $result['name'][4] = Rule::unique('blogs','name')->ignore($this->route('blog')->id);
        
        return $result;
    }
}
