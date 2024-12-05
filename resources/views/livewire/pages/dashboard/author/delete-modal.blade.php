<div>
    <x-form-modal maxWidth="2xl" showModal="showModal" closeModal="closeModal">
        <form method="post" wire:submit.prevent="submit" enctype="multipart/form-data">
            <div class="-mt-10 sm:flex sm:items-start">
                <div
                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto rounded-full bg-yellow-50 sm:mx-0 sm:h-10 sm:w-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-yellow-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>

                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium leading-6 text-dark-grey" id="modal-title">
                        {{ $title }}
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray">
                            {{ $message }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center gap-3 pt-5 -mb-3">
                <x-primary-button type="submit"> Yes sure! </x-primary-button>
                <x-secondary-button type="button" wire:click="closeModal"> Cancel </x-secondary-button>
            </div>
        </form>
    </x-form-modal>
</div>
