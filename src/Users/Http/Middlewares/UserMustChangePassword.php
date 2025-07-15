<?php

namespace Bhry98\Users\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMustChangePassword
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()?->must_change_password) {
            return bhry98_response_authorization_error( __( 'Bhry98::responses.you-must-change-password'));
        }
        return $next($request);
    }
}
