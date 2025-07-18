<?php

namespace Bhry98\Helpers\middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocales
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->header(key: 'Accept-Language', default: 'en');
        if (in_array($locale, ['ar', 'en'])) {
            app()->setLocale($locale);
            config(['app.locale' => $locale]);
        }
        return $next($request);
    }
}
