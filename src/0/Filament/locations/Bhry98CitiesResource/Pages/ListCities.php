<?php

namespace Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CitiesResource\Pages;

use Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CitiesResource\Bhry98CitiesResource;
use Bhry98\Bhry98LaravelReady\Services\locations\CitiesManagementService;
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
                ->action(fn(array $data) => (new CitiesManagementService())->createCity($data))
                ->slideOver()
                ->closeModalByClickingAway(false)
                ->createAnother(false)
        ];
    }
}
