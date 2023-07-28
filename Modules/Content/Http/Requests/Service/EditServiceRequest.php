<?php

namespace Modules\Content\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class EditServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|min:2|max:120',
            'image' => 'sometimes|image|mimes:png,jpg,jpeg,gif',
            'status' => 'sometimes|numeric|in:0,1',
            'description' => 'nullable|max:250|min:5',
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
