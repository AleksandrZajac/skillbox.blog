<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'short_description',
        'description',
        'is_published'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_article');
    }

    public function scopeIsPublished($query)
    {
        return $query->latest()->where('is_published', true);
    }

    public function history()
    {
        return $this->belongsToMany(User::class, 'article_histories')
            ->withPivot(['before', 'after'])->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();
        static::updating(function (Article $article) {
            $after = $article->getDirty();
            $article->history()->attach(auth()->id(), [
                'before' => json_encode(Arr::only($article->fresh()->toArray(), array_keys($after))),
                'after' => json_encode($after),
            ]);
        });
    }
}
