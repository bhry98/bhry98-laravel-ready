<?php

namespace Bhry98\Locations\Filament\Resources\Bhry98CountriesResource\Pages;

use Bhry98\Locations\Filament\Resources\Bhry98CountriesResource\Bhry98CountriesResource;
use Filament\Resources\Pages\ListRecords;

class ListCountries extends ListRecords
{
    protected static string $resource = Bhry98CountriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make()
//                ->label(__("Bhry98::global.create"))
//                ->visible(fn() => auth()->user()?->can("Locations.Countries.Create"))
//                ->action(fn(array $data) => (new CountriesManagementService())->createCountry($data))
//                ->slideOver()
//                ->closeModalByClickingAway(false)
//                ->createAnother(false)
        ];
    }
}
