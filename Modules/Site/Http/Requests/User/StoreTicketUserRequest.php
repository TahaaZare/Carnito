<?php

namespace Modules\Site\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required|min:2|max:100|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,?؟ ]+$/u',
            'description' => 'required|min:2|max:1000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,?؟ ]+$/u',
            'priority_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:ticket_priorities,id',
            'category_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:ticket_categories,id',
            'file' => 'mimes:png,jpg,jpeg,gif',
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
