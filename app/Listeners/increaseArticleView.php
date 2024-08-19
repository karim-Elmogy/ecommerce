<?php

namespace App\Listeners;

use App\Events\articleView;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class increaseArticleView
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
     * @param  \App\Events\articleView  $event
     * @return void
     */
    public function handle(articleView $event)
    {
        $this->updateViews($event->article);
    }

    public function updateViews($article){
        $article->views=$article->views+1;
        $article->save();
    }
}
