<x-modal name="pledge-modal-{{ $charity->id }}" focusable>
    <section class="p-6">
        <div class="pb-6 grid grid-cols-1 gap-x-2">
            <div class="pledge-form">
                <form wire:submit="createPledge()" class="flex flex-col gap-y-4">
                    <div class="flex flex-col gap-y-2">
                        <x-input-label for="name" value="{{ __('Name') }}" />
                        <x-text-input wire:model="name" id="name" name="name" type="text"
                            class="mt-1 block w-3/4" placeholder="{{ __('Name') }}" />
                    </div>
                    <div class="flex flex-col gap-y-2">
                        <x-input-label for="message" value="{{ __('Message') }}" />
                        <textarea wire:model="message" id="message"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Write a message to the wishlist creator..."></textarea>
                    </div>
                    <div class="flex flex-col gap-y-2">
                        <fieldset class="flex flex-col">
                            <legend class="block text-sm font-medium text-gray-700">Donation Tiers</legend>
            
                            <section class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2 cursor-pointer">
                                @foreach ($wishlist->getSelectedTiersByCharity($charity->id) as $tier)
                                    <!-- Active: "ring-2 ring-indigo-500" -->
                                    <div @class([
                                        'relative block cursor-pointer rounded-lg bg-slate-100 transition border border-gray-300 p-4 focus:outline-none',
                                        'ring-2 ring-indigo-500' => $tier_id == $tier->id,
                                        'shadow-sm hover:shadow-xl' => !$tier_id == $tier->id,
                                    ]) wire:click="selectTier({{ $tier->id }})">
                                        <input type="radio" name="tier" value="{{ $tier->id }}" class="sr-only"
                                            aria-labelledby="size-choice-0-label" aria-describedby="size-choice-0-description">
                                        <div class="flex justify-between">
                                            <p id="size-choice-0-label" class="text-base font-medium text-gray-900">
                                                {{ $tier->name }}</p>
                                            <span class="text-xs" wire:loading.delay
                                                wire:target="selectTier({{ $tier->id }})">Updating your
                                                wishlist...</span>
                                        </div>
                                        <p id="size-choice-0-description" class="mt-1 text-sm text-gray-500">
                                            {{ $tier->description }}</p>
                                        <!--
                          Active: "border", Not Active: "border-2"
                          Checked: "border-indigo-500", Not Checked: "border-transparent"
                        -->
                                        <div @class([
                                            'pointer-events-none absolute -inset-px rounded-lg active:border border-2',
                                            'border-indigo-500' => $tier_id == $tier->id,
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
                        </div>
                    @endif

                    <p>When you click "Pledge" below, your message will be sent to the wishlist creator, and you will be redirected to {{ $charity->name}}'s donation page.</p>
                    <x-primary-button class="mt-4">
                        {{ __('Pledge') }}
                    </x-primary-button>
                </form>
            </div>
    </section>
</x-modal>
