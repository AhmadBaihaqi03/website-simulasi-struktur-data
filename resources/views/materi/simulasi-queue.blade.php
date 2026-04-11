@extends('layouts.materi')

@section('title', 'Vilogic - Simulasi Interaktif Queue')

@section('materi_title')
    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Simulasi <span class="text-indigo-600">Queue</span>
    </h1>
@endsection

@section('content')
<div x-data="queueSimulator()" class="space-y-12">
    
    <div class="text-center max-w-2xl mx-auto">
        <p class="text-slate-500 font-medium leading-relaxed">
            Pahami konsep <strong>FIFO (First In, First Out)</strong>. Di sini, elemen yang pertama kali masuk akan menjadi yang pertama kali keluar, persis seperti antrean di dunia nyata.
        </p>
    </div>

    <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-100 flex gap-4 items-start shadow-inner shadow-indigo-100/50">
        <div class="bg-indigo-600 p-2 rounded-lg shrink-0 mt-1">
            <i data-lucide="help-circle" class="text-white w-4 h-4"></i>
        </div>
        <div class="space-y-1">
            <h6 class="font-bold text-indigo-950 text-sm">Bagaimana Queue Bekerja?</h6>
            <p class="text-xs text-indigo-900 leading-relaxed">
                Dalam Queue, penambahan data (Enqueue) selalu dilakukan di posisi paling belakang (Rear), sedangkan penghapusan data (Dequeue) selalu dilakukan di posisi paling depan (Front/Index 0).
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-5 rounded-[2rem] bg-indigo-600 text-white shadow-lg shadow-indigo-100 transition-transform hover:scale-[1.02]">
            <div class="flex items-center gap-3 mb-2">
                <i data-lucide="log-in" class="w-5 h-5"></i>
                <h6 class="font-bold text-sm">Enqueue</h6>
            </div>
            <p class="text-[11px] text-indigo-100 leading-relaxed">Menambah elemen ke urutan paling belakang (Rear). Data baru harus menunggu antrean.</p>
        </div>
        
        <div class="p-5 rounded-[2rem] bg-slate-800 text-white shadow-lg shadow-slate-200 transition-transform hover:scale-[1.02]">
            <div class="flex items-center gap-3 mb-2">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                <h6 class="font-bold text-sm">Dequeue</h6>
            </div>
            <p class="text-[11px] text-slate-200 leading-relaxed">Mengambil elemen dari urutan terdepan (Front). Elemen ini yang selesai diproses.</p>
        </div>

        <div class="p-5 rounded-[2rem] bg-slate-500 text-white shadow-lg shadow-slate-100 transition-transform hover:scale-[1.02]">
            <div class="flex items-center gap-3 mb-2">
                <i data-lucide="eye" class="w-5 h-5"></i>
                <h6 class="font-bold text-sm">Front</h6>
            </div>
            <p class="text-[11px] text-slate-100 leading-relaxed">Melihat siapa yang ada di urutan terdepan tanpa mengeluarkannya dari antrean.</p>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-[3rem] p-8 md:p-10 shadow-sm transition-all hover:shadow-md">
        <div class="mb-10 p-6 bg-amber-50 border-l-4 border-amber-400 rounded-r-3xl">
            <div class="flex gap-4 items-center">
                <div>
                    <h6 class="font-bold text-amber-900 !text-base">Zona Bebas Eksplorasi!</h6>
                    <p class="!text-sm text-amber-800/80 leading-relaxed">
                        Instruksi di bawah ini adalah <b>titik awal</b> untuk memahami antrean. Cobalah berbagai kombinasi untuk melihat bagaimana sistem mengelola urutan data secara adil!
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mb-8">
            <div>
                <h5 class="text-2xl font-extrabold text-slate-800 flex items-center gap-3">
                    <i data-lucide="compass" class="text-indigo-600"></i> Misi Eksplorasi
                </h5>
                <p class="!text-sm text-slate-500 mt-2">Uji skenario berikut untuk melihat cara kerja Queue:</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-start gap-4 p-5 rounded-3xl bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:border-indigo-200 shadow-sm">
                <div class="bg-indigo-100 p-2 rounded-xl text-indigo-600">
                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="!text-base font-bold text-slate-800">Siapa di Belakang?</p>
                    <p class="!text-xs text-slate-500 leading-relaxed">Gunakan <b>Enqueue</b> beberapa kali. Amati bagaimana data baru selalu masuk di posisi <b>Rear</b> (paling belakang).</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-5 rounded-3xl bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:border-rose-200 shadow-sm">
                <div class="bg-rose-100 p-2 rounded-xl text-rose-600">
                    <i data-lucide="user-check" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="!text-base font-bold text-slate-800">Prinsip Keadilan (FIFO)</p>
                    <p class="!text-xs text-slate-500 leading-relaxed">Klik <b>Dequeue</b>. Perhatikan bahwa data yang <b>paling lama</b> mengantre (Front) adalah yang dihapus pertama kali.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-5 rounded-3xl bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:border-amber-200 shadow-sm">
                <div class="bg-amber-100 p-2 rounded-xl text-amber-600">
                    <i data-lucide="search" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="!text-base font-bold text-slate-800">Intip Antrean</p>
                    <p class="!text-xs text-slate-500 leading-relaxed">Gunakan tombol <b>Front</b>. Apakah data di posisi terdepan berubah atau hilang? Bandingkan dengan efek tombol Dequeue.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-5 rounded-3xl bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:border-indigo-600 shadow-sm">
                <div class="bg-indigo-600 p-2 rounded-xl text-white shadow-lg shadow-indigo-100">
                    <i data-lucide="database" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="!text-base font-bold text-slate-800">Uji Kondisi Kosong</p>
                    <p class="!text-xs text-slate-500 leading-relaxed">Klik <b>Reset</b>, lalu coba lakukan <b>Dequeue</b> atau <b>Front</b>. Amati pesan peringatan yang muncul di simulator!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 divide-x divide-slate-200 py-6 rounded-3xl bg-slate-50 border border-slate-100 text-center shadow-inner shadow-slate-100">
        <div>
            <p class="text-[10px] uppercase tracking-widest font-black text-slate-400 mb-1">Total Antrean</p>
            <h6 class="text-2xl font-black text-indigo-600" x-text="items.length">0</h6>
        </div>
        <div>
            <p class="text-[10px] uppercase tracking-widest font-black text-slate-400 mb-1">Depan (Front)</p>
            <h6 class="text-2xl font-black text-slate-800" x-text="items.length > 0 ? items[0] : '-'">-</h6>
        </div>
        <div>
            <p class="text-[10px] uppercase tracking-widest font-black text-slate-400 mb-1">Belakang (Rear)</p>
            <h6 class="text-2xl font-black text-slate-800" x-text="items.length > 0 ? items[items.length - 1] : '-'">-</h6>
        </div>
    </div>

    <div class="text-center" x-show="explanation" x-transition>
        <div class="inline-flex items-center gap-3 px-6 py-2 rounded-full bg-white border border-indigo-100 shadow-sm text-sm font-medium text-slate-700 italic">
            <i data-lucide="info" class="w-4 h-4 text-indigo-500"></i>
            <span x-text="explanation"></span>
        </div>
    </div>

    <div class="bg-slate-50/50 p-8 rounded-[3rem] border border-slate-100 shadow-inner shadow-slate-100">
        <h6 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
            <i data-lucide="terminal" class="text-indigo-600"></i> Console Kendali
        </h6>
        
        <div class="space-y-2 mb-8">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Nilai Elemen (Nama Murid/Data)</label>
            <input type="text" x-model="inputValue" @keyup.enter="enqueue()"
                class="w-full py-4 px-6 rounded-2xl border-2 border-white bg-white shadow-sm focus:border-indigo-500 focus:ring-0 transition-all outline-none" 
                placeholder="Masukkan data antrean...">
        </div>
        
        <div class="flex flex-wrap gap-3 justify-center">
            <button @click="enqueue()" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-indigo-100 transition-all active:scale-95 text-xs tracking-wide">
                <i data-lucide="log-in" class="w-4 h-4"></i> ENQUEUE
            </button>
            <button @click="dequeue()" class="flex items-center gap-2 bg-slate-800 hover:bg-black text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-slate-200 transition-all active:scale-95 text-xs tracking-wide">
                <i data-lucide="log-out" class="w-4 h-4"></i> DEQUEUE
            </button>
            <button @click="peek()" class="flex items-center gap-2 bg-slate-500 hover:bg-slate-600 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-slate-100 transition-all active:scale-95 text-xs tracking-wide">
                <i data-lucide="eye" class="w-4 h-4"></i> FRONT
            </button>
            <button @click="resetQueue()" class="flex items-center gap-2 bg-slate-300 hover:bg-slate-400 text-slate-700 px-6 py-3 rounded-2xl font-bold transition-all active:scale-95 text-xs tracking-wide">
                <i data-lucide="rotate-ccw" class="w-4 h-4"></i> RESET
            </button>
        </div>
    </div>

    <div class="bg-slate-100/50 rounded-[3rem] p-10 min-h-[300px] flex flex-col items-center justify-center border-2 border-dashed border-slate-200 shadow-inner shadow-slate-100">
        <h6 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-12 text-center">Visualisasi Antrean (FIFO)</h6>
        
        

        <div class="flex flex-wrap gap-6 justify-center items-center">
            <template x-for="(item, index) in items" :key="index">
                <div class="animate__animated animate__fadeInRight text-center space-y-3">
                    <div class="relative">
                        <div class="absolute -top-8 left-0 right-0 flex justify-center">
                            <span x-show="index === 0" class="bg-indigo-600 text-white text-[8px] font-black px-2 py-0.5 rounded-full animate__animated animate__bounceIn">FRONT</span>
                            <span x-show="index === items.length - 1 && items.length > 1" class="bg-slate-500 text-white text-[8px] font-black px-2 py-0.5 rounded-full animate__animated animate__bounceIn">REAR</span>
                        </div>

                        <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center text-lg font-black shadow-sm border-2 transition-all duration-500"
                            :class="lastAccessed === index ? 'border-indigo-500 text-indigo-600 scale-110 shadow-xl shadow-indigo-100 bg-indigo-50' : 'border-white text-slate-700'">
                            <span x-text="item"></span>
                        </div>
                    </div>
                    <div class="font-black text-[10px] transition-colors uppercase tracking-wider" 
                        :class="lastAccessed === index ? 'text-indigo-600' : 'text-slate-400'" 
                        x-text="'Index [' + index + ']'"></div>
                </div>
            </template>

            <template x-if="items.length === 0">
                <div class="text-center opacity-30 space-y-2">
                    <i data-lucide="users" class="w-12 h-12 mx-auto text-slate-400"></i>
                    <p class="font-bold text-sm text-slate-500">Antrean Kosong</p>
                </div>
            </template>
        </div>
    </div>

    <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
        <a href="{{ url('/materi/materi-queue') }}" class="group text-slate-400 hover:text-indigo-600 font-bold flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Queue
        </a>
         <a href="{{ url('/materi/operasi-queue-python') }}" class="group flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-200">
            Lanjut ke Operasi Queue dengan Python
            <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script>
    function queueSimulator() {
        return {
            items: ['Andi', 'Budi'],
            inputValue: '',
            lastAccessed: null,
            explanation: 'Sistem antrean siap digunakan.',

            enqueue() {
                if (!this.inputValue) { 
                    this.explanation = "Gagal: Masukkan nilai data!"; 
                    return; 
                }
                this.items.push(this.inputValue);
                this.lastAccessed = this.items.length - 1;
                this.explanation = `Enqueue: "${this.inputValue}" masuk ke antrean paling belakang.`;
                this.inputValue = '';
                setTimeout(() => { this.lastAccessed = null; }, 1000);
            },

            dequeue() {
                if (this.items.length === 0) { 
                    this.explanation = "Gagal: Antrean sudah kosong!"; 
                    return; 
                }
                let removed = this.items.shift();
                this.lastAccessed = 0; 
                this.explanation = `Dequeue: "${removed}" di urutan terdepan telah diproses.`;
                setTimeout(() => { this.lastAccessed = null; }, 800);
            },

            peek() {
                if (this.items.length === 0) { 
                    this.explanation = "Gagal: Antrean kosong."; 
                    return; 
                }
                this.lastAccessed = 0;
                this.explanation = `Peek: Murid terdepan saat ini adalah "${this.items[0]}".`;
                setTimeout(() => { this.lastAccessed = null; }, 1500);
            },

            resetQueue() {
                this.items = [];
                this.explanation = "Antrean telah direset.";
                this.inputValue = '';
                this.lastAccessed = null;
            }
        }
    }
</script>
@endsection