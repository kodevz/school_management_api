<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;

trait FailedRequestTrait
{

    // Function to return validation errors for request
    // Input : validatior
    // Ouput : result json
    // protected function failedValidation(Validator $validator)
    // {
    //     $result = [];
    //     $result_obj = new \stdClass();

    //     $result_obj->status = false;
    //     $result_obj->messages = Arr::flatten($validator->errors()->toArray());

    //     $result['results'] = $result_obj;
    //     throw new HttpResponseException(response()->json($result, 200));
    // }


    /**
     * @param Validator $validator
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        $errors = $validator->errors()->getMessages();
        $transformed = [];
        foreach ($errors as $field => $messages) {
            Arr::set($transformed, $field, $messages);
        }
        return $transformed;
    }

    /**
     * Return validation errors as json response
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'status' => false,
            'statusCode' => 400,
            'message' => 'Invalid Request',
            'errors' => $this->formatErrors($validator),
        ];

        throw new HttpResponseException(response()->json($response, 400));
    }
}
