<?php

namespace Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CountriesResource;

use Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CountriesResource\Pages\ListCountries;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Carbon\Carbon;
use Exception;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
        $inputs[] = TextInput::make('code')
            ->autofocus()
            ->label(__("Bhry98::locations.country-code"));
        /**
         * "country_code",
         * "default_name",
         * "flag",
         * "lang_key",
         * "system_lang",
         * "active",
         */
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
                IconColumn::make('active')
                    ->label(__('Bhry98::global.active'))
                    ->boolean()
                    ->toggleable(),
                TextColumn::make('createdBy.email')
                    ->label(__('Bhry98::global.created-by'))
                    ->copyable()
                    ->toggleable()
                    ->default("---")
                    ->toggledHiddenByDefault(),
                TextColumn::make('created_at')
                    ->label(__('Bhry98::global.created-at'))
                    ->getStateUsing(fn(LocationsCountriesModel $record) => $record->created_at ? Carbon::parse($record->created_at)->format(config("bhry98.app_settings.date.format")) : "---")
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('updatedBy.email')
                    ->label(__('Bhry98::global.updated-by'))
                    ->copyable()
                    ->toggleable()
                    ->default("---")
                    ->toggledHiddenByDefault(),
                TextColumn::make('updated_at')
                    ->label(__('Bhry98::global.updated-at'))
                    ->getStateUsing(fn(LocationsCountriesModel $record) => $record->updated_at ? Carbon::parse($record->updated_at)->format(config("bhry98.app_settings.date.format")) : "---")
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->filters([
                TrashedFilter::make()
                    ->visible(auth()->user()->can(abilities: 'CoreUsers.ForceDelete') || auth()->user()->can(abilities: 'CoreUsers.Delete'))
            ])
            ->actions([])
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
