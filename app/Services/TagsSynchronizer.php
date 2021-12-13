<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class TagsSynchronizer
{
    public function sync(string $tags, Model $model)
    {
        $syncIds = [];
        $tagsCollection = collect(explode(',', $tags));

        foreach ($tagsCollection  as $tagItem) {
            $tagItem = Tag::firstOrCreate(['name' => $tagItem]);
            $syncIds[] = $tagItem->id;
        }

        $model->tags()->sync($syncIds);
    }
}
