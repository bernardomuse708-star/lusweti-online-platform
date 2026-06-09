<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Livewire\Pages\SearchPage;
use Illuminate\Support\Facades\Route;
use App\Livewire\Frontend\CategoryPage;
use App\Livewire\DynamicPage;
use App\Livewire\Frontend\SubscribePage;
use App\Livewire\Pages\PreviewPage;
use App\Models\Page;

/*
|--------------------------------------------------------------------------
| EXPLICIT & STATIC ROUTES FIRST
|--------------------------------------------------------------------------
*/

Route::get('/home', [PageController::class, 'home']);
Route::get('/', [PageController::class, 'home']);
Route::get('/stream', [PageController::class, 'stream']);

Route::get('/pages/preview/{token}', PreviewPage::class)
    ->name('page.preview');

Route::get('/preview/{token}', function ($token) {
    $page = Page::where('preview_token', $token)->firstOrFail();
    return view('preview.page', compact('page'));
})->name('pages.preview');

/*
|--------------------------------------------------------------------------
| Socialite OAuth Routes
|--------------------------------------------------------------------------
| Strictly for Google authentication. Fortify handles standard email/pass.
*/

Route::middleware('guest')->group(function () {
    Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])
        ->name('google.redirect');
        
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])
        ->name('google.callback');
});


/*
|--------------------------------------------------------------------------
| Authenticated Reader Routes
|--------------------------------------------------------------------------
| Protected routes for logged-in users (e.g., managing subscriptions, saved articles).
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/account', function () {
        return view('account.dashboard');
    })->name('account.dashboard');

    // Example: Route::get('/saved-articles', [ArticleController::class, 'saved'])->name('articles.saved');
});

// Note: Filament automatically handles its own /admin routes via its panel provider.


/*
|--------------------------------------------------------------------------
| CATEGORY & LIVEWIRE ROUTES
|--------------------------------------------------------------------------
*/
// Route::get('/ms/spoti-majuu', SpotiMajuuPage::class)->name('pages.spoti-majuu');
Route::get('/ms/subscribe', SubscribePage::class)->name('subscribe');

// 1. EXPLICIT SEARCH ROUTE (Must be above the wildcard)
// Explicit Routing Layer
Route::get('/ms/search', SearchPage::class)->name('search.index');

// 2. WILDCARD CATEGORY ROUTE
// New way to handle category pages with Livewire components
Route::get('/ms/{category:slug}', CategoryPage::class)->name('category.show');
Route::get('/michezo', [PageController::class, 'michezo'])->name('pages.michezo');
Route::get('/burudani', [PageController::class, 'burudani'])->name('pages.burudani');

/*
|--------------------------------------------------------------------------
| CATCH-ALL ROUTES LAST
|--------------------------------------------------------------------------
*/
Route::get('/{page:slug}', DynamicPage::class)->name('pages.show');
