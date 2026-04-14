@extends('layouts.materi')

@section('title', 'Vilogic - Proyek Sistem Antrean TU')

@section('materi_title')
    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        <span class="text-indigo-600">Integrasi Struktur Data</span>
    </h1>
@endsection

@section('content')
<div class="space-y-12">
    
    <div class="bg-indigo-600 rounded-[3rem] p-8 md:p-12 text-white relative overflow-hidden shadow-2xl shadow-indigo-200">
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-white/10 rounded-full -mb-32 -mr-32 blur-3xl"></div>
        <div class="relative z-10">
            <h5 class="text-2xl font-bold mb-4 flex items-center gap-3">
                <i data-lucide="combine" class="text-white"></i> Integrasi Struktur Data List, Queue, dan stack untuk Sistem Antrean TU
            </h5>
            <p class="text-indigo-100 leading-relaxed text-lg max-w-4xl">
                Kali ini, kita akan menggabungkan konsep <strong>list</strong> (untuk fitur edit, dan hapus), <strong>Queue</strong> (untuk antrean siswa), dan <strong>Stack</strong> (untuk fitur <em>Undo</em>) menggunakan bahasa Python.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 shadow-sm transition-transform hover:scale-[1.01]">
            <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-6">
                <i data-lucide="users" class="text-indigo-600"></i>
            </div>
            <h6 class="font-bold text-slate-800 text-lg mb-2">Queue (Antrean)</h6>
            <p class="text-sm text-slate-500 italic mb-4">"First-In, First-Out"</p>
            <p class="text-sm text-slate-600 leading-relaxed">
                Digunakan untuk menampung siswa yang datang. Menggunakan <code>append()</code> untuk masuk dan <code>pop(0)</code> untuk melayani.
            </p>
        </div>

        <div class="p-8 bg-slate-900 rounded-[2.5rem] text-white shadow-xl transition-transform hover:scale-[1.01]">
            <div class="w-12 h-12 bg-slate-800 rounded-2xl flex items-center justify-center mb-6 text-indigo-400">
                <i data-lucide="history"></i>
            </div>
            <h6 class="font-bold text-lg mb-2">Stack (Riwayat/Undo)</h6>
            <p class="text-sm text-slate-400 italic mb-4">"Last-In, First-Out"</p>
            <p class="text-sm text-slate-300 leading-relaxed">
                Menyimpan data siswa yang selesai dilayani. Menggunakan <code>pop()</code> untuk mengambil tindakan terakhir saat melakukan pembatalan (Undo).
            </p>
        </div>
    </div>

    <section class="space-y-6">
        <div class="flex items-center justify-between px-2">
            <h3 class="text-2xl font-black text-slate-800 tracking-tight flex items-center gap-3">
                <i data-lucide="code-2" class="text-indigo-600"></i> Implementasi Python
            </h3>
            <button onclick="copyCode()" class="flex items-center gap-2 bg-slate-100 hover:bg-indigo-600 hover:text-white text-slate-600 px-4 py-2 rounded-xl transition-all font-bold text-xs group">
                <i data-lucide="copy" class="w-4 h-4"></i>
                <span id="copyText">Salin Semua Kode</span>
            </button>
        </div>
        
        <div class="bg-[#1e1e1e] rounded-[3rem] p-6 md:p-10 shadow-2xl border border-slate-800 relative">
            <div id="fullCode" class="overflow-x-auto custom-scrollbar font-mono text-sm leading-relaxed pr-4" style="max-height: 600px;">
                <div class="bg-slate-900 rounded-lg p-6 font-mono text-sm leading-relaxed shadow-xl border border-slate-700">
                    <pre class="text-slate-500"># =============================================================</pre>
                    <pre class="text-slate-500"># SISTEM ANTREAN TU</pre>
                    <pre class="text-slate-500"># =============================================================</pre>
                    <br>

                    <pre class="text-slate-500"># PERSIAPAN LIST (Tempat menyimpan data)</pre>
                    <pre><span class="text-white">antrean = []</span></pre>
                    <pre><span class="text-white">riwayat_undo = []</span></pre>
                    <br>

                    <pre class="text-slate-500"># FUNGSI MENGELOLA DATA</pre>
                    <pre class="text-purple-400">def <span class="text-blue-400">tambah_data</span><span class="text-white">(data):</span></pre>
                    <pre><span class="text-white">    antrean.<span class="text-yellow-400">append</span>(data)</span></pre>
                    <pre><span class="text-white">    <span class="text-yellow-400">print</span>(<span class="text-emerald-400">f"[TAMBAH] {data} berhasil masuk antrean."</span>)</span></pre>
                    <br>

                    <pre class="text-purple-400">def <span class="text-blue-400">edit_data</span><span class="text-white">(nomor_urutan, data_baru):</span></pre>
                    <pre><span class="text-slate-500">    # Mengubah urutan manusia (1,2,3) ke urutan komputer (0,1,2)</span></pre>
                    <pre><span class="text-white">    index = nomor_urutan - <span class="text-orange-400">1</span></span></pre>
                    <pre><span class="text-white">    <span class="text-purple-400">if</span> <span class="text-orange-400">0</span> <= index < <span class="text-yellow-400">len</span>(antrean):</span></pre>
                    <pre><span class="text-white">        data_lama = antrean[index]</span></pre>
                    <pre><span class="text-white">        antrean[index] = data_baru</span></pre>
                    <pre><span class="text-white">        <span class="text-yellow-400">print</span>(<span class="text-emerald-400">f"[EDIT] Data nomor {nomor_urutan} diganti: {data_lama} -> {data_baru}"</span>)</span></pre>
                    <pre><span class="text-white">    <span class="text-purple-400">else</span>:</span></pre>
                    <pre><span class="text-white">        <span class="text-yellow-400">print</span>(<span class="text-emerald-400">"[Gagal] Nomor urutan tidak ada!"</span>)</span></pre>
                    <br>

                    <pre class="text-purple-400">def <span class="text-blue-400">hapus_data</span><span class="text-white">(nomor_urutan):</span></pre>
                    <pre><span class="text-white">    index = nomor_urutan - <span class="text-orange-400">1</span></span></pre>
                    <pre><span class="text-white">    <span class="text-purple-400">if</span> <span class="text-orange-400">0</span> <= index < <span class="text-yellow-400">len</span>(antrean):</span></pre>
                    <pre><span class="text-white">        data_dibuang = antrean.<span class="text-yellow-400">pop</span>(index)</span></pre>
                    <pre><span class="text-white">        <span class="text-yellow-400">print</span>(<span class="text-emerald-400">f"[HAPUS] {data_dibuang} telah keluar dari antrean."</span>)</span></pre>
                    <br>

                    <pre class="text-purple-400">def <span class="text-blue-400">layani_pertama</span><span class="text-white">():</span></pre>
                    <pre><span class="text-white">    <span class="text-purple-400">if</span> <span class="text-yellow-400">len</span>(antrean) > <span class="text-orange-400">0</span>:</span></pre>
                    <pre><span class="text-white">        diproses = antrean.<span class="text-yellow-400">pop</span>(<span class="text-orange-400">0</span>) <span class="text-slate-500"># FIFO</span></span></pre>
                    <pre><span class="text-white">        riwayat_undo.<span class="text-yellow-400">append</span>(diproses)</span></pre>
                    <pre><span class="text-white">        <span class="text-yellow-400">print</span>(<span class="text-emerald-400">f"[PROSES] Melayani: {diproses}"</span>)</span></pre>
                    <pre><span class="text-white">    <span class="text-purple-400">else</span>:</span></pre>
                    <pre><span class="text-white">        <span class="text-yellow-400">print</span>(<span class="text-emerald-400">"[KOSONG] Antrean sudah habis."</span>)</span></pre>
                    <br>

                    <pre class="text-purple-400">def <span class="text-blue-400">batal_layanan</span><span class="text-white">():</span></pre>
                    <pre><span class="text-white">    <span class="text-purple-400">if</span> <span class="text-yellow-400">len</span>(riwayat_undo) > <span class="text-orange-400">0</span>:</span></pre>
                    <pre><span class="text-white">        data_balik = riwayat_undo.<span class="text-yellow-400">pop</span>() <span class="text-slate-500"># LIFO</span></span></pre>
                    <pre><span class="text-white">        antrean.<span class="text-yellow-400">insert</span>(<span class="text-orange-400">0</span>, data_balik)</span></pre>
                    <pre><span class="text-white">        <span class="text-yellow-400">print</span>(<span class="text-emerald-400">f"[UNDO] Pelayanan {data_balik} dibatalkan."</span>)</span></pre>
                    <br>

                    <pre class="text-slate-500"># ======================================</pre>
                    <pre class="text-slate-500"># BAGIAN MENJALANKAN FUNGSI SISTEM</pre>
                    <pre class="text-slate-500"># ======================================</pre>
                    <pre><span class="text-yellow-400">print</span>(<span class="text-emerald-400">">>> MEMULAI SISTEM <<<"</span>)</pre>
                    <pre class="text-slate-500"># 1. Masukkan data</pre>
                    <pre><span class="text-white">tambah_data(<span class="text-emerald-400">"Budi - Legalisir"</span>)</span></pre>
                    <pre><span class="text-white">tambah_data(<span class="text-emerald-400">"Hani - Surat Magang"</span>)</span></pre>
                    <pre><span class="text-white">cek_antrean()</span></pre>
                    <br>

                    <pre class="text-slate-500"># 2. Edit data (Contoh: Ganti Hani jadi Hani Putri)</pre>
                    <pre class="text-slate-500"># Format: edit_data(nomor_urutan, "data baru")</pre>
                    <pre><span class="text-white">edit_data(<span class="text-orange-400">2</span>, <span class="text-emerald-400">"Hani Putri - Surat Magang"</span>)</span></pre>
                    <pre><span class="text-white">cek_antrean()</span></pre>
                    <br>

                    <pre class="text-slate-500"># 3. Hapus data (Contoh: Hapus Hani Putri)</pre>
                    <pre><span class="text-white">hapus_data(<span class="text-orange-400">2</span>)</span></pre>
                    <pre><span class="text-white">cek_antrean()</span></pre>
                    <br>

                    <pre class="text-slate-500"># 4. Layani siswa pertama</pre>
                    <pre><span class="text-white">layani_pertama()</span></pre>
                    <pre><span class="text-white">cek_antrean()</span></pre>
                    <br>
                    
                    <pre class="text-slate-500"># 5. Batalkan pelayanan</pre>
                    <pre><span class="text-white">batal_layanan()</span></pre>
                    <pre><span class="text-white">cek_antrean()</span></pre>
                    <pre><span class="text-yellow-400">print</span>(<span class="text-emerald-400">">>> SISTEM SELESAI <<<"</span>)</pre>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-black text-slate-800 tracking-tight flex items-center gap-3">
            <i data-lucide="book-open" class="text-indigo-600"></i> Memahami Cara Kerja
        </h3>
        <div class="grid grid-cols-1 gap-4">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex gap-4 items-start">
                <div class="bg-indigo-100 p-3 rounded-2xl text-indigo-600"><strong>01</strong></div>
                <div>
                    <p class="font-bold text-slate-800">Inisialisasi Data</p>
                    <p class="text-sm text-slate-600">Dua list kosong disiapkan: <code>antrian</code> (Queue) untuk alur masuk siswa dan <code>riwayat</code> (Stack) untuk mencatat siapa yang baru saja selesai dilayani.</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex gap-4 items-start">
                <div class="bg-indigo-100 p-3 rounded-2xl text-indigo-600"><strong>02</strong></div>
                <div>
                    <p class="font-bold text-slate-800">Operasi Dasar (CRUD)</p>
                    <p class="text-sm text-slate-600">Kita bisa menambah data (Push), mengedit nama berdasarkan nomor urut (Index), dan menghapus siswa dari tengah antrean jika mereka membatalkan kunjungan.</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex gap-4 items-start">
                <div class="bg-indigo-100 p-3 rounded-2xl text-indigo-600"><strong>03</strong></div>
                <div>
                    <p class="font-bold text-slate-800">Logika Undo yang Unik</p>
                    <p class="text-sm text-slate-600">Fungsi <code>undo_layanan</code> memindahkan data paling atas di <code>riwayat</code> (Stack) kembali ke posisi index 0 di <code>antrian</code> (Queue) menggunakan <code>insert(0)</code>.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="bg-amber-50 border-2 border-dashed border-amber-200 rounded-[2.5rem] p-8 md:p-10 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-4 opacity-10">
            <i data-lucide="lightbulb" class="w-20 h-20 text-amber-600"></i>
        </div>
        <div class="relative z-10 text-sm text-amber-700 leading-relaxed italic">
            <strong>Catatan:</strong> Penggunaan <code>insert(0, siswa)</code> adalah teknik khusus untuk menempatkan kembali elemen ke baris paling depan (prioritas pertama) setelah proses dibatalkan.
        </div>
    </div>

    <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
        <a href="{{ url('/materi/operasi-stack') }}" class="group text-slate-400 hover:text-indigo-600 font-bold flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Operasi Stack
        </a>
    </div>
</div>

<script>
    function copyCode() {
        const codeElement = document.getElementById('fullCode');
        const textToCopy = codeElement.innerText;
        const copyBtn = document.getElementById('copyText');

        navigator.clipboard.writeText(textToCopy).then(() => {
            copyBtn.innerText = "Tersalin ke Clipboard!";
            setTimeout(() => {
                copyBtn.innerText = "Salin Semua Kode";
            }, 2000);
        });
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #1e1e1e; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #475569; }
</style>
@endsection