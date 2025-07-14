<?php

namespace Bhry98\Bhry98LaravelReady\Filament\Pages\Auth;

use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreModel;
use Bhry98\Bhry98LaravelReady\Services\system\logs\SystemLogsUsersLogonsService;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Http\Responses\Auth\LoginResponse;
use Filament\Pages\Auth\Login as BaseAuth;
use Filament\Forms\Form;
use Illuminate\Validation\ValidationException;

class Bhry98Login extends BaseAuth
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
//                $this->getLoginFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

//    protected function getLoginFormComponent(): Component
//    {
//        return TextInput::make('username')
//            ->label('Username')
//            ->required()
//            ->autocomplete()
//            ->autofocus()
//            ->extraInputAttributes(['tabindex' => 1]);
//    }


    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            "email"=> $data['email'],
            'password' => $data['password'],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState(); // Get the submitted form data

        if (auth()->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {
            session()->regenerate();
//            dd(auth()->user());
            (new SystemLogsUsersLogonsService())->createLogonLog();
            return app(LoginResponse::class);
        }
        $this->throwFailureValidationException();
    }

    /**
     * @throws ValidationException
     */
    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.login' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}