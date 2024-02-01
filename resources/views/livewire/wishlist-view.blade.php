<section class="flex flex-col items-center gap-4 font-sans py-7 w-3/5 mx-auto">
    <h1 class="text-4xl my-8">Your Wishlist</h1>
    <article class="">
        <ul>
            @foreach ($wishlist->wishlistItems as $item)
                <li>{{ $item->tier->charity->name}}: {{ $item->tier->name }}</li>
            @endforeach
        </ul>
    </article>
</section>
