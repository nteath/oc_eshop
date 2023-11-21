<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Response;
use App\Http\Resources\CartResource;
use App\Http\Requests\AddProductToCartRequest;
use App\EShop\Services\AddProductToCartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;


class CartItemsController extends ApiController
{
    /**
     * Adding a new item on a Cart.
     *
     * @param AddProductToCartRequest $request
     * @param AddProductToCartService $cartService
     * @return Response|Application|ResponseFactory
     */
    public function store(AddProductToCartRequest $request, AddProductToCartService $cartService): Response|Application|ResponseFactory
    {
        try {
            $cart = $cartService->run($request);

            return $this->success([
                'data' => new CartResource($cart->load('items'))
            ]);
        }
        catch (Exception $e) {
            return $this->failure([$e->getMessage()], 406);
        }
    }
}
