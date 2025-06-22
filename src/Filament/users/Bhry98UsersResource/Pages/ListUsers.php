<?php

namespace Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages;

use App\Filament\Resources\Users\UsersResource;
use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Bhry98UsersResource;
use Bhry98\Bhry98LaravelReady\Services\users\UsersManagementService;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = Bhry98UsersResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Actions\Action::make(__(key: "center.users.create"))
//                ->form(form: UsersResource::usersForm())
                ->action(function (array $data): void {
                    (new UsersManagementService())->createNewUser($data);
                })
                ->slideOver()
                ->stickyModalFooter()
        ];
    }
}
