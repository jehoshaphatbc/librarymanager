<?php

namespace App\Livewire\Pages\Dashboard\Author;

use App\Models\Author;
use App\Traits\Toasts\Toaster;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;

class FormModal extends Component
{
    use Toaster;

    public $author;

    public $showModal = false;

    public $formType = 'add';

    public $formTitle = 'Add a Author';

    public $formSubTitle = 'Create new author as per your requirements.';

    public $disabledField = false;

    #[Rule('required')]
    public $name;

    public function getListeners(): array
    {
        return [
            'addAuthor' => 'openAdd',
            'editAuthor' => 'openEdit',
        ];
    }

    public function render()
    {
        return view('livewire.pages.dashboard.author.form-modal');
    }

    public function openAdd()
    {
        $this->formType = 'add';
        $this->formTitle = 'Add a Author';
        $this->formSubTitle = 'Create new author as per your requirements.';
        $this->showModal = true;
        $this->disabledField = false;
    }

    public function openEdit(Author $author)
    {
        $this->formType = 'edit';
        $this->showModal = true;
        $this->formTitle = 'Edit a Author';
        $this->formSubTitle = 'Update author as per your requirements.';
        $this->disabledField = false;

        $this->fillFormModal($author);
    }

    public function fillFormModal($author)
    {
        $this->author = $author;
        $this->name = $author->name;
    }

    public function data(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    public function submitForm()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            if ($this->formType == 'add') {
                $this->author = Author::create($this->data());
            } else {
                $this->author->update($this->data());
            }

            DB::commit();

            $this->dispatch('refreshAuthors');

            $title = $this->formType == 'edit' ? 'Author Edited' : 'Author Added';
            $message = $this->formType = 'edit' ? 'Author data successfully updated' : 'Author data successfully saved';

            $this->toast('success', $title, $message);

            $this->closeModal();

        } catch (Exception $e) {
            DB::rollback();

            $this->toast('error', 'Gagal', $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->author = null;
        $this->resetErrorBag();
    }
}
