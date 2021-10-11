<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Article;
use App\Models\User;
use App\Notifications\SendDigest as NotificationSendDigest;

class SendDigest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:digest
                            {--subject=Новые опубликованые статьи за неделю : Заголовок письма}
                            {--period=7 : Период дней}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда рассылает всем пользователям сообщение о новых статьях, за период в днях';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $period = $this->option('period');

        $articles = Article::where([
            ['created_at', '>', Carbon::now()->subDays($period)],
            ['is_published', true],
        ])->get();

        $subject = $this->option('subject');
        $users = User::all();
        $users->map->notify(new NotificationSendDigest($articles, $subject));

        $this->info('Уведомления отравлены');
    }
}
