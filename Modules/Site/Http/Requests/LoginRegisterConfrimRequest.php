<?php

namespace Modules\Site\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRegisterConfrimRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'otp' => 'required|min:6|max:6',
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'ایمیل یا شماره موبایل',
            'otp' => 'رمز یک بار مصرف'
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
