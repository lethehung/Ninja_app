<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Configuration extends FormRequest
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
            'time_start' => 'required|date_format:H:i',
            'time_end'=> 'required|date_format:H:i',
            'work_schedule'=>[function ($attribute, $value, $fail){
                if(count(explode('|',$value))!=2)
                    $fail(': work_schedule valid struct');
            }],
            'ip'=>'required|min:7',
            'location'=>'required'
        ];
    }
}
