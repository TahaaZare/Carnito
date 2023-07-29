<?php

namespace Modules\Content\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'category_id' => 'sometimes|min:1|max:100000000|regex:/^[0-9]+$/u|exists:project_categories,id',
            'image' => 'image|mimes:png,jpg,jpeg,gif',
            'status' => 'required|numeric|in:0,1',
            'description' => 'required|min:5',
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
