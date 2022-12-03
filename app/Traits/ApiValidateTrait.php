<?php


namespace App\Traits;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait ApiValidateTrait
{
    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {

        $response = new JsonResponse([
            'error' => $validator->errors(),
            'response_code' => 422,
            'message' => 'error',
            'data' => null
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
