<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function scopeRoleUser($query)
    {
        return $query->where('name', 'user');
    }

    public function scopeRoleAdmin($query)
    {
        return $query->where('name', 'admin');
    }
}
