<?php
namespace App\Livewire\MagazineLayout;

use App\Models\Category;
use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Contracts\View\View;

class MagazineCategoryStream extends Component
{
    public int $categoryId;

    public function mount(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    #[On('echo:magazine-stream,article.mutated')]
    public function refreshCategoryStream(): void
    {
        $this->dispatch('$refresh');
    }

    public function getCategoryProperty(): ?Category
    {
        return Category::find($this->categoryId);
    }

    public function getArticlesProperty()
    {
        return Article::with('category')
            ->where('category_id', $this->categoryId)
            ->published()
            ->take(12)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.magazine-layout.magazine-category-stream');
    }
}