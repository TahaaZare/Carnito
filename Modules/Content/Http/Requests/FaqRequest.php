<?php

namespace Modules\Content\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->isMethod('post')){
            return [
                'question' => 'required|max:120|min:2',
                'awnser' => 'required|max:2000|min:5',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'slug' => 'nullable|max:120|min:2',
            ];
        }
        else{
            return [
                'question' => 'required|max:120|min:2',
                'awnser' => 'required|max:2000|min:5',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'slug' => 'nullable|max:120|min:2',
            ];
        }
    }
    public function attributes()
    {
        return [
            'tags' => 'تگ ها',
            'question' => 'سوال'
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
