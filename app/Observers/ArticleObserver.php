<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Arr;

class ArticleObserver
{
    /**
     * Handle the Article "updating" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updating(Article $article)
    {
        $after = $article->getDirty();
        $article->history()->attach(auth()->id(), [
            'before' => json_encode(Arr::only($article->fresh()->toArray(), array_keys($after))),
            'after' => json_encode($after),
        ]);
    }
}
