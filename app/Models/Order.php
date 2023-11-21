<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Order extends Model
{
    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'total_amount',
        'amount_paid',
        'paid_at'
    ];


    /**
     * Casting attribute to date.
     *
     * @var string[]
     */
    protected $dates = ['paid_at'];


    /**
     * The order's customer.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * The order's cart details.
     *
     * @return BelongsTo
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
