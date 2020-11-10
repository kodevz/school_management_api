<?php

namespace App\Http\Requests;

use App\Traits\FailedRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
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
            'name' => 'required|unique:classes,name',
            'class_type_id' => 'required'
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
            'class_type_id' => 'Classtype id '
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
            'class_type_id.required' => 'A :attribute is required'
        ];
    }

}
