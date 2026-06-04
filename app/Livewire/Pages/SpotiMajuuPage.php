<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Category;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Burudani;
use Livewire\Attributes\Computed;

 #[Layout('layout.app')]
class SpotiMajuuPage extends Component
{
    public string $slug = 'spoti-majuu';

    #[Computed]
    public function category()
    {
        return Category::where('slug', $this->slug)->firstOrFail();
    }

    #[Computed]
    public function spotiKenyaArticles()
    {
        $kenyaCat = Category::where('slug', 'spoti-kenya')->first();
        if (!$kenyaCat) return collect();

        return Article::where('category_id', $kenyaCat->id)
            ->orderBy('published_at', 'desc')
            ->get();
    }

    #[Computed]
    public function pichaGalleries()
    {
        return Gallery::where('is_visible', true)
            ->orderBy('published_at', 'desc')
            ->get();
    }

    #[Computed]
    public function burudaniNews()
    {
        return Burudani::orderBy('published_at', 'desc')->get();
    }

    #[Computed]
    public function spotiMajuuArticles()
    {
        return Article::where('category_id', $this->category->id)
            ->orderBy('published_at', 'desc')
            ->get();
    }


// #[Computed]
// public function category()
// {
//     // If you have global scopes, this ignores them
//     return Category::withoutGlobalScopes()
//         ->where('slug', $this->slug)
//         ->firstOrFail();
// }


//     public function render()
// {
//     // Debug: Check if the category even exists
//     $cat = Category::where('slug', $this->slug)->first();
//     if (!$cat) {
//         dd("Could not find category with slug: " . $this->slug);
//     }
    
//     // Check if articles exist
//     $articles = Article::where('category_id', $cat->id)->get();
//     // dd($articles); // Uncomment this to stop execution and see if you have data

//     return view('livewire.pages.spoti-majuu-page');
// }







    public function render()
    {
        return view('livewire.pages.spoti-majuu-page'); // Maps to resources/views/layouts/app.blade.php
    }
}