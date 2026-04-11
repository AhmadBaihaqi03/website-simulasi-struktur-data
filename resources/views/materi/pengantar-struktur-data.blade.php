@extends('layouts.materi')

@section('title', 'Vilogic - Pengantar Struktur Data')

@section('materi_title')
    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Pengantar <span class="text-indigo-600">Struktur Data</span>
    </h1>
@endsection

@section('content')
    <div class="mb-10">
        <p class="text-xl text-slate-600 border-l-4 border-indigo-600 ps-6 italic leading-relaxed">
            Dalam aktivitas di sekolah seperti di Tata Usaha (TU), pengelolaan data adalah hal yang tidak bisa dihindari. 
            Ternyata, proses rutin ini membutuhkan <span class="text-indigo-600 font-semibold">ketelitian dan keteraturan</span> yang berkaitan erat dengan konsep pemrograman.
        </p>
    </div>

    <div class="mb-12">
        <h5 class="flex items-center gap-3 font-bold text-slate-800 text-lg">
            <i data-lucide="book-marked" class="text-indigo-600"></i> Studi Kasus: Administrasi Sekolah
        </h5>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 hover:shadow-md transition-all">
                <i data-lucide="user-plus" class="text-indigo-500 mb-4 w-8 h-8"></i>
                <h6 class="font-bold text-slate-800 mb-2">Pencatatan</h6>
                <p class="!text-base text-slate-500 leading-relaxed">Mendata murid yang datang agar informasi tetap akurat dan sistematis.</p>
            </div>
            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 hover:shadow-md transition-all">
                <i data-lucide="timer" class="text-indigo-500 mb-4 w-8 h-8"></i>
                <h6 class="font-bold text-slate-800 mb-2">Antrean</h6>
                <p class="!text-base text-slate-500 leading-relaxed">Mengatur urutan pelayanan agar tetap tertib, adil, dan efisien.</p>
            </div>
            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 hover:shadow-md transition-all">
                <i data-lucide="refresh-ccw" class="text-indigo-500 mb-4 w-8 h-8"></i>
                <h6 class="font-bold text-slate-800 mb-2">Koreksi</h6>
                <p class="!text-base text-slate-500 leading-relaxed">Memperbaiki kesalahan input data dengan mengembalikan ke kondisi sebelumnya.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <div class="p-6 bg-red-50 border-l-4 border-red-500 rounded-r-2xl">
            <h6 class="font-bold text-red-700 flex items-center gap-2 mb-3 text-sm uppercase tracking-wider">
                <i data-lucide="alert-triangle" class="w-4 h-4"></i> Dampak Masalah Manual
            </h6>
            <ul class="!text-base text-red-600/90 space-y-2 list-disc ps-5">
                <li>Antrean tidak tertib (Ketidakadilan pelayanan).</li>
                <li>Data tidak akurat dan berisiko ganda.</li>
                <li>Kesulitan melacak riwayat perbaikan data.</li>
            </ul>
        </div>
        <div class="p-6 bg-green-50 border-l-4 border-green-500 rounded-r-2xl">
            <h6 class="font-bold text-green-700 flex items-center gap-2 mb-3 text-sm uppercase tracking-wider">
                <i data-lucide="zap" class="w-4 h-4"></i> Keunggulan Struktur Data
            </h6>
            <ul class="!text-base text-green-600/90 space-y-2 list-disc ps-5">
                <li>Penyimpanan data yang sistematis dan terorganisir.</li>
                <li>Akses dan manipulasi data menjadi lebih cepat.</li>
                <li>Memudahkan pengembangan sistem digital yang lebih luas.</li>
            </ul>
        </div>
    </div>

    <div class="mb-12 bg-indigo-50/50 p-6 md:p-8 rounded-[2rem] border border-indigo-100 shadow-sm">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            
            <div class="lg:col-span-3 flex flex-col">
                <h6 class="font-bold text-indigo-900 mb-6 flex items-center gap-3 text-lg underline decoration-indigo-200 underline-offset-8">
                    <i data-lucide="target" class="w-6 h-6 text-indigo-600"></i> Tujuan Pembelajaran
                </h6>
                <ul class="space-y-4 flex-grow">
                    <li class="flex items-start gap-4">
                        <span class="bg-indigo-600 text-white w-7 h-7 rounded-full flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold shadow-md shadow-indigo-100">1</span>
                        <p class="leading-relaxed !text-base text-slate-700">Murid mampu menjelaskan konsep dan karakteristik struktur data <b>list, stack, dan queue</b>.</p>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="bg-indigo-600 text-white w-7 h-7 rounded-full flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold shadow-md shadow-indigo-100">2</span>
                        <p class="leading-relaxed !text-base text-slate-700">Murid mampu menentukan penggunaan struktur data <b>list, stack, dan queue</b> yang sesuai pada permasalahan dalam kehidupan sehari-hari.</p>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="bg-indigo-600 text-white w-7 h-7 rounded-full flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold shadow-md shadow-indigo-100">3</span>
                        <p class="leading-relaxed !text-base text-slate-600 italic">Murid mampu menerapkan struktur data list, stack, dan queue dalam <b class="text-indigo-600">bahasa Python</b> untuk menyelesaikan permasalahan sederhana.</p>
                    </li>
                </ul>
            </div>

            <div class="lg:col-span-2 flex flex-col">
                <h6 class="font-bold text-indigo-900 mb-6 flex items-center gap-3 text-lg">
                    <i data-lucide="sparkles" class="w-6 h-6 text-indigo-600"></i> Manfaat Untukmu
                </h6>
                <div class="bg-white p-6 rounded-3xl border border-indigo-100 shadow-sm relative overflow-hidden flex-grow flex items-center">
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-indigo-50 rounded-full blur-2xl opacity-60"></div>
                    <p class="!text-base text-slate-600 leading-relaxed italic relative z-10 text-left">
                        "Pembelajaran ini melatihmu berpikir 
                        <span class="text-indigo-600 font-bold uppercase tracking-widest text-[10px] bg-indigo-50 px-2 py-0.5 rounded mx-1 inline-block">logis & sistematis</span>, 
                        serta mampu merancang solusi berbasis teknologi."
                    </p>
                </div>
            </div>
        </div>
    </div>

    <p class="!text-base text-slate-600 leading-relaxed border-l-4 border-indigo-600 ps-6 mb-12">
        Di sini, kita akan mempelajari <b>List, Stack, dan Queue</b> dengan menggunakan bahasa <b>Python</b>. 
        Ketiganya akan kita gunakan untuk membuat sistem antrean. Yuk, kita mulai!
    </p>

    <div class="mt-12 pt-8 border-t border-slate-100 flex justify-end">
        <a href="{{ url('/materi/konsep-struktur-data') }}" class="group flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-200">
            Lanjut ke Konsep Struktur Data
            <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
@endsection