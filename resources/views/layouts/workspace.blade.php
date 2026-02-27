<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'PBL Workspace' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        /* Aksen Utama Indigo */
        .bg-indigo { background-color: #4f46e5 !important; }
        .text-indigo { color: #4f46e5 !important; }
        .border-indigo { border-color: #4f46e5 !important; }

        .navbar-workspace {
            background: #4f46e5;
            border-bottom: 4px solid #3730a3;
        }

        /* Card untuk Form agar tidak hancur */
        .card-workspace {
            border: none;
            border-radius: 1.25rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 2rem;
        }

        .btn-indigo {
            background-color: #4f46e5;
            color: white;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }

        .btn-indigo:hover {
            background-color: #4338ca;
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark navbar-workspace shadow-sm mb-5">
        <div class="container py-1">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="#">
                <div class="bg-white text-indigo rounded-3 p-1 me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>
                PBL / WORKSPACE
            </a>
            
            <div class="d-flex align-items-center">
                <span class="text-white opacity-75 small d-none d-md-block">
                    <i class="bi bi-people-fill me-1"></i> Mode Kolaborasi
                </span>
            </div>
        </div>
    </nav>

    <main class="container">
        {{ $slot }}
    </main>

    <footer class="container text-center py-5 mt-5 border-top">
        <p class="text-muted small">
            &copy; {{ date('Y') }} Problem Based Learning System &bull; <span class="text-indigo fw-bold">Indigo Design</span>
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>