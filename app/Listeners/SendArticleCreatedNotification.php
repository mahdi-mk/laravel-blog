<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\ArticleCreatedMail;
use App\Events\ArticleCretaedEvent;

class SendArticleCreatedNotification
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
     * @param  ArticleCreatedEvent  $event
     * @return void
     */
    public function handle(ArticleCretaedEvent $event)
    {
        // Whene new article has been created, Send email to the user
        \Mail::to($event->article->Owner->email)->send(new ArticleCreatedMail($event->article));
    }
}
