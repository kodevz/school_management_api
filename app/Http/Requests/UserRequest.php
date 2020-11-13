<?php

namespace App\Http\Requests;

use App\Traits\FailedRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'password' => 'nullable|string|min:3|max:50',
            'role_id' => 'required',
            'gender' => 'required|string',
            'phone' => 'required|nullable|string|min:6|max:20',
            'email' => 'required|nullable|email|max:100|unique:users',
            'username' => 'required|nullable|alpha_dash|min:8|max:100|unique:users',
            'image' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
            'address' => 'required|string|min:6|max:120',
            'city_id' => 'sometimes|required',
            'dob' => 'required'
        ];

        $userId = isset($this->user) ? $this->user->id : '';
        $update =  [
            'name' => 'required|string|min:6|max:150',
            'password' => 'nullable|string|min:3|max:50',
            'gender' => 'required|string',
            'phone' => 'required|nullable|string|min:6|max:20',
            'email' => 'required|nullable|email|max:100|unique:users,email,'.$userId,
            'image_url' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
            'address' => 'required|string|min:6|max:120',
            'city_id' => 'sometimes|required',
            'dob' => 'required'
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
