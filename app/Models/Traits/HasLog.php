<?php

namespace App\Models\Traits;

use App\Events\LogFinishedEvent;
use App\Events\LogStartedEvent;
use App\Models\Log;
use App\Services\Log\LoggerCrud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log as LogIlluminate;

trait HasLog
{
    const EVENT_CREATED = 'created';
    const EVENT_UPDATED = 'updated';
    const EVENT_DELETED = 'deleted';
    const EVENT_RETRIEVED = 'retrieved';

    protected static function bootHasLog(): void
    {
        static::created(function (Model $model) {
            event(new LogStartedEvent($model::class, self::EVENT_CREATED));

            $log = Log::create(array(
                'name_model' => $model::class,
                'name_event' => self::EVENT_CREATED,
                'old_field' => $model->getOriginal(),
                'new_field' => $model->getAttributes()
            ));

            LoggerCrud::logs(model: $model, nameFile: self::EVENT_CREATED);

            event(new LogFinishedEvent($log));
        });
        static::updated(function (Model $model) {
            Log::create(array(
                'name_model' => $model::class,
                'name_event' => self::EVENT_UPDATED,
                'old_field' => $model->getOriginal(),
                'new_field' => $model->getAttributes()
            ));
            LoggerCrud::logs(model: $model, nameFile: self::EVENT_UPDATED);
        });
        static::deleted(function (Model $model) {
            Log::create(array(
                'name_model' => $model::class,
                'name_event' => self::EVENT_DELETED,
                'old_field' => $model->getOriginal(),
                'new_field' => $model->getAttributes()
            ));
            LoggerCrud::logs(model: $model, nameFile: self::EVENT_DELETED);
        });
    }
}
