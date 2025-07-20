<?php

namespace Bhry98\AccountCenter\Http\Responses;

use Bhry98\AccountCenter\Filament\Pages\Applications\ApplicationsSwitcher;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class Bhry98AuthenticationLoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        // Here, you can define which resource and which page you want to redirect to
//        return redirect()->to(Applications::getUrl());
//        dd(
//            Filament::getCurrentPanel()->getUrl(),
//            ,
//            Filament::getCurrentPanel()->getId(),
//            ApplicationsSwitcher::getRoutePath());
//        return redirect()->to("/SelfService/MyApplications");
        $panelPath = Filament::getCurrentPanel()->getPath();
        $panelRoutePath = ApplicationsSwitcher::getRoutePath();
//        dd("{$panelPath}{$panelRoutePath}");
        return redirect()->to("{$panelPath}{$panelRoutePath}");
    }
}
