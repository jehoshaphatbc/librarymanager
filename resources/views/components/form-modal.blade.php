@props([
    'maxWidth' => 'sm',
    'title' => '',
    'subTitle' => '',
    'showModal' => 'showModal',
    'closeModal' => 'closeModal',
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    '4xl' => 'sm:max-w-4xl',
    '6xl' => 'sm:max-w-6xl',
    '7xl' => 'sm:max-w-7xl',
    'full' => 'sm:max-w-full',
][$maxWidth];
@endphp

<div x-data="{ showModal: @entangle("$showModal").live }">

    {{-- Modal Add --}}
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div x-show="showModal" class="flex items-center justify-center min-h-screen px-4 py-4 pb-20 text-center lg:block lg:p-0 md:p-10">

            <div
                x-show="showModal"
                class="fixed inset-0 transition-all transform"
                wire:click="{{ $closeModal }}"
                x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="showModal"
                {{ $attributes->twMerge(['class' => "inline-block px-6 py-16 overflow-visible text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:w-full sm:p-16 $maxWidth"]) }}

                x-transition:enter="transition-scale ease-out duration-150"
                x-transition:enter-start="scale-0"
                x-transition:enter-end="scale-100"
                x-transition:leave="transition-scale ease-in duration-150"
                x-transition:leave-start="scale-100"
                x-transition:leave-end="scale-0">
                <div class="h-0 text-end">
                    <button
                        wire:click="{{ $closeModal }}"
                        type="button"
                        class="box-content p-1 transition-all ease-out translate-x-8 -translate-y-20 bg-white border-none rounded-md shadow-lg hover:scale-110 lg:-translate-y-20 lg:translate-x-20 md:-translate-y-20 md:translate-x-20"
                        data-te-modal-dismiss
                        aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>

                    </button>
                </div>
                <div class="mb-6">
                    <div class="mb-2 text-2xl font-bold text-center">{{ $title }}</div>
                    <div class="font-semibold text-center text-gray-400 text-md">{{ $subTitle }}</div>
                </div>

                {{ $slot }}
            </div>

        </div>
    </div>

</div>
