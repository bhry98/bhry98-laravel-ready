<?php

namespace Bhry98\Users\Filament\Resources\Bhry98UsersResource\Pages;
use Bhry98\Users\Filament\Resources\Bhry98UsersResource\Bhry98UsersResource;

use Bhry98\Users\Models\UsersAuthenticationLogModel;
use Carbon\Carbon;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ManageUserLogons extends ViewRecord implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = Bhry98UsersResource::class;
    protected static string $view = 'Users::manage-logons';
    protected static ?string $navigationIcon = "heroicon-o-lock-closed";

    public static function getNavigationLabel(): string
    {
        return __("Bhry98::users.logons-info");
    }

    public function getTitle(): string
    {
        return __("Bhry98::users.user-logons", ['user' => $this->record?->display_name ?? ""]);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions(config("bhry98.filament.pagination.per_page"))
            ->query(UsersAuthenticationLogModel::query()->where(['authenticatable_id' => $this->record?->id ?? null])->orWhereRaw('0 = 1')->latest('id'))
            ->modelLabel(__("Bhry98::users.logons-info"))
            ->columns([
                TextColumn::make('login_at')->label(__("Bhry98::auth.login-at"))->getStateUsing(fn($record) => $record->login_at ? Carbon::parse($record->login_at)->format(config('bhry98.date.format')) : "---"),
                Tables\Columns\IconColumn::make('login_successful')->label(__("Bhry98::auth.login-successful"))->boolean(),
                TextColumn::make('logout_at')->label(__("Bhry98::auth.logout-at"))->getStateUsing(fn($record) => $record->logout_at ? Carbon::parse($record->logout_at)->format(config('bhry98.date.format')) : "---"),
                TextColumn::make('ip_address')->label(__("Bhry98::auth.ip-address")),
                TextColumn::make('user_agent')->label(__("Bhry98::auth.user-agent")),
                TextColumn::make('location')->label(__("Bhry98::auth.location")),
                /**
                 * authenticatable_type
                 * authenticatable_id
                 * cleared_by_user
                 *
                 */
//                TextColumn::make('city')->searchable()->toggleable()->label(__("Bhry98::global.city")),
//                TextColumn::make('region')->toggleable()->label(__("Bhry98::global.region")),
//                TextColumn::make('country')->searchable()->toggleable()->label(__("Bhry98::global.country")),
//                TextColumn::make('loc')->toggleable()->toggledHiddenByDefault()->label(__("Bhry98::global.loc")),
//                TextColumn::make('org')->toggleable()->label(__("Bhry98::global.org")),
//                TextColumn::make('timezone')->toggleable()->label(__("Bhry98::global.timezone")),
            ])
            ->filters([])
            ->actions([]);
    }


}
