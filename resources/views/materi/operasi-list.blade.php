@extends('layouts.materi')

@section('title', 'Vilogic - Sintaks Python List')

@section('materi_title')
    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Sintaks Python <span class="text-indigo-600">List</span>
    </h1>
@endsection

@section('content')
<div class="space-y-12">
    
    <div class="bg-slate-900 rounded-[3rem] p-8 md:p-12 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
        <div class="relative z-10">
            <h5 class="text-2xl font-bold mb-4 flex items-center gap-3">
                <i data-lucide="terminal" class="text-indigo-400"></i> Implementasi Kode
            </h5>
            <p class="text-slate-300 leading-relaxed">
                Sekarang saatnya kita melihat bagaimana operasi List yang kamu coba di simulasi tadi ditulis dalam bahasa pemrograman Python. Kita akan menggunakan contoh kasus Layanan TU Sekolah.
            </p>
        </div>
    </div>

    <section class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">1</div>
            <h3 class="text-xl font-bold text-slate-800">Membuat List & Menambah Data</h3>
        </div>
        <div class="ml-0 md:ml-14 space-y-4">
            <p class="text-slate-600 text-sm">
                Gunakan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">append()</code> untuk menambah di akhir, atau <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">insert(index, nilai)</code> untuk posisi tertentu.
            </p>
            <div class="bg-[#1e1e1e] rounded-2xl p-6 font-mono text-sm shadow-xl border border-slate-800">
                <div class="flex gap-2 mb-4 border-b border-slate-800 pb-2">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                </div>
                <pre class="text-blue-300"># Membuat list awal</pre>
                <pre class="text-white">layanan_tu = []</pre>
                <br>
                <pre class="text-blue-300"># Menambahkan data di akhir</pre>
                <pre class="text-white">layanan_tu.<span class="text-yellow-400">append</span>(<span class="text-emerald-400">"Legalisir Ijazah"</span>)</pre>
                <pre class="text-white">layanan_tu.<span class="text-yellow-400">append</span>(<span class="text-emerald-400">"Surat Aktif"</span>)</pre>
                <br>
                <pre class="text-blue-300"># Menyisipkan di indeks 1</pre>
                <pre class="text-white">layanan_tu.<span class="text-yellow-400">insert</span>(<span class="text-orange-400">1</span>, <span class="text-emerald-400">"Cetak Kartu"</span>)</pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">2</div>
            <h3 class="text-xl font-bold text-slate-800">Mengubah Data (Update)</h3>
        </div>
        <div class="ml-0 md:ml-14 space-y-4">
            <p class="text-slate-600 text-sm">
                Cukup panggil nomor indeksnya, lalu masukkan nilai baru menggunakan operator sama dengan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">=</code>.
            </p>
            <div class="bg-[#1e1e1e] rounded-2xl p-6 font-mono text-sm shadow-xl border border-slate-800">
                <pre class="text-blue-300"># Mengubah data pada indeks 0</pre>
                <pre class="text-white">layanan_tu[<span class="text-orange-400">0</span>] = <span class="text-emerald-400">"Legalisir Rapor"</span></pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">3</div>
            <h3 class="text-xl font-bold text-slate-800">Menghapus Data (Delete)</h3>
        </div>
        <div class="ml-0 md:ml-14 space-y-4">
            <p class="text-slate-600 text-sm">
                Gunakan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">remove()</code> untuk hapus lewat nama, atau <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">del</code> untuk hapus lewat posisi (indeks).
            </p>
            <div class="bg-[#1e1e1e] rounded-2xl p-6 font-mono text-sm shadow-xl border border-slate-800">
                <pre class="text-blue-300"># Hapus berdasarkan nama data</pre>
                <pre class="text-white">layanan_tu.<span class="text-yellow-400">remove</span>(<span class="text-emerald-400">"Cetak Kartu"</span>)</pre>
                <br>
                <pre class="text-blue-300"># Hapus berdasarkan nomor indeks</pre>
                <pre class="text-white"><span class="text-purple-400">del</span> layanan_tu[<span class="text-orange-400">1</span>]</pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">4</div>
            <h3 class="text-xl font-bold text-slate-800">Menampilkan Semua Data (Traversal)</h3>
        </div>
        <div class="ml-0 md:ml-14 space-y-4">
            <p class="text-slate-600 text-sm">
                Gunakan perulangan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">for</code> untuk mencetak satu per satu elemen yang ada di dalam List.
            </p>
            <div class="bg-[#1e1e1e] rounded-2xl p-6 font-mono text-sm shadow-xl border border-slate-800">
                <pre class="text-white"><span class="text-purple-400">for</span> layanan <span class="text-purple-400">in</span> layanan_tu:</pre>
                <pre class="text-white">    <span class="text-yellow-400">print</span>(<span class="text-emerald-400">"-"</span>, layanan)</pre>
            </div>
        </div>
    </section>

    <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
        <a href="{{ url('/materi/Simulasi-list') }}" class="group text-slate-400 hover:text-indigo-600 font-bold flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Simulasi List
        </a>
         <a href="{{ url('/materi/materi-queue') }}" class="group flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-200">
            Lanjut ke Materi Queue
            <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
</div>
@endsection