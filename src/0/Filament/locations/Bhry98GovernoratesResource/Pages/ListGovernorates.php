<?php

namespace Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98GovernoratesResource\Pages;

use Bhry98\Bhry98LaravelReady\Filament\locations\Bhry98GovernoratesResource\Bhry98GovernoratesResource;
use Bhry98\Bhry98LaravelReady\Services\locations\GovernorateManagementService;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGovernorates extends ListRecords
{
    protected static string $resource = Bhry98GovernoratesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__("Bhry98::global.create"))
                ->visible(fn() => auth()->user()?->can("Locations.Governorates.Create"))
                ->action(fn(array $data) => (new GovernorateManagementService())->createGovernorate($data))
                ->slideOver()
                ->closeModalByClickingAway(false)
                ->createAnother(false)
        ];
    }
}
