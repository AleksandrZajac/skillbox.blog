<?php

namespace App\Channels;

use App\Notifications\ArticleNotificationCreated;

class PushAllChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \App\Notifications\ArticleNotificationCreated  $notification
     * @return void
     */
    public function send($notifiable, ArticleNotificationCreated $notification)
    {
        $message = $notification->toPushAll($notifiable);
    }
}
