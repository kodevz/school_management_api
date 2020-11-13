<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradesRequest extends FormRequest
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
            'name' => 'required|string',
            'class_type_id' => 'required',
            'mark_from' => 'required|numeric',
            'mark_to' => 'required|numeric',
            'remark' => 'required'
        ];
    }


    public function attributes()
    {
        return  [
            'name' => 'Grade name',
            'mark_from' => 'Mark From',
            'mark_to' => 'Mark To',
            'remark' => 'Remark'
        ];
    }
}
