<?php namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends ApiController
{
    use AuthenticatesUsers;


    /**
     * Login a user using username/password.
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response|\Symfony\Component\HttpFoundation\Response
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();

            return $this->success([
                'data' => new UserResource($user)
            ]);
        }

        return $this->failure([
            'Invalid credentials.'
        ], 422);
    }


    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }


    /**
     * @param Request $request
     * @return Response|Application|ResponseFactory
     */
    public function logout(Request $request): Response|Application|ResponseFactory
    {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return $this->success();
    }
}
