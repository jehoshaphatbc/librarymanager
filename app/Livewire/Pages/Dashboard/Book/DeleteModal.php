<?php

namespace App\Livewire\Pages\Dashboard\Book;

use App\Models\Book;
use App\Traits\Toasts\Toaster;
use Livewire\Component;

class DeleteModal extends Component
{
    use Toaster;

    public $title = '';

    public $message = '';

    public $book;

    public $showModal = false;

    protected function getListeners(): array
    {
        return [
            'deleteBook' => 'openDelete',
        ];
    }

    public function render()
    {
        return view('livewire.pages.dashboard.book.delete-modal');
    }

    public function openDelete(Book $book): void
    {
        $this->book = $book;

        $this->title = 'Delete Book';
        $this->message = "Are you sure to delete this book {$this->book->title}? ";

        $this->showModal = true;
    }

    public function submit(): void
    {
        $this->book->delete();

        $this->dispatch('refreshBooks');

        $this->toast('success', 'Success Delete', "Successfully deleted {$this->book->title}!");

        $this->closeModal();
    }

    public function closeModal(): void
    {
        $this->book = null;
        $this->title = '';
        $this->message = '';
        $this->showModal = false;
    }
}
