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
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Filament\Forms;
class Bhry98ProfileUpdateCop extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static string $view = 'AC::auth.update-profile';
    protected static ?string $title = 'Edit Profile';
    protected static ?string $navigationGroup = 'Account Settings';
    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public static function getRouteName(?string $panel = null): string
    {
        return 'filament.center.pages.bhry98-profile-update';
    }
    public function mount(): void
    {
        dd('$panel');

        $this->form->fill(auth()->user()->toArray());
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('password')
                ->password()
                ->label('New Password')
                ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                ->dehydrated(fn ($state) => filled($state))
                ->maxLength(255),
        ];
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data');
    }

    public function save(): void
    {
        $user = auth()->user();

        $user->update($this->form->getState());

        Notification::make()
            ->title('Profile updated successfully!')
            ->success()
            ->send();
    }
}