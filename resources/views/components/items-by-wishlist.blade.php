<?php

use function Livewire\Volt\{mount, state, computed};
use App\Models\Wishlist;
use App\Models\WishlistItem;

state('items');

mount(function () {
    $this->items = WishlistItem::where('wishlist_id', Wishlist::current()->id)->get();
});

?>

<div class="">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Wishlist Items</h1>
            <p class="mt-2 text-sm text-gray-700">These are the items in your wishlist!</p>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Description
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Charity</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($this->items as $item)
                                <tr wire:key="wishlist-item-{{ $item->id }}">
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ $item->tier->description }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $item->tier->name }}</td>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $item->tier->charity->name }}</td>
                                    {{-- <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span
                                                class="sr-only">, {{ $pledge->name }}</span></a>
                                    </td> --}}
                                </tr>
                            @endforeach

                            <!-- More people... -->
                            {{-- <tr>
                                <td
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-bold text-gray-900 sm:pl-6">
                                    Summary</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="font-bold">Total Amount Pledged</div>
                                    <div>${{ $this->total }}</div>
                                </td>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                </td>
                                <td
                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span
                                            class="sr-only">, {{ $pledge->name }}</span></a>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
