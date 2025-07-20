<?php

namespace Bhry98\GroupPolicies\Filament\Resources\Bhry98GroupsResource\Pages;

use Bhry98\GroupPolicies\Filament\Resources\Bhry98GroupsResource\Bhry98GroupsResource;
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
//                ->action(fn(array $data) => (new UsersManagementService())->createNewUser($data))
                ->slideOver()
                ->closeModalByClickingAway(false)
                ->createAnother(false)
        ];
    }
}
