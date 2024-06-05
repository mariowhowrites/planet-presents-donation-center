<?php

use function Livewire\Volt\{mount, state, computed, with, usesPagination};
use App\Models\Pledge;
use App\Models\Wishlist;

usesPagination();

with(
    fn() => [
        'pledges' => Pledge::where('wishlist_id', Wishlist::current()->id)->paginate(20),
    ],
);

?>

{{-- <div class="pt-12">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Pledges</h1>
            <p class="mt-2 text-sm text-gray-700">These are the pledges to your wishlist!</p>
        </div>
    </div>
    <div class="mt-8 flow-root pb-12 border-b border-gray-900/10">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Charity</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Amount</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Message</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Date</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($pledges as $pledge)
                                <tr wire:key="pledge-{{ $pledge->id }}">
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ $pledge->name }}</td>
                                    <td
                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $pledge->tier->charity->name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        ${{ $pledge->amount }}</td>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $pledge->message }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $pledge->created_at }}</td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span
                                                class="sr-only">, {{ $pledge->name }}</span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pledges->links() }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="space-y-16 py-16 xl:space-y-20">
    <!-- Recent pledges table -->
    <div>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="mx-auto max-w-2xl text-base font-semibold leading-6 text-gray-900 lg:mx-0 lg:max-w-none">Recent
                pledges</h2>
        </div>
        <div class="mt-6 overflow-hidden border-t border-gray-100">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
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
                                                    <div class="text-sm font-medium leading-6 text-gray-900">${{ $pledge->amount }}
                                                        USD</div>
                                                </div>
                                                <div class="mt-1 text-xs leading-5 text-gray-500">{{ $pledge->tier->charity->name }}</div>
                                            </div>
                                        </div>
                                        <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100"></div>
                                        <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100"></div>
                                    </td>
                                    <td class="hidden py-5 pr-6 sm:table-cell">
                                        <div class="text-sm leading-6 text-gray-900">{{ $pledge->created_at->toDayDateTimeString() }}</div>
                                        <div class="mt-1 text-xs leading-5 text-gray-500">{{ $pledge->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="py-5 text-right">
                                        <div class="flex justify-end">
                                            <div href="#"
                                                class="text-sm font-medium leading-6">{{ $pledge->name }}</div>
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
