<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\PushAll;

class SendArticleCreatedPushAllNotification
{
    private $pushall;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PushAll $pushall)
    {
        $this->pushall = $pushall;
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

        $this->pushall->send($article->title . PHP_EOL . url('/articles/' . $article->slug), 'Создана новая статья');
    }
}
