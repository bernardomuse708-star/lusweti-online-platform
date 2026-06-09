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
        $page = $this->page->load([
            'sections.sectionType',
            'sections.category',
            'sections.items.article.category',
            'sections.items.article.media',
        ]);

        return view('livewire.dynamic-page', [
            'page' => $page,
        ]);
    }
}
