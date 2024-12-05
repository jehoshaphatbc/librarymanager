<?php

namespace App\Livewire\Pages\Dashboard\Author;

use App\Models\Author;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    #[Url]
    public $page = 1;

    #[Url]
    public $pagination = 10;

    public $sortBy = 'name';

    public $sortDirection = 'asc';

    public function getListeners(): array
    {
        return [
            'refreshAuthors' => '$refresh',
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
        return view('livewire.pages.dashboard.author.index', [
            'authors' => $this->getAuthors(),
        ])->layout('layouts.app', ['title' => 'Author']);
    }

    public function getAuthors()
    {
        return Author::when($this->search, function ($q, $search) {
            $q->where('name', 'like', '%'.$this->search.'%');
        })->orderBy($this->sortBy, $this->sortDirection)->paginate($this->pagination);
    }
}
