<x-filament-panels::page>
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
