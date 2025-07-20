<?php

namespace Bhry98\AccountCenter\Filament\Pages\Auth;

use Bhry98\AccountCenter\Http\Responses\Bhry98AuthenticationLoginResponse;
use Bhry98\Users\Models\UsersCoreModel;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Http\Responses\Auth\LoginResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login as BaseAuth;
use Filament\Forms\Form;
use Illuminate\Validation\ValidationException;

class Bhry98AuthenticationLogin extends BaseAuth
{

    public int $step = 1;

    public ?UsersCoreModel $user = null;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent()->live()->disabled(fn(Get $get) => $this->step === 2)->dehydrated(),
                $this->getPasswordFormComponent()->live()->visible(fn(Get $get) => $get('email') && $this->step === 2),
                $this->getRememberFormComponent()->live()->visible(fn(Get $get) => $get('email') && $this->step === 2),
            ])
            ->statePath('data');
    }


    /**
     * @throws ValidationException
     */
    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();

        if ($this->step === 1) {
            // Step 1: Check if email exists and allowed
            $this->user = UsersCoreModel::query()->where('email', $data['email'])->first();
            if (!$this->user) {
                Notification::make()
                    ->danger()
                    ->title(__('User not found or not allowed to access admin panel.'))
                    ->send();

                $this->throwFailureValidationException();
            }
            // You can check for admin panel permission here if needed
            // if (! $this->user->canAccessAdminPanel()) { ... }
            $this->step = 2;
            // Refill form to trigger Livewire reactivity
            $this->form->fill([
                'email' => $data['email'],
                'password' => '',
            ]);
            return null; // re-render the form with password
        }

        // Step 2: Proceed to login
        if (auth()->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {
            session()->regenerate();
//            (new \SystemLogsUsersLogonsService())->createLogonLog();
//            return app(LoginResponse::class);
            return app(Bhry98AuthenticationLoginResponse::class);
        }

        $this->throwFailureValidationException();
    }

    /**
     * @throws ValidationException
     */
    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
    /////////////////////////////////////
//    public function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                $this->getEmailFormComponent(),
////                $this->getLoginFormComponent(),
////                $this->getPasswordFormComponent(),
////                $this->getRememberFormComponent(),
//            ])
//            ->statePath('data');
//    }
//
////    protected function getLoginFormComponent(): Component
////    {
////        return TextInput::make('username')
////            ->label('Username')
////            ->required()
////            ->autocomplete()
////            ->autofocus()
////            ->extraInputAttributes(['tabindex' => 1]);
////    }
//
//
//    protected function getCredentialsFromFormData(array $data): array
//    {
//        return [
//            "email"=> $data['email'],
//            'password' => $data['password'],
//        ];
//    }
//
//    /**
//     * @throws ValidationException
//     */
//    public function authenticate(): ?LoginResponse
//    {
//        $data = $this->form->getState(); // Get the submitted form data
//
//        if (auth()->attempt([
//            'email' => $data['email'],
//            'password' => $data['password'],
//        ])) {
//            session()->regenerate();
////            dd(auth()->user());
//            (new SystemLogsUsersLogonsService())->createLogonLog();
//            return app(LoginResponse::class);
//        }
//        $this->throwFailureValidationException();
//    }
//
//    /**
//     * @throws ValidationException
//     */
//    protected function throwFailureValidationException(): never
//    {
//        throw ValidationException::withMessages([
//            'data.login' => __('filament-panels::pages/auth/login.messages.failed'),
//        ]);
//    }
}