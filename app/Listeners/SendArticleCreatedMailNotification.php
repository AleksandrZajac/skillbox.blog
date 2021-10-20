<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ArticleNotificationCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendArticleCreatedMailNotification
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
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        $article = $event->getArticle();

        // $this->pushall->send($article->title, 'Создана новая статья');

        Notification::route('mail', config('mail.to.admin'))->notify(new ArticleNotificationCreated($article));
    }
}
