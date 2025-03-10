<div class="space-y-8">
    <div class="flex items-center justify-between space-x-8">
        <h2 class="flex-shrink-0 text-lg font-heading text-gray-900">
            All plugins
        </h2>

        <div class="flex items-center space-x-4">
            <div>
                <label class="sr-only" for="search">
                    Search
                </label>

                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center justify-center w-10 h-10 text-gray-400 transition pointer-events-none group-focus-within:text-primary-500">
                        <x-heroicon-o-search class="w-5 h-5" />
                    </span>

                    <input
                        wire:model="search"
                        id="search"
                        placeholder="Search"
                        type="search"
                        class="block w-full h-10 pl-10 placeholder-gray-400 transition duration-75 border-gray-300 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600"
                    >
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap gap-2">
        <span class="font-medium">
            Filter by:
        </span>

        @foreach (\App\Enums\PluginCategory::cases() as $category)
            <button
                type="button"
                wire:click="toggleCategoryFilter('{{ $category->value }}')"
                wire:loading.class="cursor-wait"
                wire:target="toggleCategoryFilter"
                @class([
                    'inline-flex items-center justify-center space-x-1 text-primary-700 bg-primary-500/10 min-h-6 px-2 py-0.5 text-sm font-medium tracking-tight rounded-xl whitespace-normal',
                    'opacity-50' => count($categoryFilter) && (! in_array($category->value, $categoryFilter)),
                ])
            >
                {{ $category->getLabel() }}
            </button>
        @endforeach
    </div>

    @php
        $plugins = $this->getPlugins()
    @endphp

    @if (count($plugins))
        <div class="grid grid-cols-1 gap-x-8 gap-y-8 sm:grid-cols-2 sm:gap-y-10 lg:grid-cols-4">
            @foreach ($plugins as $plugin)
                <x-plugins.card :plugin="$plugin" />
            @endforeach
        </div>
    @else
        <x-tables::empty-state
            icon="heroicon-o-x"
            heading="No plugins found"
            description="No plugins match your search criteria."
            class="border rounded-2xl"
        />
    @endif

    <x-tables::pagination
        :paginator="$plugins"
        :records-per-page-select-options="[8, 12, 20, 28]"
    />
</div>
