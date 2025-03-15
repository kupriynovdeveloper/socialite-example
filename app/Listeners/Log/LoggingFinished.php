<?php

namespace App\Listeners\Log;

use App\Events\LogFinishedEvent;
use Illuminate\Support\Facades\Log;

class LoggingFinished
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LogFinishedEvent $event): void
    {
        Log::info("Логирование завершено: {$event->log->name_model} (событие: {$event->log->name_event})");
    }
}
