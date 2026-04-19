<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="theme-color" content="#4F46E5">

        <title>@yield('title', 'Vilogic')</title>
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Crect x='6' y='22' width='10' height='10' rx='2' fill='%234F46E5'/%3E%3Crect x='24' y='8' width='10' height='10' rx='2' fill='%231E293B'/%3E%3Cpath d='M16 27C22 27 20 13 24 13' stroke='%236366F1' stroke-width='2' stroke-linecap='round' stroke-dasharray='2 2'/%3E%3Cpath d='M22 15L24 13L22 11' stroke='%236366F1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Plus Jakarta Sans', 'sans-serif'],
                        },
                    }
                }
            }
        </script>

        <style>
            /* ========================================
               FORCE LIGHT MODE - OVERRIDE ALL DARK STYLES
               ======================================== */

            /* Disable dark mode globally */
            html {
                color-scheme: light !important;
            }

            /* ========================================
               MOBILE-OPTIMIZED AUTH LAYOUT
               ======================================== */

            html, body {
                scroll-behavior: smooth;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                -webkit-tap-highlight-color: transparent;
                overflow-x: hidden;
            }

            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            /* Main container */
            .min-h-screen.flex.items-center.justify-center {
                padding: 1rem;
                position: relative;
            }

            /* Grid layout */
            .w-full.max-w-6xl.grid.grid-cols-1.lg\:grid-cols-2 {
                gap: 2rem;
                align-items: stretch;
            }

            /* Form card improvements */
            .w-full.max-w-md.mx-auto.bg-white {
                border-radius: 1.5rem;
                padding: 1.5rem;
                box-shadow: 0 20px 60px rgba(79, 70, 229, 0.08);
                border: 1px solid #eef0ff;
                width: 100%;
            }

            /* Form title */
            .mb-10.text-center.lg\:text-left h2 {
                font-size: 1.5rem;
                font-weight: 800;
                margin-bottom: 0.5rem;
                line-height: 1.2;
            }

            .mb-10.text-center.lg\:text-left p {
                font-size: 0.9rem;
                margin-bottom: 0;
            }

            /* Form group spacing */
            .space-y-5,
            .space-y-6 {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            /* Label styling */
            label {
                display: block;
                font-size: 0.85rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.15em;
                margin-bottom: 0.5rem;
                padding: 0 0.25rem;
                color: #94a3b8;
            }

            /* Form inputs */
            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="checkbox"] {
                min-height: 48px;
                font-size: 16px;
                padding: 12px 16px;
                border-radius: 1rem;
                font-family: inherit;
                transition: all 0.2s ease;
                -webkit-font-smoothing: antialiased;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                width: 100%;
                display: block;
                background: #ffffff !important;
                border: 1.5px solid #e5e7eb !important;
                color: #4b5563 !important;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }

            input[type="text"]::placeholder,
            input[type="email"]::placeholder,
            input[type="password"]::placeholder {
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

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus {
                outline: none;
                background: #ffffff !important;
                border-color: #4F46E5 !important;
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1) !important;
                color: #4b5563 !important;
            }

            input[type="checkbox"] {
                width: 18px;
                cursor: pointer;
            }

            /* Checkbox container */
            .flex.items-center.cursor-pointer {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                cursor: pointer;
            }

            .flex.items-center.cursor-pointer span {
                font-size: 0.85rem;
                font-weight: 600;
                color: #64748b;
                user-select: none;
            }

            /* Submit button */
            button[type="submit"] {
                width: 100%;
                min-height: 48px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.85rem;
                font-weight: 800;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                border-radius: 1rem;
                border: none;
                cursor: pointer;
                transition: all 0.2s ease;
                margin-top: 0.5rem;
                padding: 0;
                gap: 0.5rem;
            }

            button[type="submit"]:active {
                transform: scale(0.98);
            }

            button[type="submit"]:focus-visible {
                outline: 2px solid #4F46E5;
                outline-offset: 2px;
            }

            /* Link styling */
            a {
                color: #4F46E5;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.2s ease;
                outline-offset: 2px;
            }

            a:hover {
                text-decoration: underline;
                opacity: 0.8;
            }

            a:focus-visible {
                outline: 2px solid #4F46E5;
            }

            /* Error messages */
            .mt-2.text-xs.font-bold.text-red-500 {
                font-size: 0.8rem;
                margin-top: 0.5rem;
                display: block;
            }

            /* Desktop left column hidden on mobile */
            .hidden.lg\:flex {
                display: none;
            }

            /* Mobile viewport - up to 575px */
            @media (max-width: 575px) {
                .min-h-screen.flex.items-center.justify-center {
                    padding: 1rem 0.75rem;
                    min-height: auto;
                    min-height: 100vh;
                }

                .w-full.max-w-6xl.grid.grid-cols-1.lg\:grid-cols-2 {
                    gap: 1rem;
                }

                .w-full.max-w-md.mx-auto.bg-white {
                    padding: 1.25rem;
                    border-radius: 1.25rem;
                    margin: 0;
                }

                .mb-10.text-center.lg\:text-left {
                    text-align: center;
                    margin-bottom: 1.5rem;
                }

                .mb-10.text-center.lg\:text-left h2 {
                    font-size: 1.25rem;
                    margin-bottom: 0.5rem;
                }

                .mb-10.text-center.lg\:text-left p {
                    font-size: 0.85rem;
                }

                .space-y-5,
                .space-y-6 {
                    gap: 0.75rem;
                }

                input[type="text"],
                input[type="email"],
                input[type="password"] {
                    padding: 12px 14px;
                    font-size: 16px;
                }

                /* Better spacing for mobile buttons */
                button[type="submit"] {
                    margin-top: 0.75rem;
                }

                /* Flex improvements for mobile */
                .flex.items-center.justify-between {
                    flex-direction: row;
                    gap: 0.75rem;
                }

                /* Bottom divider section */
                .mt-8.text-center.pt-8.border-t,
                .mt-10.text-center.pt-8.border-t {
                    margin-top: 1.5rem;
                    padding-top: 1.25rem;
                    border-top: 1px solid #f1e5ff;
                }

                .mt-8.text-center.pt-8.border-t p,
                .mt-10.text-center.pt-8.border-t p {
                    font-size: 0.8rem;
                    margin-bottom: 0;
                }

                .mt-8.text-center.pt-8.border-t a,
                .mt-10.text-center.pt-8.border-t a,
                .mt-8.text-center.pt-8.border-t .text-indigo-600,
                .mt-10.text-center.pt-8.border-t .text-indigo-600 {
                    display: inline;
                    margin-left: 0.25rem;
                }
            }

            /* Tablet (576px - 767px) */
            @media (min-width: 576px) and (max-width: 767px) {
                .w-full.max-w-md.mx-auto.bg-white {
                    padding: 1.5rem;
                }

                .w-full.max-w-6xl.grid.grid-cols-1.lg\:grid-cols-2 {
                    gap: 1.5rem;
                }

                input[type="text"],
                input[type="email"],
                input[type="password"] {
                    padding: 12px 14px;
                }
            }

            /* Medium and larger show desktop layout */
            @media (min-width: 768px) {
                .hidden.lg\:flex {
                    display: flex;
                }

                .w-full.max-w-6xl.grid.grid-cols-1.lg\:grid-cols-2 {
                    gap: 2rem;
                }

                .w-full.max-w-md.mx-auto.bg-white {
                    padding: 2rem;
                }

                input[type="text"],
                input[type="email"],
                input[type="password"] {
                    padding: 12px 16px;
                }
            }

            /* Accessibility - reduce motion */
            @media (prefers-reduced-motion: reduce) {
                * {
                    animation-duration: 0.01ms !important;
                    transition-duration: 0.01ms !important;
                }
            }

            /* Dark mode support */
            @media (prefers-color-scheme: dark) {
                input[type="text"],
                input[type="email"],
                input[type="password"] {
                    background: #1a1a1a;
                    border-color: #444;
                    color: #fff;
                }

                input[type="text"]:focus,
                input[type="email"]:focus,
                input[type="password"]:focus {
                    background: #222;
                }
            }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-[#e0e7ff]">
        {{ $slot }}
    </body>
</html>
