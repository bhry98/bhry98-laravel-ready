<?php

namespace Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages;

use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Bhry98UsersResource;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Services\users\UsersManagementService;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;
use Illuminate\Contracts\Support\Htmlable;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneEntry;

class ViewUsers extends ViewRecord
{
    protected static string $resource = Bhry98UsersResource::class;
    protected static string $view = 'Bhry98UsersResource::user-details';

    public static function getNavigationLabel(): string
    {
        return __("Bhry98::users.details");
    }

    public function getTitle(): string|Htmlable
    {
        return __("Bhry98::users.user-details", ['user' => $this->record?->display_name ?? $this->record?->email]) . " ({$this->record?->code})";
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->visible(fn(UsersCoreUsersModel $record) => $record->canEdit())
                ->action(fn(UsersCoreUsersModel $record, $data) => (new UsersManagementService())->updateUser($record->id, $data))
                ->slideOver()
                ->closeModalByClickingAway(false)
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        $sections = [];
//        $basicInfo[] = ImageEntry::make('avatar_base64')->label(__("Bhry98::users.avatar"))->circular()->height(40);
//        $basicInfo[] = TextEntry::make('code')->label(__("Bhry98::users.code"))->weight(FontWeight::Bold)->copyable();
        $basicInfo[] = TextEntry::make('first_name')->label(__("Bhry98::users.first-name"))->weight(FontWeight::Bold)->copyable();
        $basicInfo[] = TextEntry::make('last_name')->label(__("Bhry98::users.last-name"))->weight(FontWeight::Bold)->copyable();
        $basicInfo[] = TextEntry::make('display_name')->label(__("Bhry98::users.display-name"))->weight(FontWeight::Bold)->copyable();
        $basicInfo[] = TextEntry::make('gender.default_name')->label(__("Bhry98::users.gender"))->getStateUsing(fn($record) => $record->gender?->name ?? $record->gender?->default_name ?? "---")->weight(FontWeight::Bold)->copyable();
        $basicInfo[] = TextEntry::make('nationality.default_name')->label(__("Bhry98::users.nationality"))->getStateUsing(fn($record) => $record->nationality ? "({$record->nationality?->flag}) {$record->nationality?->name}" : "---")->weight(FontWeight::Bold)->copyable();
        $basicInfo[] = TextEntry::make('birthdate')->label(__("Bhry98::users.birthdate"))->getStateUsing(fn($record) => $record->birthdate ? Carbon::parse($record->birthdate)->format(config("bhry98.date.format_without_time")) : "---")->weight(FontWeight::Bold)->copyable();
        $basicInfo[] = TextEntry::make('national_id')->label(__("Bhry98::users.national-id"))->default("---")->weight(FontWeight::Bold)->copyable();
        $basicInfo[] = TextEntry::make('language.default_name')->label(__("Bhry98::users.lang"))->getStateUsing(fn($record) => $record->language?->name_label ?? "---")->weight(FontWeight::Bold)->copyable();
        $accountInfo[] = TextEntry::make('email')->label(__("Bhry98::users.email"))->weight(FontWeight::Bold)->copyable();
        $accountInfo[] = PhoneEntry::make('phone_number')->label(__("Bhry98::users.phone-number"))->weight(FontWeight::Bold)->copyable();
        $accountInfo[] = TextEntry::make('username')->label(__("Bhry98::users.username"))->weight(FontWeight::Bold)->copyable();
        $accountInfo[] = TextEntry::make('type.default_name')->label(__("Bhry98::users.type"))->getStateUsing(fn($record) => $record->type?->name ?? $record->type?->default_name ?? "---")->weight(FontWeight::Bold)->copyable();
        $accountInfo[] = TextEntry::make('country.default_name')->label(__("Bhry98::users.country"))->getStateUsing(fn($record) => $record->country ? "({$record->country?->flag}) {$record->country?->name}" : "---")->weight(FontWeight::Bold)->copyable();
        $accountInfo[] = TextEntry::make('governorate.default_name')->label(__("Bhry98::users.governorate"))->getStateUsing(fn($record) => $record->governorate?->name ?? $record->governorate?->default_name ?? "---")->weight(FontWeight::Bold)->copyable();
        $accountInfo[] = TextEntry::make('city.default_name')->label(__("Bhry98::users.city"))->getStateUsing(fn($record) => $record->city?->name ?? $record->city?->default_name ?? "---")->weight(FontWeight::Bold)->copyable();
        $accountInfo[] = TextEntry::make('timezone.default_name')->label(__("Bhry98::users.timezone"))->getStateUsing(fn($record) => $record->timezone?->name ?? $record->timezone?->default_name ?? "---")->weight(FontWeight::Bold)->copyable();
        $accountInfo[] = TextEntry::make('phone_number_verified_at')->label(__("Bhry98::users.phone-number-verified-at"))->getStateUsing(fn($record) => $record->phone_number_verified_at ? Carbon::parse($record->phone_number_verified_at)->format(config("bhry98.date.format.format")) : "---")->weight(FontWeight::Bold)->copyable();
        $accountInfo[] = TextEntry::make('email_verified_at')->label(__("Bhry98::users.email-verified-at"))->getStateUsing(fn($record) => $record->email_verified_at ? Carbon::parse($record->email_verified_at)->format(config("bhry98.date.format.format")) : "---")->weight(FontWeight::Bold)->copyable();
        $accountInfo[] = IconEntry::make('active')->label(__("Bhry98::global.active"))->boolean();
        $accountInfo[] = IconEntry::make('must_change_password')->label(__("Bhry98::users.must-change-password"))->boolean();
        $sections[] = Section::make(__("Bhry98::users.basic-info"))->columns(4)->schema($basicInfo);
        $sections[] = Section::make(__("Bhry98::users.account-info"))->columns(4)->schema($accountInfo);
        return $infolist->schema($sections);
    }
}
