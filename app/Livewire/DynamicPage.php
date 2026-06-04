<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class DynamicPage extends Component
{
    public Page $page;

    protected $listeners = [
    'echo:pages,PageUpdated' => '$refresh',
];

    public function mount(Page $page): void
    {
        $this->page = $page;
    }

    public function render()
    {
        $cacheKey = "page:{$this->page->id}";

        $page = Cache::remember($cacheKey, 60, function () {

                return $this->page->load([
                    'sections.sectionType',
                    'sections.category',
                    'sections.items.article.category',
                ]);
            });

        return view('livewire.dynamic-page', [
            'page' => $page,
        ]);
    }
}