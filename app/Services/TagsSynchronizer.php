<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class TagsSynchronizer
{

    public function sync(Collection $tags, Model $model)
    {
        $articleTags = $model->tags->keyBy('name');

        $tagsToAttach = $tags->diffKeys($articleTags);

        $syncIds = $articleTags->intersectByKeys($tags)->pluck('id')->toArray();

        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $model->tags()->sync($syncIds);
    }
}
