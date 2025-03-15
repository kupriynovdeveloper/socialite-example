<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Log;

class CategoryObserver
{
    const EVENT_CREATED = 'created';
    const EVENT_UPDATED = 'updated';
    const EVENT_DELETED = 'deleted';
    const EVENT_RETRIEVED = 'retrieved';

    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        Log::create(array(
            'name_model' => $category::class,
            'name_event' => self::EVENT_CREATED,
            'old_field' => $category->getOriginal(),
            'new_field' => $category->getAttributes()
        ));
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        Log::create([
            'name_model' => $category::class,
            'name_event' => self::EVENT_UPDATED,
            'old_field' => $category->getOriginal(),
            'new_field' => $category->getAttributes()
        ]);
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        Log::create([
            'name_model' => $category::class,
            'name_event' => self::EVENT_DELETED,
            'old_field' => $category->getOriginal(),
            'new_field' => $category->getAttributes()
        ]);
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }

    public function retrieved(Category $category): void
    {
        Log::create([
            'name_model' => $category::class,
            'name_event' => self::EVENT_RETRIEVED,
            'old_field' => $category->getOriginal(),
            'new_field' => $category->getAttributes()
        ]);
    }
}
