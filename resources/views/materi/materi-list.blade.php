@extends('layouts.materi')

@section('title', 'Vilogic - Materi List')

@section('materi_title')
    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Struktur Data <span class="text-indigo-600">List</span>
    </h1>
@endsection

@section('content')
    <div class="mb-16 mt-4">
        <h5 class="text-2xl font-extrabold text-slate-800 mb-6 flex items-center gap-3">
            <i data-lucide="book-open" class="text-indigo-600"></i> Pengertian List
        </h5>
        <div class="ml-0 md:ml-10 space-y-6">
            <p class="!text-base text-slate-600 leading-relaxed border-l-4 border-indigo-500 ps-6">
                <b>List</b> merupakan salah satu struktur data paling dasar di Python yang digunakan untuk menyimpan sekumpulan data dalam satu variabel. Dengan List, kita bisa mengelola banyak data sekaligus secara lebih mudah dan terorganisir.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <div class="p-6 bg-emerald-50 border border-emerald-100 rounded-3xl transition-all hover:shadow-md">
                    <h6 class="font-bold text-emerald-800 !text-sm flex items-center gap-2 mb-2">
                        <i data-lucide="edit-3" class="w-4 h-4"></i> Dapat Diedit
                    </h6>
                    <p class="!text-sm text-emerald-700 leading-relaxed">
                        Data di dalam List tidak bersifat permanen. Kamu bisa <b>mengganti, menambah, atau menghapus</b> isinya kapan saja saat program sedang berjalan.
                    </p>
                </div>
                <div class="p-6 bg-indigo-50 border border-indigo-100 rounded-3xl transition-all hover:shadow-md">
                    <h6 class="font-bold text-indigo-800 !text-sm flex items-center gap-2 mb-2">
                        <i data-lucide="layers" class="w-4 h-4"></i> Fleksibel
                    </h6>
                    <p class="!text-sm text-indigo-700 leading-relaxed">
                        Dapat menyimpan berbagai jenis data (angka, teks, atau kombinasi keduanya) dan jumlah elemennya dapat berubah sesuai kebutuhan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-16">
        <h5 class="text-2xl font-extrabold text-slate-800 mb-6 flex items-center gap-3">
            <i data-lucide="cpu" class="text-indigo-600"></i> Cara Kerja & Indeks
        </h5>
        <div class="ml-0 md:ml-10 space-y-8">
            <p class="!text-base text-slate-600 leading-relaxed text-justify">
                List bekerja dengan cara menyimpan data secara berurutan di dalam suatu wadah. Data di dalamnya disebut <b>elemen</b>. Agar setiap elemen mudah dikenali dan diakses, setiap posisi diberi nomor urut yang disebut <b>Indeks</b>.
            </p>

            <div class="overflow-hidden border border-slate-200 rounded-[2rem] shadow-sm bg-white">
                <table class="w-full text-center !text-base">
                    <tr class="bg-indigo-600 text-white font-bold">
                        <td class="p-5 border-r border-indigo-500 uppercase tracking-widest text-[10px]">Elemen Data</td>
                        <td class="p-5 border-r border-indigo-500 italic">"Andi"</td>
                        <td class="p-5 border-r border-indigo-500 italic">"Budi"</td>
                        <td class="p-5 italic">"Citra"</td>
                    </tr>
                    <tr class="bg-white text-slate-700">
                        <td class="p-5 border-r border-b font-bold bg-slate-50 text-[10px] text-slate-400">INDEKS POSITIF</td>
                        <td class="p-5 border-r border-b text-indigo-600 font-black text-xl">0</td>
                        <td class="p-5 border-r border-b text-indigo-600 font-black text-xl">1</td>
                        <td class="p-5 border-b text-indigo-600 font-black text-xl">2</td>
                    </tr>
                    <tr class="bg-slate-50/50 text-slate-500">
                        <td class="p-5 border-r font-bold bg-slate-50 text-[10px] text-slate-400">INDEKS NEGATIF</td>
                        <td class="p-5 border-r font-bold text-lg">-3</td>
                        <td class="p-5 border-r font-bold text-lg">-2</td>
                        <td class="p-5 font-bold text-lg">-1</td>
                    </tr>
                </table>
            </div>

            <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200 flex gap-4 items-start">
                <div class="bg-slate-800 p-2 rounded-lg shrink-0">
                    <i data-lucide="lightbulb" class="text-amber-400 w-5 h-5"></i>
                </div>
                <p class="!text-sm text-slate-600 leading-relaxed">
                    <b>Catatan Indeks:</b> Dalam Python, penomoran dimulai dari angka <strong>0</strong> (bukan 1). Elemen pertama berada pada indeks ke-0, kedua pada indeks ke-1, dan seterusnya.
                </p>
            </div>
        </div>
    </div>

    <div class="mb-16">
        <h5 class="text-xl font-bold text-slate-800 mb-8 flex items-center gap-2">
            <i data-lucide="zap" class="text-indigo-600"></i> Operasi Dasar List
        </h5>
        
        <div class="ml-0 md:ml-10 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition-all hover:border-indigo-200">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-4 font-bold">
                    1
                </div>
                <h6 class="font-bold text-slate-800 mb-2">Menambah Data</h6>
                <p class="text-slate-500 !text-sm leading-relaxed">Menambahkan elemen baru menggunakan fungsi seperti <code>append()</code> atau <code>insert()</code>.</p>
            </div>

            <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition-all hover:border-indigo-200">
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mb-4 font-bold">
                    2
                </div>
                <h6 class="font-bold text-slate-800 mb-2">Menghapus Data</h6>
                <p class="text-slate-500 !text-sm leading-relaxed">Menghilangkan elemen berdasarkan nilai atau indeks tertentu dengan <code>remove()</code> atau <code>pop()</code>.</p>
            </div>
            
            <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition-all hover:border-indigo-200">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-4 font-bold">
                    3
                </div>
                <h6 class="font-bold text-slate-800 mb-2">Mengubah Data</h6>
                <p class="text-slate-500 !text-sm leading-relaxed">Mengganti nilai pada indeks tertentu secara langsung</p>
            </div>

            <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition-all hover:border-indigo-200">
                <div class="w-12 h-12 bg-sky-50 text-sky-600 rounded-2xl flex items-center justify-center mb-4 font-bold">
                    4
                </div>
                <h6 class="font-bold text-slate-800 mb-2">Menelusuri Data</h6>
                <p class="text-slate-500 !text-sm leading-relaxed">Membaca atau menampilkan semua isi List satu per satu menggunakan perulangan (looping).</p>
            </div>
        </div>
    </div>

    <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
        <a href="{{ url('/materi/konsep-struktur-data') }}" class="group text-slate-400 hover:text-indigo-600 font-bold flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Konsep Struktur Data
        </a>
         <a href="{{ url('/materi/simulasi-list') }}" class="group flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-200">
            Lanjut ke Simulasi List
            <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
@endsection