<?php

namespace Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Pages;

use Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Bhry98GroupsResource;
use Bhry98\GP\Models\GPGroupsPermissionsModel;
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

class ManageGroupPoliciesPermissions extends ViewRecord implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = Bhry98GroupsResource::class;
    protected static string $view = 'GP::groups.manage-permissions';
    protected static ?string $navigationIcon = "heroicon-o-shield-check";
    public static function getNavigationLabel(): string
    {
        return __("Bhry98::gp.permissions", ['group' => '']);
    }
    public function getTitle(): string
    {
        return __("Bhry98::gp.permissions", ['group' => $this->record?->name ?? $this->record?->code ?? ""]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('add-permission')
                ->label(__("Bhry98::gp.add-permission"))
                ->form([
                    Select::make('permission_id')
                        ->label(__("Bhry98::gp.permission"))
                        ->required()
                        ->relationship('permissions.permission', 'code')
                        ->getOptionLabelFromRecordUsing(fn($record) => $record->name ?? $record->code)
                        ->searchable()
                        ->preload()
                ])
                ->visible(auth()->user()->can('GP.ManagePermissionsInGroup'))
                ->action(fn($data) => (new GPGroupsService())->managePermissionsInGroup($this->record->id, $data['permission_id'], true))
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
            ->query(GPGroupsPermissionsModel::query()->where(['group_id' => $this->record?->id ?? null])->with(['permission'])->latest())
            ->modelLabel(__("Bhry98::gp.permissions", ['group' => '']))
            ->columns([
                TextColumn::make('permission.code')->label(__("Bhry98::gp.permission-code"))->toggleable()->toggledHiddenByDefault(),
                TextColumn::make('permission.default_name')->label(__("Bhry98::gp.permission-name"))->getStateUsing(fn($record) => $record->permission?->name ?? "---"),
                TextColumn::make('permission.default_description')->label(__("Bhry98::gp.permission-description"))->limit(50)->getStateUsing(fn($record) => $record->permission?->name ?? "---"),
                TextColumn::make('created_at')->label(__("Bhry98::global.join-at"))->getStateUsing(fn($record) => $record->created_at ? Carbon::parse($record->created_at)->format(config('bhry98.date.format')) : "---"),
            ])
            ->actions([
                Tables\Actions\Action::make('leave')
                    ->label(__("Bhry98::global.leave"))
                    ->requiresConfirmation()
                    ->icon("heroicon-o-backspace")->color(Color::Red)
                    ->closeModalByClickingAway(false)
                    ->visible(auth()->user()->can('GP.ManagePermissionsInGroup'))
                    ->action(fn($record) => (new GPGroupsService())->managePermissionsInGroup($record->group_id, $record->permission_id, false))
            ]);
    }

}
