<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public static function articleTagsCloud()
    {
        return (new static)->has('articles')->get();
    }

    public static function newsTagsCloud()
    {
        return (new static)->has('news')->get();
    }
}
