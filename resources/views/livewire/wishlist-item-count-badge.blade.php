<?php

use function Livewire\Volt\{state, on, mount};
use App\Models\Wishlist;
use Illuminate\Support\Facades\Log;

// state(['item_count' => fn() => Wishlist::current()->itemCount(), 'id' => fn() => Wishlist::current()->id]);

state(['count']);

mount(function (Wishlist $wishlist) {
    $this->count = $wishlist->item_count;
});

on([
    'wishlist-items-changed' => function ($count) {
        $this->count = $count;
    },
]);

?>

<div id="wishlist-item-count-badge" class="shrink-0 flex items-center transition" x-data="{ didIncrement: false, animationTimeout: null }">
    <span
        x-on:wishlist-items-changed.window="clearTimeout(animationTimeout); didIncrement = true; animationTimeout = setTimeout(() => didIncrement = false, 2000)"
        :class="{ 'animate-hi-there': didIncrement }">
        <a href="{{ route('my-wishlist') }}"
            class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-500 cursor-pointer"
            wire:navigate>
            <span class="text-sm font-medium leading-none">{{ $this->count }}</span>
        </a>
    </span>
</div>
