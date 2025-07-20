<?php

namespace Bhry98\Locations\Filament\Resources\Bhry98CitiesResource;

use Bhry98\Locations\Filament\Resources\Bhry98CitiesResource\Pages\ListCities;
use Bhry98\Locations\Models\LocationsCitiesModel;
use Bhry98\Locations\Services\LocationsCitiesService;
use Bhry98\Locations\Services\LocationsCountriesService;
use Bhry98\Locations\Services\LocationsGovernorateService;
use Exception;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\{
    EditAction,
    DeleteAction,
    ForceDeleteAction,
    RestoreAction
};
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use TomatoPHP\FilamentTranslationComponent\Components\Translation;

class Bhry98CitiesResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $model = LocationsCitiesModel::class;

    public static function canAccess(): bool
    {
        return auth()->user()->can('Locations.Cities.All');
    }

    public static function getEloquentQuery(): Builder
    {
        return LocationsCitiesModel::query()
            ->locales()
            ->with(['createdBy', 'updatedBy', 'deletedBy'])
            ->withCount(['users'])
            ->latest();
    }

    public static function getRoutePrefix(): string
    {
        $currentPanelId = filament()->getCurrentPanel()?->getId();
        if ($currentPanelId === config('bhry98.filament.locations.id')) {
            return "/Locations/Cities";
        }
        return '/Cities';
    }

    public static function getNavigationGroup(): ?string
    {
        $currentPanelId = filament()->getCurrentPanel()?->getId();
        if ($currentPanelId === config('bhry98.filament.locations.id')) {
            return null;
        }
        return __('Bhry98::locations.manage');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Bhry98::locations.cities');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Bhry98::locations.cities');
    }

    public static function getLabel(): ?string
    {
        return __('Bhry98::locations.cities');
    }

    public static function form(Form $form): Form
    {
        $inputs[] = Select::make('country_id')->label(__("Bhry98::locations.country"))
            ->relationship('country', 'default_name')
            ->reactive()
            ->afterStateUpdated(fn($set) => $set('governorate_id', null))
            ->getSearchResultsUsing(fn($search) => (new LocationsCountriesService())->searchByName($search))
            ->getOptionLabelFromRecordUsing(fn($record) => "($record?->flag) $record?->name")->searchable()->preload()->required();;
        $inputs[] = Select::make('governorate_id')->label(__("Bhry98::locations.governorate"))
            ->relationship('governorate', 'default_name')
            ->reactive()
            ->disabled(fn($get) => !$get('country_id'))
            ->options(fn($get) => (new LocationsGovernorateService())->getOptions(countryId: $get('country_id')))
            ->getSearchResultsUsing(fn($search, $get) => (new LocationsGovernorateService())->getOptions($search, countryId: $get('country_id')))
            ->getOptionLabelFromRecordUsing(fn($record) => $record?->name)->searchable()->preload();
        $inputs[] = TextInput::make('code')->nullable()->minLength(2)->maxLength(20)->label(__("Bhry98::locations.city-code"))->unique((new LocationsCitiesModel)->getTable(), "code", ignoreRecord: true);
        $inputs[] = TextInput::make('default_name')->label(__("Bhry98::global.default-name"))->minLength(2)->maxLength(50)->required();
        $inputs[] = Toggle::make('active')->required()->inline(false)->label(__("Bhry98::global.active"))->required();
        $inputs[] = Translation::make('names')->formatStateUsing(fn(?LocationsCitiesModel $record) => $record?->getLocalizedArray())->columnSpanFull()->label(__("Bhry98::locations.governorate-name"))->required();
        return $form->schema($inputs);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->label(__('Bhry98::global.code'))->copyable()->toggleable()->toggledHiddenByDefault()->searchable(),
                TextColumn::make('country.default_name')->label(__('Bhry98::locations.country'))->getStateUsing(fn(LocationsCitiesModel $record) => $record->country?->name_label ?? "---"),
                TextColumn::make('governorate.default_name')->label(__('Bhry98::locations.governorate'))->getStateUsing(fn(LocationsCitiesModel $record) => $record->governorate?->name ?? "---"),
                TextColumn::make('default_name')->label(__('Bhry98::global.default-name'))->toggleable()->searchable(),
                TextColumn::make('localization.value')->label(__('Bhry98::locations.city-name'))->getStateUsing(fn(LocationsCitiesModel $record) => $record->name ?? $record->default_name ?? "---")->toggleable(),
                TextColumn::make('users_count')->label(__('Bhry98::locations.total-users'))->toggleable(),
                ...bhry98_common_filament_columns(activeButtonDisabled: true)
            ])
            ->filters([
                TrashedFilter::make()->visible(auth()->user()->can('Locations.Cities.ForceDelete') || auth()->user()->can('Locations.Cities.Delete')),
                TernaryFilter::make('active')->label(__("Bhry98::global.active")),
            ])
            ->actions([
                EditAction::make()->label(__("Bhry98::global.modify"))->visible(fn(LocationsCitiesModel $record) => $record->canEdit())->action(fn(LocationsCitiesModel $record, array $data) => (new LocationsCitiesService())->updateCity($record->id, $data))->slideOver()->closeModalByClickingAway(false),
                DeleteAction::make()->label(__("Bhry98::global.delete"))->visible(fn(LocationsCitiesModel $record) => $record->canDelete(self::relationsCount($record)))->action(fn(LocationsCitiesModel $record) => (new LocationsCitiesService())->deleteCity($record->id))->closeModalByClickingAway(false),
                RestoreAction::make()->label(__("Bhry98::global.restore"))->visible(fn(LocationsCitiesModel $record) => $record->canRestore())->action(fn(LocationsCitiesModel $record) => (new LocationsCitiesService())->restoreCity($record->id))->closeModalByClickingAway(false),
                ForceDeleteAction::make()->label(__("Bhry98::global.force-delete"))->visible(fn(LocationsCitiesModel $record) => $record->canForceDelete(self::relationsCount($record)))->action(fn(LocationsCitiesModel $record) => (new LocationsCitiesService())->deleteCity($record->id, true))->closeModalByClickingAway(false),
            ])
            ->bulkActions([]);
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
            'index' => ListCities::route(path: '/'),
        ];
    }

    private static function relationsCount(?LocationsCitiesModel $record): int
    {
        if (!$record) return 0;
        return $record->users_count + $record->cities_count;
    }

}
