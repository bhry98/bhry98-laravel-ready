<x-filament-panels::page>
    {{--    @if ($this->hasInfolist())--}}
    {{--        {{ $this->infolist }}--}}
    {{--    @else--}}
    {{--        {{ $this->form }}--}}
    {{--    @endif--}}
    {{$this->table}}
    @if (count($relationManagers = $this->getRelationManagers()))
        <div class="sticky top-0 z-40 bg-white dark:bg-gray-900 shadow">
            <x-filament-panels::resources.relation-managers
                    :active-manager="$this->activeRelationManager"
                    :managers="$relationManagers"
                    :owner-record="$record"
                    :page-class="static::class"
            />
        </div>
    @endif
</x-filament-panels::page>
