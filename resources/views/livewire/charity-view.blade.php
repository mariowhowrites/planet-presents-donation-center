<section class="flex flex-col items-center gap-4 font-sans max-h-fit py-4 w-4/5 mx-auto">
    <h1 class="text-4xl my-8">{{ $charity->name }}</h1>
    <article class="grid grid-cols-1 md:grid-cols-2">
        <div>
            <img class="max-h-96 object-contain" src="{{ $charity->preview_image }}" alt="{{ $charity->name }}">
            <p class="">{{ $charity->description }}</p>
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
</section>
