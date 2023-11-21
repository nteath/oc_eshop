<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->expectsJson() and $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'errors'  => ['Record not found.']
                ], 404);
            }
        });


        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->expectsJson() and $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'errors'  => ['Unauthenticated.']
                ], 401);
            }
        });
    }
}
