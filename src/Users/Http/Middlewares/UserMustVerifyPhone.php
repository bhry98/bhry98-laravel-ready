<?php

namespace Bhry98\Users\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMustVerifyPhone
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()?->must_verify_phone) {
            return bhry98_response_authorization_error( __( 'Bhry98::responses.you-must-verify-phone-first'));
        }
        return $next($request);
    }
}
