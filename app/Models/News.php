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
}
