<?php

namespace Bhry98\Locations\Filament\Resources\Bhry98GovernoratesResource;


use Bhry98\Locations\Filament\Resources\Bhry98GovernoratesResource\Pages\ListGovernorates;
use Bhry98\Locations\Models\LocationsCountriesModel;
use Bhry98\Locations\Models\LocationsGovernoratesModel;
use Bhry98\Locations\Services\LocationsCountriesService;
use Bhry98\Locations\Services\LocationsGovernorateService;
use Exception;
use Filament\Forms\Components\Select;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use SolutionForest\FilamentTranslateField\Forms\Component\Translate;
use TomatoPHP\FilamentTranslationComponent\Components\Translation;

class Bhry98GovernoratesResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $model = LocationsGovernoratesModel::class;

    public static function canAccess(): bool
    {
        return auth()->user()->can('Locations.Governorates.All');
    }

    public static function getEloquentQuery(): Builder
    {
        return LocationsGovernoratesModel::query()
            ->locales()
            ->with(['createdBy', 'updatedBy', 'deletedBy'])
            ->withCount(['cities', 'users'])
            ->latest();
    }

    public static function getRoutePrefix(): string
    {
        $currentPanelId = filament()->getCurrentPanel()?->getId();
        if ($currentPanelId === config('bhry98.filament.locations.id')) {
            return '/Locations/Governorates';
        }
        return '/Governorates';
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
        return __('Bhry98::locations.governorates');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Bhry98::locations.governorates');
    }

    public static function getLabel(): ?string
    {
        return __('Bhry98::locations.governorates');
    }

    public static function form(Form $form): Form
    {
        $inputs[] = Select::make('country_id')->label(__("Bhry98::locations.country"))
            ->relationship('country', 'default_name')
            ->getSearchResultsUsing(fn($search) => (new LocationsCountriesService())->searchByName($search))
            ->getOptionLabelFromRecordUsing(fn($record) => "($record?->flag) $record?->name")->searchable()->preload()->required();;
        $inputs[] = TextInput::make('code')->nullable()->minLength(2)->maxLength(20)->label(__("Bhry98::locations.governate-code"))->unique((new LocationsGovernoratesModel)->getTable(), "code", ignoreRecord: true);
        $inputs[] = TextInput::make('default_name')->label(__("Bhry98::global.default-name"))->minLength(2)->maxLength(50)->required();
        $inputs[] = ToggleButtons::make('active')->boolean()->required()->inline()->label(__("Bhry98::global.active"))->required()->default(true);
//        $inputs[] = Translation::make('names')->formatStateUsing(fn(?LocationsGovernoratesModel $record) => $record?->getLocalizedArray())->columnSpanFull()->label(__("Bhry98::locations.governorate-name"))->required();
        $locales = [
            TextInput::make('names')->label("Bhry98::locations.governorate-name")->required()
//                ->formatStateUsing(fn(?LocationsCitiesModel $record) => $record?->getLocalized('name'))
        ];
        $inputs[] = Translate::make()
            ->locales(config("bhry98.locales"))
            ->fieldTranslatableLabel(fn($field, $locale) => __($field->getLabel(), locale: $locale))
            ->formatStateUsing(fn(?LocationsGovernoratesModel $record) => $record ? [...$record->toArray(), "names" => $record->getLocalizedArray()] : ['active'=>true])
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
                TextColumn::make('country.default_name')->label(__('Bhry98::locations.country'))->formatStateUsing(fn(LocationsGovernoratesModel $record) => $record->country ? "({$record->country->flag}) {$record->country->name}" : "---"),
                TextColumn::make('default_name')->label(__('Bhry98::global.default-name'))->toggleable()->searchable(),
                TextColumn::make('localization.value')->label(__('Bhry98::locations.governorate-name'))->getStateUsing(fn(LocationsGovernoratesModel $record) => $record->name ?? $record->default_name ?? "---")->toggleable(),
                TextColumn::make('cities_count')->label(__('Bhry98::locations.total-cities'))->toggleable(),
                TextColumn::make('users_count')->label(__('Bhry98::locations.total-users'))->toggleable(),
                IconColumn::make('active')->label(__('Bhry98::global.active'))->boolean()->toggleable(),
                ...bhry98_common_filament_columns(withActive:false)
            ])
            ->filters([
                TrashedFilter::make()->visible(auth()->user()->can('Locations.Countries.ForceDelete') || auth()->user()->can('Locations.Countries.Delete')),
                TernaryFilter::make('active')->label(__("Bhry98::global.active")),
                SelectFilter::make('country_id')->label(__("Bhry98::locations.country"))
                    ->relationship('country', 'default_name', fn($query) => $query->where('active', true))
                    ->getSearchResultsUsing(fn($search) => (new LocationsCountriesService())->searchByName($search))
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->name_label)
                    ->searchable()
                    ->preload(),
                ])
            ->actions([
                EditAction::make()->label(__("Bhry98::global.modify"))->visible(fn(LocationsGovernoratesModel $record) => $record->canEdit())->action(fn(LocationsGovernoratesModel $record, array $data) => (new LocationsGovernorateService())->updateGovernorate($record->id, $data))->slideOver()->closeModalByClickingAway(false),
                DeleteAction::make()->label(__("Bhry98::global.delete"))->visible(fn(LocationsGovernoratesModel $record) => $record->canDelete(self::relationsCount($record)))->action(fn(LocationsGovernoratesModel $record) => (new LocationsGovernorateService())->deleteGovernorate($record->id))->closeModalByClickingAway(false),
                RestoreAction::make()->label(__("Bhry98::global.restore"))->visible(fn(LocationsGovernoratesModel $record) => $record->canRestore())->action(fn(LocationsGovernoratesModel $record) => (new LocationsGovernorateService())->restoreGovernorate($record->id))->closeModalByClickingAway(false),
                ForceDeleteAction::make()->label(__("Bhry98::global.force-delete"))->visible(fn(LocationsGovernoratesModel $record) => $record->canForceDelete(self::relationsCount($record)))->action(fn(LocationsGovernoratesModel $record) => (new LocationsGovernorateService())->deleteGovernorate($record->id, true))->closeModalByClickingAway(false),
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
            'index' => ListGovernorates::route(path: '/'),
        ];
    }

    private static function relationsCount(?LocationsGovernoratesModel $record): int
    {
        if (!$record) return 0;
        return $record->users_count + $record->cities_count;
    }

}
