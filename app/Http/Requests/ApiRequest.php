<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\Api\ValidationException as ApiValidationException;


class ApiRequest extends FormRequest
{
    /**
     * Overriding the default ValidationException
     * to return our own custom response.
     *
     * @param Validator $validator
     * @throws ApiValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ApiValidationException($validator);
    }
}
