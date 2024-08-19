<?php

namespace App\Jobs;

use App\Models\Dashboard\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OfferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $offers;
    public function __construct($offers)
    {
        $this->offers=$offers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $offers=Offer::all();
        foreach ($offers as $offer)
        {
            $offer=Offer::whereNotNull('start')->whereNotNull('end')->first();
            // time in egypt          =>   $currentDateTime = now()->addHours(2)->format('Y-m-d H:i:s');
            // time in Saudi Arabia's =>   $currentDateTime = now()->addHours(3)->format('Y-m-d H:i:s');
            $currentDateTime = now()->addHours(2)->format('Y-m-d H:i:s');
//            dd($currentDateTime);
//            dd($offer->end < $currentDateTime , $offer->end,$currentDateTime);
            if ($offer)
            {
                if ($offer->start < $currentDateTime && $offer->end < $currentDateTime)
                {
                    $offer->update(
                        [
                            'is_active'=>0,
                        ]
                    );
                }else{
                    $offer->update(
                        [
                            'is_active'=>1,
                        ]
                    );
                }
            }
        }
    }
}
