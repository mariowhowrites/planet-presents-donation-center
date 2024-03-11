<x-filament-panels::page>

    {{-- <x-filament::badge>
        wow!
    </x-filament::badge>
    <x-filament::badge color="danger">
        wow!
    </x-filament::badge>
    <x-filament::badge color="gray">
        wow!
    </x-filament::badge>
    <x-filament::badge color="info">
        wow!
    </x-filament::badge>
    <x-filament::badge color="success">
        wow!
    </x-filament::badge>
    <x-filament::badge color="warning">
        wow!
    </x-filament::badge>

    <x-filament::section>

        <x-filament::dropdown>
            <x-slot name="trigger">
                <x-filament::button>
                    More actions
                </x-filament::button>
            </x-slot>

            <x-filament::dropdown.list>
                <x-filament::dropdown.list.item>
                    View
                </x-filament::dropdown.list.item>
                <x-filament::dropdown.list.item>
                    Edit
                </x-filament::dropdown.list.item>
            </x-filament::dropdown.list>
        </x-filament::dropdown>


    </x-filament::section>

    <x-filament::icon-button icon="heroicon-m-plus" wire:click="openNewUserModal" label="New label" color="info" />

    <x-filament::input.wrapper prefix-icon="heroicon-m-globe-alt">
        <x-filament::input type="text" />
    </x-filament::input.wrapper>

    <x-filament::input.wrapper>
        <x-filament::input.select>
            <option value="draft">Draft</option>
            <option value="reviewing">Reviewing</option>
            <option value="published">Published</option>
        </x-filament::input.select>
    </x-filament::input.wrapper>

    <x-filament::tabs label="Content tabs">
        <x-filament::tabs.item>
            Tab 1
        </x-filament::tabs.item>

        <x-filament::tabs.item>
            Tab 2
        </x-filament::tabs.item>

        <x-filament::tabs.item>
            Tab 2
        </x-filament::tabs.item>
    </x-filament::tabs> --}}

    <x-filament::section>
        <x-slot name="heading">
            Edit Wishlist
        </x-slot>

        <x-filament-panels::form wire:submit="save">
            {{ $this->form }}

            <x-filament-panels::form.actions :actions="$this->getFormActions()" />
        </x-filament-panels::form>
    </x-filament::section>
</x-filament-panels::page>
