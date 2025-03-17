<?php

namespace App\Models\Traits;

use App\Filters\AbstractFilter;
use App\Filters\PostFilter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilter
{
    public function scopeFilter(Builder $builder, array $data): Builder
    {
        $ClassName = "App\\Filters\\". class_basename($this). 'Filter';

        /** @var $ClassName AbstractFilter */
        if (class_exists($ClassName)) {
            return (new $ClassName())->apply($builder, $data);
        }
        return $builder;
    }
}
