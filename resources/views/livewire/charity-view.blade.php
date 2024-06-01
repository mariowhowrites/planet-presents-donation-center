<article class="flex flex-col items-center gap-4 font-sans max-h-fit w-4/5 mx-auto">
    <div
        class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:grid-rows-2 lg:gap-x-8 lg:px-8">
        <!-- Charity description -->
        <section id="charity-description-section" class="lg:max-w-lg">
            <nav id="charity-view-breadcrumb" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-2">
                    <li>
                        <div class="flex items-center text-sm">
                            <a href="{{ route('home') }}"
                                class="font-medium text-gray-500 hover:text-gray-900">Charities</a>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Charity name -->
            <div id="charity-name" class="mt-4">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $charity->name }}</h1>
            </div>

            <section aria-labelledby="information-heading" class="mt-4">
                <h2 id="information-heading" class="sr-only">Available Donation Tiers</h2>

                <div class="mt-4 space-y-6">
                    <p class="text-base text-gray-500">{{ $charity->description }}</p>
                </div>
            </section>
        </section>

        <!-- Charity image -->
        <div id="charity-image-section" class="mt-10 lg:col-start-2 lg:row-span-2 lg:mt-0 lg:self-center">
            <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg">
                <img src="{{ $charity->previewImageURL() }}" alt="{{ $charity->name }}"
                    class="h-full w-full object-cover object-center">
            </div>
        </div>

        <!-- Donation Tier Selection -->
        <div class="pt-10 lg:pt-0 lg:col-start-1 lg:row-start-2 lg:max-w-lg lg:self-start">
            <section aria-labelledby="options-heading">
                <h2 id="options-heading" class="sr-only">{{ __('routes/charity-view.label') }}</h2>

                <form>
                    <div class="sm:flex sm:justify-between">
                        <!-- Size selector -->
                        <fieldset class="flex flex-col">
                            <legend class="block text-sm font-medium text-gray-700">
                                {{ __('routes/charity-view.label') }}</legend>

                            <p class="py-2">{{ __('routes/charity-view.intro.before') }} <a
                                    class="text-blue-700 hover:text-blue-600 font-bold"
                                    href="{{ route('my-wishlist') }}" wire:navigate>your wishlist.</a>
                                {{ __('routes/charity-view.intro.after') }}</p>
                            <div class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                @foreach ($charity->tiers as $tier)
                                    <!-- Active: "ring-2 ring-indigo-500" -->
                                    <div @class([
                                        'relative block cursor-pointer rounded-lg bg-slate-100 transition border border-gray-300 p-4 focus:outline-none',
                                        'ring-2 ring-indigo-500' => $this->currentWishlist->hasTier($tier),
                                        'shadow-sm hover:shadow-xl' => !$this->currentWishlist->hasTier($tier),
                                    ])
                                        wire:click="toggleFromWishlist({{ $tier->id }})"
                                        wire:id="tier-item-{{ $tier->id }}"
                                        >
                                        <input type="radio" name="size-choice" value="18L" class="sr-only"
                                            aria-labelledby="size-choice-0-label"
                                            aria-describedby="size-choice-0-description">
                                        <div class="flex justify-between">
                                            <p id="size-choice-0-label" class="text-base font-medium text-gray-900">
                                                {{ $tier->name }}</p>
                                            <span class="text-xs" wire:loading.delay
                                                wire:target="toggleFromWishlist({{ $tier->id }})">{{ __('routes/charity-view.updating-wishlist') }}</span>
                                        </div>
                                        <p id="size-choice-0-description" class="mt-1 text-sm text-gray-500">
                                            {{ $tier->description }}</p>
                                        <!--
                          Active: "border", Not Active: "border-2"
                          Checked: "border-indigo-500", Not Checked: "border-transparent"
                        -->
                                        <div @class([
                                            'pointer-events-none absolute -inset-px rounded-lg active:border border-2',
                                            'border-indigo-500' => $this->currentWishlist->hasTier($tier),
                                        ]) aria-hidden="true"></div>
                                    </div>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>
                </form>
            </section>
        </div>
    </div>
</article>
