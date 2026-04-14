@extends('layouts.materi')

@section('title', 'Vilogic - Materi Queue')

@section('materi_title')
    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Struktur Data <span class="text-indigo-600">Queue</span>
    </h1>
@endsection

@section('content')
    <div class="mb-16 mt-4">
        <h5 class="text-2xl font-extrabold text-slate-800 mb-6 flex items-center gap-3">
            <i data-lucide="info" class="text-indigo-600"></i> Apa itu Queue?
        </h5>
        <div class="ml-0 md:ml-10 space-y-6">
            <p class="!text-base text-slate-600 leading-relaxed border-l-4 border-indigo-500 ps-6">
                <b>Queue</b> (Antrean) adalah struktur data linear yang mengikuti prinsip <b class="text-indigo-600 italic">FIFO (First In First Out)</b>. Artinya, elemen yang pertama kali masuk adalah yang pertama kali akan keluar atau diproses.
            </p>
            
            <div class="bg-indigo-50 p-6 rounded-3xl border border-indigo-100 flex gap-4 items-start transition-all hover:shadow-md">
                <div class="bg-indigo-600 p-2 rounded-lg shrink-0 shadow-lg shadow-indigo-200">
                    <i data-lucide="users" class="text-white w-5 h-5"></i>
                </div>
                <p class="!text-sm text-indigo-900 leading-relaxed">
                    <b>Analogi:</b> Bayangkan antrean murid di layanan TU. Murid yang datang paling awal akan dilayani terlebih dahulu, sementara murid yang baru datang harus menunggu di barisan paling belakang.
                </p>
            </div>
        </div>
    </div>

    <div class="mb-16">
        <h5 class="text-2xl font-extrabold text-slate-800 mb-8 flex items-center gap-3">
            <i data-lucide="activity" class="text-indigo-600"></i> Operasi Dasar Queue
        </h5>
        
        <div class="ml-0 md:ml-10 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition-all hover:border-indigo-200 group">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 font-bold group-hover:scale-110 transition-transform">
                    <i data-lucide="log-in" class="w-6 h-6"></i>
                </div>
                <h6 class="font-bold text-slate-800 mb-2">1. Enqueue</h6>
                <p class="text-slate-500 !text-sm leading-relaxed">Menambahkan data atau elemen baru ke posisi paling belakang (<i>rear</i>) dari antrean.</p>
            </div>

            <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition-all hover:border-rose-200 group">
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mb-4 font-bold group-hover:scale-110 transition-transform">
                    <i data-lucide="log-out" class="w-6 h-6"></i>
                </div>
                <h6 class="font-bold text-slate-800 mb-2">2. Dequeue</h6>
                <p class="text-slate-500 !text-sm leading-relaxed">Menghapus atau mengambil data dari posisi paling depan (<i>front</i>) antrean.</p>
            </div>

            <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition-all hover:border-amber-200 group">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-4 font-bold group-hover:scale-110 transition-transform">
                    <i data-lucide="eye" class="w-6 h-6"></i>
                </div>
                <h6 class="font-bold text-slate-800 mb-2">3. Front</h6>
                <p class="text-slate-500 !text-sm leading-relaxed">Melihat data yang berada di posisi terdepan tanpa menghapusnya dari antrean.</p>
            </div>

            <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition-all hover:border-slate-300 group">
                <div class="w-12 h-12 bg-slate-50 text-slate-600 rounded-2xl flex items-center justify-center mb-4 font-bold group-hover:scale-110 transition-transform">
                    <i data-lucide="help-circle" class="w-6 h-6"></i>
                </div>
                <h6 class="font-bold text-slate-800 mb-2">4. IsEmpty</h6>
                <p class="text-slate-500 !text-sm leading-relaxed">Mengecek apakah antrean dalam kondisi kosong atau masih berisi data.</p>
            </div>
        </div>
    </div>

    <div class="mb-16 bg-slate-900 rounded-[3rem] p-8 md:p-12 text-white relative overflow-hidden shadow-2xl shadow-indigo-100">
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
        
        <div class="relative z-10 space-y-4">
            <h5 class="text-2xl font-bold flex items-center gap-3">
                <i data-lucide="zap" class="text-indigo-400"></i> Mengapa Queue Penting?
            </h5>
            <p class="text-slate-300 !text-base leading-relaxed">
                Queue menjamin <span class="text-indigo-400 font-bold italic">keadilan</span> dalam pemrosesan data. Dalam pemrograman, Queue digunakan untuk manajemen printer, pengaturan lalu lintas data jaringan, hingga penjadwalan tugas (scheduling) pada sistem operasi.
            </p>
        </div>
    </div>

    <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
        <a href="{{ url('/materi/operasi-list') }}" class="group text-slate-400 hover:text-indigo-600 font-bold flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Operasi List
        </a>
         <a href="{{ url('/materi/simulasi-queue') }}" class="group flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-200">
            Lanjut ke Simulasi Queue
            <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
@endsection