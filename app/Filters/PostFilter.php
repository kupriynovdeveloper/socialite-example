<?php

namespace App\Filters;

use App\Models\Like;
use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{
    protected array $keys = [
        'id',
        'title',
        'view_to',
        'view_from',
        'published_at_to',
        'published_at_from',
        'category_title',
        'likes_to',
        'likes_from'
    ];

    protected function title(Builder $builder, $value): void
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    protected function viewTo(Builder $builder, $value): void
    {
        $builder->where('view', '>=', $value);
    }

    protected function viewFrom(Builder $builder, $value): void
    {
        $builder->where('view', '<=', $value);
    }

    protected function publishedAtTo(Builder $builder, $value): void
    {
        $builder->where('published_at', '>=', $value);
    }

    protected function publishedAtFrom(Builder $builder, $value): void
    {
        $builder->where('published_at', '<=', $value);
    }

    protected function categoryTitle(Builder $builder, $value): void
    {
        $builder->whereRelation('category', 'title', $value);
    }

    protected function id(Builder $builder, $value): void
    {
        $builder->where('id', $value);
    }

    protected function likesTo(Builder $builder, $value): void
    {
        $builder->withCount('likes')->having('likes_count', '>=', $value);
    }

    protected function likesFrom(Builder $builder, $value): void
    {
        $builder->withCount('likes')->having('likes_count', '<=', $value);
    }
}
