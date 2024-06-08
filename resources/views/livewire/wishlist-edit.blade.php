{{-- <x-slot:meta_tags>
    <meta property="og:title"
    content="{{ $wishlist->name }}: {{ config('app.name', 'Planet Presents Donation Center') }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ route('wishlist.show', $wishlist->id) }}">
    <meta property="og:image" content="{{ $wishlist->getSelectedCharities()[0]->preview_image ?? '' }}">
    <meta name="twitter:card" content="summary">
</x-slot:meta_tags> --}}


<div class="py-12 md:py-24 md:w-3/5 mx-auto">
    <section class="grid gap-2 grid-columns-8">
        {{-- <div class="col-span-full lg:flex lg:items-center lg:justify-between pb-12">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Wishlist Settings</h2>
            </div>
            <div class="mt-5 flex lg:ml-4 lg:mt-0">
                <span class="ml-3 hidden sm:block">
                    <a href="{{ route('wishlist.show', $wishlist->id) }}"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path
                                d="M12.232 4.232a2.5 2.5 0 013.536 3.536l-1.225 1.224a.75.75 0 001.061 1.06l1.224-1.224a4 4 0 00-5.656-5.656l-3 3a4 4 0 00.225 5.865.75.75 0 00.977-1.138 2.5 2.5 0 01-.142-3.667l3-3z" />
                            <path
                                d="M11.603 7.963a.75.75 0 00-.977 1.138 2.5 2.5 0 01.142 3.667l-3 3a2.5 2.5 0 01-3.536-3.536l1.225-1.224a.75.75 0 00-1.061-1.06l-1.224 1.224a4 4 0 105.656 5.656l3-3a4 4 0 00-.225-5.865z" />
                        </svg>
                        View
                    </a>
                </span>

                <span class="sm:ml-3">
                    <button type="button"
                        wire:click="toggleWishlistPublished()"
                        class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $this->publishButtonText() }}
                    </button>
                </span>

                <!-- Dropdown -->
                <div class="relative ml-3 sm:hidden">
                    <button type="button"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400"
                        id="mobile-menu-button" aria-expanded="false" aria-haspopup="true">
                        More
                        <svg class="-mr-1 ml-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div> --}}
        <header class="pb-4 pt-6 sm:pb-6 px-4 md:px-0">
            <div class="mx-auto flex max-w-7xl flex-wrap items-center gap-6 sm:flex-nowrap">
                <h1 class="text-base font-semibold leading-7 text-gray-900">Wishlist Dashboard</h1>
                <div
                    class="order-last flex w-full gap-x-8 text-sm font-semibold leading-6 sm:order-none sm:w-auto sm:border-l sm:border-gray-200 sm:pl-6 sm:leading-7">
                    <button wire:click="changeView('Analytics')" @class([
                        'text-indigo-600' => $this->currentView == 'Analytics',
                        'text-gray-700' => $this->currentView !== 'Analytics',
                    ])>Analytics</button>
                    <button wire:click="changeView('Settings')" @class([
                        'text-indigo-600' => $this->currentView == 'Settings',
                        'text-gray-700' => $this->currentView !== 'Settings',
                    ])>Settings</button>
                    {{-- <a href="#" class="text-gray-700">All-time</a> --}}
                </div>
                <span class="ml-auto hidden sm:block">
                    <a href="{{ route('wishlist.show', $wishlist->id) }}"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path
                                d="M12.232 4.232a2.5 2.5 0 013.536 3.536l-1.225 1.224a.75.75 0 001.061 1.06l1.224-1.224a4 4 0 00-5.656-5.656l-3 3a4 4 0 00.225 5.865.75.75 0 00.977-1.138 2.5 2.5 0 01-.142-3.667l3-3z" />
                            <path
                                d="M11.603 7.963a.75.75 0 00-.977 1.138 2.5 2.5 0 01.142 3.667l-3 3a2.5 2.5 0 01-3.536-3.536l1.225-1.224a.75.75 0 00-1.061-1.06l-1.224 1.224a4 4 0 105.656 5.656l3-3a4 4 0 00-.225-5.865z" />
                        </svg>
                        View
                    </a>
                </span>

                <button type="button" wire:click="toggleWishlistPublished()"
                    class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $this->publishButtonText() }}
                </button>
            </div>
        </header>
        @switch($this->currentView)
            @case('Analytics')
                <article class="col-span-full"><livewire:wishlist-statistics :wishlist="$wishlist" /></article>
                <article class="col-span-full"><livewire:pledges-by-wishlist /></article>
                <article class="col-span-full py-12"><livewire:items-by-wishlist /></article>
            @break

            @case('Settings')
                <article class="col-span-full"><livewire:wishlist-edit-form :wishlist="$wishlist" /></article>
            @break
        @endswitch
    </section>
</div>
