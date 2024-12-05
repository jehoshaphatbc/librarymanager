<div>
    <x-form-modal maxWidth="2xl" :title="$formTitle" :subTitle="$formSubTitle" showModal="showModal" closeModal="closeModal">
        <form method="post" wire:submit="submitForm" enctype="multipart/form-data">
            <div>
                <div class="grid grid-cols-1 gap-4 my-5">
                    <div>
                        <x-input-label for="title" value="Title" required/>
                        <x-text-input :disabled="$disabledField" id="title" name="title" type="text" class="block w-full px-2 py-1 mt-1" autocomplete="title" wire:model="title"/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="categoryId" value="Category" required/>
                        <select :disabled="$disabledField" id="categoryId" class="block w-full px-2 py-1 mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            wire:model.defer="categoryId">
                            @if ($formType == 'add')
                                <option value="" class="capitalize">Choose category</option>
                            @else
                                <option value="" class="hidden capitalize">Choose category</option>
                            @endif
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('categoryId')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="authorId" value="Author" required/>
                        <select :disabled="$disabledField" id="authorId" class="block w-full px-2 py-1 mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            wire:model.defer="authorId">
                            @if ($formType == 'add')
                                <option value="" class="capitalize">Choose author</option>
                            @else
                                <option value="" class="hidden capitalize">Choose author</option>
                            @endif
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('authorId')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="year" value="Year" required/>
                        <x-text-input :disabled="$disabledField" id="year" name="year" type="number" min="0" max="2099" class="block w-full px-2 py-1 mt-1" autocomplete="year" wire:model="year"/>
                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
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
