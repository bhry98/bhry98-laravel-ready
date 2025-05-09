<?php


namespace Bhry98\Bhry98LaravelReady\Exceptions;

use ErrorException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

class HandlerUnAuthenticatedException extends ExceptionHandler
{
    /**
     * Render an unauthenticated response.
     */
    protected function unauthenticated($request, AuthenticationException $exception): JsonResponse
    {
        $locale = $request->header(key: 'Accept-Language', default: 'en');
        if (in_array($locale, ['ar', 'en'])) {
            app()->setLocale($locale);
            config(['app.locale' => $locale]);
        }
        return bhry98_response_unauthenticated();
    }

    public function render($request, Throwable $e): \Symfony\Component\HttpFoundation\Response
    {
        $locale = $request->header(key: 'Accept-Language', default: 'en');
        if (in_array($locale, ['ar', 'en'])) {
            app()->setLocale($locale);
            config(['app.locale' => $locale]);
        }
        if ($e instanceof AuthorizationException) {
            return bhry98_response_authorization_error();
        }
        if ($e instanceof ErrorException) {
            return bhry98_response_internal_error([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine()

            ]);
        }

//        if (!app()->isProduction()) {
//            return bhry98_response_internal_error([
//                'message' => $e->getMessage(),
//                'code' => $e->getCode(),
//                'file' => $e->getFile(),
//                'line' => $e->getLine()
//            ]);
//
//        }
        return parent::render($request, $e);

    }
}
