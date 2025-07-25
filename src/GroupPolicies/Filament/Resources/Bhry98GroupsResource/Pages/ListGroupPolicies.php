<?php

namespace Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Pages;

use Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Bhry98GroupsResource;
use Bhry98\GP\Services\GPGroupsService;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGroupPolicies extends ListRecords
{
    protected static string $resource = Bhry98GroupsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__("Bhry98::global.create"))
                ->visible(auth()->user()->can("GP.Create"))
                ->action(fn(array $data) => (new GPGroupsService())->createGroup($data))
                ->slideOver()
                ->closeModalByClickingAway(false)
                ->createAnother(false)
        ];
    }
}
