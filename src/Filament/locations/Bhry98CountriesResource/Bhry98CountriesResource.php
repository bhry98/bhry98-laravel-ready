<?php

namespace Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CountriesResource;

use Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CountriesResource\Pages\ListCountries;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class Bhry98CountriesResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $model = LocationsCountriesModel::class;


    public static function canAccess(): bool
    {
        return true;
//        return auth()->user()->can(abilities: 'CoreUsers.All');
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(name: 'last_name')
                    ->label(__(key: 'center.users.last-name'))
                    ->copyable()
                    ->searchable(),
            ])
            ->filters([
                TrashedFilter::make()
                    ->label(__(key: 'center.delete'))
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
