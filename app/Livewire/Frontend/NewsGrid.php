<?php

namespace App\Livewire\Frontend;

use App\Models\Burudani;
use Livewire\Component;

class NewsGrid extends Component
{
    public function render()
    {
        $featuredBurudani = Burudani::where('is_featured', true)
            ->latest('published_at')
            ->first();

        $standardBurudanis = Burudani::where('is_featured', false)
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('livewire.frontend.news-grid', [
            'featuredBurudani' => $featuredBurudani,
            'standardBurudanis' => $standardBurudanis,
        ]);
    }
}