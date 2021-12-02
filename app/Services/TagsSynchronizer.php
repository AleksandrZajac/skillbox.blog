<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class TagsSynchronizer
{
    public function sync(Model $model)
    {
        $syncIds = [];
        $tags = collect(explode(',', request('tags')));

        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $model->tags()->sync($syncIds);
    }
}
