<?php

use function Livewire\Volt\{state, on, mount, rules};

state(['wishlist'])->locked();

state([
    'name' => fn() => $this->wishlist->name,
    'description' => fn() => $this->wishlist->description,
]);

rules([
    'name' => ['required', 'string'],
    'description' => ['required', 'string'],
]);

$saveWishlistChanges = function () {
    $this->validate();

    $this->wishlist->update([
        'name' => $this->name,
        'description' => $this->description,
    ]);
};

?>


<form wire:submit="saveWishlistChanges" class="pt-12">
    <div class="space-y-12">
        <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Wishlist</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be
                    careful what you share.</p>
            </div>

            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                <div class="sm:col-span-4">
                    <label for="website" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <div @class([
                            'flex rounded-md shadow-sm ring-4 ring-inset focus-within:ring-2 focus-within:ring-inset sm:max-w-md ring-gray-300',
                            'focus-within:ring-indigo-600' => !$errors->has('name'),
                            'ring-red-400 focus-within:ring-red-600' => $errors->has('name'),
                        ])>
                            <input type="text" name="name" id="name" wire:model="name"
                                class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 bg-white">
                        </div>
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600" id="email-error">
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                    <div class="mt-2">
                        <textarea id="description" name="description" rows="3" wire:model="description" @class([
                            'px-3 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6',
                            'ring-gray-300 focus:ring-indigo-600' => !$errors->has('description'),
                            'ring-red-400 focus:ring-red-600' => $errors->has('description'),
                        ])></textarea>
                    </div>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600" id="email-error">
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6 md:col-span-3">
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </div>
    </div>

</form>
