<?php

namespace Modules\Content\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'summary' => 'required|min:5',
            'category_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:post_categories,id',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif',
            'status' => 'required|numeric|in:0,1',
            'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'description' => 'required|min:5',
            'published_at' => 'required',
            'slug' => 'required|unique:posts,slug'
        ];
    }
    public function attributes()
    {
        return [
            'published_at' => 'تاریخ انتشار',
            'summary' => 'خلاصه',
            'tags' => 'تگ ها'
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
