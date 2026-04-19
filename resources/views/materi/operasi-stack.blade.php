@extends('layouts.materi')

@section('title', 'Vilogic - Sintaks Python Stack')

@section('materi_title')
    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Sintaks Python <span class="text-indigo-600">Stack</span>
    </h1>
@endsection

@section('content')
<div class="space-y-12">

    <div class="bg-slate-900 rounded-2xl sm:rounded-[3rem] p-5 sm:p-8 md:p-12 text-white relative overflow-hidden shadow-2xl shadow-indigo-100">
        <div class="absolute top-0 right-0 w-32 h-32 sm:w-64 sm:h-64 bg-indigo-500/10 rounded-full -mr-10 sm:-mr-20 -mt-10 sm:-mt-20 blur-3xl"></div>
        <div class="relative z-10 space-y-3 sm:space-y-4">
            <h5 class="text-lg sm:text-xl md:text-2xl font-bold flex items-center justify-center sm:justify-start gap-2 sm:gap-3">
                <i data-lucide="terminal" class="text-indigo-400 w-5 h-5 sm:w-6 sm:h-6"></i> Implementasi Tumpukan
            </h5>
            <p class="text-slate-300 !text-sm sm:!text-base leading-relaxed max-w-3xl">
                Dalam Python, implementasi <strong>Stack</strong> sebenarnya lebih sederhana daripada Queue. Kita cukup menggunakan fungsi bawaan List secara standar karena perilaku default List adalah menambahkan dan menghapus dari urutan terakhir.
            </p>
        </div>
    </div>

    <section class="space-y-4 sm:space-y-6">
        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold text-sm sm:text-base">1</div>
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-slate-800">Push (Tambah ke Atas)</h3>
        </div>
        <div class="ml-0 space-y-3 sm:space-y-4">
            <p class="text-slate-600 text-xs sm:text-sm">
                Gunakan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold text-xs sm:text-sm">append()</code> untuk menumpuk data. Data yang baru masuk akan selalu berada di posisi index terakhir.
            </p>
            <div>
                <div class="overflow-x-auto" style="max-height: 400px;">
                    <div class="bg-slate-900 rounded-lg p-4 sm:p-6 font-mono text-xs sm:text-sm leading-relaxed shadow-xl border border-slate-700 inline-block min-w-full">
                        <pre class="text-blue-300"># Membuat stack kosong</pre>
                        <pre class="text-white">stack = []</pre>
                        <br>
                        <pre class="text-blue-300"># Menambahkan tugas ke tumpukan</pre>
                        <pre class="text-white">stack.<span class="text-yellow-400">append</span>(<span class="text-emerald-400">"Tugas 1"</span>)</pre>
                        <pre class="text-white">stack.<span class="text-yellow-400">append</span>(<span class="text-emerald-400">"Tugas 2"</span>)</pre>
                        <pre class="text-white">stack.<span class="text-yellow-400">append</span>(<span class="text-emerald-400">"Tugas 3"</span>)</pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-4 sm:space-y-6">
        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold text-sm sm:text-base">2</div>
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-slate-800">Top (Melihat Data Teratas)</h3>
        </div>
        <div class="ml-0 space-y-3 sm:space-y-4">
            <p class="text-slate-600 text-xs sm:text-sm">
                Untuk melihat data teratas tanpa menghapusnya, kita mengakses index terakhir menggunakan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold text-xs sm:text-sm">[-1]</code>.
            </p>
            <div>
                <div class="overflow-x-auto" style="max-height: 400px;">
                    <div class="bg-slate-900 rounded-lg p-4 sm:p-6 font-mono text-xs sm:text-sm leading-relaxed shadow-xl border border-slate-700 inline-block min-w-full">
                        <pre class="text-blue-300"># Mengintip data paling atas</pre>
                        <pre class="text-white"><span class="text-yellow-400">print</span>(stack[<span class="text-orange-400">-1</span>])  <span class="text-slate-500"># Output: Tugas 3</span></pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-4 sm:space-y-6">
        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold text-sm sm:text-base">3</div>
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-slate-800">Pop (Hapus Data Teratas)</h3>
        </div>
        <div class="ml-0 space-y-3 sm:space-y-4">
            <p class="text-slate-600 text-xs sm:text-sm">
                Berbeda dengan Queue, pada Stack kita gunakan <code class="bg-slate-100 px-2 py-1 rounded text-rose-600 font-bold text-xs sm:text-sm">pop()</code> <strong>tanpa angka 0</strong>. Ini akan menghapus elemen terakhir (yang paling atas).
            </p>

            <div >
                <div class="overflow-x-auto" style="max-height: 400px;">
                    <div class="bg-slate-900 rounded-lg p-4 sm:p-6 font-mono text-xs sm:text-sm leading-relaxed shadow-xl border border-slate-700 inline-block min-w-full">
                        <pre class="text-blue-300"># Menghapus elemen paling atas</pre>
                        <pre class="text-white">stack.<span class="text-yellow-400">pop</span>()</pre>
                        <pre class="text-blue-300"># Sekarang "Tugas 2" menjadi yang teratas</pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-4 sm:space-y-6">
        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold text-sm sm:text-base">4</div>
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-slate-800">IsEmpty & Traversal</h3>
        </div>
        <div class="ml-0 space-y-3 sm:space-y-4">
            <p class="text-slate-600 text-xs sm:text-sm">
                Gunakan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold text-xs sm:text-sm">len()</code> untuk mengecek apakah tumpukan kosong, dan <code class="bg-slate-100 px-2 py-1 rounded text-indigo-600 font-bold text-xs sm:text-sm">for</code> untuk melihat seluruh isi.
            </p>
            <div>
                <div class="overflow-x-auto" style="max-height: 400px;">
                    <div class="bg-slate-900 rounded-lg p-4 sm:p-6 font-mono text-xs sm:text-sm leading-relaxed shadow-xl border border-slate-700 inline-block min-w-full">
                        <pre class="text-blue-300"># Cek status stack</pre>
                        <pre class="text-white"><span class="text-purple-400">if</span> <span class="text-yellow-400">len</span>(stack) == <span class="text-orange-400">0</span>:</pre>
                        <pre class="text-white">    <span class="text-yellow-400">print</span>(<span class="text-emerald-400">"Tumpukan Kosong"</span>)</pre>
                        <br>
                        <pre class="text-blue-300"># Menampilkan semua isi tumpukan</pre>
                        <pre class="text-white"><span class="text-purple-400">for</span> data <span class="text-purple-400">in</span> stack:</pre>
                        <pre class="text-white">    <span class="text-yellow-400">print</span>(<span class="text-emerald-400">"-"</span>, data)</pre>
                    </div>
                </div>
            </div>        </div>
    </section>

    <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between sm:gap-6">
        <a href="{{ url('/materi/Simulasi-stack') }}" class="group w-full sm:w-auto text-slate-400 hover:text-indigo-600 font-bold flex items-center justify-center sm:justify-start gap-2 transition text-sm sm:text-base order-2 sm:order-1 text-center sm:text-left">
            <i data-lucide="arrow-left" class="w-4 h-4 sm:w-5 sm:h-5 group-hover:-translate-x-1 transition-transform hidden sm:block"></i> Kembali ke Simulasi Stack
        </a>
        <a href="{{ url('/materi/integrasi-struktur-data') }}" class="group flex items-center justify-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-xl sm:rounded-2xl font-bold text-sm sm:text-base transition-all shadow-lg shadow-indigo-200 order-1 sm:order-2 w-full sm:w-auto">
            Lanjut ke Integrasi Struktur Data
            <i data-lucide="arrow-right" class="w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
</div>
@endsection
