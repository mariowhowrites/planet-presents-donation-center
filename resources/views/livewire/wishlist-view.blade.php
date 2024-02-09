{{-- <section class="flex flex-col items-center gap-4 font-sans py-7 w-3/5 mx-auto">
    <h1 class="text-4xl my-8"></h1>
    <article class="">
        @if ($wishlist->wishlistItems->isEmpty())
            <p>Your wishlist is empty!</p>
            <p>Find some causes to donate to by visiting our <a class="underline text-blue-600" href="{{ route('home') }}"
                    wire:navigate>Charities</a> page</p>
        @else
            @if ($this->canEditWishlist())
                <p>Wishlist Status: {{ $wishlist->status->value }}</p>
                @if ($wishlist->status == App\Enums\WishlistStatus::Private)
                    <button wire:click="publishWishlist">Publish</button>
                @else
                    <button wire:click="unpublishWishlist">Unpublish</button>
                @endif
            @endif
            <ul>
                @foreach ($wishlist->wishlistItems as $item)
                    <li>{{ $item->tier->charity->name }}: {{ $item->tier->name }}</li>
                @endforeach
            </ul>
        @endif
    </article>
</section> --}}
<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                {{ $this->canEditWishlist() ? 'Your Wishlist' : "Someone else's Wishlist" }}</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">{{ $wishlist->description }}</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
            {{-- Wishlist items --}}
            @foreach ($wishlist->getSelectedCharities() as $charity)
                <article class="flex flex-col items-start justify-between">
                    <div class="relative w-full">
                        <img src="{{ $charity->preview_image }}"
                            alt=""
                            class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                        <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                    </div>
                    <div class="max-w-xl">
                        {{-- <div class="mt-8 flex items-center gap-x-4 text-xs">
                            <time datetime="2020-03-16" class="text-gray-500">Mar 16, 2020</time>
                            <a href="#"
                                class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">Marketing</a>
                        </div> --}}
                        <div class="group relative mt-8">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    {{ $charity->name }}
                                </a>
                            </h3>
                            <p class="mt-5 text-sm leading-6 text-gray-600">
                                {{ $charity->description }}
                            </p>
                        </div>
                        {{-- <div class="relative mt-8 flex items-center gap-x-4">
                            <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="" class="h-10 w-10 rounded-full bg-gray-100">
                            <div class="text-sm leading-6">
                                <p class="font-semibold text-gray-900">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        Michael Foster
                                    </a>
                                </p>
                                <p class="text-gray-600">Co-Founder / CTO</p>
                            </div>
                        </div> --}}
                        {{-- <h3 class="my-2">Suggested Donation Amounts</h3>
                        <div class="flex flex-col items-stretch gap-4">
                            @foreach ($wishlist->getSelectedTiersByCharity($charity->id) as $tier)
                                <div
                                    class="font-sans border-2 border-blue-300/30 shadow-sm hover:shadow-md px-6 py-4 bg-slate-200/50 hover:bg-slate-300/50">
                                    <h2 class="text-4xl">{{ $tier->name }}</h2>
                                    <p>{{ $tier->description }}</p>
                                    <p>{{ $tier->price }}</p>
                                </div>
                            @endforeach
                        </div> --}}

                        <button wire:click="beginPledge">Donate</button>
                </article>
            @endforeach

            <!-- More posts... -->
        </div>
    </div>
</div>
