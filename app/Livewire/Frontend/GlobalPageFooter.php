<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\FooterMetaLink;
use App\Models\FooterSetting;
use App\Models\SocialLink;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class GlobalPageFooter extends Component
{
    #[On('echo:footer,.footer.updated')]
    #[On('categories-updated')]
    #[On('meta-links-updated')]
    public function refreshFooter(): void
    {
        Cache::forget('global_footer_categories_v4');
        Cache::forget('global_footer_metalinks_v4');
        Cache::forget('global_footer_settings_v4');
        // Cache::forget('global_footer_socials_v4');

        unset($this->footerSettings);
        unset($this->footerCategories);
        unset($this->metaLinks);
        // unset($this->socialLinks);

        $this->dispatch('$refresh');
    }

    #[Computed]
    public function footerSettings(): array
    {
        return Cache::remember(
            'global_footer_settings_v4',
            86400,
            function () {
                $settings = FooterSetting::first();

                // Return as an array with fallbacks in case the table is empty
                return $settings ? $settings->toArray() : [
                    'brand_name' => 'Lusweti',
                    'brand_description' => '',
                    'copyright_text' => 'All rights reserved.',
                    'sections_title' => 'Sections',
                    'information_title' => 'Information',
                    'footer_decoration' => null,
                ];
            }
        );
    }

    #[Computed]
    public function footerCategories(): array
    {
        return Cache::remember(
            'global_footer_categories_v4',
            86400,
            function () {
                return Category::query()
                    ->where('is_active', true)
                    ->where('is_visible_in_footer', true)
                    ->orderBy('sort_weight')
                    ->get(['id', 'name', 'slug'])
                    ->map(fn($category) => [
                        'id'   => (int) $category->id,
                        'name' => (string) $category->name,
                        'slug' => (string) $category->slug,
                    ])
                    ->values()
                    ->all();
            }
        );
    }

    #[Computed]
    public function metaLinks(): array
    {
        return Cache::remember(
            'global_footer_metalinks_v4',
            86400,
            function () {
                return FooterMetaLink::query()
                    ->where('is_active', true)
                    ->orderBy('sort_weight')
                    ->get(['title', 'url', 'open_in_new_tab'])
                    ->map(fn($link) => [
                        'title'            => (string) $link->title,
                        'url'              => (string) $link->url,
                        'open_in_new_tab'  => (bool) $link->open_in_new_tab,
                    ])
                    ->values()
                    ->all();
            }
        );
    }

    // Make sure your listeners array catches the Reverb broadcast signature
    // #[On('echo:footer,.socials.updated')]
    // public function refreshSocials(): void
    // {
    //     Cache::forget('global_footer_socials_v4');
    //     unset($this->socialLinks);
    //     $this->dispatch('$refresh');
    // }

    // #[Computed]
    // public function socialLinks(): array
    // {
    //     return Cache::remember(
    //         'global_footer_socials_v4',
    //         86400,
    //         function () {
    //             return SocialLink::query()
    //                 ->where('is_active', true)
    //                 ->orderBy('sort_weight')
    //                 ->get()
    //                 ->map(fn($social) => [
    //                     'id'           => (int) $social->id,
    //                     'name'         => (string) $social->name,
    //                     'platform_key' => (string) $social->platform_key,
    //                     'color_class'  => (string) $social->color_class,
    //                     'url'          => (string) $social->url,
    //                     // Pull the Spatie Media image URL and store it right in the cache array
    //                     'logo_url'     => (string) $social->getFirstMediaUrl('logo'),
    //                 ])
    //                 ->values()
    //                 ->all();
    //         }
    //     );
    // }

    public function render(): View
    {
        return view('livewire.frontend.global-page-footer', [
            'currentYear' => now()->year,
        ]);
    }
}
