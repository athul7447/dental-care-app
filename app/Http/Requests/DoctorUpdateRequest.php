<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorUpdateRequest extends FormRequest
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
            'image' => 'bail|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'name' => 'bail|required|max:255|string',
            'username' => 'bail|required|max:255|string|unique:doctors,username,'.request()->route()->id,
            'email' => 'bail|required|email|max:255|unique:doctors,email,'.request()->route()->id,
            'qualification' => 'bail|required|max:255|string',
            'phone' => 'bail|required|max:255|string',
            'address' => 'bail|required|max:500|string',
            'appointment_per_day' => 'bail|required|max:50|numeric',
        ];
    }

}
