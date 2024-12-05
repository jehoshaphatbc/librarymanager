<?php

namespace App\Livewire\Pages\Dashboard\Author;

use App\Models\Author;
use App\Traits\Toasts\Toaster;
use Livewire\Component;

class DeleteModal extends Component
{
    use Toaster;

    public $title = '';

    public $message = '';

    public $author;

    public $showModal = false;

    protected function getListeners(): array
    {
        return [
            'deleteAuthor' => 'openDelete',
        ];
    }

    public function render()
    {
        return view('livewire.pages.dashboard.author.delete-modal');
    }

    public function openDelete(Author $author): void
    {
        $this->author = $author;

        $this->title = 'Delete Author';
        $this->message = "Are you sure to delete this author {$this->author->name}? ";

        $this->showModal = true;
    }

    public function submit(): void
    {
        $this->author->delete();

        $this->dispatch('refreshAuthors');

        $this->toast('success', 'Success Delete', "Successfully deleted {$this->author->name}!");

        $this->closeModal();
    }

    public function closeModal(): void
    {
        $this->author = null;
        $this->title = '';
        $this->message = '';
        $this->showModal = false;
    }
}
