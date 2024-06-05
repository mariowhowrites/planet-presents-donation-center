<?php

use App\Models\{Pledge, Wishlist};
use function Livewire\Volt\{state, with};

state(['wishlist'])->locked();

with(function () {
    return [
        'total_pledge_count' => Pledge::countByWishlist($this->wishlist),
        'pledges_this_week' => Pledge::countByWishlistThisWeek($this->wishlist),
        'total_pledged' => Pledge::totalPledgedByWishlist($this->wishlist),
        'most_recent_pledge' => Pledge::mostRecentByWishlist($this->wishlist),
    ];
});

?>
<div>
    <div class="border-b border-b-gray-900/10 lg:border-t lg:border-t-gray-900/5">
        <dl class="mx-auto grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 lg:px-2 xl:px-0">
            <div
                class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8">
                <dt class="text-sm font-medium leading-6 text-gray-500">Total Pledges</dt>
                {{-- <dd class="text-xs font-medium text-gray-700">+0.00</dd> --}}
                <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
                    {{ $total_pledge_count }}</dd>
            </div>
            <div
                class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8 sm:border-l">
                <dt class="text-sm font-medium leading-6 text-gray-500">Pledges This Week</dt>
                {{-- <dd class="text-xs font-medium text-rose-600">+10.18%</dd> --}}
                <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
                    {{ $pledges_this_week }}
                </dd>
            </div>
            <div
                class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8 sm:border-l">
                <dt class="text-sm font-medium leading-6 text-gray-500">Total Amount Pledged</dt>
                {{-- <dd class="text-xs font-medium text-rose-600">+54.02%</dd> --}}
                <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
                    ${{ $total_pledged }}</dd>
            </div>
            <div
                class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8 lg:border-l">
                <dt class="text-sm font-medium leading-6 text-gray-500">Most Recent Pledge</dt>
                {{-- <dd class="text-xs font-medium text-gray-700">-1.39%</dd> --}}
                <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
                    ${{ $most_recent_pledge ? $most_recent_pledge->amount : '0 (yet)' }}</dd>
            </div>
        </dl>
    </div>
</div>
