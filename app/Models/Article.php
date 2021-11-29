<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
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
}
