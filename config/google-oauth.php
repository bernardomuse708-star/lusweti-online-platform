<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google OAuth Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for Google OAuth authentication.
    | To enable Google OAuth, you need to:
    |
    | 1. Create a project in Google Cloud Console
    | 2. Enable Google+ API and Google OAuth2 API
    | 3. Create OAuth 2.0 Client ID credentials
    | 4. Add your callback URL: http://your-domain.com/auth/google/callback
    | 5. Copy the Client ID and Client Secret to your .env file
    | 6. Install laravel/socialite: composer require laravel/socialite
    | 7. Uncomment the Google provider in config/services.php
    |
    */

    'enabled' => env('GOOGLE_OAUTH_ENABLED', false),

    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT_URI', rtrim(env('APP_URL', 'http://localhost'), '/') . '/auth/google/callback'),
    'scopes' => [
        'https://www.googleapis.com/auth/userinfo.email',
        'https://www.googleapis.com/auth/userinfo.profile',
    ],

    'options' => [
        'access_type' => 'offline',
        'prompt' => 'consent',
    ],
];
