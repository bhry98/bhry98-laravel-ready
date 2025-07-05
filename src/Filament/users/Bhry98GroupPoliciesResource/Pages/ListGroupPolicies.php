<?php

namespace Bhry98\Bhry98LaravelReady\Filament\users\Bhry98GroupPoliciesResource\Pages;

use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98GroupPoliciesResource\Bhry98GroupPoliciesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGroupPolicies extends ListRecords
{
    protected static string $resource = Bhry98GroupPoliciesResource::class;

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
