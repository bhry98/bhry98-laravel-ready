<?php

namespace Bhry98\Users\Filament\Resources\Bhry98UsersResource\Pages;

use Bhry98\AccountCenter\Models\AcChatMessagesModel;
use Bhry98\AccountCenter\Services\UsersNotificationsService;
use Bhry98\Users\Filament\Resources\Bhry98UsersResource\Bhry98UsersResource;
use Bhry98\Users\Models\UsersCoreModel;
use Filament\Forms\Components\DatePicker;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ManageUserNotifications extends ViewRecord implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = Bhry98UsersResource::class;
    protected static string $view = 'Users::view-notifications';
    protected static ?string $navigationIcon = "heroicon-o-bell";

    public static function getNavigationLabel(): string
    {
        return __("Bhry98::users.notifications");
    }

    public function getTitle(): string
    {
        return __("Bhry98::users.user-notifications", ['user' => $this->record?->display_name]) . " ({$this->record?->code})";
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        $query = AcChatMessagesModel::query()->where([
            'channel_id' => (new UsersNotificationsService)->createOrGetNotificationChannel(UsersCoreModel::query()->where(['id' => $this->record?->id])->first())?->id
        ])->latest();
        return $table
            ->paginationPageOptions(config("bhry98.filament.pagination.per_page"))
            ->query($query)
            ->modelLabel(__("Bhry98::ac.notifications"))
            ->columns([
                TextColumn::make('created_at')->label(__("Bhry98::ac.notification-time"))->getStateUsing(fn($record) => $record->created_at?->format(config('bhry98.date.format')) ?? "---"),
//                TextColumn::make('channel.type')->label(__("Bhry98::ac.channel-type"))->badge(),
                TextColumn::make('type')->label(__("Bhry98::ac.message-type"))->badge(),
                TextColumn::make('sender.display_name')->label(__("Bhry98::ac.sender-name"))->default(env("APP_NAME")),
                TextColumn::make('body')->label(__("Bhry98::ac.message-body"))->limit(20)->lineClamp(1),
                TextColumn::make('read_at')->label(__("Bhry98::ac.message-read-at"))->getStateUsing(fn($record) => $record->read_at?->format(config('bhry98.date.format')) ?? "---"),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')->form([
                    DatePicker::make('created_from')->label(__("Bhry98::global.from-date")),
                    DatePicker::make('created_until')->label(__("Bhry98::global.to-date"))->default(now()),
                ])->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                })
            ])
            ->actions([
                ViewAction::make()->label(__("Bhry98::global.view"))->infolist(self::viewLog())->slideOver()->closeModalByClickingAway(false)
            ]);
    }

    private function viewLog(): array
    {
        $infoList[] = \Filament\Infolists\Components\Section::make()
            ->heading(__("Bhry98::global.summary"))
            ->columns(2)
            ->schema([
                TextEntry::make('created_at')->label(__("Bhry98::ac.notification-time"))->weight(FontWeight::Bold)->getStateUsing(fn($record) => $record->created_at?->format(config('bhry98.date.format')) ?? "---"),
                TextEntry::make('sender.display_name')->label(__("Bhry98::ac.sender-name"))->weight(FontWeight::Bold)->default(env("APP_NAME")),
                TextEntry::make('read_at')->label(__("Bhry98::ac.message-read-at"))->weight(FontWeight::Bold)->getStateUsing(fn($record) => $record->read_at?->format(config('bhry98.date.format')) ?? "---"),
                TextEntry::make('type')->label(__("Bhry98::ac.message-type"))->badge(),
            ]);
        $infoList[] = \Filament\Infolists\Components\Section::make()
            ->heading(__("Bhry98::ac.message-body"))
            ->schema([
                TextEntry::make('body')->label('')->columnSpanFull()->html(),
            ]);
        return $infoList;
    }
}
