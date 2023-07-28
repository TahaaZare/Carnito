<?php

namespace Modules\Site\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'job' => 'nullable',
            'adderss' => 'nullable',
            'code_meli' => ['sometimes', 'required', Rule::unique('users')->ignore($this->user()->code_meli, 'code_meli')],
            'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
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
