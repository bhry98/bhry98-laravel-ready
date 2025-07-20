<x-filament::page>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
        @foreach ($this->getPanels() as $panel)
            <x-filament::card>
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold">
                            {{ ucfirst($panel->getId()) }}
                        </h2>
                        <p class="text-sm text-gray-600">
                            {{ $panel->getPath() }}
                        </p>
                    </div>
                    <a
                            href="{{ url($panel->getPath()) }}"
                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-primary-600 rounded-md hover:bg-primary-700"
                    >
                        {{__("Bhry98::global.open")}}
                    </a>
                </div>
            </x-filament::card>
        @endforeach
    </div>
</x-filament::page>