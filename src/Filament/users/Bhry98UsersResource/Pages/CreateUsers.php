<?php

namespace Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages;

use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsCoreTypes;
use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Bhry98UsersResource;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Services\enums\EnumsManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\CitiesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\CountriesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\GovernorateManagementService;
use Bhry98\Bhry98LaravelReady\Services\users\UsersManagementService;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Pages\CreateRecord;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class CreateUsers extends CreateRecord
{
    protected static string $resource = Bhry98UsersResource::class;
    protected static bool $canCreateAnother = false;


    public function form(Form $form): Form
    {
        $personalInputs[] = TextInput::make('code')->label(__("Bhry98::users.code"))->nullable()->unique(UsersCoreUsersModel::TABLE_NAME, "code", ignoreRecord: true);
        $personalInputs[] = TextInput::make('first_name')->label(__("Bhry98::users.first-name"))->live(debounce: 500)->required()->afterStateUpdated(fn($get, $set) => $set('display_name', trim($get('first_name')) . " " . trim($get('last_name'))));
        $personalInputs[] = TextInput::make('last_name')->label(__("Bhry98::users.last-name"))->live(debounce: 500)->required()->afterStateUpdated(fn($get, $set) => $set('display_name', trim($get('first_name')) . " " . trim($get('last_name'))));
        $personalInputs[] = TextInput::make('display_name')->label(__("Bhry98::users.display-name"))->required();
        $personalInputs[] = Select::make('gender_id')->relationship('gender', 'default_name')->options((new EnumsManagementService())->selectOptions(EnumsCoreTypes::UsersGender->name))->getSearchResultsUsing(fn($search) => (new EnumsManagementService())->searchByName(EnumsCoreTypes::UsersGender->name, $search))->searchable()->preload()->label(__("Bhry98::users.gender"))->required();
        $personalInputs[] = Select::make('nationality_id')->relationship('nationality', 'default_name')->getOptionLabelFromRecordUsing(fn($record) => $record->name_label)->getSearchResultsUsing(fn($search) => (new CountriesManagementService())->searchByName($search))->searchable()->preload()->label(__("Bhry98::users.nationality"))->required();
        $personalInputs[] = DatePicker::make('birthdate')->native(false)->label(__("Bhry98::users.birthdate"))->nullable();
        $personalInputs[] = Select::make('lang')->getOptionLabelFromRecordUsing(fn($record) => $record->name_label)->options(fn() => (new CountriesManagementService())->getOptions())->getSearchResultsUsing(fn($search) => (new CountriesManagementService())->searchByName($search))->searchable()->preload()->label(__("Bhry98::users.lang"))->required();
        $personalInputs[] = TextInput::make('national_id')->numeric()->label(__("Bhry98::users.national-id"))->nullable();
        $accountInputs[] = TextInput::make('email')->label(__("Bhry98::users.email"))->email()->unique(UsersCoreUsersModel::TABLE_NAME, "email", ignoreRecord: true)->required();
        $accountInputs[] = PhoneInput::make('phone_number')->label(__("Bhry98::users.phone-number"))->defaultCountry(bhry98_get_setting("default_input_phone_country", "EG"))->required();
        $accountInputs[] = TextInput::make('username')->label(__("Bhry98::users.username"))->maxLength(100)->unique(UsersCoreUsersModel::TABLE_NAME, "username", ignoreRecord: true)->nullable();
        $accountInputs[] = Select::make('type_id')->relationship('type', 'default_name')->options((new EnumsManagementService())->selectOptions(EnumsCoreTypes::UsersType->name))->getSearchResultsUsing(fn($search) => (new EnumsManagementService())->searchByName(EnumsCoreTypes::UsersType->name, $search))->searchable()->preload()->label(__("Bhry98::users.type"))->required();
        $accountInputs[] = Select::make('timezone_id')->relationship('timezone', 'default_name')->options((new EnumsManagementService())->selectOptions(EnumsCoreTypes::Timezone->name))->getSearchResultsUsing(fn($search) => (new EnumsManagementService())->searchByName(EnumsCoreTypes::Timezone->name, $search))->searchable()->preload()->label(__("Bhry98::users.timezone"))->required();
        $accountInputs[] = TextInput::make('password')->label(__("Bhry98::users.password"))->maxLength(100)->password()->minLength(8)->maxLength(20)->revealable();
        $accountInputs[] = Select::make('country_id')->relationship('country', 'default_name')->getSearchResultsUsing(fn($search) => (new CountriesManagementService())->searchByName($search))->getOptionLabelFromRecordUsing(fn($record) => $record->name_label)->reactive()->afterStateUpdated(function (Set $set) {
            $set('governorate_id', null);
            $set('city_id', null);
        })->searchable()->preload()->label(__("Bhry98::users.country"))->required();
        $accountInputs[] = Select::make('governorate_id')->relationship('governorate', 'default_name')->disabled(fn($get) => !$get('country_id'))->options(fn($get) => (new GovernorateManagementService())->getOptions(countryId: $get('country_id')))->getSearchResultsUsing(fn($search, $get) => (new GovernorateManagementService())->getOptions($search, countryId: $get('country_id')))->reactive()->searchable()->preload()->label(__("Bhry98::users.governorate"))->nullable();
        $accountInputs[] = Select::make('city_id')->relationship('city', 'default_name')->disabled(fn($get) => !$get('governorate_id'))->options(fn($get) => (new CitiesManagementService())->getOptions(governorateId: $get('governorate_id')))->getSearchResultsUsing(fn($search, $get) => (new CitiesManagementService())->getOptions($search, governorateId: $get('governorate_id')))->reactive()->searchable()->preload()->label(__("Bhry98::users.city"))->nullable();
        $accountInputs[] = Toggle::make('active')->label(__("Bhry98::global.active"))->default(true)->inline(false);
        $accountInputs[] = Toggle::make('must_change_password')->label(__("Bhry98::users.must-change-password"))->default(true)->inline(false);

        $tabs[] = Tab::make(__("Bhry98::users.basic-info"))->columns(3)->schema($personalInputs);
        $tabs[] = Tab::make(__("Bhry98::users.account-info"))->columns(3)->schema($accountInputs);
        return $form->schema([Tabs::make()->columnSpanFull()->schema($tabs)]);
    }
}
