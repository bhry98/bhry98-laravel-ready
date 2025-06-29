<?php

namespace Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Pages;

use Bhry98\Bhry98LaravelReady\Filament\users\Bhry98UsersResource\Bhry98UsersResource;
use Bhry98\Bhry98LaravelReady\Models\sessions\SessionsLogonsModel;
use Carbon\Carbon;
use CRM\Filament\Resources\Customers\CustomersResource;
use CRM\Models\customers\CRMCustomersContactsModel;
use CRM\Services\Customers\CRMCustomersService;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

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
        return __("Bhry98::users.user-logons", ['user' => $this->record?->display_name]);
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make('create_contact')
                ->label(__("crm.customers.add-contact"))
//                ->visible(fn() => $this->record?->canManageContacts())
//                ->action(fn(array $data) => (new CRMCustomersService())->addContact($this->record?->id, $data))
                ->slideOver()
                ->closeModalByClickingAway(false)
                ->createAnother(false)
//                ->form(self::contactForm()),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions(config("bhry98.filament.pagination.per_page"))
            ->query(SessionsLogonsModel::query()->where(['user_id' => $this->record?->id])->latest())
            ->modelLabel(__("Bhry98::users.logons-info"))
            ->columns([
                TextColumn::make(name: 'created_at')
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->label(__(key: "global.created-at"))
                    ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->format(bhry98_app_settings('date.table')) : "---"),
                TextColumn::make(name: 'createdBy.display_name')
                    ->default("---")
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->label(__(key: "global.created-by")),
                TextColumn::make(name: 'updated_at')
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->label(__(key: "global.updated-at"))
                    ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->format(bhry98_app_settings('date.table')) : "---"),
//                TextColumn::make(name: 'updatedBy.display_name')
                TextColumn::make(name: 'updated_by')
                    ->default("---")
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->label(__(key: "global.updated-by")),
            ])
            ->filters([
//                Tables\Filters\TrashedFilter::make()
//                    ->visible($this->record?->canManageContacts())
            ])
            ->actions([

            ]);
    }

    function contactForm(): array
    {
        return [
            Grid::make()
                ->columns(2)
                ->schema([
                    TextInput::make('display_name')
                        ->label(__("global.display-name"))
                        ->required()
                        ->maxLength(50),
                    TextInput::make('email')
                        ->label(__("global.email"))
                        ->email()
                        ->required()
                        ->maxLength(50),
                    PhoneInput::make('phone_number')
                        ->label(__("global.phone-number"))
                        ->defaultCountry('EG')
                        ->startsWith("+")
                        ->required(),
                    PhoneInput::make('whatsapp_number')
                        ->label(__("global.whatsapp-number"))
                        ->defaultCountry('EG')
                        ->nullable()
                        ->startsWith("+"),
                    TextInput::make("note")
                        ->label(__("global.note"))
                        ->nullable()
                        ->columnSpanFull(),
                ]),
            Section::make("")
                ->columns(2)
                ->schema([
                    Toggle::make("is_primary")->label(__("global.is-primary"))->default(false),
                    Toggle::make("is_valid")->label(__("global.is-valid"))->default(true),
                    Toggle::make("is_optional")->label(__("global.is-optional"))->default(false),
                    Toggle::make("for_sms")->label(__("global.for-sms"))->default(false),
                    Toggle::make("for_billing")->label(__("global.for-billing"))->default(false),
                ])
        ];

    }

}
