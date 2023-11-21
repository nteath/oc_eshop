<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Controller as BaseController;


class ApiController extends BaseController
{
    /**
     * Api request succeeded response.
     *
     * @param array $responseBody
     * @return Application|ResponseFactory|Response
     */
    public function success(array $responseBody = [])
    {
        $response = array_merge([
            'success' => true,
        ], $responseBody);

        return response($response);
    }


    /**
     * Api request failed response.
     *
     * @param array $errors
     * @param $code
     * @return Application|ResponseFactory|Response
     */
    public function failure(array $errors, $code)
    {
        $response = array_merge([
            'success' => false,
        ], [
            'errors' => $errors
        ]);

        return response($response, $code);
    }
}
