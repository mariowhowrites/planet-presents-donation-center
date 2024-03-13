<?php

use function Livewire\Volt\{state, on};
use App\Models\Wishlist;
use Illuminate\Support\Facades\Log;

state(['item_count' => fn() => Wishlist::current()->itemCount(), 'id' => fn() => Wishlist::current()->id]);

on([
    'wishlist-items-changed-{id}' => function ($item_count) {
        if ($item_count > $this->item_count) {
            $this->dispatch('wishlist-incremented-' . $this->id);
        }

        $this->item_count = $item_count;
    },
]);

?>

<div class="shrink-0 flex items-center transition" x-data="{ didIncrement: false }">
    <span
        x-on:wishlist-incremented-{{ $id }}.window="didIncrement = true; setTimeout(() => didIncrement = false, 2000)"
        :class="{ 'animate-hi-there': didIncrement }">
        <a href="{{ route('my-wishlist') }}"
            class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-500 cursor-pointer">
            <span class="text-sm font-medium leading-none">{{ Wishlist::current()->itemCount() }}</span>
        </a>
    </span>
</div>
