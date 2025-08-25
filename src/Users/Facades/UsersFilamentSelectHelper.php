<?php

namespace Bhry98\Users\Facades;

use Bhry98\Users\Filament\Resources\Bhry98UsersResource\Bhry98UsersResource;
use Bhry98\Users\Services\UsersManagementService;
use Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Set;

class UsersFilamentSelectHelper
{
    public static function make(string $relationship, string $displayColumn, ?string $columnName = null, ?Closure $modifyQueryUsing = null): Select
    {
        return Select::make($columnName ?? "{$relationship}_id")
            ->relationship($relationship, $displayColumn, $modifyQueryUsing)
            ->searchable()
            ->preload()
            ->suffixIconColor('primary')
            ->suffixAction(
                Action::make("create{$relationship}")
                    ->icon('heroicon-o-plus')
                    ->tooltip(__("Bhry98::users.create-user"))
                    ->slideOver()
                    ->closeModalByClickingAway(false)
                    ->modalHeading(__("Bhry98::users.create-user"))
                    ->form(fn(): array => [Grid::make(2)->schema(Bhry98UsersResource::userFrom())])
                    ->action(function (array $data, Set $set) use ($columnName, $relationship) {
                        $newUser = (new UsersManagementService())->createNew($data);
                        if ($newUser) $set($columnName ?? "{$relationship}_id", $newUser->id);
                    })
            );
    }
}