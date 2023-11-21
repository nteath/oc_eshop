<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use App\Models\Coupon;
use App\Models\PromotionOffer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePromotionOffer
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
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCompleted $event)
    {
        // For simplicity user a random coupon.
        $coupon = Coupon::findByCode('oc');

        $offer              = new PromotionOffer;
        $offer->order_id    = $event->order->id;
        $offer->coupon_code = $coupon->code;
        $offer->send_at     = $event->order->paid_at->addMinutes(15);

        $offer->save();
    }
}
