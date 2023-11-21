<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Response;
use App\Http\Resources\CartResource;
use App\Http\Requests\ApplyDiscountRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;


class CartsController extends ApiController
{
    /**
     * Show Cart details.
     *
     * @param string $uuid
     * @return Application|ResponseFactory|Response
     */
    public function show(string $uuid): Response|Application|ResponseFactory
    {
        $cart = Cart::with('items')
                    ->where(['uuid' => $uuid])
                    ->first();

        if (! $cart) {
            return $this->failure(['Cart not found.'], 404);
        }

        return $this->success([
            'data' => new CartResource($cart)
        ]);
    }


    /**
     * Apply a coupon discount on a Cart
     *
     * @param ApplyDiscountRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function applyDiscount(ApplyDiscountRequest $request): Response|Application|ResponseFactory
    {
        $cart   = Cart::findByUuid($request->cart_id);
        $coupon = Coupon::findByCode($request->coupon);

        $cart->coupon_id = $coupon->id;
        $cart->save();

        return $this->success([
            'data' => new CartResource($cart)
        ]);
    }
}
