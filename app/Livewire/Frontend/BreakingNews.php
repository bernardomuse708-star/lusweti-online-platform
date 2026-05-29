<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\BreakingNews as BreakingNewsModel;

class BreakingNews extends Component
{
    public $breakingItems;

    
    /* ---------------- BREAKING NEWS ---------------- */

    #[On('echo:breaking-news,breaking.updated')]
    public function loadBreakingItems()
    {
        $this->breakingItems = BreakingNewsModel::active()
            ->orderByDesc('is_urgent')
            ->orderByDesc('priority')
            ->orderByDesc('ai_score')
            ->latest()
            ->limit(20)
            ->get();

        foreach ($this->breakingItems as $item) {
            $item->increment('views');
        }
    }

    public function hasBreaking(): bool
    {
        return $this->breakingItems?->isNotEmpty() ?? false;
    }

    public function getStatus($item)
    {
        if ($item->is_urgent) return 'URGENT';
        if ($item->is_live) return 'LIVE';
        if ($item->created_at->diffInMinutes() < 5) return 'NEW';
        return null;
    }

    public function trackClick($id)
    {
        if ($item = BreakingNewsModel::find($id)) {
            $item->increment('clicks');
            $item->updateScore();
        }
    }

    /* ---------------- LIFECYCLE ---------------- */

    public function mount()
    {
        $this->loadBreakingItems();
    }

    public function hydrate()
    {
        $this->breakingItems ??= collect();
    }

    public function render()
    {
        return view('livewire.frontend.breaking-news');
    }
}