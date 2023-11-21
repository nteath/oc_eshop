<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\PromotionOffer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPromotionalOffer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        // Select offers ready to send.
        $offers = PromotionOffer::whereNull('sent_at')
                                 ->whereBetween('send_at', [
                                     now()->startOfMinute(),
                                     now()->endOfMinute()
                                 ])->get();

        if ($offers->count() === 0) {
            return true;
        }

        foreach ($offers as $offer) {
            $offer->sendNow();
        }
    }
}
