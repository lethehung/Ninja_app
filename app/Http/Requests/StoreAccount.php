<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccount extends FormRequest
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
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:191|unique:users',
            'password' => '',
            'password_confirm' => 'same:password',
            'phone' => 'required|min:3|max:255',
            'facebook' => 'required',
            'sex' => 'required',
            'birth_day' => 'required|date',
            'permission' => 'required',
            'id_department' => 'required',
        ];
    }
}
