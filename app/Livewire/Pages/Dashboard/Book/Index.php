<?php

namespace App\Livewire\Pages\Dashboard\Book;

use App\Models\Book;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    #[Url]
    public $page = 1;

    #[Url]
    public $pagination = 10;

    public $sortBy = 'title';

    public $sortDirection = 'asc';

    public function getListeners(): array
    {
        return [
            'refreshBooks' => '$refresh',
        ];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPagination()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.pages.dashboard.book.index', [
            'books' => $this->getBooks()
        ])->layout('layouts.app', ['title' => 'Book']);
    }

    public function getBooks()
    {
        return Book::when($this->search, function ($q, $search) {
            $q->where('title', 'like', '%'.$this->search.'%');
        })->orderBy($this->sortBy, $this->sortDirection)->paginate($this->pagination);
    }
}
