<?php

namespace App\Listeners;

use App\Mail\ArticleCreated as MailCreated;
use App\Events\ArticleCreated;
use Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendArticleCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        Mail::to('admin@mail.com')->send(
            new MailCreated($event->article)
        );
    }
}
