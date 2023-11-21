<?php namespace App\Exceptions\Api;

use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Validation\ValidationException as BaseValidationException;


class ValidationException extends BaseValidationException
{
    public function __construct($validator, $response = null, $errorBag = 'default')
    {
        parent::__construct($validator, $response, $errorBag);
    }


    /**
     * @return Application|ResponseFactory|Response
     */
    public function render()
    {
        $response['success'] = false;
        $response['errors']  = $this->validator->errors()->toArray();

        return response($response, 422);
    }
}
