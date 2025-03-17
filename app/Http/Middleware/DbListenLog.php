<?php

namespace App\Http\Middleware;

use App\Models\DbListenLog as CustomLog;
use Closure;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DbListenLog
{
    private array $method = [
        'select',
        'insert',
        'update',
        'delete',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $logging = true;

        DB::listen(function (QueryExecuted $query) use ($request, $next, &$logging) {
            if (!$logging) {
                return; // Игнорируем запросы, связанные с записью логов
            }

            $logging = false;

            CustomLog::create([
                'user' => 'login: ' .$request->user()->login. ', email: ' .$request->user()->email,
                //'count_requests' => '',
                'sql' => $query->toRawSql(). PHP_EOL,
                'status' => $next($request)->getStatusCode(),
                'time' => +$query->time,
                //'message' => $next($request)->exception?->message(),
                'route' => $request->route()->getName(),
            ]);

            $logging = true;
        });

        return $next($request);
    }
}
