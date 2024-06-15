@script
    <script>
        $wire.on('pledge-created', () => {
            window.open("{{ $charity->donation_url }}", "_blank")
        });
    </script>
@endscript

<x-modal name="pledge-modal-{{ $charity->id }}" focusable>
    <section class="p-6">
        <div class="pb-6 grid grid-cols-1 gap-x-2">
            <div class="pledge-form">
                <form wire:submit="createPledge()" class="flex flex-col gap-y-4">
                    <div class="flex flex-col gap-y-2">
                        <x-input-label for="name" value="{{ __('Name') }}" />
                        <x-text-input wire:model="name" id="name" name="name" type="text"
                            class="mt-1 block w-3/4" placeholder="{{ __('Name') }}" />
                        @error('name')
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        @enderror
                    </div>
                    <div class="flex flex-col gap-y-2">
                        <x-input-label for="message" value="{{ __('Message') }}" />
                        <textarea wire:model="message" id="message"
                            class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            placeholder="Write a message to the wishlist creator..."></textarea>
                        @error('message')
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        @enderror
                    </div>
                    <div class="flex flex-col gap-y-2">
                        <fieldset class="flex flex-col">
                            <legend class="block text-sm font-medium text-gray-700">Donation Tiers</legend>

                            <section class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2 cursor-pointer">
                                @foreach ($wishlist->getWishlistItemsByCharity($charity->id) as $item)
                                    <!-- Active: "ring-2 ring-indigo-500" -->
                                    <div @class([
                                        'relative block cursor-pointer rounded-lg bg-slate-100 transition border border-gray-300 p-4 focus:outline-none',
                                        'ring-2 ring-indigo-500' => $item_id == $item->id,
                                        'shadow-sm hover:shadow-xl' => !$item_id == $item->id,
                                    ]) wire:click="selectTier({{ $item->id }})">
                                        <input type="radio" name="tier" value="{{ $item->id }}" class="sr-only"
                                            aria-labelledby="item-choice-{{ $item->id }}-label"
                                            aria-describedby="item-choice-{{ $item->id }}-description">
                                        <div class="flex justify-between">
                                            <p id="item-choice-{{ $item->id }}-label" class="text-base font-medium text-gray-900">
                                                {{ $item->tier->name }}</p>
                                            <span class="text-xs" wire:loading.delay
                                                wire:target="selectTier({{ $item->id }})">Updating your
                                                wishlist...</span>
                                        </div>
                                        <p id="item-choice-{{ $item->id }}-description" class="mt-1 text-sm text-gray-500">
                                            {{ $item->tier->description }}</p>
                                        <!--
                          Active: "border", Not Active: "border-2"
                          Checked: "border-indigo-500", Not Checked: "border-transparent"
                        -->
                                        <div @class([
                                            'pointer-events-none absolute -inset-px rounded-lg active:border border-2',
                                            'border-indigo-500' => $item_id == $item->id,
                                        ]) aria-hidden="true"></div>
                                    </div>
                                @endforeach
                            </section>
                        </fieldset>
                    </div>

                    @if ($this->shouldShowAmountInput())
                        <div class="flex flex-col gap-y-2">
                            <x-input-label for="amount" value="{{ __('Amount') }}" />
                            <x-text-input wire:model="amount" id="amount" name="amount" type="number"
                                class="mt-1 block w-3/4" placeholder="{{ __('Amount') }}" />
                            @error('amount')
                                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                            @enderror
                        </div>
                    @endif

                    <p>When you click "Pledge" below, your message will be sent to the wishlist creator, and you will be
                        redirected to {{ $charity->name }}'s donation page.</p>
                    <x-primary-button class="mt-4">
                        {{ __('Pledge') }}
                    </x-primary-button>
                </form>
            </div>
    </section>
</x-modal>
