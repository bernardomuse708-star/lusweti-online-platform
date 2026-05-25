<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Override the URL generator for console commands
        if ($this->app->runningInConsole()) {
            $this->app->singleton('url', function ($app) {
                $routes = $app['router']->getRoutes();
                
                // Create a dummy request for console commands
                $request = Request::create($app['config']['app.url'], 'GET');
                
                return new \Illuminate\Routing\UrlGenerator($routes, $request);
            });
        }
    }
}
