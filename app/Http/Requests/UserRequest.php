<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Input;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (Input::has('idUser')) {
            $id = Input::get('idUser');
            return [
                'name' => 'required|string|min:3|max:25',
                'email' => 'required|string|email|min:10|max:50|unique:users,email,' . $id . ',id',
            ];

        } else {
            return [
                'name' => 'required|string|min:3|max:25',
                'email' => 'required|string|email|min:10|max:50|unique:users',
            ];
        }

    }
}
