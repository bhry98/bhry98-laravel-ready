<?php

namespace Bhry98\Locations\Filament\Resources\Bhry98CitiesResource\Pages;

use Bhry98\Locations\Filament\Resources\Bhry98CitiesResource\Bhry98CitiesResource;
use Bhry98\Locations\Services\LocationsCitiesService;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCities extends ListRecords
{
    protected static string $resource = Bhry98CitiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__("Bhry98::global.create"))
                ->visible(fn() => auth()->user()?->can("Locations.Cities.Create"))
                ->action(fn(array $data) => (new LocationsCitiesService())->createCity($data))
                ->slideOver()
                ->closeModalByClickingAway(false)
                ->createAnother(false)
        ];
    }
}
