<?php

namespace App\Http\Requests;

use App\Traits\FailedRequestTrait;
use Illuminate\Foundation\Http\FormRequest;


class ClassTypeRequest extends FormRequest
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
            'name' => 'required|unique:class_types,name',
            'code' => 'required'
        ];

        // return [
        //     'hotspot_name' => 'required',
        //     'value_expected' => 'required|numeric',
        //     'hotspot_timeline_value.*.value' => 'required|numeric',
        //     'hotspot_timeline_value.*.value_percent' => 'required|numeric'
        // ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {

        return [
            'name' => 'Class Type Name',
            'code' => 'Class Type Code'
        ];

        // return [
        //     'hotspot_name' => 'Hotspot Name',
        //     'value_expected' => 'Value Expected',
        //     'hotspot_timeline_value.*.value' => 'Hotspot Timeline Value',
        //     'hotspot_timeline_value.*.value_percent' => 'Hotspot Present Values'
        // ];
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
            'code.required' => 'A :attribute is required'
        ];

        // return [
        //     'hotspot_name.required' => 'A :attribute is required',
        //     'value_expected.required' => 'A :attribute is required',
        //     'value_expected.numeric' => 'A :attribute should be a numeric',

        // ];
    }


    
}
