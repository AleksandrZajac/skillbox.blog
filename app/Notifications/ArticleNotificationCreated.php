<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Channels\PushAllChannel;
use App\Services\PushAll;

class ArticleNotificationCreated extends Notification
{
    use Queueable;

    private $article;
    private $pushAll;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($article, PushAll $pushAll)
    {
        $this->article = $article;
        $this->pushAll = $pushAll;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', PushAllChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Статья ' . $this->article->title . ' создана.')
            ->action('Перейти на статью', url('/articles/' . $this->article->slug))
            ->line('Спасибо что используете наше приложение!');
    }

    public function toPushAll($notifiable)
    {
        return  $this->pushAll
            ->send($this->article->title . PHP_EOL . route('articles.show', $this->article->slug), 'Создана новая статья');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
