<?php

namespace App\Livewire\Frontend;

use App\Models\SocialLink;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class SocialLinks extends Component
{

    // Make sure your listeners array catches the Reverb broadcast signature
    #[On('echo:footer,.socials.updated')]
    public function refreshSocials(): void
    {
        Cache::forget('global_footer_socials_v4');
        unset($this->socialLinks);
        $this->dispatch('$refresh');
    }

    #[Computed]
    public function socialLinks(): array
    {
        return Cache::remember(
            'global_footer_socials_v4',
            86400,
            function () {
                return SocialLink::query()
                    ->where('is_active', true)
                    ->orderBy('sort_weight')
                    ->get()
                    ->map(fn($social) => [
                        'id'           => (int) $social->id,
                        'name'         => (string) $social->name,
                        'platform_key' => (string) $social->platform_key,
                        'color_class'  => (string) $social->color_class,
                        'url'          => (string) $social->url,
                        // Pull the Spatie Media image URL and store it right in the cache array
                        'logo_url'     => (string) $social->getFirstMediaUrl('logo'),
                    ])
                    ->values()
                    ->all();
            }
        );
    }

    public function render(): View
    {
        return view('livewire.frontend.social-links', [
            'currentYear' => now()->year,
        ]);
    }
}
