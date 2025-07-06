<a href="{{route('filament.' . filament()->getCurrentPanel()->getId() . '.pages.applications-switcher') }}" class="fi-dropdown-trigger flex cursor-pointer">
    <div class="flex items-center justify-center w-9 h-9 language-switch-trigger text-primary-600 bg-primary-500/10 rounded-lg">
        <span class="font-semibold text-md">
            <x-filament::icon icon="heroicon-o-server-stack" class="h-5 w-5" />
        </span>
    </div>
</a>
