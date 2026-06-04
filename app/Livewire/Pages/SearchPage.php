<?php 

namespace App\Livewire\Pages;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;


 #[Layout('layout.app')]
class SearchPage extends Component
{
    use WithPagination;

    #[Url(as: 'search', keep: true)]
    public string $search = '';

    // Reset pagination window when typing to avoid out-of-bounds page sets
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $results = Article::query()
            ->with(['category']) 
            ->advancedSearch($this->search)
            ->published() // <-- Use your model's existing scope
            ->paginate(12);

        return view('livewire.pages.search-page', [
            'results' => $results
        ]); 
    }
}