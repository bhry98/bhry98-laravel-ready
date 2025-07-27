<?php

namespace Bhry98\Users\Filament\Resources\Bhry98UsersResource\Pages;

use Bhry98\Users\Enums\UsersAccountTypes;
use Bhry98\Users\Enums\UsersGenders;
use Bhry98\Users\Enums\UsersTitles;
use Bhry98\Users\Filament\Resources\Bhry98UsersResource\Bhry98UsersResource;

use Bhry98\Users\Models\UsersCoreModel;
use Bhry98\Users\Services\UsersManagementService;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class CreateUsers extends CreateRecord
{
    protected static string $resource = Bhry98UsersResource::class;
    protected static bool $canCreateAnother = false;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        return (new UsersManagementService())->createNew($data);
    }

    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }

//    public function form(Form $form): Form
//    {
//        $inputs[] = TextInput::make('first_name')->label(__("Bhry98::users.first-name"))->required()->maxLength(30)->minLength(2)->string();
//        $inputs[] = TextInput::make('middle_name')->label(__("Bhry98::users.middle-name"))->nullable()->maxLength(30)->minLength(2)->string();
//        $inputs[] = TextInput::make('last_name')->label(__("Bhry98::users.last-name"))->required()->maxLength(30)->minLength(2)->string();
//        $inputs[] = TextInput::make('display_name')->label(__("Bhry98::users.display-name"))->nullable()->maxLength(60)->minLength(5)->string();
//        $inputs[] = PhoneInput::make('phone_number')->label(__("Bhry98::users.phone-number"))->nullable()->defaultCountry('EG');
//        $inputs[] = TextInput::make('email')->label(__("Bhry98::users.email"))->required()->email()->unique((new UsersCoreModel)->getTable(), 'email', ignoreRecord: true);
//        $inputs[] = TextInput::make('work_email')->label(__("Bhry98::users.work-email"))->nullable()->email();
//        $inputs[] = TextInput::make('username')->label(__("Bhry98::users.username"))->nullable()->unique((new UsersCoreModel)->getTable(), 'username', ignoreRecord: true);
//        $inputs[] = Select::make('account_type')->label(__("Bhry98::users.account-type"))->searchable()->required()->options(UsersAccountTypes::class)->default(UsersAccountTypes::User->name);
//        $inputs[] = ToggleButtons::make('gender')->label(__("Bhry98::users.gender"))->required()->options(UsersGenders::class)->inline()->default(UsersGenders::Male->name);
//        $inputs[] = TextInput::make('national_id')->label(__("Bhry98::users.national-id"))->nullable()->unique((new UsersCoreModel)->getTable(), 'national_id', ignoreRecord: true);
//        $inputs[] = DatePicker::make('birthdate')->label(__("Bhry98::users.birthdate"))->nullable()->native(false);
//        $inputs[] = Select::make('nationality_id')->label(__("Bhry98::users.nationality"))->searchable()->preload()->nullable()->relationship('nationality', 'default_name')->getOptionLabelFromRecordUsing(fn($record) => $record->name_label);
//        $inputs[] = Select::make('country_id')->label(__("Bhry98::users.country"))->searchable()->preload()->nullable()->relationship('country', 'default_name')->getOptionLabelFromRecordUsing(fn($record) => $record->name_label)->live()->afterStateUpdated(function (Set $set) {
//            $set('governorate_id', null);
//            $set('city_id', null);
//        });
//        $inputs[] = Select::make('governorate_id')->label(__("Bhry98::users.governorate"))->searchable()->preload()->nullable()->relationship('governorate', 'default_name', fn($query, $get) => $query->where(['country_id' => $get('country_id')]))->getOptionLabelFromRecordUsing(fn($record) => $record->name)->disabled(fn($get) => is_null($get('country_id')))->live()->afterStateUpdated(fn($set) => $set('city_id', null));
//        $inputs[] = Select::make('city_id')->label(__("Bhry98::users.city"))->searchable()->preload()->nullable()->relationship('city', 'default_name', fn($query, $get) => $query->where(['governorate_id' => $get('governorate_id')]))->getOptionLabelFromRecordUsing(fn($record) => $record->name)->disabled(fn($get) => is_null($get('governorate_id')));
//        $inputs[] = Select::make('title')->label(__("Bhry98::users.title"))->searchable()->preload()->options(UsersTitles::class)->default(UsersTitles::Mr->name);;
//        $inputs[] = TextInput::make('job_position')->label(__("Bhry98::users.job-position"))->nullable()->maxLength(60)->minLength(5)->string();
//        $inputs[] = TimezoneSelect::make('timezone')->label(__("Bhry98::users.timezone"))->required()->default(config('app.timezone', "Africa/Cairo"));
//        $inputs[] = ToggleButtons::make('active')->label(__("Bhry98::users.active"))->required()->boolean()->default(true)->inline();
//        /**
//         * "must_verify_email",
//         * "must_verify_phone",
//         * "must_change_password",
//         * "bio",
//         * "language",
//         * "theme",
//         * "password",
//         * "type_id",
//         */
//        return $form
//            ->columns(4)->schema($inputs);
//    }
}
