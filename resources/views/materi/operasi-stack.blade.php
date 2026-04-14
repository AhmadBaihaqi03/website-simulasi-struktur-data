@extends('layouts.materi')

@section('title', 'Vilogic - Sintaks Python Stack')

@section('materi_title')
    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Sintaks Python <span class="text-indigo-600">Stack</span>
    </h1>
@endsection

@section('content')
<div class="space-y-12">
    
    <div class="bg-slate-900 rounded-[3rem] p-8 md:p-12 text-white relative overflow-hidden shadow-2xl shadow-indigo-100">
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
        <div class="relative z-10 text-center md:text-left">
            <h5 class="text-2xl font-bold mb-4 flex items-center justify-center md:justify-start gap-3">
                <i data-lucide="terminal" class="text-indigo-400"></i> Implementasi Tumpukan
            </h5>
            <p class="text-slate-300 leading-relaxed max-w-3xl">
                Dalam Python, implementasi <strong>Stack</strong> sebenarnya lebih sederhana daripada Queue. Kita cukup menggunakan fungsi bawaan List secara standar karena perilaku default List adalah menambahkan dan menghapus dari urutan terakhir.
            </p>
        </div>
    </div>

    <section class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">1</div>
            <h3 class="text-xl font-bold text-slate-800">Push (Tambah ke Atas)</h3>
        </div>
        <div class="ml-0 md:ml-14 space-y-4">
            <p class="text-slate-600 text-sm">
                Gunakan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">append()</code> untuk menumpuk data. Data yang baru masuk akan selalu berada di posisi index terakhir.
            </p>
            <div class="bg-[#1e1e1e] rounded-2xl p-6 font-mono text-sm shadow-xl border border-slate-800">
                <pre class="text-blue-300"># Membuat stack kosong</pre>
                <pre class="text-white">stack = []</pre>
                <br>
                <pre class="text-blue-300"># Menambahkan tugas ke tumpukan</pre>
                <pre class="text-white">stack.<span class="text-yellow-400">append</span>(<span class="text-emerald-400">"Tugas 1"</span>)</pre>
                <pre class="text-white">stack.<span class="text-yellow-400">append</span>(<span class="text-emerald-400">"Tugas 2"</span>)</pre>
                <pre class="text-white">stack.<span class="text-yellow-400">append</span>(<span class="text-emerald-400">"Tugas 3"</span>)</pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">2</div>
            <h3 class="text-xl font-bold text-slate-800">Top (Melihat Data Teratas)</h3>
        </div>
        <div class="ml-0 md:ml-14 space-y-4">
            <p class="text-slate-600 text-sm">
                Untuk melihat data teratas tanpa menghapusnya, kita mengakses index terakhir menggunakan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">[-1]</code>.
            </p>
            <div class="bg-[#1e1e1e] rounded-2xl p-6 font-mono text-sm shadow-xl border border-slate-800">
                <pre class="text-blue-300"># Mengintip data paling atas</pre>
                <pre class="text-white"><span class="text-yellow-400">print</span>(stack[<span class="text-orange-400">-1</span>])  <span class="text-slate-500"># Output: Tugas 3</span></pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">3</div>
            <h3 class="text-xl font-bold text-slate-800">Pop (Hapus Data Teratas)</h3>
        </div>
        <div class="ml-0 md:ml-14 space-y-4">
            <p class="text-slate-600 text-sm">
                Berbeda dengan Queue, pada Stack kita gunakan <code class="bg-slate-100 px-2 py-1 rounded text-rose-600 font-bold">pop()</code> <strong>tanpa angka 0</strong>. Ini akan menghapus elemen terakhir (yang paling atas).
            </p>
            
            <div class="bg-[#1e1e1e] rounded-2xl p-6 font-mono text-sm shadow-xl border border-slate-800">
                <pre class="text-blue-300"># Menghapus elemen paling atas</pre>
                <pre class="text-white">stack.<span class="text-yellow-400">pop</span>()</pre>
                <pre class="text-blue-300"># Sekarang "Tugas 2" menjadi yang teratas</pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">4</div>
            <h3 class="text-xl font-bold text-slate-800">IsEmpty & Traversal</h3>
        </div>
        <div class="ml-0 md:ml-14 space-y-4">
            <p class="text-slate-600 text-sm">
                Gunakan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">len()</code> untuk mengecek apakah tumpukan kosong, dan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold">for</code> untuk melihat seluruh isi.
            </p>
            <div class="bg-[#1e1e1e] rounded-2xl p-6 font-mono text-sm shadow-xl border border-slate-800">
                <pre class="text-blue-300"># Cek status stack</pre>
                <pre class="text-white"><span class="text-purple-400">if</span> <span class="text-yellow-400">len</span>(stack) == <span class="text-orange-400">0</span>:</pre>
                <pre class="text-white">    <span class="text-yellow-400">print</span>(<span class="text-emerald-400">"Tumpukan Kosong"</span>)</pre>
                <br>
                <pre class="text-blue-300"># Menampilkan semua isi tumpukan</pre>
                <pre class="text-white"><span class="text-purple-400">for</span> data <span class="text-purple-400">in</span> stack:</pre>
                <pre class="text-white">    <span class="text-yellow-400">print</span>(<span class="text-emerald-400">"-"</span>, data)</pre>
            </div>
        </div>
    </section>

    <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
        <a href="{{ url('/materi/Simulasi-stack') }}" class="group text-slate-400 hover:text-indigo-600 font-bold flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Simulasi Stack
        </a>
         <a href="{{ url('/materi/integrasi-struktur-data') }}" class="group flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-200">
            Lanjut ke Integrasi Struktur Data
            <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
</div>
@endsection