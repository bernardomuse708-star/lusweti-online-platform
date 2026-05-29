import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

/*
|--------------------------------------------------------------------------
| Reverb Runtime Configuration
|--------------------------------------------------------------------------
|
| Production-safe runtime websocket resolver supporting:
| - Local development
| - HTTPS reverse proxies
| - Docker/VPS deployments
| - Cloudflare/Nginx proxying
| - Laravel Reverb clustering
|
*/

const scheme =
    import.meta.env.VITE_REVERB_SCHEME ||
    (window.location.protocol === 'https:' ? 'https' : 'http');

const isSecure = scheme === 'https';

const reverbHost =
    import.meta.env.VITE_REVERB_HOST ||
    window.location.hostname;

/*
|--------------------------------------------------------------------------
| Port Resolution
|--------------------------------------------------------------------------
|
| Priority:
| 1. Explicit WS/WSS ports
| 2. Shared Reverb port
| 3. Protocol defaults
|
*/

const wsPort = Number(
    import.meta.env.VITE_REVERB_WS_PORT ||
    import.meta.env.VITE_REVERB_PORT ||
    8080
);

const wssPort = Number(
    import.meta.env.VITE_REVERB_WSS_PORT ||
    import.meta.env.VITE_REVERB_PORT ||
    443
);

/*
|--------------------------------------------------------------------------
| Echo Bootstrap
|--------------------------------------------------------------------------
*/

window.Echo = new Echo({
    broadcaster: 'reverb',

    key: import.meta.env.VITE_REVERB_APP_KEY,

    wsHost: reverbHost,

    wsPort,

    wssPort,

    forceTLS: isSecure,

    encrypted: isSecure,

    disableStats: true,

    enabledTransports: ['ws', 'wss'],

    /*
    |--------------------------------------------------------------------------
    | Production Stability
    |--------------------------------------------------------------------------
    */

    activityTimeout: 30000,

    pongTimeout: 15000,

    unavailableTimeout: 10000,
});