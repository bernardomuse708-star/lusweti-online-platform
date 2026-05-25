<?php

namespace App\Livewire\Frontend;

use App\Models\SiteSetting;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\Attributes\Computed;

class PageHeaderMeta extends Component
{
    // protected $listeners = [
    //     'echo:news,article.published' => '$refresh',
    // ];

    #[Computed]
    public function tagline(): string
    {
        return SiteSetting::getWithCache('page_tagline', 'Kata kiu ya michezo na burudani');
    }

    #[Computed]
    public function formattedDate(): array
    {
        $now = Carbon::now(); // Correctly respects application timezone configuration
        
        return [
            'iso' => $now->toDateString(),                       // e.g., 2026-05-25
            'human' => $now->isoFormat('dddd, MMMM D, YYYY'),    // e.g., Monday, May 25, 2026
        ];
    }

    public function render(): string
{
    return <<<'HTML'
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center justify-between gap-4 border-b border-gray-100 pb-6 sm:flex-row">
            
            {{-- Tagline: Editorial Branding --}}
            <div class="flex items-center gap-3">
                <span class="inline-block h-4 w-1 bg-red-600"></span>
                <span class="text-[11px] font-black uppercase tracking-[0.25em] text-gray-900">
                    {{ $this->tagline }}
                </span>
            </div>

            {{-- Date: Contextual Metadata --}}
            <time class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-gray-400" 
                  datetime="{{ $this->formattedDate['iso'] }}">
                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $this->formattedDate['human'] }}
            </time>

        </div>
    </div>
    HTML;
}
}



