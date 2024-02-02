<section class="flex flex-col items-center gap-4 font-sans py-7 w-3/5 mx-auto">
    <h1 class="text-4xl my-8">Your Wishlist</h1>
    <article class="">
        @if ($wishlist->wishlistItems->isEmpty())
            <p>Your wishlist is empty!</p>
            <p>Find some causes to donate to by visiting our <a class="underline text-blue-600" href="{{ route('home') }}"
                    wire:navigate>Charities</a> page</p>
        @else
            <p>Wishlist Status: {{ $wishlist->status->value }}</p>
            @if ($wishlist->status == App\Enums\WishlistStatus::Private)
                <button wire:click="publishWishlist">Publish</button>
            @else
                <button wire:click="unpublishWishlist">Unpublish</button>
            @endif
            <ul>
                @foreach ($wishlist->wishlistItems as $item)
                    <li>{{ $item->tier->charity->name }}: {{ $item->tier->name }}</li>
                @endforeach
            </ul>
        @endif
    </article>
</section>
