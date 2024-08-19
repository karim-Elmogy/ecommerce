<?php

namespace App\Listeners;

use App\Events\advertiseView;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class increaseAdvertiseView
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
     * @param  \App\Events\advertiseView  $event
     * @return void
     */
    public function handle(advertiseView $event)
    {
       $this->updateViews($event->advertisement);
    }

    public function updateViews($advertisement){
        $advertisement->views=$advertisement->views+1;
        $advertisement->save();
    }
}
