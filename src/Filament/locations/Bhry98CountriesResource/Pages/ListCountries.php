<?php

namespace Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CountriesResource\Pages;

use Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98CountriesResource\Bhry98CountriesResource;
use Bhry98\Bhry98LaravelReady\Services\locations\CountriesManagementService;
use Bhry98\Bhry98LaravelReady\Services\users\UsersManagementService;
use Filament\{
    Actions,
    Actions\Action
};
use Filament\Resources\Pages\ListRecords;

class ListCountries extends ListRecords
{
    protected static string $resource = Bhry98CountriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make()
//                ->label(__("Bhry98::global.create"))
////                ->visible(fn() => auth()->user()->can())
//                ->action(fn(array $data) => (new CountriesManagementService())->createCountry($data))
//                ->slideOver()
//                ->closeModalByClickingAway(false)
//                ->createAnother(false)
        ];
    }
}
