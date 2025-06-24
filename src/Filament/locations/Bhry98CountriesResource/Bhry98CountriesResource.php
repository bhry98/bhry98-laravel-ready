<?php

namespace Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CountriesResource;

use Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CountriesResource\Pages\ListCountries;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Services\locations\CountriesManagementService;
use Carbon\Carbon;
use Exception;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
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
        return '/locations/countries';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Bhry98::locations.manage');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Bhry98::locations.countries');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Bhry98::locations.countries');
    }

    public static function form(Form $form): Form
    {
//        $inputs[] = TextInput::make('code')->autofocus()->label(__("Bhry98::global.country-code"))->minLength(2)->maxLength(50)->unique(LocationsCountriesModel::TABLE_NAME, "code")->nullable();
        $inputs[] = TextInput::make('country_code')->label(__("Bhry98::locations.country-code"))->minLength(2)->maxLength(50)->unique(LocationsCountriesModel::TABLE_NAME , "code")->nullable();
        $inputs[] = TextInput::make('default_name')->label(__("Bhry98::locations.default-name"))->minLength(2)->maxLength(50)->nullable();
        $inputs[] = TextInput::make('flag')->label(__("Bhry98::locations.flag"))->disabled();
        $inputs[] = TextInput::make('lang_key')->required()->minLength(2)->maxLength(4)->label(__("Bhry98::locations.lang-key"))->required();
        $inputs[] = Toggle::make('system_lang')->required()->inline(false)->label(__("Bhry98::locations.country-system-lang"))->required();
        $inputs[] = Toggle::make('active')->required()->inline(false)->label(__("Bhry98::global.active"))->required();
        $inputs[] = Translation::make('names')->columnSpanFull()->label(__("Bhry98::locations.names"))->required();
        return $form->schema($inputs);
    }

//    public static function infolist(Infolist $infolist): Infolist
//    {
//        return $infolist
//            ->schema(self::usersInfoList());
//    }

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
                TextColumn::make('country_code')
                    ->label(__('Bhry98::locations.country-code'))
                    ->copyable()
                    ->searchable(),
                TextColumn::make('default_name')
                    ->label(__('Bhry98::global.default-name'))
                    ->copyable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('localization.value')
                    ->label(__('Bhry98::locations.country-name'))
                    ->copyable()
                    ->getStateUsing(fn(LocationsCountriesModel $record) => $record->name ?? $record->default_name ?? "---")
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('flag')
                    ->label(__('Bhry98::locations.country-flag'))
                    ->copyable()
                    ->toggleable(),
                TextColumn::make('governorates_count')
                    ->label(__('Bhry98::locations.total-governorates'))
                    ->toggleable(),
                TextColumn::make('cities_count')
                    ->label(__('Bhry98::locations.total-cities'))
                    ->toggleable(),
                TextColumn::make('users_count')
                    ->label(__('Bhry98::locations.total-users'))
                    ->toggleable(),
                TextColumn::make('lang_key')
                    ->label(__('Bhry98::locations.country-lang-key'))
                    ->toggleable(),
                IconColumn::make('system_lang')
                    ->label(__('Bhry98::locations.country-system-lang'))
                    ->boolean()
                    ->toggleable(),
                ...bhry98_figma_columns()
            ])
            ->filters([
                TrashedFilter::make()
                    ->visible(auth()->user()->can(abilities: 'CoreUsers.ForceDelete') || auth()->user()->can(abilities: 'CoreUsers.Delete'))
            ])
            ->actions([
                EditAction::make()
                    ->label(__("Bhry98::global.modify"))
                    ->visible(fn() => auth()->user()->can("Locations.Countries.Update"))
                    ->action(fn(LocationsCountriesModel $record, array $data) => (new CountriesManagementService())->updateCountry($record->id, $data))
                    ->slideOver()
                    ->closeModalByClickingAway(false),
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
//            'view' => Users\UsersResource\Pages\ViewUsers::route(path: '/{record}'),
        ];
    }

}
