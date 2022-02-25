<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_published'
    ];

    public function scopeIsPublished($query)
    {
        return $query->where('is_published', true);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            \Cache::tags(['news'])->flush();
        });

        static::updated(function () {
            \Cache::tags(['news'])->flush();
        });

        static::deleted(function () {
            \Cache::tags(['news'])->flush();
        });
    }
}
