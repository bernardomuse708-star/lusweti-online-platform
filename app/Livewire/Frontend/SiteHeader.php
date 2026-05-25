<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use App\Models\Category;
use App\Models\News;

class SiteHeader extends Component
{
    public ?array $latestBreakingNews = null;

    // protected $listeners = [
    //     'echo:news,article.published' => '$refresh',
    // ];


    public function mount()
    {
        // Load the initial breaking news state on page load
        $news = News::where('is_breaking', true)->latest()->first();
        if ($news) {
            $this->latestBreakingNews = [
                'headline' => $news->headline,
                'url' => $news->url,
            ];
        }
    }

    // Listen to Laravel Reverb via Laravel Echo
    #[On('echo:public-news,BreakingNewsPublished')]
    public function handleNewBreakingNews($event)
    {
        $this->latestBreakingNews = [
            'headline' => $event['headline'],
            'url' => $event['url'],
        ];
    }

    #[Computed]
    public function categories()
    {
        // Make sure you use ->get() to return complete Model objects
 return Category::where('is_visible_in_nav', true)
            ->orderBy('sort_order')
            ->get(['name', 'slug']);    }

    // Cache categories to prevent redundant DB queries on every request
    // #[Computed(cache: true, key: 'header-navigation-categories')]
    // public function categories()
    // {
    //     return Category::where('is_visible_in_nav', true)
    //         ->orderBy('sort_order')
    //         ->get(['name', 'slug']);
    // }

    public function render()
    {
        return view('livewire.frontend.site-header');
    }
}
