<?php

namespace App\Models;

use App\Events\ArticleCreated;
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

    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_article');
    }

    public function scopeIsPublished($query)
    {
        return $query->latest()->where('is_published', true);
    }
}
