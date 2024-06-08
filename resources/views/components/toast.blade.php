<?php

use function Livewire\Volt\{state, computed, on};

state(['show' => false, 'message' => '', 'type' => 'success', 'closeButton' => true]);

$wrapperStyles = computed(function () {
    return ['fixed bottom-0 right-0 rounded-md p-4 mr-4 mb-4', 'bg-green-50' => $this->type === 'success', 'bg-red-50' => $this->type === 'error'];
});

$close = function () {
    $this->show = false;
};

on(['show-toast' => function ($message, $type = 'success', $closeButton = true) {
    $this->message = $message;
    $this->type = $type;
    $this->closeButton = $closeButton;
    $this->show = true;
}]);

?>

<div @class($this->wrapperStyles) style="display: {{ $this->show ? 'block' : 'none' }}">
    <div class="flex">
        <div class="flex-shrink-0">
            @switch($this->type)
                @case('success')
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clip-rule="evenodd" />
                    </svg>
                @break

                @case('error')
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                            clip-rule="evenodd" />
                    </svg>
                @break
            @endswitch
        </div>
        <div class="ml-3">
            <p @class([
                'text-sm font-medium',
                'text-green-800' => $this->type === 'success',
                'text-red-800' => $this->type === 'error',
            ])>{{ $this->message }}</p>
        </div>
        @if($this->closeButton)
        <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
                <button type="button" wire:click="close()" @class([
                    'inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2',
                    'bg-green-50 text-green-500 hover:bg-green-100 focus:ring-offset-green-50 focus:ring-green-600' =>
                        $this->type === 'success',
                    'bg-red-50 text-red-500 hover:bg-red-100 focus:ring-offset-red-50 focus:ring-red-600' =>
                        $this->type === 'error',
                ])>
                    <span class="sr-only">Dismiss</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path
                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </button>
            </div>
        </div>
        @endif
    </div>
</div>
