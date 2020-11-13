<?php

namespace App\Http\Requests;

use App\Traits\FailedRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class StudentMasterRequest extends FormRequest
{
    use FailedRequestTrait;

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
        $store =  [
            'name' => 'required|string|min:6|max:150',
            'gender' => 'required|string',
            'phone' => 'sometimes|nullable|string|min:6|max:20',
            'email' => 'sometimes|nullable|email|max:100|unique:users',
            'image' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
            'address' => 'required|string|min:6|max:120',
            'city_id' => 'sometimes|required',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'admission_date' => 'required'
        ];

        $update =  [
            'name' => 'required|string|min:6|max:150',
            'gender' => 'required|string',
            'phone' => 'sometimes|nullable|string|min:6|max:20',
            'email' => 'sometimes|nullable|email|max:100|unique:users,email,'. $this->route('student'),
            'image_url' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
            'address' => 'required|string|min:6|max:120',
            'city_id' => 'sometimes|required',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'admission_date' => 'required'
        ];

        return ($this->method() === 'POST') ? $store : $update;
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Name',
            'password' => 'Password',
            'gender' => 'Gender',
            'phone' => 'Phone No.',
            'email' => 'Email',
            'username' => 'Username',
            'image_url' => 'Uploaded Image',
            'address' => 'Address',
            'city_id' => 'City'
        ];
    }
}
