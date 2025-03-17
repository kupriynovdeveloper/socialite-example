<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Symfony\Component\HttpKernel\Exception\NotFoundHttpException $exception, $request) {
            return response()->json([
                'error' => 'Запрашиваемый ресурс не найден',
                'status' => $exception->getStatusCode(),
            ], 404);
        });

        /*$exceptions->render(function (Illuminate\Database\QueryException $exception, $request) {
            return response()->json([
                'error' => 'Internal Server Error',
            ], 500);
        });*/

        $exceptions->render(function (Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $exception, $request) {
            return response()->json([
                'error' => 'Method Not Allowed',
                'status' => $exception->getStatusCode(),
            ], 405);
        });
    })->create();
