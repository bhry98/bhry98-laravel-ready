<?php

namespace Bhry98\Bhry98LaravelReady\Filament\Pages\Configurations;

use Bhry98\Bhry98LaravelReady\Enums\system\SystemSettingsEnums;
use Filament\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Forms\Concerns\{
    InteractsWithForms
};
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
class Bhry98ConfigurationsSettings extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    protected static string $view = 'Bhry98::Configurations.global-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            SystemSettingsEnums::TermsAndConditions->name => bhry98_get_setting(SystemSettingsEnums::TermsAndConditions->name, 'No Content'),
        ]);
    }

    public function getTitle(): string|Htmlable
    {
        return __('center.settings.global-settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('center.settings.global-settings');
    }

    public static function canAccess(): bool
    {
        return auth()->user()->can('Config.GlobalSettings');
    }


    protected function getFormSchema(): array
    {
        return [
            // points settings
            Fieldset::make()->label(label: __(key: "center.settings.points-settings"))->schema([
                TextInput::make(name: SystemSettingsEnums::TermsAndConditions->name)
                    ->numeric()
                    ->label(__(key: "center.settings.points-price"))
                    ->default((int)SystemSettingsEnums::TermsAndConditions->name)->required(),
            ]),
        ];
    }

    protected function getFormModel(): string
    {
        return static::class;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data');
    }

    public function save(): void
    {
//        dd($this->form->getState());
        $formValues = $this->form->getState();
//        Settings::setMany($this->form->getState());
        bhry98_set_setting(key: SystemSettingsEnums::TermsAndConditions->name, value: $formValues[SystemSettingsEnums::TermsAndConditions->name]);
        \Filament\Notifications\Notification::make()
            ->title(__(key: "center.saved"))
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('Save'))
                ->submit('save'), // Calls $this->save()
        ];
    }
    public function getSubNavigation(): array
    {
        return [
            NavigationGroup::make('group')
                ->items([
                    NavigationItem::make(Page::class::getNavigationLabel())
                        ->icon(Pages::class::getNavigationIcon())
                        ->isActiveWhen(fn (): bool => request()->routeIs(Page::class::getNavigationItemActiveRoutePattern()))
                        ->url(Page::class::getNavigationUrl()),
                ])
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }


}
