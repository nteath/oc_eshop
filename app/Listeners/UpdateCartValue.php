<?php

namespace App\Listeners;

use App\Events\ProductAddedToCart;

class UpdateCartValue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Update current cart's value.
     * For all items in cart calculate the price.
     *
     * @param ProductAddedToCart $event
     * @return void
     */
    public function handle(ProductAddedToCart $event)
    {
        $cart = $event->cart;

        $newValue = 0;
        foreach ($cart->items()->get() as $cartItem) {
            $newValue += $cartItem->price * $cartItem->extra->quantity;
        }

        $cart->update(['value' => $newValue]);
    }
}
