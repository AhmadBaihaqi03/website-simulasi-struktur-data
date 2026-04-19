<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

        <title>{{ config('app.name', 'Vilogic') }}</title>
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Crect x='6' y='22' width='10' height='10' rx='2' fill='%234F46E5'/%3E%3Crect x='24' y='8' width='10' height='10' rx='2' fill='%231E293B'/%3E%3Cpath d='M16 27C22 27 20 13 24 13' stroke='%236366F1' stroke-width='2' stroke-linecap='round' stroke-dasharray='2 2'/%3E%3Cpath d='M22 15L24 13L22 11' stroke='%236366F1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* ========================================
               FORCE LIGHT MODE - OVERRIDE ALL DARK STYLES
               ======================================== */

            html {
                color-scheme: light !important;
            }

            /* ========================================
               MOBILE-OPTIMIZED LAYOUT STYLES
               ======================================== */

            /* Prevent overflow and ensure proper viewport */
            html, body {
                overflow-x: hidden;
                max-width: 100%;
                scroll-behavior: smooth;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                -webkit-tap-highlight-color: transparent;
            }

            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            /* Fixed navigation bar */
            .force-pinned-nav {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                width: 100% !important;
                z-index: 9999 !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            }

            /* Content spacer below navbar */
            .content-spacer {
                margin-top: 64px !important;
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            /* Main content area */
            main {
                flex: 1;
                padding: 1rem 0 2rem 0;
                width: 100%;
            }

            /* Header improvements */
            header {
                padding: 1rem 1rem;
                margin-top: 0;
            }

            header h1,
            header h2 {
                word-wrap: break-word;
                word-break: break-word;
                overflow-wrap: break-word;
                margin-bottom: 0.25rem;
            }

            /* Container optimization */
            .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .max-w-7xl {
                margin-left: auto;
                margin-right: auto;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            /* Touch-friendly minimum sizes */
            button, .btn, a.btn, input[type="submit"],
            input[type="button"], .btn-indigo {
                min-height: 48px;
                min-width: 44px;
                padding: 12px 16px;
                border-radius: 10px;
                font-size: 14px;
                font-weight: 600;
                letter-spacing: 0.5px;
                transition: all 0.2s ease;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                white-space: nowrap;
                text-decoration: none;
            }

            button:active,
            .btn:active,
            a.btn:active {
                transform: scale(0.98);
            }

            /* Form inputs */
            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="number"],
            input[type="search"],
            input[type="date"],
            input[type="time"],
            textarea,
            select,
            .form-control,
            .form-control-custom {
                min-height: 48px;
                padding: 12px 14px;
                font-size: 16px;
                border-radius: 10px;
                font-family: inherit;
                transition: all 0.2s ease;
                background-color: #ffffff !important;
                color: #4b5563 !important;
                border: 1px solid #e5e7eb !important;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }

            input[type="text"]::placeholder,
            input[type="email"]::placeholder,
            input[type="password"]::placeholder,
            input[type="number"]::placeholder,
            input[type="search"]::placeholder,
            textarea::placeholder {
                color: #a8adb7 !important;
                opacity: 1 !important;
            }

            input[type="text"]:autofill,
            input[type="email"]:autofill,
            input[type="password"]:autofill {
                background-color: #ffffff !important;
                -webkit-text-fill-color: #4b5563 !important;
                box-shadow: inset 0 0 0 1000px #ffffff !important;
            }

            input:focus,
            textarea:focus,
            select:focus,
            .form-control:focus,
            .form-control-custom:focus {
                outline: none;
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1) !important;
                border-color: #4F46E5 !important;
                background-color: #ffffff !important;
                color: #4b5563 !important;
            }

            /* Textarea enhancements */
            textarea {
                resize: vertical;
                min-height: 120px;
            }

            /* Card improvements */
            .card {
                border: 1px solid #eee;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
                transition: all 0.2s ease;
                margin-bottom: 1rem;
            }

            .card-body {
                padding: 1rem;
            }

            .card:hover {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            /* Bootstrap table scroll */
            .table-responsive {
                -webkit-overflow-scrolling: touch;
                border-radius: 10px;
                overflow: hidden;
            }

            /* Selection improvements */
            ::selection {
                background-color: #4F46E5;
                color: white;
            }

            ::-moz-selection {
                background-color: #4F46E5;
                color: white;
            }

            /* Mobile viewport optimizations */
            @media (max-width: 575px) {
                /* Navbar adjustments */
                .force-pinned-nav {
                    height: auto;
                    min-height: 56px;
                }

                .content-spacer {
                    margin-top: 56px;
                }

                /* Aggressive padding reduction on mobile */
                header {
                    padding: 0.75rem 1rem;
                }

                main {
                    padding: 0.75rem 0 1.5rem 0;
                }

                .container-fluid,
                .container {
                    padding-left: 1rem;
                    padding-right: 1rem;
                }

                .max-w-7xl {
                    padding-left: 1rem;
                    padding-right: 1rem;
                }

                /* Better mobile button spacing */
                .btn-group {
                    display: flex;
                    flex-direction: column;
                    gap: 0.5rem;
                }

                .btn-group .btn {
                    width: 100%;
                }

                /* Stack form buttons */
                .form-actions {
                    display: flex;
                    flex-direction: column;
                    gap: 0.75rem;
                }

                .form-actions button,
                .form-actions .btn,
                .form-actions input[type="submit"] {
                    width: 100%;
                }

                /* Card spacing on mobile */
                .card {
                    margin-bottom: 1rem;
                    border-radius: 12px;
                }

                .card-body {
                    padding: 1rem;
                }

                /* Row gutters */
                .row {
                    row-gap: 1rem;
                }

                /* Improved spacing utilities */
                .py-4 { padding-top: 0.75rem !important; padding-bottom: 0.75rem !important; }
                .py-5 { padding-top: 1rem !important; padding-bottom: 1rem !important; }
                .px-4 { padding-left: 1rem !important; padding-right: 1rem !important; }
                .px-6 { padding-left: 1rem !important; padding-right: 1rem !important; }

                /* Modal improvements */
                .modal-dialog {
                    margin: 0.75rem;
                }

                .modal-content {
                    border-radius: 12px;
                    border: none;
                    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
                }

                .modal-header {
                    padding: 1rem;
                    border-bottom: 1px solid #eee;
                }

                .modal-body {
                    padding: 1rem;
                }

                .modal-footer {
                    padding: 1rem;
                    gap: 0.75rem;
                    display: flex;
                    justify-content: flex-end;
                }
            }

            /* Tablet and up */
            @media (min-width: 768px) {
                header {
                    padding: 1.5rem 1.5rem;
                }

                main {
                    padding: 1.5rem 0;
                }

                .card-body {
                    padding: 1.5rem;
                }

                button, .btn {
                    min-height: 44px;
                }

                input[type="text"],
                input[type="email"],
                input[type="password"],
                input[type="number"],
                textarea,
                select,
                .form-control {
                    min-height: 44px;
                    font-size: 14px;
                }

                textarea {
                    min-height: 100px;
                }
            }

            /* Keyboard navigation support */
            button:focus-visible,
            .btn:focus-visible,
            a:focus-visible,
            input:focus-visible,
            textarea:focus-visible,
            select:focus-visible {
                outline: 2px solid #4F46E5;
                outline-offset: 2px;
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
