<?php

namespace Bhry98\GroupPolicies\Filament\Resources\Bhry98GroupsResource;

use Bhry98\GP\Models\GPGroupsModel;
use Bhry98\GroupPolicies\Filament\Resources\Bhry98GroupsResource\Pages\ListGroupPolicies;
use Exception;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class Bhry98GroupsResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $model = GPGroupsModel::class;

    public static function canAccess(): bool
    {
        return auth()->user()->can('GP.All') || auth()->user()->isAdmin();
    }

    public static function getEloquentQuery(): Builder
    {
        return GPGroupsModel::query()->withCount(['users', 'permissions']);
    }

    public static function getRoutePrefix(): string
    {
        return '/group-policies';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Bhry98::users.manage');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Bhry98::rbac.group-policies');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Bhry98::rbac.group-policies');
    }

    public static function getLabel(): ?string
    {
        return __('Bhry98::rbac.group-policies');
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions(config("bhry98.filament.pagination.per_page"))
            ->columns([
                TextColumn::make('code')->label(__('Bhry98::rbac.group-code'))->toggleable()->searchable(),
                TextColumn::make('default_name')->label(__('Bhry98::rbac.group-name'))->getStateUsing(fn($record) => $record->name)->toggleable()->searchable(),
                TextColumn::make('default_description')->label(__('Bhry98::rbac.group-description'))->getStateUsing(fn($record) => $record->description)->toggleable()->searchable(),
                IconColumn::make('is_default')->boolean()->toggleable()->label(__('Bhry98::global.is-default')),
                IconColumn::make('can_delete')->boolean()->toggleable()->label(__('Bhry98::global.can-delete')),
                IconColumn::make('active')->boolean()->toggleable()->label(__('Bhry98::global.active')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()->visible(auth()->user()->can('Users.ForceDelete') || auth()->user()->can('Users.Delete')),
                Tables\Filters\TernaryFilter::make('active')->label(__("Bhry98::global.active")),
//                Tables\Filters\TernaryFilter::make('must_change_password')->label(__("Bhry98::users.must-change-password")),
            ])
            ->actions([
                ActionGroup::make([
//                    Tables\Actions\EditAction::make()
//                        ->label(__("Bhry98::global.modify"))
//                        ->visible(fn(UsersCoreUsersModel $record) => $record->canEdit())
//                        ->action(fn(UsersCoreUsersModel $record, array $data) => (new UsersManagementService())->updateUser($record->id, $data))
//                        ->slideOver()
//                        ->closeModalByClickingAway(false),
//                    Tables\Actions\DeleteAction::make()
//                        ->label(__("Bhry98::global.delete"))
//                        ->visible(fn(UsersCoreUsersModel $record) => $record->canDelete(self::geRelationsCount()))
//                        ->action(fn(UsersCoreUsersModel $record) => (new UsersManagementService())->deleteUser($record->id))
//                        ->closeModalByClickingAway(false),
//                    Tables\Actions\ForceDeleteAction::make()
//                        ->label(__("Bhry98::global.force-delete"))
//                        ->visible(fn(UsersCoreUsersModel $record) => $record->canForceDelete(self::geRelationsCount()))
//                        ->action(fn(UsersCoreUsersModel $record) => (new UsersManagementService())->deleteUser($record->id, true))
//                        ->closeModalByClickingAway(false),
//                    Tables\Actions\RestoreAction::make()
//                        ->label(__("Bhry98::global.restore"))
//                        ->visible(fn(UsersCoreUsersModel $record) => $record->canRestore())
//                        ->action(fn(UsersCoreUsersModel $record) => (new UsersManagementService())->restoreUser($record->id))
//                        ->closeModalByClickingAway(false),
//                    Tables\Actions\Action::make()
//                        ->label(__("Bhry98::auth.change-password"))
//                        ->visible(fn(UsersCoreUsersModel $record) => $record->canChangePassword())
//                        ->action(fn(UsersCoreUsersModel $record) => (new UsersManagementService())->restoreUser($record->id))
//                        ->closeModalByClickingAway(false),
                ])
            ])
            ->bulkActions([
            ]);
    }

    public static function form(Form $form): Form
    {
        $inputs[] = TextInput::make('code')->label(__("Bhry98::rbac.group-code"))->nullable()->unique((new GPGroupsModel)->getTable(), 'code', ignoreRecord: true);
        return $form->schema($inputs);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getRecordSubNavigation(\Filament\Pages\Page $page): array
    {
        return [
//            ViewUsers::class,
        ];

    }

    public static function getPages(): array
    {
        return [
            'index' => ListGroupPolicies::route('/'),
        ];
    }

    protected static function geRelationsCount(): int
    {
        return 0;
    }
}