<?php

namespace Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource;

use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsCoreTypes;
use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages\CreateUsers;
use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages\ListUsers;
use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages\ManageUserLogons;
use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages\ViewUserLogs;
use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages\ViewUserNotifications;
use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages\ViewUsers;
use Bhry98\Bhry98LaravelReady\Models\enums\EnumsCoreModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Services\enums\EnumsManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\CitiesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\CountriesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\GovernorateManagementService;
use Bhry98\Bhry98LaravelReady\Services\users\UsersManagementService;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

//use Filament\;
class Bhry98UsersResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $model = UsersCoreUsersModel::class;

    public static function canAccess(): bool
    {
        return auth()->user()->can('Users.All');
    }

    public static function getRoutePrefix(): string
    {
        return '/users';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Bhry98::users.manage');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Bhry98::users.users');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Bhry98::users.users');
    }

    public static function getLabel(): ?string
    {
        return __('Bhry98::users.users');
    }


//    public static function infolist(Infolist $infolist): Infolist
//    {
//        return $infolist
//            ->schema(self::usersInfoList());
//    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions(config("bhry98.filament.pagination.per_page"))
            ->columns([
                TextColumn::make('code')
                    ->label(__('Bhry98::users.code'))
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->searchable(),
                TextColumn::make('first_name')
                    ->label(__('Bhry98::users.first-name'))
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('last_name')
                    ->label(__('Bhry98::users.last-name'))
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('display_name')
                    ->label(__('Bhry98::users.display-name'))
                    ->toggleable(),
                TextColumn::make('phone_number')
                    ->label(__('Bhry98::users.phone-number'))
                    ->toggleable(),
                TextColumn::make('phone_number_verified_at')
                    ->label(__('Bhry98::users.phone-number-verified-at'))
                    ->getStateUsing(fn($record) => $record->phone_number_verified_at ? Carbon::parse($record->phone_number_verified_at)->format(config("bhry98.date.format")) : "---")
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('email')
                    ->label(__('Bhry98::users.email'))
                    ->toggleable(),
                TextColumn::make('email_verified_at')
                    ->label(__('Bhry98::users.email-verified-at'))
                    ->getStateUsing(fn($record) => $record->email_verified_at ? Carbon::parse($record->email_verified_at)->format(config("bhry98.date.format")) : "---")
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('birthdate')
                    ->label(__('Bhry98::users.birthdate'))
                    ->getStateUsing(fn($record) => $record->birthdate ? Carbon::parse($record->birthdate)->format(config("bhry98.date.format")) : "---")
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('username')
                    ->label(__('Bhry98::users.username'))
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('national_id')
                    ->label(__('Bhry98::users.national-id'))
                    ->default("--")
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('gender.default_name')
                    ->getStateUsing(fn($record) => $record->gender?->name ?? $record->gender?->default_name ?? "---")
                    ->toggleable()
                    ->label(__('Bhry98::users.gender')),
                TextColumn::make('nationality.default_name')
                    ->getStateUsing(fn($record) => $record->nationality ? "({$record->nationality->flag}) {$record->nationality->name}" : "---")
                    ->toggleable()
                    ->label(__('Bhry98::users.nationality')),
                TextColumn::make('country.default_name')
                    ->getStateUsing(fn($record) => $record->country ? "({$record->country->flag}) {$record->country->name}" : "---")
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->label(__('Bhry98::users.country')),
                TextColumn::make('governorate.default_name')
                    ->getStateUsing(fn($record) => $record->governorate?->name ?? $record->governorate?->default_name ?? "---")
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->label(__('Bhry98::users.governorate')),
                TextColumn::make('city.default_name')
                    ->getStateUsing(fn($record) => $record->city?->name ?? $record->city?->default_name ?? "---")
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->label(__('Bhry98::users.city')),
                TextColumn::make('timezone.default_name')
                    ->getStateUsing(fn($record) => $record->timezone?->name ?? $record->timezone?->default_name ?? "---")
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->label(__('Bhry98::users.timezone')),
                TextColumn::make('type.default_name')
                    ->getStateUsing(fn($record) => $record->type?->name ?? $record->type?->default_name ?? "---")
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->label(__('Bhry98::users.type')),
                TextColumn::make('lang')
                    ->getStateUsing(fn($record) => $record->lang ?? "---")
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->label(__('Bhry98::users.lang')),
                IconColumn::make('active')
                    ->boolean()
                    ->toggleable()
                    ->label(__('Bhry98::global.active')),
                IconColumn::make('must_change_password')
                    ->boolean()
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->label(__('Bhry98::users.must-change-password')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()->visible(auth()->user()->can('Users.ForceDelete') || auth()->user()->can('Users.Delete')),
                Tables\Filters\TernaryFilter::make('active')->label(__("Bhry98::global.active")),
                Tables\Filters\TernaryFilter::make('must_change_password')->label(__("Bhry98::users.must-change-password")),
            ])
            ->actions([

            ])
            ->bulkActions([
            ]);
    }

    public static function form(Form $form): Form
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


    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getRecordSubNavigation(\Filament\Pages\Page $page): array
    {
        $pages = array_merge(
            [
                ViewUsers::class,
                ViewUserLogs::class,
                ViewUserNotifications::class,
                ManageUserLogons::class,
            ],
            static::discoverPages(true),
        );
//        dd($pages);
        return $page->generateNavigationItems($pages);
    }

    public static function getPages(): array
    {

        $pages = array_merge(
            [
                'index' => ListUsers::route('/'),
//                'create' => CreateUsers::route('/create'),
                'view' => ViewUsers::route('/{record:code}'),
                'logons' => ManageUserLogons::route('/{record:code}/logons'),
                'logs' => ViewUserLogs::route('/{record:code}/logs'),
                'notifications' => ViewUserNotifications::route('/{record:code}/notifications'),
            ],
            static::discoverPages(),
        );
        return $pages;
    }

    /**
     * Discovers and maps page routes from configuration.
     *
     * @return array<string, mixed> Array of discovered page routes
     */
    protected static function discoverPages(bool $forSubNavigation = false): array
    {
        try {
            return collect(config('bhry98.filament.users-pages', []))
                ->filter(function (string $class): bool {
                    return class_exists($class) && method_exists($class, 'route');
                })
                ->mapWithKeys(function (string $class) use ($forSubNavigation): array {
                    $baseName = str($class)->classBasename()->kebab()->toString();
                    return $forSubNavigation ? [$class] : [$baseName => $class::route('/{record:code}/' . $baseName)];
                })
                ->all();
        } catch (\Throwable $e) {
            report($e);
            return [];
        }
    }
}