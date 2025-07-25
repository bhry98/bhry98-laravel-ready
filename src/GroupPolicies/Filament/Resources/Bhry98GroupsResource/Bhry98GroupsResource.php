<?php

namespace Bhry98\GP\Filament\Resources\Bhry98GroupsResource;

use Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Pages\ManageGroupPoliciesPermissions;
use Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Pages\ManageGroupPoliciesUsers;
use Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Pages\ViewGroupPolicies;
use Bhry98\GP\Models\GPGroupsModel;
use Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Pages\ListGroupPolicies;
use Bhry98\GP\Services\GPGroupsService;
use Exception;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
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
        return auth()->user()->can('GP.All');
    }

    public static function getEloquentQuery(): Builder
    {
        return GPGroupsModel::query()->withTrashed()->withCount(['users', 'permissions']);
    }

    public static function getRoutePrefix(): string
    {
        $currentPanelId = filament()->getCurrentPanel()?->getId();
        if ($currentPanelId === config('bhry98.filament.group-policies.id')) {
            return '/GroupPolicies/Groups';
        }
        return "/Groups";
    }

    public static function getNavigationGroup(): ?string
    {
        $currentPanelId = filament()->getCurrentPanel()?->getId();
        if ($currentPanelId === config('bhry98.filament.group-policies.id')) {
            return "";
        }
        return __('Bhry98::users.manage');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Bhry98::gp.group-policies');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Bhry98::gp.group-policies');
    }

    public static function getLabel(): ?string
    {
        return __('Bhry98::gp.group-policies');
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions(config("bhry98.filament.pagination.per_page"))
            ->columns([
                TextColumn::make('code')->label(__('Bhry98::gp.group-code'))->toggleable()->searchable(),
                TextColumn::make('default_name')->label(__('Bhry98::gp.group-name'))->getStateUsing(fn($record) => $record->name)->toggleable(),
                TextColumn::make('users_count')->label(__('Bhry98::gp.users',['group'=>''])),
                TextColumn::make('permissions_count')->label(__('Bhry98::gp.permissions',['group'=>''])),
                TextColumn::make('default_description')->label(__('Bhry98::gp.group-description'))->limit(20)->lineClamp(1)->getStateUsing(fn($record) => $record->description)->toggleable()->toggledHiddenByDefault(),
                IconColumn::make('is_default')->boolean()->toggleable()->label(__('Bhry98::gp.is-default-group')),
                IconColumn::make('active')->boolean()->toggleable()->label(__('Bhry98::gp.active-group')),
                ...bhry98_common_filament_columns(withActive: false)
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()->visible(auth()->user()->can('GP.ForceDelete') || auth()->user()->can('GP.Delete')),
                Tables\Filters\TernaryFilter::make('active')->label(__("Bhry98::global.active")),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label(__("Bhry98::global.view")),
                Tables\Actions\EditAction::make()
                    ->label(__("Bhry98::global.modify"))
                    ->visible(fn(GPGroupsModel $record) => $record->canEdit())
                    ->action(fn(GPGroupsModel $record, array $data) => (new GPGroupsService())->updateGroup($record->id, $data))
                    ->fillForm(function ($record): array {
                        $data = $record->toArray();
                        foreach (config('bhry98.locales', []) as $locale) {
                            $data["names"][$locale] = $record?->getLocalized('name', $locale);
                            $data["descriptions"][$locale] = $record?->getLocalized('description', $locale);
                        }
                        return $data;
                    })
                    ->slideOver()
                    ->closeModalByClickingAway(false),
                Tables\Actions\DeleteAction::make()
                    ->label(__("Bhry98::global.delete"))
                    ->visible(fn(GPGroupsModel $record) => $record->canDelete())
                    ->action(fn(GPGroupsModel $record) => (new GPGroupsService())->deleteGroup($record->id))
                    ->closeModalByClickingAway(false),
                Tables\Actions\RestoreAction::make()
                    ->label(__("Bhry98::global.restore"))
                    ->visible(fn(GPGroupsModel $record) => $record->canRestore())
                    ->action(fn(GPGroupsModel $record) => (new GPGroupsService())->restoreGroup($record->id))
                    ->closeModalByClickingAway(false),
                Tables\Actions\ForceDeleteAction::make()
                    ->label(__("Bhry98::global.force-delete"))
                    ->visible(fn(GPGroupsModel $record) => $record->canForceDelete(self::geRelationsCount($record)))
                    ->action(fn(GPGroupsModel $record) => (new GPGroupsService())->deleteGroup($record->id, true))
                    ->closeModalByClickingAway(false),
            ])
            ->bulkActions([]);
    }

    public static function form(Form $form): Form
    {
        $inputs[] = TextInput::make('code')->label(__("Bhry98::gp.group-code"))->nullable()->unique((new GPGroupsModel)->getTable(), 'code', ignoreRecord: true);
        $inputs[] =ToggleButtons::make('is_default')->label(__("Bhry98::gp.is-default-group"))->required()->boolean()->inline()->default(false);
        $inputs[] = TextInput::make('names.ar')->label(__("Bhry98::gp.group-ar-name"))->required()->maxLength(50);
        $inputs[] = TextInput::make('names.en')->label(__("Bhry98::gp.group-en-name"))->required()->maxLength(50);
        $inputs[] = TextInput::make('descriptions.ar')->label(__("Bhry98::gp.group-ar-description"))->nullable();
        $inputs[] = TextInput::make('descriptions.en')->label(__("Bhry98::gp.group-en-description"))->nullable();
        $inputs[] =ToggleButtons::make('active')->label(__("Bhry98::gp.active-group"))->required()->boolean()->inline()->default(true);
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
        $pages = [
            ViewGroupPolicies::class,
            ManageGroupPoliciesUsers::class,
            ManageGroupPoliciesPermissions::class,
        ];
        return $page->generateNavigationItems($pages);

    }

    public static function getPages(): array
    {
        return [
            'index' => ListGroupPolicies::route('/'),
            'view' => ViewGroupPolicies::route('/{record:code}'),
            'users' => ManageGroupPoliciesUsers::route('/{record:code}/users'),
            'permissions' => ManageGroupPoliciesPermissions::route('/{record:code}/permissions'),
        ];
    }

     static function geRelationsCount(GPGroupsModel $record): int
    {
        return ($record->permissions_count ?? 0) + ($record->users_count ?? 0);
    }
}