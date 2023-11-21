<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Response;
use App\Http\Resources\ProductResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;


class ProductsController extends ApiController
{
    /**
     * Sample e-shop page. Listing products.
     *
     * @return Response|Application|ResponseFactory
     */
    public function index(): Response|Application|ResponseFactory
    {
        $products = Product::all()->random(5);

        return $this->success([
            'data' => ProductResource::collection($products)
        ]);
    }


    /**
     * Show details for a specific product.
     *
     * @param string $uuid
     * @return Response|Application|ResponseFactory
     */
    public function show(string $uuid): Response|Application|ResponseFactory
    {
        $product = Product::findByUuid($uuid);

        if (! $product) {
            return $this->failure(['Product not found.'], 404);
        }

        return $this->success([
            'data' => new ProductResource($product)
        ]);
    }
}
