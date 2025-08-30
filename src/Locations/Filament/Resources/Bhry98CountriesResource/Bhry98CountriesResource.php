<?php

namespace Bhry98\Locations\Filament\Resources\Bhry98CountriesResource;

use Bhry98\Locations\Filament\Panels\Bhry98LocationsPanelProvider;
use Bhry98\Locations\Filament\Resources\Bhry98CountriesResource\Pages\ListCountries;
use Bhry98\Locations\Models\LocationsCitiesModel;
use Bhry98\Locations\Models\LocationsCountriesModel;
use Bhry98\Locations\Services\LocationsCountriesService;
use Exception;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\{
    EditAction,
    DeleteAction,
    ForceDeleteAction,
    RestoreAction
};
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use SolutionForest\FilamentTranslateField\Forms\Component\Translate;
use TomatoPHP\FilamentTranslationComponent\Components\Translation;

class Bhry98CountriesResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $model = LocationsCountriesModel::class;

    public static function canAccess(): bool
    {
        return auth()->user()->can('Locations.Countries.All');
    }

    public static function getEloquentQuery(): Builder
    {
        return LocationsCountriesModel::query()
            ->locales()
            ->with(['createdBy', 'updatedBy', 'deletedBy'])
            ->withCount(['governorates', 'cities', 'users'])
            ->latest();
    }

    public static function getRoutePrefix(): string
    {
        $currentPanelId = filament()->getCurrentPanel()?->getId();
        if ($currentPanelId === config('bhry98.filament.locations.id')) {
            return '/Locations/Countries';
        }
        return '/Countries';
    }

    /**
     * @throws Exception
     */
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
        return __('Bhry98::locations.countries');
    }
    public static function getModelLabel(): string
    {
        return __('Bhry98::locations.countries');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Bhry98::locations.countries');
    }

    public static function form(Form $form): Form
    {
        $inputs[] = TextInput::make('country_code')->label(__("Bhry98::locations.country-code"))->minLength(2)->maxLength(50)->unique((new LocationsCountriesModel)->getTable(), "country_code", ignoreRecord: true)->nullable();
        $inputs[] = TextInput::make('default_name')->label(__("Bhry98::global.default-name"))->minLength(2)->maxLength(50)->nullable();
//        $inputs[] = TextInput::make('flag')->label(__("Bhry98::locations.country-flag"))->disabled();
        $inputs[] = TextInput::make('dial_code')->label(__("Bhry98::locations.country-dial-code"))->required();
        $inputs[] = TextInput::make('lang_key')->required()->minLength(2)->maxLength(4)->label(__("Bhry98::locations.country-lang-key"))->required();
        $inputs[] = ToggleButtons::make('system_lang')->boolean()->required()->inline()->label(__("Bhry98::locations.country-system-lang"))->required();
        $inputs[] = ToggleButtons::make('active')->boolean()->required()->inline()->label(__("Bhry98::global.active"))->required();
//        $inputs[] = Translation::make('names')->formatStateUsing(fn(?LocationsCountriesModel $record) => $record?->getLocalizedArray())->columnSpanFull()->label(__("Bhry98::locations.country-name"))->required();
        $locales = [
            TextInput::make('names')->label("Bhry98::locations.country-name")->required()
//                ->formatStateUsing(fn(?LocationsCitiesModel $record) => $record?->getLocalized('name'))
        ];
        $inputs[] = Translate::make()
            ->locales(config("bhry98.locales"))
            ->fieldTranslatableLabel(fn($field, $locale) => __($field->getLabel(), locale: $locale))
            ->formatStateUsing(fn(?LocationsCountriesModel $record) => $record?[...$record->toArray(),"names" => $record->getLocalizedArray()]:[])
            ->suffixLocaleLabel()
            ->columnSpanFull()
            ->contained(false)
            ->schema($locales);
        return $form->schema($inputs);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions(config("bhry98.filament.pagination.per_page"))

            ->columns([
                TextColumn::make('code')->label(__('Bhry98::global.code'))->copyable()->toggleable()->toggledHiddenByDefault()->searchable(),
                TextColumn::make('country_code')->label(__('Bhry98::locations.country-code'))->copyable()->searchable(),
                TextColumn::make('default_name')->label(__('Bhry98::global.default-name'))->toggleable()->searchable(),
                TextColumn::make('localization.value')->label(__('Bhry98::locations.country-name'))->getStateUsing(fn(LocationsCountriesModel $record) => $record->name ?? $record->default_name ?? "---")->toggleable(),
                TextColumn::make('flag')->label(__('Bhry98::locations.country-flag'))->toggleable(),
                TextColumn::make('governorates_count')->label(__('Bhry98::locations.total-governorates'))->toggleable(),
                TextColumn::make('cities_count')->label(__('Bhry98::locations.total-cities'))->toggleable(),
                TextColumn::make('users_count')->label(__('Bhry98::locations.total-users'))->toggleable(),
                TextColumn::make('lang_key')->label(__('Bhry98::locations.country-lang-key'))->toggleable(),
                TextColumn::make('dial_code')->label(__('Bhry98::locations.country-dial-code'))->toggleable(),
                IconColumn::make('active')->label(__('Bhry98::global.active'))->boolean()->toggleable(),
                ...bhry98_common_filament_columns(withActive: false)
            ])
            ->filters([
                TrashedFilter::make()->visible(auth()->user()->can('Locations.Countries.ForceDelete') || auth()->user()->can('Locations.Countries.Delete')),
                TernaryFilter::make('active')->label(__("Bhry98::global.active")),
                TernaryFilter::make('system_lang')->label(__("Bhry98::locations.country-system-lang")),
            ])
            ->actions([
                EditAction::make()->label(__("Bhry98::global.modify"))->visible(fn(LocationsCountriesModel $record) => $record->canEdit())->action(fn(LocationsCountriesModel $record, array $data) => (new LocationsCountriesService())->updateCountry($record->id, $data))->slideOver()->closeModalByClickingAway(false),
                DeleteAction::make()->label(__("Bhry98::global.delete"))->visible(fn(LocationsCountriesModel $record) => $record->canDelete(self::relationsCount($record)))->action(fn(LocationsCountriesModel $record) => (new LocationsCountriesService())->deleteCountry($record->id))->closeModalByClickingAway(false),
                RestoreAction::make()->label(__("Bhry98::global.restore"))->visible(fn(LocationsCountriesModel $record) => $record->canRestore())->action(fn(LocationsCountriesModel $record) => (new LocationsCountriesService())->restoreCountry($record->id))->closeModalByClickingAway(false),
//                ForceDeleteAction::make()->label(__("Bhry98::global.force-delete"))->visible(fn(LocationsCountriesModel $record) => $record->canForceDelete(self::relationsCount($record)))->action(fn(LocationsCountriesModel $record) => (new LocationsCountriesService())->deleteCountry($record->id, true))->closeModalByClickingAway(false),
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
            'index' => ListCountries::route(path: '/'),
        ];
    }

    private static function relationsCount(?LocationsCountriesModel $record): int
    {
        if (!$record) return 0;
        return $record->users_count + $record->governorates_count + $record->cities_count;
    }

}
