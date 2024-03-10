<div class="bg-white py-24 sm:py-32 grow">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            @if (!$this->canEditWishlist())
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    {{ $wishlist->name }}</h2>
            @else
                <div class="h-10" x-data="{}">
                    @if ($this->isEditingName)
                        <input wire:model="newName" type="text" id="newName" @keydown.enter="$wire.stopEditingName()"
                            @click.away="$wire.stopEditingName()" @blur="$wire.stopEditingName()">
                    @else
                        <h2 wire:click="startEditingName"
                            class="text-3xl pointer-cursor font-bold tracking-tight text-gray-900 sm:text-4xl">
                            {{ $wishlist->name }}</h2>
                    @endif
                    {{-- <form x-show="isEditingName" wire:submit="">
                        <input wire:model="newName" type="text" id="newName"
                            @keydown.enter="isEditingName = false; $wire.stopEditingName()"
                            @click.away="isEditingName = false; $wire.stopEditingName()"
                            @blur="isEditingName = false; $wire.stopEditingName()">
                    </form> --}}
                </div>
            @endif
            @if ($wishlist->wishlistItems->isEmpty())
                <p class="mt-2 text-lg leading-8 text-gray-600">{{ __('routes/wishlist-view.empty.before') }} <a
                        class="underline text-blue-600" href="{{ route('home') }}" wire:navigate>Charities</a>
                    {{ __('routes/wishlist-view.empty.after') }}</p>
            @else
                <div x-data="{}">
                    @if (!$this->canEditWishlist())

                        <p class="mt-2 text-lg leading-8 text-gray-600">{{ $wishlist->description }}</p>
                    @else
                        @if ($this->isEditingDescription)
                            <form x-show="isEditingDescription" wire:submit="">
                                <textarea wire:model="newDescription" @keydown.enter="$wire.stopEditingDescription()"
                                    @click.away="$wire.stopEditingDescription()" @blur="$wire.stopEditingDescription()" rows="5" cols="60"></textarea>
                            </form>
                        @else
                            <p wire:click="startEditingDescription" @click="isEditingDescription = true"
                                class="mt-2 text-lg leading-8 text-gray-600">{{ $wishlist->description }}</p>
                        @endif
                    @endif
                </div>
                @if ($this->canEditWishlist())
                    <p class="mt-1 leading-8 text-gray-600">Wishlist Status: {{ $wishlist->status->value }}</p>
                    <fieldset id="wishlist-controls" class="flex flex-col items-center gap-2">
                        @if ($wishlist->status == App\Enums\WishlistStatus::Private)
                            <x-secondary-button
                                wire:click="publishWishlist">{{ __('routes/wishlist-view.publish') }}</x-secondary-button>
                        @else
                            <x-secondary-button
                                wire:click="unpublishWishlist">{{ __('routes/wishlist-view.unpublish') }}</x-secondary-button>
                        @endif
                        {{-- <a href="/admin/my-wishlist">
                            <x-secondary-button>Edit Wishlist</x-secondary-button>
                        </a> --}}
                        @if ($wishlist->status == App\Enums\WishlistStatus::Public)
                            <x-secondary-button
                                x-on:click="navigator.clipboard.writeText('{{ route('wishlist.show', $wishlist->id) }}')">
                                {{ __('routes/wishlist-view.copy-wishlist-link') }}
                            </x-secondary-button>
                        @endif
                    </fieldset>
                @endif
            @endif
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
            {{-- Wishlist items --}}
            @foreach ($wishlist->getSelectedCharities() as $charity)
                <article class="">
                    <div class="relative w-full">
                        <img src="{{ asset($charity->preview_image) }}" alt=""
                            class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1]">
                        <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                    </div>
                    <h3 class="mt-10 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                        <a href="{{ route('charity.show', $charity->id) }}" class="relative">
                            <span class="absolute inset-0"></span>
                            {{ $charity->name }}
                        </a>
                    </h3>
                    <div class="max-w-xl flex-grow-1">
                        <div class="relative">
                            <p class="mt-5 text-sm leading-6 text-gray-600">
                                {{ $charity->description }}
                            </p>
                        </div>

                        <x-primary-button class="mt-4"
                            wire:click="$dispatch('open-modal', 'pledge-modal-{{ $charity->id }}')">{{ __('routes/wishlist-view.donate') }}</x-primary-button>

                        <livewire:pledge-modal :charity="$charity" :wishlist="$wishlist" />
                </article>
            @endforeach
        </div>
    </div>
</div>
