<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompany extends FormRequest
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
            'email'=>'required|email|unique:company_user',
            'name' => 'required',
            'address'=>'required',
            'phone' => 'required|min:8|max:20',
            'facebook' => 'required',
            'type'=>'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'date_sell' => 'required|date'
        ];
    }
}
