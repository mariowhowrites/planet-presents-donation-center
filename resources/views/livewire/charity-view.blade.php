<section class="flex flex-col items-center gap-4 font-sans max-h-fit w-4/5 mx-auto">
    {{-- <h1 class="text-4xl my-8">{{ $charity->name }}</h1>
    <article class="flex flex-col gap-4">
        <img class="object-fill w-2/5 mx-auto" src="{{ $charity->preview_image }}" alt="{{ $charity->name }}">
        <div class="bg-gray-50 px-4 py-4 rounded-lg shadow-sm">
            <p class="font-serif">{{ $charity->description }}</p>
        </div>
        <div class="flex flex-col items-stretch mx-8 gap-4">
            @foreach ($charity->tiers as $tier)
                <div
                    class="font-sans border-2 border-blue-300/30 shadow-sm hover:shadow-md px-6 py-4 bg-slate-200/50 hover:bg-slate-300/50">
                    <h2 class="text-4xl">{{ $tier->name }}</h2>
                    <p>{{ $tier->description }}</p>
                    <p>{{ $tier->price }}</p>
                    @if ($currentWishlist->hasTier($tier))
                        <p>Currently in Wishlist!</p>
                        <button wire:click="removeFromWishlist({{ $tier }})">Remove from Wishlist</button>
                    @else
                        <button wire:click="addToWishlist({{ $tier }})">Add to Wishlist</button>
                    @endif
                </div>
            @endforeach
        </div>
    </article>

    <h2 class="text-lg font-medium text-gray-900">Donation Tiers</h2>

    <p>These are the donation amounts that can offer a significant boost to these charities. Click the "Add to Wishlist" button below any given tier to add it to your personal wishlist.</p>
    <p>Then, <a href="{{ route('my-wishlist') }}" wire:navigate>review your wishlist</a> and share it with friends and family!</p>

    <dl class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 lg:gap-x-8 pb-8">
        @foreach ($charity->tiers as $tier)
            <div class="border-t border-gray-200 pt-4 flex flex-col items-start gap-y-2">
                <dt class="font-medium text-gray-900">{{ $tier->name }}</dt>
                <dd class="mt-2 text-sm text-gray-500">{{ $tier->description }}</dd>
                <x-secondary-button wire:click="toggleFromWishlist({{ $tier->id }})">{{ $this->wishlistButtonText($tier) }}</x-secondary-button>
            </div>
        @endforeach
    </dl> --}}

    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8">
        <!-- Product details -->
        <div class="lg:max-w-lg lg:self-end">
            <nav aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-2">
                    <li>
                        <div class="flex items-center text-sm">
                            <a href="{{ route('home') }}"
                                class="font-medium text-gray-500 hover:text-gray-900">Charities</a>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="mt-4">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $charity->name }}</h1>
            </div>

            <section aria-labelledby="information-heading" class="mt-4">
                <h2 id="information-heading" class="sr-only">Available Donation Tiers</h2>

                {{-- <div class="flex items-center">
                    <p class="text-lg text-gray-900 sm:text-xl">$220</p>

                    <div class="ml-4 border-l border-gray-300 pl-4">
                        <h2 class="sr-only">Reviews</h2>
                        <div class="flex items-center">
                            <div>
                                <div class="flex items-center">
                                    <!-- Active: "text-yellow-400", Default: "text-gray-300" -->
                                    <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <svg class="text-gray-300 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="sr-only">4 out of 5 stars</p>
                            </div>
                            <p class="ml-2 text-sm text-gray-500">1624 reviews</p>
                        </div>
                    </div>
                </div> --}}

                <div class="mt-4 space-y-6">
                    <p class="text-base text-gray-500">{{ $charity->description }}</p>
                </div>

                {{-- <div class="mt-6 flex items-center">
                    <svg class="h-5 w-5 flex-shrink-0 text-green-500" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="ml-2 text-sm text-gray-500">In stock and ready to ship</p>
                </div> --}}
            </section>
        </div>

        <!-- Product image -->
        <div class="mt-10 lg:col-start-2 lg:row-span-2 lg:mt-0 lg:self-center">
            <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg">
                <img src="{{ asset($charity->preview_image) }}"
                    alt="{{ $charity->name }}"
                    class="h-full w-full object-cover object-center">
            </div>
        </div>

        <!-- Product form -->
        <div class="mt-10 lg:col-start-1 lg:row-start-2 lg:max-w-lg lg:self-start">
            <section aria-labelledby="options-heading">
                <h2 id="options-heading" class="sr-only">Product options</h2>

                <form>
                    <div class="sm:flex sm:justify-between">
                        <!-- Size selector -->
                        <fieldset>
                            <legend class="block text-sm font-medium text-gray-700">Donation Tiers</legend>
                            <div class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                @foreach ($charity->tiers as $tier)
                                    <!-- Active: "ring-2 ring-indigo-500" -->
                                    <div @class($this->tierButtonClasses($tier))
                                        wire:click="toggleFromWishlist({{ $tier->id }})">
                                        <input type="radio" name="size-choice" value="18L" class="sr-only"
                                            aria-labelledby="size-choice-0-label"
                                            aria-describedby="size-choice-0-description">
                                        <p id="size-choice-0-label" class="text-base font-medium text-gray-900">
                                            {{ $tier->name }}</p>
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
                                {{-- <!-- Active: "ring-2 ring-indigo-500" -->
                                <div
                                    class="relative block cursor-pointer rounded-lg border border-gray-300 p-4 focus:outline-none">
                                    <input type="radio" name="size-choice" value="20L" class="sr-only"
                                        aria-labelledby="size-choice-1-label"
                                        aria-describedby="size-choice-1-description">
                                    <p id="size-choice-1-label" class="text-base font-medium text-gray-900">20L</p>
                                    <p id="size-choice-1-description" class="mt-1 text-sm text-gray-500">Enough room
                                        for a serious amount of snacks.</p>
                                    <!--
                          Active: "border", Not Active: "border-2"
                          Checked: "border-indigo-500", Not Checked: "border-transparent"
                        -->
                                    <div class="pointer-events-none absolute -inset-px rounded-lg border-2"
                                        aria-hidden="true"></div>
                                </div> --}}
                            </div>
                        </fieldset>
                    </div>
                    {{-- <div class="mt-4">
                        <a href="#" class="group inline-flex text-sm text-gray-500 hover:text-gray-700">
                            <span>What size should I buy?</span>
                            <svg class="ml-2 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM8.94 6.94a.75.75 0 11-1.061-1.061 3 3 0 112.871 5.026v.345a.75.75 0 01-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 108.94 6.94zM10 15a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div> --}}
                    <div class="mt-10">
                        {{-- <button type="submit"
                            class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Add
                            to wishlist</button> --}}
                    </div>
                    {{-- <div class="mt-6 text-center">
                        <a href="#" class="group inline-flex text-base font-medium">
                            <svg class="mr-2 h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                            <span class="text-gray-500 hover:text-gray-700">Lifetime Guarantee</span>
                        </a>
                    </div> --}}
                </form>
            </section>
        </div>
    </div>
</section>
