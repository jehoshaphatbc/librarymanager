<?php

namespace App\Livewire\Pages\Dashboard\Category;

use App\Models\Category;
use App\Traits\Toasts\Toaster;
use Livewire\Component;

class DeleteModal extends Component
{
    use Toaster;

    public $title = '';

    public $message = '';

    public $category;

    public $showModal = false;

    protected function getListeners(): array
    {
        return [
            'deleteCategory' => 'openDelete',
        ];
    }

    public function render()
    {
        return view('livewire.pages.dashboard.category.delete-modal');
    }

    public function openDelete(Category $category): void
    {
        $this->category = $category;

        $this->title = 'Delete Category';
        $this->message = "Are you sure to delete this category {$this->category->name}? ";

        $this->showModal = true;
    }

    public function submit(): void
    {
        $this->category->delete();

        $this->dispatch('refreshCategories');

        $this->toast('success', 'Success Delete', "Successfully deleted {$this->category->name}!");

        $this->closeModal();
    }

    public function closeModal(): void
    {
        $this->category = null;
        $this->title = '';
        $this->message = '';
        $this->showModal = false;
    }
}
