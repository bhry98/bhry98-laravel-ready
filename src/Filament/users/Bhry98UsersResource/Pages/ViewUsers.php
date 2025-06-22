<?php

namespace Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages;

use App\Filament\Resources\Users\UsersResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUsers extends ViewRecord
{
    protected static string $resource = UsersResource::class;

//    public static function getRoutePath(): string
//    {
//        return "/users/{record:identity_code}";
//    }

//    public function infolist(Infolist $infolist): Infolist
//    {
//        return $infolist
//            ->schema(UsersResource::usersInfoList());
//    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
