<?php

namespace Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages;

use Bhry98\Bhry98LaravelReady\Enums\logs\LogsLevelsEnums;
use Bhry98\Bhry98LaravelReady\Enums\system\SystemActionEnums;
use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Bhry98UsersResource;
use Bhry98\Bhry98LaravelReady\Models\logs\LogsSystemModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsUsersModel;
use Bhry98\Bhry98LaravelReady\Models\sessions\SessionsLogonsModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersNotificationsModel;
use Bhry98\Bhry98LaravelReady\Services\system\rbac\RBACLocalManagementService;
use Carbon\Carbon;
use CRM\Filament\Resources\Customers\CustomersResource;
use CRM\Models\customers\CRMCustomersContactsModel;
use CRM\Services\Customers\CRMCustomersService;
use Exception;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;
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

class ManageUserGroupPolicies extends ViewRecord implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = Bhry98UsersResource::class;
    protected static string $view = 'Bhry98UsersResource::manage-group-policies';
    protected static ?string $navigationIcon = "heroicon-o-shield-check";

    public static function canAccess(array $parameters = []): bool
    {
        return auth()->user()->can('Users.Account.ManagerGroupPolicies');
    }

    public static function getNavigationLabel(): string
    {
        return __("Bhry98::users.group-policies");
    }

    public function getTitle(): string
    {
        return __("Bhry98::users.user-group-policies", ['user' => $this->record?->display_name]) . " ({$this->record?->code})";
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('join-to-group')->label(__("Bhry98::rbac.join-to-group"))->form([Select::make('group_id')->label(__("Bhry98::rbac.name"))->required()->options(fn() => (new RBACLocalManagementService())->getOptions())->searchable()->getSearchResultsUsing(fn($search) => (new RBACLocalManagementService())->getOptions($search))])->action(fn($data) => (new RBACLocalManagementService())->manageGroupUser($data['group_id'], $this->record->id))->closeModalByClickingAway(false)
        ];
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions(config("bhry98.filament.pagination.per_page"))
            ->query(RBACGroupsUsersModel::query()->where(['user_id' => $this->record?->id ?? null])->with(['group'])->latest())
            ->modelLabel(__("Bhry98::users.group-policies"))
            ->columns([
                TextColumn::make('group.default_name')->label(__("Bhry98::rbac.group-name"))->getStateUsing(fn(RBACGroupsUsersModel $record) => $record->group?->name),
                TextColumn::make('group.default_description')->label(__("Bhry98::rbac.group-description"))->limit()->lineClamp(1)->getStateUsing(fn(RBACGroupsUsersModel $record) => $record->group?->description),
                TextColumn::make('created_at')->label(__("Bhry98::global.join-at"))->getStateUsing(fn($record) => $record->created_at ? Carbon::parse($record->created_at)->format(config('bhry98.date.format')) : "---"),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\Action::make('leave')->label(__("Bhry98::global.leave"))->requiresConfirmation()->icon("heroicon-o-backspace")->color(Color::Red)->closeModalByClickingAway(false)->action(fn($record) => (new RBACLocalManagementService())->manageGroupUser($record->group_id, $this->record->id, false))
            ]);
    }

}
