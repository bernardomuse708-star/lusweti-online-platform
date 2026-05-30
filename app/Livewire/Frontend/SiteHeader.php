<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use App\Models\Category;
use App\Models\News;
use App\Models\SiteSetting;

class SiteHeader extends Component
{
    public ?array $latestBreakingNews = null;

    


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

    // Listen to Laravel Reverb via Laravel Echo for breaking news updates
    #[On('echo:public-news,BreakingNewsPublished')]
    public function handleNewBreakingNews($event): void
    {
        $this->latestBreakingNews = [
            'headline' => $event['headline'],
            'url' => $event['url'],
        ];
    }

    // Listen for SiteHeader logo/branding updates from Filament
    #[On('echo:site-header,.header.updated')]
    public function refreshHeader(): void
    {
        $this->dispatch('$refresh');
    }

    #[Computed]
    public function categories()
    {
        // Make sure you use ->get() to return complete Model objects
        return Category::where('is_visible_in_nav', true)
            ->orderBy('sort_order')
            ->get(['name', 'slug']);
    }

    #[Computed]
    public function siteLogoUrl(): string
    {
        $siteSetting = SiteSetting::where('key', 'site_header_logo')->first();

        if ($siteSetting && $siteSetting->hasMedia('site_logo')) {
            return $siteSetting->getFirstMediaUrl('site_logo', 'optimized');
        }

        $path = SiteSetting::getWithCache(
            'site_header_logo',
            'resource/crblob/4351492/5c3d71953e078c66977c4abdce89ec1e/ms-logo-svg-data.svg'
        );

        if (!$path) {
            return asset('resource/crblob/4351492/5c3d71953e078c66977c4abdce89ec1e/ms-logo-svg-data.svg');
        }

        return preg_match('/^https?:\/\//', $path)
            ? $path
            : asset($path);
    }

    #[Computed]
    public function siteLogoAlt(): string
    {
        return SiteSetting::getWithCache('site_header_logo_alt', 'Mwanaspoti');
    }

    public function render()
    {
        return view('livewire.frontend.site-header');
    }
}
