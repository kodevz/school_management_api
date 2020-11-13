<?php

namespace App\Http\Requests;

use App\Traits\FailedRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class SectionsRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'class_id' => 'required',
            'teacher_id' => 'sometimes|nullable|exists:staff_master,id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Class Name',
            'class_id' => 'Class id ',
            'teacher_id' => 'Teacher User Id'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A :attribute is required',
            'name.unique' => 'A :attribute should be unique',
            'class_id.required' => 'A :attribute is required'
        ];
    }
}
