<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define the missing acronym macro fluently
        Stringable::macro('acronym', function (string $delimiter = '') {
            return new Stringable(
                collect(preg_split('/[\s_]+/', $this->value))
                    ->map(fn ($word) => mb_substr($word, 0, 1))
                    ->join($delimiter)
            );
        });
    }
}
