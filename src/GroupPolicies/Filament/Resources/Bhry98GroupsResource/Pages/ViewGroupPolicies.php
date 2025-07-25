<?php

namespace Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Pages;

use Bhry98\GP\Filament\Resources\Bhry98GroupsResource\Bhry98GroupsResource;
use Bhry98\GP\Models\GPGroupsModel;
use Bhry98\GP\Services\GPGroupsService;
use Carbon\Carbon;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\IconPosition;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneEntry;

class ViewGroupPolicies extends ViewRecord
{
    protected static string $resource = Bhry98GroupsResource::class;
    public static function getNavigationLabel(): string
    {
        return __("Bhry98::gp.group-details", ['group' => '']);
    }
    public function getTitle(): string
    {
        return __("Bhry98::gp.group-details", ['group' => $this->record?->name ?? $this->record?->code ?? ""]);
    }
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label(__("Bhry98::global.modify"))
                ->visible(fn(GPGroupsModel $record) => $record->canEdit())
                ->action(fn(GPGroupsModel $record, array $data) => (new GPGroupsService())->updateGroup($record->id, $data))
                ->fillForm(function ($record): array {
                    $data = $record->toArray();
                    foreach (config('bhry98.locales', []) as $locale) {
                        $data["names"][$locale] = $record?->getLocalized('name', $locale);
                        $data["descriptions"][$locale] = $record?->getLocalized('description', $locale);
                    }
                    return $data;
                })
                ->slideOver()
                ->closeModalByClickingAway(false),
            DeleteAction::make()
                ->label(__("Bhry98::global.delete"))
                ->visible(fn(GPGroupsModel $record) => $record->canDelete())
                ->action(fn(GPGroupsModel $record) => (new GPGroupsService())->deleteGroup($record->id))
                ->closeModalByClickingAway(false),
            RestoreAction::make()
                ->label(__("Bhry98::global.restore"))
                ->visible(fn(GPGroupsModel $record) => $record->canRestore())
                ->action(fn(GPGroupsModel $record) => (new GPGroupsService())->restoreGroup($record->id))
                ->closeModalByClickingAway(false),
            ForceDeleteAction::make()
                ->label(__("Bhry98::global.force-delete"))
                ->visible(fn(GPGroupsModel $record) => $record->canForceDelete(Bhry98GroupsResource::geRelationsCount($record)))
                ->action(fn(GPGroupsModel $record) => (new GPGroupsService())->deleteGroup($record->id, true))
                ->closeModalByClickingAway(false),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        $entries[] = TextEntry::make('code')->label(__("Bhry98::gp.group-code"))->weight(FontWeight::Bold)->copyable();
        $entries[] = TextEntry::make('default_name')->label(__("Bhry98::gp.group-name"))->getStateUsing(fn($record) => $record->name ?? "---")->weight(FontWeight::Bold)->copyable();
        $entries[] = IconEntry::make('is_default')->label(__("Bhry98::gp.is-default-group"))->boolean();
        $entries[] = IconEntry::make('active')->label(__("Bhry98::gp.active-group"))->boolean();
        $entries[] = TextEntry::make('default_description')->label(__("Bhry98::gp.group-description"))->columnSpanFull()->getStateUsing(fn($record) => $record->description ?? "---")->weight(FontWeight::Bold)->copyable();
        $sections[] = Section::make(__("Bhry98::gp.group-info"))->columns(4)->schema($entries);
        return $infolist->schema($sections);
    }

}
