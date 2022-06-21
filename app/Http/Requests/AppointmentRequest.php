<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'name'=>'required|min:3|max:50|string',
            'email'=>'required|email|max:30|string',
            'phone'=>'required|min:10|max:15|string',
            'date'=>'required|date|string',
            'time'=>'required|string',
            'doctor_name'=>'required|string',
            'note'=>'required|string',
        ];
    }
}
