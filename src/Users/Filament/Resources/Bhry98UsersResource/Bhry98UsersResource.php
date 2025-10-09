<?php

namespace Bhry98\Users\Filament\Resources\Bhry98UsersResource;

use Bhry98\Users\Enums\UsersAccountTypes;
use Bhry98\Users\Enums\UsersGenders;
use Bhry98\Users\Enums\UsersTitles;
use Bhry98\Users\Filament\Resources\Bhry98UsersResource\Pages\{CreateUsers,
    EditUsers,
    ListUsers,
    ManageUserGroupPolicies,
    ManageUserLogons,
    ManageUserLogs,
    ManageUserNotifications,
    ViewUsers
};
use Bhry98\Users\Models\UsersCoreModel;
use Bhry98\Users\Services\UsersManagementService;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class Bhry98UsersResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $model = UsersCoreModel::class;

    public static function canAccess(): bool
    {
        return auth()?->user()?->can('Users.All') ?? false;
    }

    public static function getEloquentQuery(): Builder
    {
        return UsersCoreModel::query()->with(['country', 'nationality', 'type']);
    }

    public static function getRoutePrefix(): string
    {
        return '/users';
    }

    public static function getNavigationGroup(): ?string
    {
        $currentPanelId = filament()->getCurrentPanel()?->getId();
        if ($currentPanelId === config('bhry98.filament.users.id')) {
            return null;
        }
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

    public static function form(Form $form): Form
    {

        return $form
            ->columns(4)->schema((new Bhry98UsersResource)->userFrom());
    }

    public static function userFrom(): array
    {
        $inputs[] = TextInput::make('first_name')->label(__("Bhry98::users.first-name"))->required()->maxLength(20)->minLength(2)->string();
        $inputs[] = TextInput::make('middle_name')->label(__("Bhry98::users.middle-name"))->nullable()->maxLength(20)->minLength(2)->string();
        $inputs[] = TextInput::make('last_name')->label(__("Bhry98::users.last-name"))->required()->maxLength(20)->minLength(2)->string();
        $inputs[] = TextInput::make('display_name')->label(__("Bhry98::users.display-name"))
            ->hintIcon("heroicon-o-information-circle", __("Bhry98::users.display-name-hint"))
            ->nullable()->maxLength(40)->minLength(5)->string();
        $inputs[] = PhoneInput::make('phone_number')->label(__("Bhry98::users.phone-number"))->nullable()->defaultCountry('EG');
        $inputs[] = TextInput::make('email')->label(__("Bhry98::users.email"))->required()->email()->unique((new UsersCoreModel)->getTable(), 'email', ignoreRecord: true);
        $inputs[] = TextInput::make('work_email')->label(__("Bhry98::users.work-email"))->nullable()->email();
        $inputs[] = TextInput::make('username')->label(__("Bhry98::users.username"))->nullable()->unique((new UsersCoreModel)->getTable(), 'username', ignoreRecord: true);
        $inputs[] = Select::make('account_type')->label(__("Bhry98::users.account-type"))->searchable()->required()->options(UsersAccountTypes::class)->default(UsersAccountTypes::User->name);
        $inputs[] = ToggleButtons::make('gender')->label(__("Bhry98::users.gender"))->required()->options(UsersGenders::class)->inline()->default(UsersGenders::Male->name);
        $inputs[] = TextInput::make('national_id')->label(__("Bhry98::users.national-id"))->nullable()->unique((new UsersCoreModel)->getTable(), 'national_id', ignoreRecord: true);
        $inputs[] = DatePicker::make('birthdate')->label(__("Bhry98::users.birthdate"))->nullable()->native(false);
        $inputs[] = Select::make('nationality_id')->label(__("Bhry98::users.nationality"))->searchable()->preload()->nullable()->relationship('nationality', 'default_name')->getOptionLabelFromRecordUsing(fn($record) => $record->name_label);
        $inputs[] = Select::make('country_id')->label(__("Bhry98::users.country"))->searchable()->preload()->nullable()->relationship('country', 'default_name')->getOptionLabelFromRecordUsing(fn($record) => $record->name_label)->live()->afterStateUpdated(function (Set $set) {
            $set('governorate_id', null);
            $set('city_id', null);
        });
        $inputs[] = Select::make('governorate_id')->label(__("Bhry98::users.governorate"))->searchable()->preload()->nullable()->relationship('governorate', 'default_name', fn($query, $get) => $query->where(['country_id' => $get('country_id')]))->getOptionLabelFromRecordUsing(fn($record) => $record->name)->disabled(fn($get) => is_null($get('country_id')))->live()->afterStateUpdated(fn($set) => $set('city_id', null));
        $inputs[] = Select::make('city_id')->label(__("Bhry98::users.city"))->searchable()->preload()->nullable()->relationship('city', 'default_name', fn($query, $get) => $query->where(['governorate_id' => $get('governorate_id')]))->getOptionLabelFromRecordUsing(fn($record) => $record->name)->disabled(fn($get) => is_null($get('governorate_id')));
        $inputs[] = Select::make('title')->label(__("Bhry98::users.title"))->searchable()->preload()->options(UsersTitles::class)->default(UsersTitles::Mr->name);;
        $inputs[] = TextInput::make('job_position')->label(__("Bhry98::users.job-position"))->nullable()->maxLength(40)->minLength(5)->string();
        $inputs[] = TimezoneSelect::make('timezone')->label(__("Bhry98::users.timezone"))->required()->default(config('app.timezone', "Africa/Cairo"));
        $inputs[] = ToggleButtons::make('active')->label(__("Bhry98::users.active"))->required()->boolean()->default(true)->inline();
        /**
         * "must_verify_email",
         * "must_verify_phone",
         * "must_change_password",
         * "bio",
         * "language",
         * "theme",
         * "password",
         * "type_id",
         */
        return $inputs;
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions(config("bhry98.filament.pagination.per_page"))
            ->columns([
                TextColumn::make('code')->label(__('Bhry98::users.code'))->toggleable()->toggledHiddenByDefault()->searchable(),
                TextColumn::make('first_name')->label(__('Bhry98::users.first-name'))->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('last_name')->label(__('Bhry98::users.last-name'))->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('display_name')->label(__('Bhry98::users.display-name'))->toggleable()->searchable(),
                PhoneColumn::make('phone_number')->label(__('Bhry98::users.phone-number'))->toggleable()->searchable(),
                TextColumn::make('phone_number_verified_at')->label(__('Bhry98::users.phone-number-verified-at'))->getStateUsing(fn($record) => $record->phone_number_verified_at ? Carbon::parse($record->phone_number_verified_at)->format(config("bhry98.date.format")) : "---")->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('email')->label(__('Bhry98::users.email'))->toggleable()->searchable(),
                TextColumn::make('email_verified_at')->label(__('Bhry98::users.email-verified-at'))->getStateUsing(fn($record) => $record->email_verified_at ? Carbon::parse($record->email_verified_at)->format(config("bhry98.date.format")) : "---")->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('birthdate')->label(__('Bhry98::users.birthdate'))->getStateUsing(fn($record) => $record->birthdate ? Carbon::parse($record->birthdate)->format(config("bhry98.date.format")) : "---")->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('username')->label(__('Bhry98::users.username'))->searchable()->toggleable(),
                TextColumn::make('national_id')->label(__('Bhry98::users.national-id'))->default("--")->searchable()->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('gender')->badge()->toggleable()->toggledHiddenByDefault()->label(__('Bhry98::users.gender')),
                TextColumn::make('nationality.default_name')->getStateUsing(fn($record) => $record->nationality?->name_label ?? "---")->toggleable()->label(__('Bhry98::users.nationality')),
                TextColumn::make('country.default_name')->getStateUsing(fn($record) => $record->country?->name_label ?? "---")->toggleable()->toggledHiddenByDefault()->label(__('Bhry98::users.country')),
                TextColumn::make('governorate.default_name')->getStateUsing(fn($record) => $record->governorate?->name ?? "---")->toggleable()->toggledHiddenByDefault()->label(__('Bhry98::users.governorate')),
                TextColumn::make('city.default_name')->getStateUsing(fn($record) => $record->city?->name ?? "---")->toggleable()->toggledHiddenByDefault()->label(__('Bhry98::users.city')),
                TextColumn::make('timezone.default_name')->getStateUsing(fn($record) => $record->timezone?->name ?? "---")->toggleable()->toggledHiddenByDefault()->label(__('Bhry98::users.timezone')),
                TextColumn::make('type.default_name')->getStateUsing(fn($record) => $record->type?->name ?? "---")->toggleable()->toggledHiddenByDefault()->label(__('Bhry98::users.type')),
                TextColumn::make('lang')->getStateUsing(fn($record) => $record->lang ?? "---")->toggleable()->toggledHiddenByDefault()->label(__('Bhry98::users.lang')),
                IconColumn::make('active')->boolean()->toggleable()->label(__('Bhry98::global.active')),
                IconColumn::make('must_change_password')->boolean()->toggleable()->toggledHiddenByDefault()->label(__('Bhry98::users.must-change-password')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()->visible(auth()?->user()?->can('Users.ForceDelete') || auth()?->user()?->can('Users.Delete')),
                Tables\Filters\TernaryFilter::make('active')->label(__("Bhry98::global.active")),
                Tables\Filters\TernaryFilter::make('must_change_password')->label(__("Bhry98::users.must-change-password")),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\Action::make('reset_password')
                        ->label(__('Bhry98::users.reset-password'))
                        ->requiresConfirmation()
                        ->form([
                            TextInput::make('password')
                                ->label(__("Bhry98::users.password"))
                                ->password()
                                ->revealable()
                                ->required()
                                ->confirmed(),
                            TextInput::make('password_confirmation')
                                ->label(__("Bhry98::users.confirmation-password"))
                                ->same('password')
                                ->password()
                                ->revealable()
                                ->required()
                        ])
                        ->visible(auth()?->user()?->can('Users.Account.ChangePassword'))
                        ->action(fn($record, $data) => $record->update(['password' => $data['password']])),
                    Tables\Actions\EditAction::make()
                        ->label(__("Bhry98::global.modify"))
                        ->visible(fn(UsersCoreModel $record) => $record->canEdit())
                        ->action(fn(UsersCoreModel $record, array $data) => (new UsersManagementService())->updateUser($record->id, $data))
                        ->slideOver()
                        ->closeModalByClickingAway(false),
                    Tables\Actions\DeleteAction::make()
                        ->label(__("Bhry98::global.delete"))
                        ->visible(fn(UsersCoreModel $record) => $record->canDelete(self::getRelationsCount()))
                        ->action(fn(UsersCoreModel $record) => (new UsersManagementService())->deleteUser($record->id))
                        ->closeModalByClickingAway(false),
                    Tables\Actions\ForceDeleteAction::make()
                        ->label(__("Bhry98::global.force-delete"))
                        ->visible(fn(UsersCoreModel $record) => $record->canForceDelete(self::getRelationsCount()))
                        ->action(fn(UsersCoreModel $record) => (new UsersManagementService())->deleteUser($record->id, true))
                        ->closeModalByClickingAway(false),
                    Tables\Actions\RestoreAction::make()
                        ->label(__("Bhry98::global.restore"))
                        ->visible(fn(UsersCoreModel $record) => $record->canRestore())
                        ->action(fn(UsersCoreModel $record) => (new UsersManagementService())->restoreUser($record->id))
                        ->closeModalByClickingAway(false),
                ])
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getRecordSubNavigation(\Filament\Pages\Page $page): array
    {
        $pages = array_merge(
            [
                ViewUsers::class,
                ManageUserLogs::class,
                ManageUserNotifications::class,
                ManageUserLogons::class,
                ManageUserGroupPolicies::class,
            ],
            static::discoverPages(true),
        );

        return $page->generateNavigationItems($pages);
    }

    public static function getPages(): array
    {
        return array_merge(
            [
                'index' => ListUsers::route('/'),
                'create' => CreateUsers::route('/create'),
                'view' => ViewUsers::route('/{record:code}'),
                'edit' => EditUsers::route('/{record:code}/modify'),
                ///
                'logons' => ManageUserLogons::route('/{record:code}/logons'),
                'logs' => ManageUserLogs::route('/{record:code}/logs'),
                'notifications' => ManageUserNotifications::route('/{record:code}/notifications'),
                'group-policies' => ManageUserGroupPolicies::route('/{record:code}/group-policies'),
            ],
            static::discoverPages(),
        );
    }

    protected static function discoverPages(bool $forSubNavigation = false): array
    {
        try {
            return collect(config('bhry98.filament.users-pages', []))
                ->filter(fn(string $class): bool => class_exists($class) && method_exists($class, 'route'))
                ->mapWithKeys(fn(string $class) => $forSubNavigation
                    ? [$class]
                    : [str($class)->classBasename()->kebab()->toString() => $class::route('/{record:code}/' . str($class)->classBasename()->kebab()->toString())])
                ->all();
        } catch (\Throwable $e) {
            report($e);
            return [];
        }
    }

    protected static function getRelationsCount(): int
    {
        return 0;
    }
}