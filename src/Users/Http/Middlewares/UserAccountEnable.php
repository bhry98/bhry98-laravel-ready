<?php

namespace Bhry98\Users\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccountEnable
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && !auth()->user()?->active) {
            return bhry98_response_authorization_error( __( 'Bhry98::responses.your-account-disabled'));
        }
        return $next($request);
    }
}
