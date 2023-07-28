<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return [

                'first_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'last_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'mobile' => ['required',  'unique:users'],
                'email' => ['required', 'string', 'email', 'unique:users'],
                'password' => ['required', Password::min(8)->letters()->numbers()->uncompromised(), 'confirmed'], //->mixedCase()->symbols()
                'activation' => 'required|numeric|in:0,1',
                'code_meli' => 'nullable|digits:10',
                'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            ];
        } else {
            return [
                'first_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'last_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'mobile' => ['required'],
                'activation' => 'required|numeric|in:0,1',
                'code_meli' =>'nullable|digits:10',
                'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
            ];
        }
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
