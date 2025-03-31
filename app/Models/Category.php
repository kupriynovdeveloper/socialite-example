<?php

namespace App\Models;

use App\Models\Traits\HasLog;
use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

//#[ObservedBy(CategoryObserver::class)]
class Category extends Model
{
    use HasFactory, HasLog;

    protected $fillable = [
        'title',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, Post::class);
    }

    public function comment(): HasOneThrough
    {
        return $this->hasOneThrough(Comment::class, Post::class)->latest();
    }
}
