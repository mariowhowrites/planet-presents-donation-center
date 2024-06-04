<?php

use App\Models\{Pledge, Wishlist};
use function Livewire\Volt\{state, with};

state(['wishlist'])->locked();

with(function () {
    return [
        'pledge_count' => Pledge::countByWishlist($this->wishlist),
        'total_pledged' => Pledge::totalPledgedByWishlist($this->wishlist),
        'most_recent_pledge' => Pledge::mostRecentByWishlist($this->wishlist),
    ];
});

?>

<div class="border-b border-gray-900/10 pb-12">
    <h3 class="text-base font-semibold leading-6 text-gray-900">Statistics</h3>
    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Total Pledges</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $pledge_count }}</dd>
        </div>
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Total Amount Pledged</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">${{ $total_pledged }}</dd>
        </div>
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Most Recent Pledge</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">${{ $most_recent_pledge->amount }}</dd>
        </div>
    </dl>
</div>
