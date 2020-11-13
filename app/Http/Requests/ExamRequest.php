<?php

namespace App\Http\Requests;

use App\Traits\FailedRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'term' => 'required|numeric',
            'year' => 'required|string',
        ];
    }
}
