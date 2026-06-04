<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\SpotiMajuuPage;
use App\Livewire\Frontend\CategoryPage;
use App\Livewire\DynamicPage;
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
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| CATEGORY & LIVEWIRE ROUTES
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| CATEGORY & LIVEWIRE ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/ms/spoti-majuu', SpotiMajuuPage::class)->name('pages.spoti-majuu');

// 1. EXPLICIT SEARCH ROUTE (Must be above the wildcard)
// Explicit Routing Layer
Route::get('/ms/search', \App\Livewire\Pages\SearchPage::class)->name('search.index');

// 2. WILDCARD CATEGORY ROUTE
// New way


Route::get('/ms/{category:slug}', CategoryPage::class)->name('category.show');

/*
|--------------------------------------------------------------------------
| CATCH-ALL ROUTES LAST
|--------------------------------------------------------------------------
*/
Route::get('/{page:slug}', DynamicPage::class)->name('pages.show');