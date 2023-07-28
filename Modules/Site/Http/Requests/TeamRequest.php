<?php

namespace Modules\Site\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class TeamRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $route = Route::current();
        if ($route->getName() === 'admin.team.store') {
            return [
                'first_name' =>  'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'last_name' =>  'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'instagram_link' =>  'nullable',
                'telegram_link' =>  'nullable',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'team_role' => 'required',
                'bio'=>'nullable'
            ];
        } elseif ($route->getName() === 'admin.team.update') {
            return [
                'first_name' =>  'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'last_name' =>  'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'instagram_link' =>  'nullable',
                'telegram_link' =>  'nullable',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'team_role' => 'required',
                'bio'=>'nullable'

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
