<?php

declare(strict_types=1);

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\FooterMetaLink;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class GlobalPageFooter extends Component
{
    #[On('categories-updated')]
    #[On('meta-links-updated')] // Added an event in case you update meta links in Filament
    public function refreshFooter(): void
    {
        // Bust the cache when an event is fired so the computed property rebuilds it
        Cache::forget('global_app_footer_data_v3');
    }

    #[Computed]
    public function footerPayload(): array
    {
        return Cache::remember('global_app_footer_data_v3', 86400, function () {
            return [
                'categories' => Category::query()
                    ->where('is_active', true)
                    ->select('id', 'name', 'slug')
                    ->get()
                    ->values(),
                
                'metaLinks'  => FooterMetaLink::activeFeed()
                    ->get(['title', 'url', 'open_in_new_tab']),
            ];
        });
    }

    public function render(): View
    {
        return view('livewire.frontend.global-page-footer', [
            // Safe filtering in memory
            'footerCategories' => collect($this->footerPayload['categories'])
                ->filter(fn($item) => is_object($item) && isset($item->slug))
                ->values(),

            'metaLinks'   => $this->footerPayload['metaLinks'],
            'currentYear' => now()->format('Y'),
        ]);
    }
}

// declare(strict_types=1);

// namespace App\Livewire\Frontend;

// use App\Models\Category;
// use App\Models\FooterMetaLink;
// use Livewire\Attributes\On;
// use Livewire\Component;
// use Livewire\Attributes\Computed;
// use Illuminate\Contracts\View\View;
// use Illuminate\Support\Facades\Cache;

// class GlobalPageFooter extends Component
// {
//     #[On('categories-updated')]
//     public function refreshCategories(): void
//     {
//         // Simply triggers a refresh
//     }



//     #[Computed]
//     public function footerPayload(): array
//     {
//         // Changed the cache key to force a clean database pull
//         return Cache::remember('global_app_footer_data_v3', 86400, function () {
//             return [

//                 'categories' => Category::query()
//                     ->where('is_active', true)
//                     ->select('id', 'name', 'slug')
//                     ->get()
//                     ->values(),
//                 // 1. Added 'id' to maintain Eloquent structural integrity
//                 // 2. Used clean query constraints directly to bypass buggy scope code
//                 'metaLinks'  => FooterMetaLink::activeFeed()->get(['title', 'url', 'open_in_new_tab']),
//             ];
//         });
//     }

//     public function render(): View
//     {
//         return view('livewire.frontend.global-page-footer', [
//             'footerCategories' => collect($this->footerPayload['categories'])
//                 ->filter(fn($item) => is_object($item) && isset($item->slug))
//                 ->values(),

//             'metaLinks'   => $this->footerPayload['metaLinks'],
//             'currentYear' => now()->format('Y'),
//         ]);
//     }

//     public function render()
//     {
//         $categories = Cache::remember('footer_categories', 86400, function () {
//             return Category::all(); 
//         });

//         return view('livewire.frontend.footer', [
//             'categories' => $categories
//         ]);
//     }
// }
