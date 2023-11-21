<?php

namespace App\Providers;

use App\Events\OrderCompleted;
use App\Events\ProductAddedToCart;
use App\Listeners\CreatePromotionOffer;
use App\Listeners\UpdateCartValue;
use Illuminate\Auth\Events\Registered;
use App\Listeners\DescreaseProductStockQuantity;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*Registered::class => [
            SendEmailVerificationNotification::class,
        ],*/

        ProductAddedToCart::class => [
            DescreaseProductStockQuantity::class,
            UpdateCartValue::class,
        ],

        OrderCompleted::class => [
            CreatePromotionOffer::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
