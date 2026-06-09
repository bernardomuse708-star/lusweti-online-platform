<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Lusweti-online-center' }}</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Page-specific meta overrides --}}
    @yield('meta')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="antialiased">

    <livewire:frontend.site-header />
    <livewire:frontend.page-header-meta />
    <main>
        @yield('content')
    </main>

    <livewire:frontend.global-page-footer />

    {{-- Authentication Modals --}}
    <livewire:auth.auth-modal />
    @livewireScripts
    @stack('scripts')

</body>

</html>