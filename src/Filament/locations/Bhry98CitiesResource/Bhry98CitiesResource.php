<?php

namespace Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CitiesResource;

use Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CitiesResource\Pages\ListCities;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCitiesModel;
use Bhry98\Bhry98LaravelReady\Services\locations\CitiesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\CountriesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\GovernorateManagementService;
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
        return '/locations/cities';
    }

    public static function getNavigationGroup(): ?string
    {
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
            ->getSearchResultsUsing(fn($search) => (new CountriesManagementService())->searchByName($search))
            ->getOptionLabelFromRecordUsing(fn($record) => "($record?->flag) $record?->name")->searchable()->preload()->required();;
        $inputs[] = Select::make('governorate_id')->label(__("Bhry98::locations.governorate"))
            ->relationship('governorate', 'default_name')
            ->reactive()
            ->disabled(fn($get) => !$get('country_id'))
            ->options(fn($get) => (new GovernorateManagementService())->getOptions(countryId: $get('country_id')))
            ->getSearchResultsUsing(fn($search, $get) => (new GovernorateManagementService())->getOptions($search, countryId: $get('country_id')))
            ->getOptionLabelFromRecordUsing(fn($record) => $record?->name)->searchable()->preload();
        $inputs[] = TextInput::make('code')->nullable()->minLength(2)->maxLength(20)->label(__("Bhry98::locations.city-code"))->unique(LocationsCitiesModel::TABLE_NAME, "code", ignoreRecord: true);
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
                TextColumn::make('code')
                    ->label(__('Bhry98::global.code'))
                    ->copyable()
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->searchable(),
                TextColumn::make('country.default_name')
                    ->label(__('Bhry98::locations.country'))
                    ->getStateUsing(fn(LocationsCitiesModel $record) => $record->country?->name_label ?? "---"),
                TextColumn::make('governorate.default_name')
                    ->label(__('Bhry98::locations.governorate'))
                    ->getStateUsing(fn(LocationsCitiesModel $record) => $record->governorate?->name ?? "---"),
                TextColumn::make('default_name')
                    ->label(__('Bhry98::global.default-name'))
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('localization.value')
                    ->label(__('Bhry98::locations.city-name'))
                    ->getStateUsing(fn(LocationsCitiesModel $record) => $record->name ?? $record->default_name ?? "---")
                    ->toggleable(),
                TextColumn::make('users_count')
                    ->label(__('Bhry98::locations.total-users'))
                    ->toggleable(),
                ...bhry98_filament_columns(active: true)
            ])
            ->filters([
                TrashedFilter::make()->visible(auth()->user()->can('Locations.Cities.ForceDelete') || auth()->user()->can('Locations.Cities.Delete')),
                TernaryFilter::make('active')->label(__("Bhry98::global.active")),
            ])
            ->actions([
                EditAction::make()->label(__("Bhry98::global.modify"))->visible(fn(LocationsCitiesModel $record) => $record->canEdit())->action(fn(LocationsCitiesModel $record, array $data) => (new CitiesManagementService())->updateCity($record->id, $data))->slideOver()->closeModalByClickingAway(false),
                DeleteAction::make()->label(__("Bhry98::global.delete"))->visible(fn(LocationsCitiesModel $record) => $record->canDelete(self::relationsCount($record)))->action(fn(LocationsCitiesModel $record) => (new CitiesManagementService())->deleteCity($record->id))->closeModalByClickingAway(false),
                RestoreAction::make()->label(__("Bhry98::global.restore"))->visible(fn(LocationsCitiesModel $record) => $record->canRestore())->action(fn(LocationsCitiesModel $record) => (new CitiesManagementService())->restoreCity($record->id))->closeModalByClickingAway(false),
                ForceDeleteAction::make()->label(__("Bhry98::global.force-delete"))->visible(fn(LocationsCitiesModel $record) => $record->canForceDelete(self::relationsCount($record)))->action(fn(LocationsCitiesModel $record) => (new CitiesManagementService())->deleteCity($record->id, true))->closeModalByClickingAway(false),
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
