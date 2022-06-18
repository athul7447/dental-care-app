<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRegisterRequest extends FormRequest
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
            'name' => 'bail|required|max:255|string',
            'username' => 'bail|required|max:255|string|unique:doctors,username,',
            'email' => 'bail|required|email|max:255|unique:doctors',
            'qualification' => 'bail|required|max:255|string',
            'phone' => 'bail|required|max:255|string',
            'address' => 'bail|required|max:500|string',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
        ];
    }
}
