<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Response;
use App\Http\Resources\OrderResource;
use App\EShop\Services\CheckoutService;
use App\Http\Requests\CheckoutOrderRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;


class OrdersController extends ApiController
{
    /**
     * User submits a new order.
     *
     * @param CheckoutOrderRequest $request
     * @param CheckoutService $checkoutService
     * @return Application|ResponseFactory|Response
     */
    public function store(CheckoutOrderRequest $request, CheckoutService $checkoutService)
    {
        try {
            $order = $checkoutService->run($request);

            return $this->success([
                'data' => new OrderResource($order)
            ]);
        }
        catch (Exception $e) {
            return $this->failure([$e->getMessage()], 406);
        }
    }
}
