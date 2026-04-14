@extends('layouts.materi')

@section('title', 'Vilogic - Sintaks Python Queue')

@section('materi_title')
    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Sintaks Python <span class="text-indigo-600">Queue</span>
    </h1>
@endsection

@section('content')
<div class="space-y-12">
    
    <div class="bg-slate-900 rounded-[3rem] p-8 md:p-12 text-white relative overflow-hidden shadow-2xl shadow-indigo-100">
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
        <div class="relative z-10 text-center md:text-left">
            <h5 class="text-2xl font-bold mb-4 flex items-center justify-center md:justify-start gap-3">
                <i data-lucide="terminal" class="text-indigo-400"></i> Implementasi Antrean
            </h5>
            <p class="text-slate-300 leading-relaxed max-w-3xl">
                Dalam Python, kita bisa menggunakan struktur data <strong>List</strong> untuk menerapkan konsep <strong>Queue</strong>. Kuncinya ada pada cara kita menambah data di belakang dan menghapus data dari depan.
            </p>
        </div>
    </div>

    <section class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">1</div>
            <h3 class="text-xl font-bold text-slate-800">Enqueue (Tambah ke Belakang)</h3>
        </div>
        <div class="ml-0 md:ml-14 space-y-4">
            <p class="text-slate-600 text-sm">
                Sama seperti List, kita gunakan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">append()</code>. Fungsi ini otomatis meletakkan data di urutan paling akhir (Rear).
            </p>
            <div class="bg-[#1e1e1e] rounded-2xl p-6 font-mono text-sm shadow-xl border border-slate-800">
                <pre class="text-blue-300"># Membuat queue kosong</pre>
                <pre class="text-white">antrian = []</pre>
                <br>
                <pre class="text-blue-300"># Menambahkan Murid A, B, dan C ke belakang</pre>
                <pre class="text-white">antrian.<span class="text-yellow-400">append</span>(<span class="text-emerald-400">"Murid A"</span>)</pre>
                <pre class="text-white">antrian.<span class="text-yellow-400">append</span>(<span class="text-emerald-400">"Murid B"</span>)</pre>
                <pre class="text-white">antrian.<span class="text-yellow-400">append</span>(<span class="text-emerald-400">"Murid C"</span>)</pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">2</div>
            <h3 class="text-xl font-bold text-slate-800">Front (Melihat Data Terdepan)</h3>
        </div>
        <div class="ml-0 md:ml-14 space-y-4">
            <p class="text-slate-600 text-sm">
                Karena antrean dimulai dari depan, maka data yang akan dilayani selalu berada pada <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">index [0]</code>.
            </p>
            <div class="bg-[#1e1e1e] rounded-2xl p-6 font-mono text-sm shadow-xl border border-slate-800">
                <pre class="text-blue-300"># Mengintip siapa yang ada di depan</pre>
                <pre class="text-white"><span class="text-yellow-400">print</span>(antrian[<span class="text-orange-400">0</span>])  <span class="text-slate-500"># Output: Murid A</span></pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">3</div>
            <h3 class="text-xl font-bold text-slate-800">Dequeue (Hapus dari Depan)</h3>
        </div>
        <div class="ml-0 md:ml-14 space-y-4">
            <p class="text-slate-600 text-sm">
                Gunakan fungsi <code class="bg-slate-100 px-2 py-1 rounded text-rose-600 font-bold">pop(0)</code>. Angka 0 wajib diisi agar Python menghapus elemen terdepan, bukan terakhir.
            </p>
            
            <div class="bg-[#1e1e1e] rounded-2xl p-6 font-mono text-sm shadow-xl border border-slate-800">
                <pre class="text-blue-300"># Menghapus elemen paling depan (Index 0)</pre>
                <pre class="text-white">antrian.<span class="text-yellow-400">pop</span>(<span class="text-orange-400">0</span>)</pre>
                <pre class="text-blue-300"># Sekarang Murid B pindah ke posisi depan</pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">4</div>
            <h3 class="text-xl font-bold text-slate-800">Pengecekan & Perulangan</h3>
        </div>
        <div class="ml-0 md:ml-14 space-y-4">
            <p class="text-slate-600 text-sm">
                Kita bisa mengecek panjang antrean dengan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">len()</code> dan menampilkannya dengan perulangan.
            </p>
            <div class="bg-[#1e1e1e] rounded-2xl p-6 font-mono text-sm shadow-xl border border-slate-800">
                <pre class="text-blue-300"># Cek apakah kosong</pre>
                <pre class="text-white"><span class="text-purple-400">if</span> <span class="text-yellow-400">len</span>(antrian) == <span class="text-orange-400">0</span>:</pre>
                <pre class="text-white">    <span class="text-yellow-400">print</span>(<span class="text-emerald-400">"Antrean Kosong"</span>)</pre>
                <br>
                <pre class="text-blue-300"># Menampilkan semua isi antrean</pre>
                <pre class="text-white"><span class="text-purple-400">for</span> murid <span class="text-purple-400">in</span> antrian:</pre>
                <pre class="text-white">    <span class="text-yellow-400">print</span>(<span class="text-emerald-400">"-"</span>, murid)</pre>
            </div>
        </div>
    </section>

    <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
        <a href="{{ url('/materi/Simulasi-queue') }}" class="group text-slate-400 hover:text-indigo-600 font-bold flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Simulasi Queue
        </a>
         <a href="{{ url('/materi/materi-stack') }}" class="group flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-200">
            Lanjut ke Materi Stack
            <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
</div>
@endsection