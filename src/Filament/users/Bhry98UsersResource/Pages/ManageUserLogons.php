<?php

namespace Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages;

use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Bhry98UsersResource;
use Bhry98\Bhry98LaravelReady\Models\logs\LogsUsersLogonsModel;
use Carbon\Carbon;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ManageUserLogons extends ViewRecord implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = Bhry98UsersResource::class;
    protected static string $view = 'Bhry98UsersResource::manage-logons';
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
            ->query(LogsUsersLogonsModel::query()->where(['user_id' => $this->record?->id ?? null])->orWhereRaw('0 = 1')->latest())
            ->modelLabel(__("Bhry98::users.logons-info"))
            ->columns([
                TextColumn::make('created_at')->label(__("Bhry98::global.created-at"))->getStateUsing(fn($record) => $record->created_at ? Carbon::parse($record->created_at)->format(config('bhry98.date.format')) : "---"),
                TextColumn::make('ip_address')->label(__("Bhry98::global.ip-address")),
                TextColumn::make('city')->searchable()->toggleable()->label(__("Bhry98::global.city")),
                TextColumn::make('region')->toggleable()->label(__("Bhry98::global.region")),
                TextColumn::make('country')->searchable()->toggleable()->label(__("Bhry98::global.country")),
                TextColumn::make('loc')->toggleable()->toggledHiddenByDefault()->label(__("Bhry98::global.loc")),
                TextColumn::make('org')->toggleable()->label(__("Bhry98::global.org")),
                TextColumn::make('timezone')->toggleable()->label(__("Bhry98::global.timezone")),
            ])
            ->filters([])
            ->actions([]);
    }


}
