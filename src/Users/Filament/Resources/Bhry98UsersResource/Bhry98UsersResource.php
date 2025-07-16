<?php

namespace Bhry98\Users\Filament\Resources\Bhry98UsersResource;

use Bhry98\Users\Filament\Resources\Bhry98UsersResource\Pages\{ListUsers,
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
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
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

    public static function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions(config("bhry98.filament.pagination.per_page"))
            ->columns([
                TextColumn::make('code')->label(__('Bhry98::users.code'))->toggleable()->toggledHiddenByDefault()->searchable(),
                TextColumn::make('first_name')->label(__('Bhry98::users.first-name'))->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('last_name')->label(__('Bhry98::users.last-name'))->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('display_name')->label(__('Bhry98::users.display-name'))->toggleable(),
                PhoneColumn::make('phone_number')->label(__('Bhry98::users.phone-number'))->toggleable(),
                TextColumn::make('phone_number_verified_at')->label(__('Bhry98::users.phone-number-verified-at'))->getStateUsing(fn($record) => $record->phone_number_verified_at ? Carbon::parse($record->phone_number_verified_at)->format(config("bhry98.date.format")) : "---")->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('email')->label(__('Bhry98::users.email'))->toggleable(),
                TextColumn::make('email_verified_at')->label(__('Bhry98::users.email-verified-at'))->getStateUsing(fn($record) => $record->email_verified_at ? Carbon::parse($record->email_verified_at)->format(config("bhry98.date.format")) : "---")->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('birthdate')->label(__('Bhry98::users.birthdate'))->getStateUsing(fn($record) => $record->birthdate ? Carbon::parse($record->birthdate)->format(config("bhry98.date.format")) : "---")->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('username')->label(__('Bhry98::users.username'))->searchable()->toggleable(),
                TextColumn::make('national_id')->label(__('Bhry98::users.national-id'))->default("--")->searchable()->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('gender.default_name')->getStateUsing(fn($record) => $record->gender?->name ?? "---")->toggleable()->label(__('Bhry98::users.gender')),
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
        $pages = array_merge(
            [
                'index' => ListUsers::route('/'),
                'view' => ViewUsers::route('/{record:code}'),
                'logons' => ManageUserLogons::route('/{record:code}/logons'),
                'logs' => ManageUserLogs::route('/{record:code}/logs'),
                'notifications' => ManageUserNotifications::route('/{record:code}/notifications'),
                'group-policies' => ManageUserGroupPolicies::route('/{record:code}/group-policies'),
            ],
            static::discoverPages(),
        );

        return $pages;
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