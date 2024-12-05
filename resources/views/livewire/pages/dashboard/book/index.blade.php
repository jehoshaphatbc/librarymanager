<div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 lg:p-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold text-gray-900">Books</h1>
                        <p class="mt-2 text-sm text-gray-700">A list of all the book in your account including their name, title, email and role.</p>
                        </div>
                        <div class="gap-2 mt-4 sm:ml-16 sm:mt-0 sm:flex">
                            <x-text-input autocomplete="search" wire:model.live.debounce.300ms="search"/>
                            <button wire:click="$dispatch('addBook')" type="button" class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add book</button>
                        </div>
                    </div>
                    <div class="flow-root mt-8">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-3 pl-4 pr-3 text-xs font-medium tracking-wide text-left text-gray-500 uppercase sm:pl-0">Name</th>
                                            <th scope="col" class="py-3 pl-4 pr-3 text-xs font-medium tracking-wide text-left text-gray-500 uppercase sm:pl-0">Category</th>
                                            <th scope="col" class="py-3 pl-4 pr-3 text-xs font-medium tracking-wide text-left text-gray-500 uppercase sm:pl-0">Book</th>
                                            <th scope="col" class="py-3 pl-4 pr-3 text-xs font-medium tracking-wide text-left text-gray-500 uppercase sm:pl-0">Year</th>
                                            <th scope="col" class="relative py-3 pl-3 pr-4 sm:pr-0">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($books as $book)
                                            <tr>
                                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-0">{{ $book->title }}</td>
                                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-0">{{ $book->category?->name }}</td>
                                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-0">{{ $book->author?->name }}</td>
                                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-0">{{ $book->year }}</td>
                                                <td class="relative py-4 pl-3 pr-4 space-x-2 text-sm font-medium text-right whitespace-nowrap sm:pr-0">
                                                    <button type="button" wire:click="$dispatch('editBook', {book: '{{ $book->id }}'})" class="text-gray-600 hover:text-gray-900">Edit</button>
                                                    <button type="button" wire:click="$dispatch('deleteBook', {book: '{{ $book->id }}'})" class="text-red-600 hover:text-red-900">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-5">
                                    {{ $books->links('vendor.livewire.tailwind') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:pages.dashboard.book.form-modal />
    <livewire:pages.dashboard.book.delete-modal />
</div>
