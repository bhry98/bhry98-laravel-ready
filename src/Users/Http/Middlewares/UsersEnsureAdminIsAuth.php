<?php

namespace Bhry98\Users\Http\Middlewares;

use Bhry98\Users\Enums\UsersAccountTypes;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersEnsureAdminIsAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $panel = Filament::getCurrentPanel();
        $panelId = $panel?->getId();
        $loginRoute = "filament.{$panelId}.auth.login";
        if (!auth()->check()) {
            return redirect()->route($loginRoute);
        }
        if (!is_null(auth()->user()->deleted_at)) {
            auth()->logout();
            return redirect()
                ->route($loginRoute)
                ->with('error', __('Your account has been deactivated.'));
        }
        if (!auth()->user()->active) {
            auth()->logout();
            return redirect()
                ->route($loginRoute)
                ->with('error', __('Your account is inactive.'));
        }

        return $next($request);
//        if (!auth()->check()) return redirect()->route('filament.center.auth.login');
//        if (!is_null(auth()->user()->deleted_at)) {
//            auth()->logout();
//            return redirect()
//                ->route('filament.center.auth.login')
//                ->with('error', __('Your account has been deactivated.'));
//        }
//        if (!auth()->user()->active) {
//            auth()->logout();
//            return redirect()
//                ->route('filament.center.auth.login')
//                ->with('error', __('Your account is inactive.'));
//        }
//        return $next($request);
    }
}
