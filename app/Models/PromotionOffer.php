<?php

namespace App\Models;

use App\Mail\SendPromotionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PromotionOffer extends Model
{
    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'coupon_code',
        'send_at',
        'sent_at',
    ];


    /**
     * Casting to date.
     *
     * @var string[]
     */
    public $dates = ['send_at', 'send_at'];


    /**
     * The Order of the offer.
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }


    /**
     * Send an email with the discount code.
     */
    public function sendNow()
    {
        $recipient = $this->order->user;
        $coupon    = Coupon::findByCode($this->coupon_code);

        $mailable          = new SendPromotionMail;
        $mailable->subject = 'Find your discount code for your next order!';
        $mailable->from    = ['email@example.com'];
        $mailable->with([
            'name'         => $recipient->name,
            'coupon_code'  => $coupon->code,
            'coupon_value' => $coupon->value,
        ]);

        Mail::to($recipient->email)->send($mailable);

        return $this->markSent();
    }


    /**
     * Mark a PromotionOffer as sent.
     *
     * @return $this
     */
    public function markSent(): static
    {
        $this->update(['sent_at' => now(),]);

        return $this;
    }
}
