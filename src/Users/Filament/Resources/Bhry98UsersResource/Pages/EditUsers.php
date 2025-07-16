<?php

namespace Bhry98\Users\Filament\Resources\Bhry98UsersResource\Pages;
use Bhry98\Users\Filament\Resources\Bhry98UsersResource\Bhry98UsersResource;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUsers extends EditRecord
{
    protected static string $resource = Bhry98UsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
