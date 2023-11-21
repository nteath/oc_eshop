<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class UsersController extends ApiController
{
    /**
     * @return Response|Application|ResponseFactory
     */
    public function show()
    {
        $user = auth()->user();
        $user->load(['orders.cart.items', 'cart']);

        return $this->success([
            'data' => new UserResource($user)
        ]);
    }
}
