<?php

namespace App\Livewire\Pages\Dashboard\Book;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Traits\Toasts\Toaster;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;

class FormModal extends Component
{
    use Toaster;

    public $book;

    public $showModal = false;

    public $formType = 'add';

    public $formTitle = 'Add a Book';

    public $formSubTitle = 'Create new book as per your requirements.';

    public $disabledField = false;

    #[Rule('required')]
    public $title;

    #[Rule('required')]
    public $year;

    #[Rule('required')]
    public $categoryId;

    #[Rule('required')]
    public $authorId;

    public function getListeners(): array
    {
        return [
            'addBook' => 'openAdd',
            'editBook' => 'openEdit',
        ];
    }

    public function render()
    {
        return view('livewire.pages.dashboard.book.form-modal', [
            'categories' => $this->getCategories(),
            'authors' => $this->getAuthors(),
        ]);
    }

    public function getCategories()
    {
        return Category::get();
    }

    public function getAuthors()
    {
        return Author::get();
    }

    public function openAdd()
    {
        $this->formType = 'add';
        $this->formTitle = 'Add a Book';
        $this->formSubTitle = 'Create new book as per your requirements.';
        $this->showModal = true;
        $this->disabledField = false;
    }

    public function openEdit(Book $book)
    {
        $this->formType = 'edit';
        $this->showModal = true;
        $this->formTitle = 'Edit a Book';
        $this->formSubTitle = 'Update book as per your requirements.';
        $this->disabledField = false;

        $this->fillFormModal($book);
    }

    public function fillFormModal($book)
    {
        $this->book = $book;
        $this->title = $book->title;
        $this->categoryId = $book->category_id;
        $this->authorId = $book->author_id;
        $this->year = $book->year;
    }

    public function data(): array
    {
        return [
            'title' => $this->title,
            'category_id' => $this->categoryId,
            'author_id' => $this->authorId,
            'year' => $this->year,
        ];
    }

    public function submitForm()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            if ($this->formType == 'add') {
                $this->book = Book::create($this->data());
            } else {
                $this->book->update($this->data());
            }

            DB::commit();

            $this->dispatch('refreshBooks');

            $title = $this->formType == 'edit' ? 'Book Edited' : 'Book Added';
            $message = $this->formType = 'edit' ? 'Book data successfully updated' : 'Book data successfully saved';

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
        $this->title = '';
        $this->year = '';
        $this->categoryId = '';
        $this->authorId = '';
        $this->book = null;
        $this->resetErrorBag();
    }
}
