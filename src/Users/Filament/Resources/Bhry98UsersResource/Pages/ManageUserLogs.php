<?php

namespace Bhry98\Users\Filament\Resources\Bhry98UsersResource\Pages;
use Bhry98\Helpers\enums\LogsLevelsEnums;
use Bhry98\Helpers\enums\SystemActionEnums;
use Bhry98\Helpers\models\LogsSystemModel;
use Bhry98\Users\Filament\Resources\Bhry98UsersResource\Bhry98UsersResource;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ManageUserLogs extends ViewRecord implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = Bhry98UsersResource::class;
    protected static string $view = 'Users::view-logs';
    protected static ?string $navigationIcon = "heroicon-o-clock";

    public static function getNavigationLabel(): string
    {
        return __("Bhry98::users.logs");
    }

    public function getTitle(): string
    {
        return __("Bhry98::users.user-logs", ['user' => $this->record?->display_name]) . " ({$this->record?->code})";
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
            ->query(LogsSystemModel::query()->where(['user_id' => $this->record?->id])->latest())
            ->modelLabel(__("Bhry98::users.logs"))
            ->columns([
                TextColumn::make('created_at')->label(__("Bhry98::logs.time"))->getStateUsing(fn($record) => $record->created_at ? Carbon::parse($record->created_at)->format(config('bhry98.date.format')) : "---"),
                TextColumn::make('log_level')->label(__("Bhry98::logs.level"))->badge(),
                TextColumn::make('action')->label(__("Bhry98::logs.action"))->badge(),
                TextColumn::make('app_profile')->label(__("Bhry98::logs.profile")),
                TextColumn::make('message')->label(__("Bhry98::logs.message"))->searchable()->limit(30),
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
        $infoList[] = Section::make()
            ->heading(__('Bhry98::logs.context'))
            ->schema([
                TextEntry::make('id')
                    ->label('')
                    ->getStateUsing(fn() => null)
                    ->helperText(fn($record) => json_encode($record->context, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))
            ]);
        return $infoList;
    }
}
