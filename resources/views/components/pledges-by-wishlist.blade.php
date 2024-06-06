<?php

use function Livewire\Volt\{mount, state, computed, with, usesPagination};
use App\Models\Pledge;
use App\Models\Wishlist;

usesPagination();

with(
    fn() => [
        'pledges' => Pledge::byWishlist(Wishlist::current())->paginate(20),
    ],
);

?>

<div class="space-y-16 py-16 xl:space-y-20">
    <!-- Recent pledges table -->
    <div>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-0">
            <h2 class="mx-auto max-w-2xl text-base font-semibold leading-6 text-gray-900 lg:mx-0 lg:max-w-none">Recent
                pledges</h2>
        </div>
        <div class="mt-6 overflow-hidden border-t border-gray-100">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-0">
                <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                    <table class="w-full text-left">
                        <thead class="sr-only">
                            <tr>
                                <th>Amount</th>
                                <th class="hidden sm:table-cell">Date</th>
                                <th>Name & Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pledges as $pledge)
                                <tr wire:key="pledge-{{ $pledge->id }}">
                                    <td class="relative py-5 pr-6">
                                        <div class="flex gap-x-6">
                                            <div class="flex-auto">
                                                <div class="flex items-start gap-x-3">
                                                    <div class="text-sm font-medium leading-6 text-gray-900">
                                                        ${{ $pledge->amount }}
                                                        USD</div>
                                                </div>
                                                <div class="mt-1 text-xs leading-5 text-gray-500">
                                                    {{ $pledge->wishlistItem->tier->charity->name }}</div>
                                            </div>
                                        </div>
                                        <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100"></div>
                                        <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100"></div>
                                    </td>
                                    <td class="hidden py-5 pr-6 sm:table-cell">
                                        <div class="text-sm leading-6 text-gray-900">
                                            {{ $pledge->created_at->toDayDateTimeString() }}</div>
                                        <div class="mt-1 text-xs leading-5 text-gray-500">
                                            {{ $pledge->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="py-5 text-right">
                                        <div class="flex justify-end">
                                            <div href="#" class="text-sm font-medium leading-6">
                                                {{ $pledge->name }}</div>
                                        </div>
                                        <div class="mt-1 text-xs leading-5 text-gray-500">{{ $pledge->message }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
