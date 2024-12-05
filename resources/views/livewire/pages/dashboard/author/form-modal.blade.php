<div>
    <x-form-modal maxWidth="2xl" :title="$formTitle" :subTitle="$formSubTitle" showModal="showModal" closeModal="closeModal">
        <form method="post" wire:submit="submitForm" enctype="multipart/form-data">
            <div>
                <div class="grid grid-cols-1 gap-4 my-5">
                    <div>
                        <x-input-label for="name" value="Name" required/>
                        <x-text-input :disabled="$disabledField" id="name" name="name" type="text" class="block w-full px-2 py-1 mt-1" autocomplete="name" wire:model="name"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="flex justify-center gap-3 mt-6">
                <x-primary-button>
                    Save
                </x-primary-button>
                <x-secondary-button type="button" wire:click="closeModal">
                    Cancel
                </x-secondary-button>
            </div>
        </form>
    </x-form-modal>
</div>
