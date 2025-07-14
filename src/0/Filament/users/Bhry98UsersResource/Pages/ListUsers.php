<?php

namespace Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages;

use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Bhry98UsersResource;
use Bhry98\Bhry98LaravelReady\Services\users\UsersManagementService;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = Bhry98UsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__("Bhry98::global.create"))
                ->action(fn(array $data) => (new UsersManagementService())->createNewUser($data))
                ->slideOver()
                ->closeModalByClickingAway(false)
                ->createAnother(false)
        ];
    }
}
