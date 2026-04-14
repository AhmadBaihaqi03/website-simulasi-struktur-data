<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Vilogic')</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Crect x='6' y='22' width='10' height='10' rx='2' fill='%234F46E5'/%3E%3Crect x='24' y='8' width='10' height='10' rx='2' fill='%231E293B'/%3E%3Cpath d='M16 27C22 27 20 13 24 13' stroke='%236366F1' stroke-width='2' stroke-linecap='round' stroke-dasharray='2 2'/%3E%3Cpath d='M22 15L24 13L22 11' stroke='%236366F1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #e0e7ff;
            overflow-x: hidden;
            max-width: 100%;
        }

        /* Efek blur transparan pada Header (Glassmorphism) */
        .glass-header {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body class="antialiased text-slate-900">

    <div class="sticky top-0 z-50 bg-[#e0e7ff]/80 backdrop-blur-md pb-2">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 pt-3 sm:pt-6">
            <header class="glass-header border border-indigo-50 rounded-2xl px-4 py-3 sm:p-4 flex items-center justify-between shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                
                <div class="flex items-center gap-2 cursor-pointer" onclick="window.location='{{ route('beranda') }}'">
                    <svg width="28" height="28" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="6" y="22" width="10" height="10" rx="2" fill="#4F46E5"/>
                        <rect x="24" y="8" width="10" height="10" rx="2" fill="#1E293B"/>
                        <path d="M16 27C22 27 20 13 24 13" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-dasharray="2 2"/>
                        <path d="M22 15L24 13L22 11" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="text-lg font-bold tracking-tighter text-slate-900">
                        Vi<span class="text-indigo-600">logic</span>
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('beranda') }}" class="flex items-center gap-1.5 text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition duration-300 min-h-[44px]">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        <span class="hidden sm:inline">Beranda</span>
                    </a>
                </div>
            </header>
        </div>
    </div>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 pb-6">
        <div class="mb-6 mt-6 sm:mb-10 sm:mt-8">
            <span class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-3 sm:mb-4 block">Materi Pembelajaran</span>
            @yield('materi_title')
        </div>

        <div class="bg-white rounded-[2rem] sm:rounded-[2.5rem] p-4 sm:p-8 lg:p-12 border border-indigo-50 shadow-2xl shadow-indigo-100/20">
            <div class="prose max-w-none">
                @yield('content')
            </div>
        </div>

        {{-- E-Book Section --}}
        <div class="mt-8 sm:mt-12 bg-slate-900 rounded-[2rem] sm:rounded-[3rem] p-6 sm:p-8 md:p-10 text-white relative overflow-hidden shadow-2xl shadow-indigo-100/50 border border-slate-800 transition-all hover:border-indigo-500/30">
            <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            
            <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-6">
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 text-center sm:text-left">
                    <div class="hidden sm:flex bg-indigo-600/20 p-4 rounded-3xl border border-indigo-500/30 text-indigo-400 shrink-0">
                        <i data-lucide="file-text" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <h6 class="text-lg sm:text-xl font-bold mb-1 tracking-tight">E-Book Materi</h6>
                        <p class="text-slate-400 text-xs leading-relaxed max-w-sm">
                            Untuk materi yang lebih detail silahkan buka atau unduh e-book materi ini 
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                    <a href="{{ asset('dokumen/MateriStrukturData.pdf') }}" target="_blank" 
                    class="group flex items-center justify-center gap-2 bg-slate-800 hover:bg-slate-700 text-white px-5 py-3 rounded-xl font-bold transition-all border border-slate-700 text-xs min-h-[44px] w-full sm:w-auto">
                        <i data-lucide="eye" class="w-4 h-4 text-indigo-400"></i>
                        <span>Lihat Materi</span>
                    </a>

                    <a href="{{ asset('dokumen/MateriStrukturData.pdf') }}" download
                    class="group flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-lg shadow-indigo-500/20 text-xs min-h-[44px] w-full sm:w-auto">
                        <i data-lucide="download-cloud" class="w-4 h-4"></i>
                        <span>Unduh PDF</span>
                    </a>
                </div>
            </div>
        </div>
    </main>
    
    <footer class="text-center py-8 sm:py-12">
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em]">
            © 2026 Vilogic
        </p>
    </footer>

    <script>
      lucide.createIcons();
    </script>

    @yield('scripts')
</body>
</html>