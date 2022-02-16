<?php

namespace App\Notifications;

use App\Models\Article;
use \App\Models\ArticleHistory;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ArticleNotificationUpdated extends Notification implements ShouldBroadcast
{
    use Queueable;

    private $article;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        $history = ArticleHistory::where('article_id', $this->article->id)->latest()->first();

        return new BroadcastMessage([
            'title' => $this->article->title,
            'history_before' => $history->before,
            'history_after' => $history->after,
            'action' => 'Перейти на статью: ' . url('/articles/' . $this->article->slug),
        ]);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('web-socket');
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
            ->line('Статья ' . $this->article->title . ' изменена.')
            ->action('Перейти на статью', url('/articles/' . $this->article->slug))
            ->line('Спасибо что используете наше приложение!');
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
