<x-filament-panels::page>
{{--        @if ($this->hasInfolist())--}}
{{--            {{ $this->infolist }}--}}
{{--        @else--}}
{{--        @endif--}}

    {{-- Render subnavigation --}}
{{--    <x-filament::layouts.app.sub-navigation--}}
{{--            :items="static::getSubNavigation()"--}}
{{--    />--}}

    {{-- Your form --}}
    {{ $this->form }}
            {{--    {{$this->table}}--}}
{{--    @if (count($relationManagers = $this->getRelationManagers()))--}}
{{--        <div class="sticky top-0 z-40 bg-white dark:bg-gray-900 shadow">--}}
{{--            <x-filament-panels::resources.relation-managers--}}
{{--                    :active-manager="$this->activeRelationManager"--}}
{{--                    :managers="$relationManagers"--}}
{{--                    :owner-record="$record"--}}
{{--                    :page-class="static::class"--}}
{{--            />--}}
{{--        </div>--}}
{{--    @endif--}}
</x-filament-panels::page>
