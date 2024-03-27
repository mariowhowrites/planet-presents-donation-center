<section id="home-main-content" class="flex items-center justify-center gap-4 py-24 sm:py-32">
    <div class="w-4/5 md:w-3/5 flex flex-col items-center gap-8 mx-auto">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Planet Presents Donation Center</h1>
        <p class="font-serif">
            {{ __('routes/home.intro') }}
        </p>
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900 sr-only">{{ __('routes/home.search-label') }}</label>
            <div class="relative rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-filament::icon class="h-5 w-5 text-gray-400" icon="heroicon-m-magnifying-glass" />
                </div>
                <input type="text" name="search" id="search" wire:model.live="search"
                    class="font-sans block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="{{ __('routes/home.search-label') }}">
            </div>
        </div>
        <div class="mx-auto max-w-7xl lg:px-8">
            <ul role="list"
                class="mx-auto first:mt-0 mt-20 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                @foreach ($this->filteredCharities as $charity)
                    <li>
                        <a href="{{ route('charity.show', $charity->id) }}" wire:navigate>
                            <img class="aspect-[3/2] w-full rounded-2xl object-cover"
                                src="{{ $charity->previewImageURL() }}" alt="">
                            <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">
                                {{ $charity->name }}</h3>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
