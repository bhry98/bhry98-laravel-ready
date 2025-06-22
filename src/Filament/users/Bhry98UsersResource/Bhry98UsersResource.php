<?php

namespace Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource;

use App\Filament\Resources\Users;
use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsCoreTypes;
use Bhry98\Bhry98LaravelReady\Filament\Bhry98UsersResource\Modules;
use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages\ListUsers;
use Bhry98\Bhry98LaravelReady\Models\enums\EnumsCoreModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Services\locations\CitiesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\CountriesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\GovernorateManagementService;
use Bhry98\Bhry98LaravelReady\Services\users\UsersManagementService;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

//use Filament\;
class Bhry98UsersResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $model = UsersCoreUsersModel::class;

    public static function canAccess(): bool
    {
        return auth()->user()->can(abilities: 'CoreUsers.All');
    }

    public static function getRoutePrefix(): string
    {
        return '/users';
    }

    public static function getNavigationGroup(): ?string
    {
        return __(key: 'center.users.user');
    }

    public static function getPluralLabel(): ?string
    {
        return __(key: 'center.users.manage');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

//    public static function infolist(Infolist $infolist): Infolist
//    {
//        return $infolist
//            ->schema(self::usersInfoList());
//    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(name: 'last_name')
                    ->label(__(key: 'center.users.last-name'))
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make(name: 'type.name')
                    ->label(__(key: 'center.users.type')),
                Tables\Columns\TextColumn::make(name: 'phone_number')
                    ->copyable()
                    ->default(state: '---')
                    ->label(__(key: 'center.users.phone-number'))
                    ->searchable(),
                Tables\Columns\TextColumn::make(name: 'gender.name')
                    ->default(state: '---')
                    ->label(__(key: 'center.users.gender')),
                Tables\Columns\TextColumn::make(name: 'email')
                    ->default(state: '---')
                    ->copyable()
                    ->label(__(key: 'center.users.email')),
                Tables\Columns\IconColumn::make(name: 'active')
                    ->boolean()
                    ->label(__(key: 'center.active')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->label(__(key: 'center.delete'))
                    ->visible(auth()->user()->can(abilities: 'CoreUsers.ForceDelete') || auth()->user()->can(abilities: 'CoreUsers.Delete'))
            ])
            ->actions([

                ActionGroup::make([
//                    Tables\Actions\ViewAction::make()
//                        ->label(__(key: "center.view"))
//                        ->visible(fn(Model $record) => is_null($record->deleted_at) && auth()->user()->can(abilities: 'CoreUsers.Retrieve'))
//                        ->url(fn($record) => Users\UsersResource\Pages\ViewUsers::getUrl([$record])),
                    Tables\Actions\EditAction::make()
                        ->label(__(key: "center.modify"))
                        ->visible(fn(Model $record) => is_null($record->deleted_at) && auth()->user()->can(abilities: 'CoreUsers.Update'))
                        ->form(form: fn(Model $record) => self::usersForm($record))
                        ->using(fn(Model $record, array $data) => (new UsersManagementService())->updateProfile(identityCode: $record->identity_code ?? "", data: $data))
                        ->slideOver()
                        ->stickyModalFooter(),
                    Tables\Actions\EditAction::make("active")
                        ->label(__(key: "center.enable-disable"))
                        ->color(Color::Gray)
                        ->visible(fn(Model $record) => is_null($record->deleted_at) && auth()->user()->can(abilities: 'CoreUsers.Update'))
                        ->requiresConfirmation()
                        ->action(fn(Model $record) => (new UsersManagementService())->changeAccountStatus(identityCode: $record->identity_code ?? "")),
                    Tables\Actions\EditAction::make("updatePassword")
                        ->label(__(key: "center.update-password"))
                        ->color(Color::Orange)
                        ->visible(fn(Model $record) => $record->id != auth()->id() && is_null($record->deleted_at) && auth()->user()->can(abilities: 'CoreUsers.Update'))
                        ->requiresConfirmation()
                        ->fillForm(["password" => null, "password_confirmation" => null])
                        ->form(form: fn(Model $record) => [
                            TextInput::make(name: "password")
                                ->label(__(key: "center.users.password"))
                                ->password()
                                ->confirmed()
                                ->revealable()
                                ->required(),
                            TextInput::make('password_confirmation')
                                ->password()
                                ->revealable()
                                ->required()
                        ])
                        ->action(fn(Model $record, array $data) => (new UsersManagementService())->changePassword(identityCode: $record->identity_code ?? "", password: $data["password"])),
                    Tables\Actions\DeleteAction::make()
                        ->label(__(key: "center.delete"))
                        ->visible(fn(Model $record) => $record->id != auth()->id() && is_null($record->deleted_at) && auth()->user()->can(abilities: 'CoreUsers.Delete'))
                        ->action(fn(Model $record) => (new UsersManagementService())->delete(identityCode: $record->identity_code ?? "")),
                    Tables\Actions\ForceDeleteAction::make()
                        ->label(__(key: "center.force-delete"))
                        ->visible(fn(Model $record) => $record->id != auth()->id() && !is_null($record->deleted_at) && auth()->user()->can(abilities: 'CoreUsers.ForceDelete'))
                        ->action(fn(Model $record) => (new UsersManagementService())->forceDelete(identityCode: $record->identity_code ?? "")),

                ]),])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route(path: '/'),
//            'view' => Users\UsersResource\Pages\ViewUsers::route(path: '/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    static function usersForm($record = null): array
    {
        return [
            Fieldset::make(label: __(key: "center.users.account-information"))
                ->columns(columns: 3)
                ->schema([
                    TextInput::make(name: "first_name")->label(__(key: "center.users.first-name"))->maxLength(length: 50)->minLength(length: 3)->required(),
                    TextInput::make(name: "last_name")->label(__(key: "center.users.last-name"))->maxLength(length: 50)->minLength(length: 3)->required(),
                    Select::make(name: "type_id")
                        ->label(__(key: "center.users.type"))
                        ->relationship(name: 'type', titleAttribute: 'default_name')
                        ->searchable()
                        ->required()
                        ->disabled($record?->id == auth()->id())
                        ->searchable()
                        ->options(function (): array {
                            return EnumsCoreModel::with('localizations')
                                ->where([
                                    'type' => EnumsCoreTypes::UsersType,
                                    'module' => Modules::Core,
                                ])
                                ->get()
                                ->mapWithKeys(function ($model) {
                                    $label = optional($model->localizations->where('locale', app()->getLocale())->first())->value ?? $model->default_name;
                                    return [$model->id => $label];
                                })->toArray();
                        })
                        ->getSearchResultsUsing(function (string $search): array {
                            return EnumsCoreModel::query()
                                ->where([
                                    'type' => EnumsCoreTypes::UsersType,
                                    'module' => Modules::Core,
                                ])
                                ->whereHas('localizations', fn($q) => $q->where('locale', app()->getLocale())->where('value', 'like', "%{$search}%"))
                                ->limit(50)
                                ->get()
                                ->mapWithKeys(function ($model) {
                                    $label = optional($model->localizations->where('locale', app()->getLocale())->first())->value ?? 'N/A';
                                    return [$model->id => $label];
                                })
                                ->toArray();
                        })
                        ->getOptionLabelUsing(function ($value): ?string {
                            return EnumsCoreModel::with('localizations')
                                ->where('id', $value)
                                ->first()
                                ?->localizations
                                ->where('locale', app()->getLocale())
                                ->first()
                                ?->value;
                        }),
                    TextInput::make(name: "phone_number")
                        ->label(__(key: "center.users.phone-number"))
                        ->required()
                        ->unique(table: UsersCoreUsersModel::TABLE_NAME, column: "phone_number", ignorable: $record),
                    TextInput::make(name: "username")
                        ->label(__(key: "center.users.username"))
                        ->required()
                        ->unique(table: UsersCoreUsersModel::TABLE_NAME, column: "username", ignorable: $record),
                    TextInput::make(name: "email")
                        ->label(__(key: "center.users.email"))
                        ->nullable()
                        ->email()
                        ->unique(table: UsersCoreUsersModel::TABLE_NAME, column: "email", ignorable: $record),
                    TextInput::make(name: "password")
                        ->visible(is_null($record))
                        ->label(__(key: "center.users.password"))
                        ->password()
                        ->revealable()
                        ->required()
                        ->default(state: Str::password(length: 10)),
                ]),
            Fieldset::make(label: __(key: "center.users.personal-information"))
                ->columns(columns: 4)
                ->schema([
                    TextInput::make(name: "national_id")
                        ->label(__(key: "center.users.national-id"))
                        ->nullable()
                        ->numeric()
                        ->startsWith(values: [2, 3])
                        ->length(length: 14)
                        ->unique(table: UsersCoreUsersModel::TABLE_NAME, column: "national_id", ignorable: $record),
                    DatePicker::make(name: "birthdate")
                        ->label(__(key: "center.users.birthdate"))
                        ->date()
                        ->beforeOrEqual(now(tz: config('app.timezone'))->subYears(10)->startOfYear())
                        ->nullable(),
                    Select::make(name: "gender_id")
                        ->label(__(key: "center.users.gender"))
                        ->relationship(name: 'gender', titleAttribute: 'default_name')
                        ->searchable()
                        ->options(function (): array {
                            return EnumsCoreModel::with('localizations')
                                ->where([
                                    'type' => EnumsCoreTypes::UsersGender,
                                    'module' => Modules::Core,
                                ])
                                ->get()
                                ->mapWithKeys(function ($model) {
                                    $label = optional($model->localizations->where('locale', app()->getLocale())->first())->value ?? $model->default_name;
                                    return [$model->id => $label];
                                })->toArray();
                        })
                        ->required(),
                    Select::make(name: "country_id")
                        ->label(__(key: "center.users.country"))
                        ->relationship(name: 'country', titleAttribute: 'default_name')
                        ->searchable()
                        ->getSearchResultsUsing(fn(string $search) => (new CountriesManagementService())->searchByName($search))
                        ->nullable(),
                    Select::make(name: "governorate_id")
                        ->label(__(key: "center.users.governorate"))
                        ->relationship(name: 'governorate', titleAttribute: 'default_name')
                        ->searchable()
                        ->getSearchResultsUsing(fn(string $search) => (new GovernorateManagementService())->searchByName($search))
                        ->nullable(),
                    Select::make(name: "city_id")
                        ->label(__(key: "center.users.city"))
                        ->relationship(name: 'city', titleAttribute: 'default_name')
                        ->searchable()
                        ->getSearchResultsUsing(fn(string $search) => (new CitiesManagementService())->searchByName($search))
                        ->nullable(),
                    Select::make(name: "timezone_id")
                        ->label(__(key: "center.users.timezone"))
                        ->relationship(name: 'timezone', titleAttribute: 'default_name')
                        ->searchable()
                        ->options(function (): array {
                            return EnumsCoreModel::with('localizations')
                                ->where([
                                    'type' => EnumsCoreTypes::Timezone,
                                    'module' => Modules::Core,
                                ])
                                ->get()
                                ->mapWithKeys(function ($model) {
                                    $label = optional($model->localizations->where('locale', app()->getLocale())->first())->value ?? $model->default_name;
                                    return [$model->id => $label];
                                })->toArray();
                        })
                        ->nullable(),
                ]),
            Fieldset::make(label: __(key: "center.users.account-settings"))
                ->schema([
                    Toggle::make(name: "active")
                        ->inline(false)
                        ->label(__(key: "center.active"))
                        ->default(state: true),
                ])
        ];
    }
}
