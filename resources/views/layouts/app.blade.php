<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Vilogic') }}</title>
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Crect x='6' y='22' width='10' height='10' rx='2' fill='%234F46E5'/%3E%3Crect x='24' y='8' width='10' height='10' rx='2' fill='%231E293B'/%3E%3Cpath d='M16 27C22 27 20 13 24 13' stroke='%236366F1' stroke-width='2' stroke-linecap='round' stroke-dasharray='2 2'/%3E%3Cpath d='M22 15L24 13L22 11' stroke='%236366F1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Prevent horizontal overflow on all screens */
            html, body {
                overflow-x: hidden;
                max-width: 100%;
            }

            .force-pinned-nav {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                width: 100% !important;
                z-index: 9999 !important;
            }
            .content-spacer {
                /* Jarak setinggi navbar agar konten tidak tertutup */
                margin-top: 64px !important;
            }

            /* Minimum touch target untuk semua interaktif element */
            button, .btn, a.btn, input[type="submit"], input[type="button"] {
                min-height: 44px;
            }

            /* Bootstrap table scroll touch friendly */
            .table-responsive {
                -webkit-overflow-scrolling: touch;
            }

            /* Responsive container padding */
            @media (max-width: 576px) {
                .container, .container-fluid {
                    padding-left: 1rem;
                    padding-right: 1rem;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen" style="background-color: #e0e7ff">
            <div class="force-pinned-nav">
                @include('layouts.navigation')
            </div>

            <div class="content-spacer">
                @isset($header)
                    <header class="bg-white shadow-sm relative z-10">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>