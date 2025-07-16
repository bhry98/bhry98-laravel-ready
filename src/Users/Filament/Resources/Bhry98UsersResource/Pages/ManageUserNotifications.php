<?php

namespace Bhry98\Users\Filament\Resources\Bhry98UsersResource\Pages;
use Bhry98\Users\Filament\Resources\Bhry98UsersResource\Bhry98UsersResource;

use Bhry98\Bhry98LaravelReady\Models\users\UsersNotificationsModel;
use Carbon\Carbon;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class ManageUserNotifications extends ViewRecord implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = Bhry98UsersResource::class;
    protected static string $view = 'Bhry98UsersResource::view-notifications';
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
        return $table
            ->paginationPageOptions(config("bhry98.filament.pagination.per_page"))
            ->query(UsersNotificationsModel::query()->where(['notifiable_id' => $this->record?->id])->latest())
            ->modelLabel(__("Bhry98::users.logs"))
            ->columns([
                TextColumn::make('created_at')->label(__("Bhry98::logs.time"))->getStateUsing(fn($record) => $record->created_at ? Carbon::parse($record->created_at)->format(config('bhry98.date.format')) : "---"),
//                TextColumn::make('log_level')->label(__("Bhry98::logs.level"))->badge(),
//                TextColumn::make('action')->label(__("Bhry98::logs.action"))->badge(),
//                TextColumn::make('app_profile')->label(__("Bhry98::logs.profile")),
//                TextColumn::make('message')->label(__("Bhry98::logs.message"))->searchable()->limit(30),
//                TextColumn::make('context')->label(__("Bhry98::logs.context"))->limit(30),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('log_level')->label(__("Bhry98::logs.level"))->options(LogsLevelsEnums::class),
                Tables\Filters\SelectFilter::make('action')->label(__("Bhry98::logs.action"))->options(SystemActionEnums::class),
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
                TextEntry::make('created_at')->label(__("Bhry98::logs.time"))->weight(FontWeight::Bold),
                TextEntry::make('app_profile')->label(__("Bhry98::logs.profile")),
                TextEntry::make('log_level')->label(__("Bhry98::logs.level"))->badge(),
                TextEntry::make('action')->label(__("Bhry98::logs.action"))->badge(),
            ]);
        $infoList[] = \Filament\Infolists\Components\Section::make()
            ->heading(__("Bhry98::logs.message"))
            ->schema([
                TextEntry::make('message')->label('')->columnSpanFull()->html(),
            ]);
//        $infoList[] = \Filament\Infolists\Components\Section::make()
//            ->heading(__("Bhry98::logs.context"))
//            ->schema([
//                TextEntry::make('context')
////                    ->label('')
////                    ->columnSpanFull()
//                    ->markdown()
////                    ->formatStateUsing(fn ($state) =>
////                        '<pre class="text-sm text-gray-800 dark:text-gray-100 whitespace-pre-wrap">' .
////                        json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) .
////                        '</pre>'
////                    ),
//            ]);
        return $infoList;
    }
}
