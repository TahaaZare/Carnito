<?php

namespace Modules\Content\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:120|min:2',
            'description' => 'nullable|max:500|min:5',
            'slug' => 'required',
            'status' => 'required|numeric|in:0,1',
            'tags' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'tags' => 'تگ'
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
