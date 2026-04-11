@extends('layouts.materi')

@section('title', 'Vilogic - Konsep Struktur Data')

@section('materi_title')
    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Konsep <span class="text-indigo-600">Struktur Data</span>
    </h1>
@endsection
@section('content')
    <div class="mb-16 mt-4">
        <h5 class="text-2xl font-extrabold text-slate-800 mb-6 flex items-center gap-3">
            <i data-lucide="info" class="text-indigo-600"></i>Pengertian Struktur Data
        </h5>
        <div class="ml-0 md:ml-10 space-y-6">
            <p class="!text-base text-slate-600 leading-relaxed border-l-4 border-indigo-500 ps-6">
                Dalam pemrograman, data merupakan komponen utama. Namun, data saja tidak cukup. Data perlu diatur agar dapat digunakan secara efektif. <b>Struktur data</b> adalah metode untuk mengorganisasikan data di dalam komputer sehingga dapat disimpan, diakses, dan diperbarui dengan lebih mudah.
            </p>
            <div class="bg-indigo-50/50 p-6 rounded-3xl border border-indigo-100 italic">
                <p class="!text-base text-slate-700 leading-relaxed">
                    "Bayangkan layanan Tata Usaha (TU). Tanpa pengelolaan yang baik, antrean menjadi tidak tertib dan data murid sulit ditemukan. Struktur data membantu menyelesaikan masalah ini secara sistematis."
                </p>
            </div>
        </div>
    </div>

    <div class="mb-16">
        <h5 class="text-xl font-bold text-slate-800 mb-8 flex items-center gap-2">
            <i data-lucide="layers" class="text-indigo-600"></i>Fungsi Struktur Data
        </h5>
        <div class="ml-0 md:ml-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition group">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i data-lucide="zap"></i>
                    </div>
                    <h6 class="font-bold text-slate-800 mb-2">1. Meningkatkan Efisiensi</h6>
                    <p class="text-slate-500 !text-sm leading-relaxed">Optimalisasi penggunaan memori dan waktu proses, terutama saat mengelola data dalam jumlah banyak.</p>
                </div>
                <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition group">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i data-lucide="layout-list"></i>
                    </div>
                    <h6 class="font-bold text-slate-800 mb-2">2. Mempermudah Pengelolaan</h6>
                    <p class="text-slate-500 !text-sm leading-relaxed">Proses menambah, menghapus, dan memperbarui data menjadi lebih teratur dan tidak membingungkan.</p>
                </div>
                <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition group">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i data-lucide="git-branch"></i>
                    </div>
                    <h6 class="font-bold text-slate-800 mb-2">3. Mendukung Pengembangan</h6>
                    <p class="text-slate-500 !text-sm leading-relaxed">Program lebih mudah dipahami oleh pengembang untuk perbaikan maupun pengembangan lanjutan.</p>
                </div>
                <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition group">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i data-lucide="shield-alert"></i>
                    </div>
                    <h6 class="font-bold text-slate-800 mb-2">4. Mengurangi Kesalahan</h6>
                    <p class="text-slate-500 !text-sm leading-relaxed">Meminimalisir kemungkinan kesalahan pada proses input, pengolahan, maupun output data.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-16">
        <h5 class="text-xl font-bold text-slate-800 mb-8 flex items-center gap-2">
            <i data-lucide="component" class="text-indigo-600"></i>Klasifikasi Struktur Data
        </h5>
        <div class="ml-0 md:ml-10 space-y-8">
            <p class="!text-base text-slate-600 leading-relaxed">
                Berdasarkan penyusunannya, struktur data dibagi menjadi dua kategori utama:
            </p>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-indigo-600 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-xl shadow-indigo-100">
                    <div class="relative z-10">
                        <div class="inline-block px-4 py-1 bg-white/20 backdrop-blur-md rounded-full !text-[10px] font-black uppercase tracking-widest mb-4">Fokus Pembelajaran</div>
                        <h6 class="text-2xl font-bold mb-4">Struktur Data Linear</h6>
                        <p class="!text-sm leading-relaxed opacity-90 mb-6">
                            Elemen disusun secara <b>berurutan dalam satu garis</b> lurus. Setiap elemen memiliki hubungan langsung dengan elemen sebelum dan sesudahnya.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 !text-sm font-semibold bg-white/10 p-3 rounded-2xl border border-white/10">
                                <i data-lucide="check-circle" class="w-4 h-4"></i> List (Daftar)
                            </li>
                            <li class="flex items-center gap-3 !text-sm font-semibold bg-white/10 p-3 rounded-2xl border border-white/10">
                                <i data-lucide="check-circle" class="w-4 h-4"></i> Stack (Tumpukan - LIFO)
                            </li>
                            <li class="flex items-center gap-3 !text-sm font-semibold bg-white/10 p-3 rounded-2xl border border-white/10">
                                <i data-lucide="check-circle" class="w-4 h-4"></i> Queue (Antrean - FIFO)
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-slate-50 rounded-[2.5rem] p-8 border border-slate-200 group transition-all">
                    <div class="inline-block px-4 py-1 bg-slate-200 text-slate-600 rounded-full !text-[10px] font-black uppercase tracking-widest mb-4">Materi Lanjutan</div>
                    <h6 class="text-2xl font-bold text-slate-800 mb-4 group-hover:text-indigo-600 transition-colors">Struktur Data Non-Linear</h6>
                    <p class="!text-sm text-slate-500 leading-relaxed mb-6">
                        Elemen tidak disusun berurutan, melainkan memiliki hubungan kompleks seperti <b>bercabang atau saling terhubung</b>.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-white rounded-2xl border border-slate-100 text-center">
                            <i data-lucide="network" class="w-8 h-8 text-slate-300 mx-auto mb-2"></i>
                            <span class="!text-xs font-bold text-slate-400">TREE</span>
                        </div>
                        <div class="p-4 bg-white rounded-2xl border border-slate-100 text-center">
                            <i data-lucide="share-2" class="w-8 h-8 text-slate-300 mx-auto mb-2"></i>
                            <span class="!text-xs font-bold text-slate-400">GRAPH</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-16">
        <h5 class="text-xl font-bold text-slate-800 mb-8 flex items-center gap-2">
            <i data-lucide="component" class="text-indigo-600"></i>Karakteristik Struktur Data Linear
        </h5>
        <div class="ml-0 md:ml-10 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-8 bg-white border border-slate-100 rounded-[2rem] shadow-sm flex flex-col items-center text-center">
                <span class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-black mb-4">1</span>
                <h6 class="font-bold text-slate-800 !text-sm mb-2 uppercase">Berurutan</h6>
                <p class="text-slate-500 !text-[12px] leading-relaxed">Data dapat diakses berdasarkan posisi atau indeksnya.</p>
            </div>
            <div class="p-8 bg-white border border-slate-100 rounded-[2rem] shadow-sm flex flex-col items-center text-center">
                <span class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-black mb-4">2</span>
                <h6 class="font-bold text-slate-800 !text-sm mb-2 uppercase">Terhubung</h6>
                <p class="text-slate-500 !text-[12px] leading-relaxed">Setiap elemen terhubung dengan elemen sebelum dan sesudahnya.</p>
            </div>
            <div class="p-8 bg-white border border-slate-100 rounded-[2rem] shadow-sm flex flex-col items-center text-center">
                <span class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-black mb-4">3</span>
                <h6 class="font-bold text-slate-800 !text-sm mb-2 uppercase">Aturan Khusus</h6>
                <p class="text-slate-500 !text-[12px] leading-relaxed">Memiliki aturan pengelolaan data tersendiri (LIFO/FIFO).</p>
            </div>
        </div>
    </div>

    <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
        <a href="{{ url('/materi/pengantar-struktur-data') }}" class="group text-slate-400 hover:text-indigo-600 font-bold flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Pengantar
        </a>
        <a href="{{ url('/materi/materi-list') }}" class="group flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-200">
            Lanjut ke Materi List
            <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
@endsection