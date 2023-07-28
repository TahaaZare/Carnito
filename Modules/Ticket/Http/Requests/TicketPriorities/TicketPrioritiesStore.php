<?php

namespace Modules\Ticket\Http\Requests\TicketPriorities;

use Illuminate\Foundation\Http\FormRequest;

class TicketPrioritiesStore extends FormRequest
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
            'status' => 'required|numeric|in:0,1',
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
