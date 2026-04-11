@extends('layouts.materi')

@section('title', 'Simulasi Interaktif Stack - Vilogic')

@section('materi_title')
    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Simulasi <span class="text-indigo-600">Stack</span>
    </h1>
@endsection

@section('content')
<div x-data="stackSimulator()" class="space-y-12">
    
    <div class="text-center max-w-2xl mx-auto">
        <p class="text-slate-500 font-medium leading-relaxed">
            Pahami konsep <strong>LIFO (Last In, First Out)</strong>. Di sini, elemen yang terakhir kali ditumpuk akan menjadi yang pertama kali keluar.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-5 rounded-[2rem] bg-indigo-600 text-white shadow-lg shadow-indigo-100 transition-transform hover:scale-[1.02]">
            <div class="flex items-center gap-3 mb-2">
                <i data-lucide="arrow-down-to-dot" class="w-5 h-5"></i>
                <h6 class="font-bold text-sm">Push</h6>
            </div>
            <p class="text-[11px] text-indigo-100 leading-relaxed">Menambah elemen baru ke posisi paling atas (Top).</p>
        </div>
        
        <div class="p-5 rounded-[2rem] bg-slate-800 text-white shadow-lg shadow-slate-200 transition-transform hover:scale-[1.02]">
            <div class="flex items-center gap-3 mb-2">
                <i data-lucide="arrow-up-from-dot" class="w-5 h-5"></i>
                <h6 class="font-bold text-sm">Pop</h6>
            </div>
            <p class="text-[11px] text-slate-200 leading-relaxed">Mengambil elemen dari posisi teratas (Top).</p>
        </div>

        <div class="p-5 rounded-[2rem] bg-slate-500 text-white shadow-lg shadow-slate-100 transition-transform hover:scale-[1.02]">
            <div class="flex items-center gap-3 mb-2">
                <i data-lucide="eye" class="w-5 h-5"></i>
                <h6 class="font-bold text-sm">Top</h6>
            </div>
            <p class="text-[11px] text-slate-100 leading-relaxed">Melihat nilai elemen teratas tanpa menghapusnya.</p>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-[3rem] p-8 md:p-10 shadow-sm transition-all hover:shadow-md">
        <div class="mb-10 p-6 bg-amber-50 border-l-4 border-amber-400 rounded-r-3xl">
            <div class="flex gap-4 items-center">
                <div>
                    <h6 class="font-bold text-amber-900 !text-base">Zona Bebas Eksplorasi!</h6>
                    <p class="!text-sm text-amber-800/80 leading-relaxed">
                        Instruksi di bawah ini adalah <b>titik awal</b> untuk memahami tumpukan. Cobalah berbagai kombinasi untuk melihat bagaimana data terakhir selalu menjadi yang pertama diproses!
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mb-8">
            <div>
                <h5 class="text-2xl font-extrabold text-slate-800 flex items-center gap-3">
                    <i data-lucide="compass" class="text-indigo-600"></i> Misi Eksplorasi
                </h5>
                <p class="!text-sm text-slate-500 mt-2">Uji skenario berikut untuk melihat mekanisme Stack:</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-start gap-4 p-5 rounded-3xl bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:border-indigo-200 shadow-sm">
                <div class="bg-indigo-100 p-2 rounded-xl text-indigo-600">
                    <i data-lucide="layers-2" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="!text-base font-bold text-slate-800">Menumpuk Data</p>
                    <p class="!text-xs text-slate-500 leading-relaxed">Gunakan <b>Push</b> untuk memasukkan beberapa data. Amati bagaimana data terbaru selalu berada di posisi paling atas (<b>Top</b>).</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-5 rounded-3xl bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:border-rose-200 shadow-sm">
                <div class="bg-rose-100 p-2 rounded-xl text-rose-600">
                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="!text-base font-bold text-slate-800">Prinsip Terakhir (LIFO)</p>
                    <p class="!text-xs text-slate-500 leading-relaxed">Klik <b>Pop</b>. Perhatikan bahwa data yang <b>terakhir kali</b> kamu masukkan adalah yang pertama kali dihapus. Mengapa demikian?</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-5 rounded-3xl bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:border-amber-200 shadow-sm">
                <div class="bg-amber-100 p-2 rounded-xl text-amber-600">
                    <i data-lucide="eye" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="!text-base font-bold text-slate-800">Intip Pucuk Tumpukan</p>
                    <p class="!text-xs text-slate-500 leading-relaxed">Gunakan tombol <b>Top</b>. Pastikan apakah kamu bisa melihat data teratas tanpa harus membuangnya dari tumpukan.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-5 rounded-3xl bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:border-indigo-600 shadow-sm">
                <div class="bg-indigo-600 p-2 rounded-xl text-white shadow-lg shadow-indigo-100">
                    <i data-lucide="history" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="!text-base font-bold text-slate-800">Simulasi Undo</p>
                    <p class="!text-xs text-slate-500 leading-relaxed">Masukkan nama "Langkah 1" hingga "Langkah 3". Lakukan <b>Pop</b> berkali-kali. Lihat bagaimana Stack bekerja seperti fitur <i>Undo</i>!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 divide-x divide-slate-200 py-6 rounded-3xl bg-slate-50 border border-slate-100 text-center shadow-inner shadow-slate-100">
        <div>
            <p class="text-[10px] uppercase tracking-widest font-black text-slate-400 mb-1">Tinggi Tumpukan</p>
            <h6 class="text-2xl font-black text-indigo-600" x-text="items.length">0</h6>
        </div>
        <div>
            <p class="text-[10px] uppercase tracking-widest font-black text-slate-400 mb-1">Status</p>
            <h6 class="text-2xl font-black text-slate-800" x-text="items.length === 0 ? 'Kosong' : 'Tersedia'">Kosong</h6>
        </div>
    </div>

    <div class="text-center" x-show="explanation" x-transition>
        <div class="inline-flex items-center gap-3 px-6 py-2 rounded-full bg-white border border-indigo-100 shadow-sm text-sm font-medium text-slate-700 italic">
            <i data-lucide="info" class="w-4 h-4 text-indigo-500"></i>
            <span x-text="explanation"></span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <div class="lg:col-span-8 bg-slate-100/50 rounded-[3rem] p-10 min-h-[500px] flex flex-col items-center border-2 border-dashed border-slate-200 shadow-inner shadow-slate-100 overflow-hidden order-2 lg:order-1">
            <h6 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-12 text-center">Visualisasi Tumpukan (LIFO)</h6>

            

            <div class="flex flex-col-reverse w-full max-w-md gap-3 overflow-y-auto pr-2" style="max-height: 400px;">
                <template x-for="(item, index) in items" :key="index">
                    <div class="animate__animated animate__fadeInUp flex items-center gap-4 group">
                        <div class="w-24 text-right font-black text-[10px] text-slate-300 group-hover:text-indigo-400 transition-colors uppercase tracking-tighter">
                            Index <span x-text="'[' + index + ']'"></span>
                        </div>
                        
                        <div class="flex-grow py-4 px-6 bg-white rounded-2xl flex items-center justify-between text-sm font-black shadow-sm border-2 transition-all duration-500 relative overflow-hidden"
                            :class="index === items.length - 1 ? 'border-indigo-500 text-indigo-600 bg-indigo-50 shadow-xl shadow-indigo-100 scale-[1.02]' : 'border-white text-slate-700'">
                            
                            <span x-text="item"></span>

                            <template x-if="index === items.length - 1">
                                <div class="flex items-center gap-2">
                                    <span class="bg-indigo-600 text-white text-[8px] font-black px-3 py-1 rounded-full animate__animated animate__bounceIn tracking-widest text-center">TOP</span>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>

                <template x-if="items.length === 0">
                    <div class="flex flex-col items-center justify-center py-20 opacity-30 space-y-4">
                        <i data-lucide="layers" class="w-16 h-16 text-slate-400"></i>
                        <div class="text-center">
                            <p class="font-bold text-slate-500">Stack Kosong</p>
                            <p class="text-[10px] uppercase font-black tracking-widest">Gunakan PUSH untuk mengisi</p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-6 order-1 lg:order-2">
            <div class="bg-slate-50/50 p-8 rounded-[3rem] border border-slate-100 shadow-inner shadow-slate-100">
                <h6 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <i data-lucide="terminal" class="text-indigo-600"></i> Console
                </h6>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Nilai Elemen</label>
                        <input type="text" x-model="inputValue" @keyup.enter="push()"
                            class="w-full py-4 px-6 rounded-2xl border-2 border-white bg-white shadow-sm focus:border-indigo-500 transition-all outline-none mt-1" 
                            placeholder="Input data...">
                    </div>
                    
                    <button @click="push()" class="w-full flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-4 rounded-2xl font-bold shadow-lg shadow-indigo-100 transition-all active:scale-95">
                        <i data-lucide="arrow-down-to-dot" class="w-4 h-4"></i> PUSH
                    </button>
                    <button @click="pop()" class="w-full flex items-center justify-center gap-2 bg-slate-800 hover:bg-black text-white px-6 py-4 rounded-2xl font-bold shadow-lg shadow-slate-200 transition-all active:scale-95">
                        <i data-lucide="arrow-up-from-dot" class="w-4 h-4"></i> POP
                    </button>
                    <button @click="peek()" class="w-full flex items-center justify-center gap-2 bg-slate-500 hover:bg-slate-600 text-white px-6 py-4 rounded-2xl font-bold transition-all active:scale-95">
                        <i data-lucide="eye" class="w-4 h-4"></i> TOP
                    </button>
                    <button @click="resetStack()" class="w-full flex items-center justify-center gap-2 bg-slate-200 hover:bg-slate-300 text-slate-600 px-6 py-3 rounded-2xl font-bold transition-all text-xs">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i> RESET
                    </button>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
        <a href="{{ url('/materi/materi-stack') }}" class="group text-slate-400 hover:text-indigo-600 font-bold flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Stack
        </a>
         <a href="{{ url('/materi/operasi-stack-python') }}" class="group flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-200">
            Lanjut ke Operasi Stack dengan Python
            <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script>
    function stackSimulator() {
        return {
            items: ['Buku Dasar Desain', 'Buku Algoritma'],
            inputValue: '',
            explanation: 'Sistem stack siap digunakan.',

            push() {
                if (!this.inputValue) { 
                    this.explanation = "Gagal: Masukkan nilai data!"; 
                    return; 
                }
                this.items.push(this.inputValue);
                this.explanation = `Push: "${this.inputValue}" ditambahkan di atas tumpukan.`;
                this.inputValue = '';
            },

            pop() {
                if (this.items.length === 0) { 
                    this.explanation = "Gagal: Stack sudah kosong!"; 
                    return; 
                }
                let removed = this.items.pop();
                this.explanation = `Pop: "${removed}" (paling atas) telah dihapus.`;
            },

            peek() {
                if (this.items.length === 0) { 
                    this.explanation = "Gagal: Stack kosong."; 
                    return; 
                }
                let topItem = this.items[this.items.length - 1];
                this.explanation = `Peek: Elemen teratas saat ini adalah "${topItem}".`;
            },

            resetStack() {
                this.items = [];
                this.explanation = "Tumpukan telah direset.";
                this.inputValue = '';
            }
        }
    }
</script>
@endsection