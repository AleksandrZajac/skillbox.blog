<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'slug',
    //     'title',
    //     'short_description',
    //     'description'
    // ];

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
