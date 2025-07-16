<?php

namespace Bhry98\Users\Filament\Resources\Bhry98UsersResource\Pages;
use Bhry98\Users\Filament\Resources\Bhry98UsersResource\Bhry98UsersResource;

use Filament\Resources\Pages\CreateRecord;

class CreateUsers extends CreateRecord
{
    protected static string $resource = Bhry98UsersResource::class;
    protected static bool $canCreateAnother = false;

}
