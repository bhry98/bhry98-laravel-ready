<?php

namespace Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Pages;

use Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Bhry98GroupsResource;
use Bhry98\GP\Models\GPGroupsUsersModel;
use Bhry98\GP\Services\GPGroupsService;
use Carbon\Carbon;
use Exception;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ManageGroupPoliciesUsers extends ViewRecord implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    protected static string $resource = Bhry98GroupsResource::class;
    protected static string $view = 'GP::groups.manage-users';
    protected static ?string $navigationIcon = "heroicon-o-users";
    public static function getNavigationLabel(): string
    {
        return __("Bhry98::gp.users", ['group' => '']);
    }
    public function getTitle(): string
    {
        return __("Bhry98::gp.users", ['group' => $this->record?->name ?? $this->record?->code ?? ""]);
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('join-to-group')
                ->label(__("Bhry98::gp.join-to-group"))
                ->form([
                    Select::make('user_id')
                        ->label(__("Bhry98::users.email"))
                        ->required()
                        ->relationship('users.user', 'email')
                        ->searchable()
                        ->preload()
                ])
                ->visible(auth()->user()->can('GP.ManageUsersInGroup'))
                ->action(fn($data) => (new GPGroupsService())->manageUserInGroup($this->record->id, $data['user_id'], true))
                ->closeModalByClickingAway(false)
        ];
    }
    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions(config("bhry98.filament.pagination.per_page"))
            ->query(GPGroupsUsersModel::query()->where(['group_id' => $this->record?->id ?? null])->with(['user'])->latest())
            ->modelLabel(__("Bhry98::gp.users",['group'=>'']))
            ->columns([
                TextColumn::make('user.display_name')->label(__("Bhry98::users.display-name")),
                TextColumn::make('user.email')->label(__("Bhry98::users.email")),
                TextColumn::make('created_at')->label(__("Bhry98::global.join-at"))->getStateUsing(fn($record) => $record->created_at ? Carbon::parse($record->created_at)->format(config('bhry98.date.format')) : "---"),
            ])
            ->actions([
                Tables\Actions\Action::make('leave')
                    ->label(__("Bhry98::global.leave"))
                    ->requiresConfirmation()
                    ->icon("heroicon-o-backspace")->color(Color::Red)
                    ->closeModalByClickingAway(false)
                    ->visible(auth()->user()->can('GP.ManageUsersInGroup'))
                    ->action(fn($record) => (new GPGroupsService())->manageUserInGroup($record->group_id, $record->user_id, false))
            ]);
    }

}
