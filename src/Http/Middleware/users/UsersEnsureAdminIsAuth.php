<?php

namespace Bhry98\Bhry98LaravelReady\Http\Middleware\users;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersEnsureAdminIsAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) return redirect()->route('filament.center.auth.login');
        if (!is_null(auth()->user()->deleted_at)) {
            auth()->logout();
            return redirect()
                ->route('filament.center.auth.login')
                ->with('error', __('Your account has been deactivated.'));
        }
        if (!auth()->user()->active) {
            auth()->logout();
            return redirect()
                ->route('filament.center.auth.login')
                ->with('error', __('Your account is inactive.'));
        }
        return $next($request);
    }
}
