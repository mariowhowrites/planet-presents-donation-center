<x-modal name="pledge-modal-{{ $charity->id }}" focusable>
    <section class="p-6">
        <div class="pb-6 grid grid-cols-1 gap-x-2">
            <div id="all-tiers" class="">
                <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                    {{ $charity->name }}</h3>
                <dl class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 lg:gap-x-8">
                    @foreach ($wishlist->getSelectedTiersByCharity($charity->id) as $tier)
                        <div class="border-t border-gray-200 pt-4">
                            <dt class="font-medium text-gray-900">{{ $tier->name }}</dt>
                            <dd class="mt-2 text-sm text-gray-500">{{ $tier->description }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
            <div class="pledge-form pt-8">
                <form wire:submit="createPledge()" class="flex flex-col gap-y-4">
                    {{-- <div class="mt-6 flex justify-end">
                        <x-input-label for="amount" value="{{ __('Amount') }}" class="sr-only" />
                        <x-text-input
                            wire:model="amount"
                            id="amount"
                            name="amount"
                            type="number"
                            class="mt-1 block w-3/4"
                            placeholder="{{ __('Amount') }}"
                        />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div> --}}
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
                        <x-input-label for="tier" value="{{ __('Tier') }}" />
                        <select wire:model.live="tier_id" id="tier"
                            class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option disabled>{{ __('Select a tier') }}</option>
                            @foreach ($wishlist->getSelectedTiersByCharity($charity->id) as $tier)
                                <option value="{{ $tier->id }}">{{ $tier->name }} -
                                    {{ $tier->humanReadableAmount() }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($this->shouldShowAmountInput())
                        <div class="flex flex-col gap-y-2">
                            <x-input-label for="amount" value="{{ __('Amount') }}" />
                            <x-text-input wire:model="amount" id="amount" name="amount" type="number"
                                class="mt-1 block w-3/4" placeholder="{{ __('Amount') }}" />
                        </div>
                    @endif

                    <x-primary-button class="mt-4">
                        {{ __('Pledge') }}
                    </x-primary-button>
                </form>
            </div>
    </section>
</x-modal>
