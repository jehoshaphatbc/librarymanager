<?php

namespace App\Livewire\Pages\Dashboard\Category;

use App\Models\Category;
use App\Traits\Toasts\Toaster;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;

class FormModal extends Component
{
    use Toaster;

    public $category;

    public $showModal = false;

    public $formType = 'add';

    public $formTitle = 'Add a Category';

    public $formSubTitle = 'Create new category as per your requirements.';

    public $disabledField = false;

    #[Rule('required')]
    public $name;

    public function getListeners(): array
    {
        return [
            'addCategory' => 'openAdd',
            'editCategory' => 'openEdit',
        ];
    }

    public function render()
    {
        return view('livewire.pages.dashboard.category.form-modal');
    }

    public function openAdd()
    {
        $this->formType = 'add';
        $this->formTitle = 'Add a Category';
        $this->formSubTitle = 'Create new category as per your requirements.';
        $this->showModal = true;
        $this->disabledField = false;
    }

    public function openEdit(Category $category)
    {
        $this->formType = 'edit';
        $this->showModal = true;
        $this->formTitle = 'Edit a Category';
        $this->formSubTitle = 'Update category as per your requirements.';
        $this->disabledField = false;

        $this->fillFormModal($category);
    }

    public function fillFormModal($category)
    {
        $this->category = $category;
        $this->name = $category->name;
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
                $this->category = Category::create($this->data());
            } else {
                $this->category->update($this->data());
            }

            DB::commit();

            $this->dispatch('refreshCategories');

            $title = $this->formType == 'edit' ? 'Category Edited' : 'Category Added';
            $message = $this->formType = 'edit' ? 'Category data successfully updated' : 'Category data successfully saved';

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
        $this->category = null;
        $this->resetErrorBag();
    }
}
