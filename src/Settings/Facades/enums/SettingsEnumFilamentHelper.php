<?php

namespace Bhry98\Settings\Facades\enums;

use Bhry98\Settings\Models\SettingsEnumsModel;
use Bhry98\Settings\Services\SettingsEnumsService;
use Closure;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreAction;

class SettingsEnumFilamentHelper
{

    protected string $recordClass;
    protected array $actions = [];

    protected array $config = [
        'edit' => null,
        'delete' => null,
        'forceDelete' => null,
        'restore' => null,
    ];

    public static function make(string $recordClass): self
    {
        return new self($recordClass);
    }

    protected function __construct(string $recordClass)
    {
        $this->recordClass = $recordClass;
    }

    public function withEdit(int|Closure $relationsCount = 0, string $ability = null): self
    {
        $this->config['edit'] = compact('relationsCount', 'ability');
        return $this;
    }

    public function withDelete(int|Closure $relationsCount = 0, string $ability = null): self
    {
        $this->config['delete'] = compact('relationsCount', 'ability');
        return $this;
    }

    public function withForceDelete(int|Closure $relationsCount = 0, string $ability = null): self
    {
        $this->config['forceDelete'] = compact('relationsCount', 'ability');
        return $this;
    }

    public function withRestore(int|Closure $relationsCount = 0, string $ability = null): self
    {
        $this->config['restore'] = compact('relationsCount', 'ability');
        return $this;
    }

    public function getActions(): array
    {
        return collect($this->config)
            ->filter()
            ->map(function ($config, $action) {
                return $this->{"build" . ucfirst($action) . "Action"}($config['relationsCount'], $config['ability']);
            })
            ->values()
            ->all();
    }

    protected function buildEditAction(int|Closure $relationsCount = 0, ?string $ability = null): EditAction
    {
        return EditAction::make()
            ->label(__('Bhry98::global.modify'))
            ->closeModalByClickingAway(false)
            ->slideOver()
            ->visible(fn(SettingsEnumsModel $record) => $record->canEdit($ability))
            ->action(fn(SettingsEnumsModel $record, array $data) => app(SettingsEnumsService::class)->updateEnum($record->id, $data))
            ->fillForm(function ($record): array {
                $data = $record->toArray();
                foreach (config('bhry98.locales', []) as $locale) {
                    $data["names"][$locale] = $record?->getLocalized('name', $locale);
                    $data["descriptions"][$locale] = $record?->getLocalized('description', $locale);
                }
                return $data;
            });
    }

    protected function buildDeleteAction(int|Closure $relationsCount = 0, ?string $ability = null): DeleteAction
    {
        return DeleteAction::make()
            ->label(__('Bhry98::global.delete'))
            ->requiresConfirmation()
            ->closeModalByClickingAway(false)
            ->visible(fn(SettingsEnumsModel $record) => $record->canDelete($ability))
            ->action(fn($record) => app(SettingsEnumsService::class)->deleteEnum($record->id));
    }

    protected function buildForceDeleteAction(int|Closure $relationsCount = 0, ?string $ability = null): ForceDeleteAction
    {
        return ForceDeleteAction::make()
            ->label(__('Bhry98::global.force-delete'))
            ->requiresConfirmation()
            ->closeModalByClickingAway(false)
            ->visible(fn(SettingsEnumsModel $record) => $record->canForceDelete(is_callable($relationsCount) ? $relationsCount($record) : $relationsCount,$ability))
            ->action(fn($record) => app(SettingsEnumsService::class)->deleteEnum($record->id, true));
    }

    protected function buildRestoreAction(int|Closure $relationsCount = 0, ?string $ability = null): RestoreAction
    {
        return RestoreAction::make()
            ->label(__('Bhry98::global.restore'))
            ->requiresConfirmation()
            ->closeModalByClickingAway(false)
            ->visible(fn(SettingsEnumsModel $record) => $record->canRestore($ability))
            ->action(fn($record) => app(SettingsEnumsService::class)->restoreEnum($record->id));
    }
}