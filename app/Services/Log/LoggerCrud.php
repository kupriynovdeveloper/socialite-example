<?php

namespace App\Services\Log;

use App\Logging\CustomizeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class LoggerCrud
{
    public static function logs(Model $model, string $nameFile): void
    {
        $path = strtolower(class_basename($model::class));

        $logger = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/'. $path. '/'. $nameFile. '.log'),
            'replace_placeholders' => true,
        ]);

        (new CustomizeFormatter())->__invoke($logger->getLogger());

        $message = self::prepareMessage($path, $nameFile);
        $attributes = $model->wasRecentlyCreated ? $model->getAttributes() : $model->getDirty();

        $logger->info($message, ['id' => $model->id, 'attributes' => $attributes]);
    }

    private static function prepareMessage(string $nameModel, string $nameMethod): string
    {
        return match ($nameMethod) {
            'created' => 'New '. $nameModel. ' ' .$nameMethod. ' success {id}, {attributes}',
            'updated' => $nameModel. ' {id} ' .$nameMethod. ', {attributes}',
            'deleted' => $nameModel. ' {id} '. $nameMethod,
        };
    }
}
