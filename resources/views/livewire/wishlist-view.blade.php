<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <h1>Your Wishlist</h1>

    @auth
        <ul>
            @foreach ($wishlist->wishlistItems as $item)
                <li>{{ $item->tier->charity->name}}: {{ $item->tier->name }}</li>
            @endforeach
        </ul>
    @endauth
</div>
