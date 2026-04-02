<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vilogic</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Crect x='6' y='22' width='10' height='10' rx='2' fill='%234F46E5'/%3E%3Crect x='24' y='8' width='10' height='10' rx='2' fill='%231E293B'/%3E%3Cpath d='M16 27C22 27 20 13 24 13' stroke='%236366F1' stroke-width='2' stroke-linecap='round' stroke-dasharray='2 2'/%3E%3Cpath d='M22 15L24 13L22 11' stroke='%236366F1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8FAFC; }
        .card-gradient { background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); }
        .btn-gradient { background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 100%); }
        .glass-header { backdrop-filter: blur(16px); background: rgba(255, 255, 255, 0.8); }
    </style>
</head>

<body class="antialiased text-slate-900">

    <div class="sticky top-0 z-50 bg-[#F8FAFC] pb-2">
        <div class="max-w-7xl mx-auto px-6 pt-6">
            <header class="glass-header border border-indigo-50 rounded-2xl p-4 flex items-center justify-between shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2 group cursor-pointer">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="6" y="22" width="10" height="10" rx="2" fill="#4F46E5" class="group-hover:fill-indigo-500 transition-colors"/>
                            <rect x="24" y="8" width="10" height="10" rx="2" fill="#1E293B" class="group-hover:fill-slate-700 transition-colors"/>
                            <path d="M16 27C22 27 20 13 24 13" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-dasharray="2 2"/>
                            <path d="M22 15L24 13L22 11" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        
                        <span class="text-2xl font-bold tracking-tighter text-slate-900">
                            Vi<span class="text-indigo-600">logic</span>
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-6">
                        <div class="flex flex-col items-end gap-0">
                            <span class="text-[7px] text-slate-400 font-black uppercase tracking-[0.3em] leading-none mb-1">
                                Akses Guru
                            </span>
                            <a href="{{ route('login') }}" class="text-[13px] font-bold text-slate-600 hover:text-indigo-600 transition leading-none">
                                Masuk
                            </a>
                        </div>
                        <div class="h-8 w-[1px] bg-slate-200"></div>
                    </div>

                    <a href="{{ route('register') }}" class="px-7 py-3 bg-[#1e293b] text-white rounded-full text-[11px] font-extrabold hover:bg-slate-800 transition shadow-lg shadow-slate-200 uppercase tracking-widest">
                        Daftar
                    </a>
                </div>
            </header>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-6 pt-16 pb-24">
        
        <section class="text-center space-y-8">
            <h2 class="text-5xl lg:text-7xl font-extrabold tracking-tighter text-slate-900 leading-[1.1]">
                <span class="text-indigo-600">Vilogic</span>
            </h2>
            <h4 class="mt-4 text-3xl lg:text-4xl font-bold tracking-tight text-slate-600 leading-[1.2]">
                Belajar Struktur Data dengan Simulasi Interaktif
            </h4>
            
            <p class="text-slate-500 max-w-2xl mx-auto text-lg leading-relaxed">
                Pilih modul di bawah atau bergabung ke sesi belajar aktif untuk menyelesasikan tantangan dari guru
            </p>

            <form action="{{ route('student.join.check') }}" method="POST" class="max-w-lg mx-auto bg-white p-2 rounded-3xl shadow-2xl shadow-indigo-100/50 border border-indigo-50 flex items-center gap-2">
                @csrf
                <div class="flex items-center gap-3 pl-4 flex-1">
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                    <input type="text" name="session_code" placeholder="Masukkan Kode Sesi" class="w-full py-3 text-sm font-semibold outline-none text-slate-700 bg-transparent" required oninput="this.value = this.value.toUpperCase()">
                </div>
                <button type="submit" class="btn-gradient px-8 py-3.5 text-white rounded-2xl text-xs font-bold flex items-center gap-2 hover:opacity-95 transition shadow-lg shadow-indigo-200">
                    Mulai Belajar <span class="text-[10px]">▶</span>
                </button>
            </form>

            @if(session('error'))
                <div class="text-red-500 text-xs font-bold mt-2 animate-pulse">
                    ⚠️ {{ session('error') }}
                </div>
            @endif
        </section>

        <section id="materi" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pt-16">
            @php
                $modules = [
                    ['01', 'Pengantar Struktur Data', 'Gerbang masuk untuk belajar struktur data dari kegiatan sehari-hari.', 'theory'],
                    ['02', 'Konsep Struktur Data', 'Memahami definisi, fungsi, dan jenis struktur data.', 'theory'],
                    ['03', 'Materi List', 'Pelajari representasi data berurutan secara dinamis.', 'theory'],
                    ['04', 'Simulasi List', 'Visualisasi interaktif penambahan & penghapusan pada List.', 'simulation'],
                    ['05', 'Materi Queue', 'Pahami konsep antrean dengan prinsip First In First Out (FIFO).', 'theory'],
                    ['06', 'Simulasi Queue', 'Lihat bagaimana data masuk dan keluar dalam antrean secara visual.', 'simulation'],
                    ['07', 'Materi Stack', 'Pahami konsep tumpukan dengan prinsip Last In First Out (LIFO).', 'theory'],
                    ['08', 'Simulasi Stack', 'Simulasikan proses Push dan Pop pada tumpukan data.', 'simulation'],
                    ['09', 'Simulasi Sistem', 'Studi kasus implementasi struktur data pada sistem antrean TU.', 'simulation'],
                ];
            @endphp

            @foreach($modules as $item)
                @php 
                    $isSim = $item[3] === 'simulation';
                    // Membuat slug/URL manual
                    $urlName = Str::slug($item[1]); 
                @endphp
                
                <a href="{{ url('/materi/' . $urlName) }}" class="group relative card-gradient rounded-[2.5rem] p-10 text-white shadow-2xl shadow-indigo-200/40 flex flex-col justify-between h-[340px] overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-indigo-400/40 border-none">
                    
                    {{-- Ikon Background Dekoratif --}}
                    <div class="absolute top-8 right-8 opacity-10 transition-transform group-hover:scale-110 duration-500">
                        @if($isSim)
                            <svg class="w-28 h-28 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/>
                            </svg>
                        @else
                            <svg class="w-28 h-28 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                            </svg>
                        @endif
                    </div>

                    <div class="relative z-10">
                        {{-- Badge Nomor --}}
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center mb-6 backdrop-blur-md border border-white/20">
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-white">{{ $item[0] }}</span>
                        </div>
                        
                        <h3 class="text-3xl font-extrabold mb-4 leading-tight tracking-tight text-white">{{ $item[1] }}</h3>
        
                        <p class="text-indigo-50/80 text-sm leading-relaxed max-w-[220px]">
                            {{ $item[2] }}
                        </p>
                    </div>

                    <div class="relative z-10 flex items-center justify-between">
                        <span class="text-[9px] font-black uppercase tracking-[0.2em] opacity-50 text-white">
                            {{ $isSim ? 'Mulai Simulasi' : 'Eksplorasi Materi' }}
                        </span>
                        <div class="w-11 h-11 rounded-2xl bg-white/20 border border-white/30 flex items-center justify-center text-white group-hover:bg-white group-hover:text-indigo-600 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </section>
    
    </main>

    <footer class="text-center py-12">
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em]">© 2026 Vilogic</p>
    </footer>
</body>
</html>