@extends('layouts.materi')

@section('title', 'Vilogic - Simulasi Interaktif List')

@section('materi_title')
    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Simulasi <span class="text-indigo-600">List</span>
    </h1>
@endsection

@section('content')
<div x-data="listSimulator()" class="space-y-12">
    
    <div class="text-center max-w-2xl mx-auto">
        <p class="text-slate-500 font-medium leading-relaxed">
            Di sini, kamu bisa mencoba bagaimana komputer mengelola memori saat data ditambah, diubah, atau dihapus dalam sebuah List.
        </p>
    </div>

    <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-100 flex gap-4 items-start shadow-inner shadow-indigo-100/50">
        <div class="bg-indigo-600 p-2 rounded-lg shrink-0 mt-1">
            <i data-lucide="help-circle" class="text-white w-4 h-4"></i>
        </div>
        <div class="space-y-1">
            <h6 class="font-bold text-indigo-950 text-sm">Apa itu Index?</h6>
            <p class="text-xs text-indigo-900 leading-relaxed">
                Index adalah nomor urut posisi elemen di dalam List. Dalam Python, **index selalu dimulai dari 0** untuk elemen pertama, 1 untuk elemen kedua, dan seterusnya. Gunakan nomor index ini untuk menentukan target operasi di bawah.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-5 rounded-[2rem] bg-indigo-600 text-white shadow-lg shadow-indigo-100 transition-transform hover:scale-[1.02]">
            <div class="flex items-center gap-3 mb-2">
                <i data-lucide="plus-circle" class="w-5 h-5"></i>
                <h6 class="font-bold text-sm">Insert (Tambah)</h6>
            </div>
            <p class="text-[11px] text-indigo-100 leading-relaxed">Menyisipkan data ke indeks tertentu. Elemen lain setelahnya akan bergeser otomatis.</p>
        </div>
        
        <div class="p-5 rounded-[2rem] bg-slate-800 text-white shadow-lg shadow-slate-200 transition-transform hover:scale-[1.02]">
            <div class="flex items-center gap-3 mb-2">
                <i data-lucide="edit-3" class="w-5 h-5"></i>
                <h6 class="font-bold text-sm">Update (Ubah)</h6>
            </div>
            <p class="text-[11px] text-slate-200 leading-relaxed">Mengganti nilai pada indeks terpilih tanpa mengubah urutan data lainnya.</p>
        </div>

        <div class="p-5 rounded-[2rem] bg-slate-500 text-white shadow-lg shadow-slate-100 transition-transform hover:scale-[1.02]">
            <div class="flex items-center gap-3 mb-2">
                <i data-lucide="trash-2" class="w-5 h-5"></i>
                <h6 class="font-bold text-sm">Delete (Hapus)</h6>
            </div>
            <p class="text-[11px] text-slate-100 leading-relaxed">Menghapus elemen. Indeks elemen setelahnya akan otomatis berkurang.</p>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-[3rem] p-8 md:p-10 shadow-sm transition-all hover:shadow-md">
        <div class="mb-10 p-6 bg-amber-50 border-l-4 border-amber-400 rounded-r-3xl">
            <div class="flex gap-4 items-center">
                <div>
                    <h6 class="font-bold text-amber-900 !text-base">Zona Bebas Eksplorasi!</h6>
                    <p class="!text-sm text-amber-800/80 leading-relaxed">
                        Instruksi di bawah ini hanyalah <b>titik awal</b>. Jangan takut salah—kamu bebas mencoba kombinasi apapun di Console Kendali. Perhatikan baik-baik bagaimana kotak-kotak data di bawah berinteraksi!
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mb-8">
            <div>
                <h5 class="text-2xl font-extrabold text-slate-800 flex items-center gap-3">
                    <i data-lucide="compass" class="text-indigo-600"></i> Misi Eksplorasi
                </h5>
                <p class="!text-sm text-slate-500 mt-2">Cobalah skenario berikut untuk melihat keajaiban List:</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-start gap-4 p-5 rounded-3xl bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:border-indigo-200 shadow-sm">
                <div class="bg-indigo-100 p-2 rounded-xl text-indigo-600">
                    <i data-lucide="move-right" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="!text-base font-bold text-slate-800">Efek "Geser" Data</p>
                    <p class="!text-xs text-slate-500 leading-relaxed">Masukkan data baru pada <b>Target Indeks 1</b>. Amati bagaimana data yang sudah ada otomatis bergeser untuk memberi ruang.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-5 rounded-3xl bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:border-indigo-200 shadow-sm">
                <div class="bg-slate-200 p-2 rounded-xl text-slate-600">
                    <i data-lucide="shrink" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="!text-base font-bold text-slate-800">Efek "Rapat" Data</p>
                    <p class="!text-xs text-slate-500 leading-relaxed">Hapus salah satu data di tengah. Perhatikan bagaimana indeks di belakangnya "maju" untuk menutup celah kosong.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-5 rounded-3xl bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:border-indigo-200 shadow-sm">
                <div class="bg-amber-100 p-2 rounded-xl text-amber-600">
                    <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="!text-base font-bold text-slate-800">Uji Batas Indeks</p>
                    <p class="!text-xs text-slate-500 leading-relaxed">Coba isi <b>Target Indeks 10</b> padahal data hanya ada 3. Apa respon simulator terhadap indeks yang tidak ada?</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-5 rounded-3xl bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:border-indigo-200 shadow-sm">
                <div class="bg-indigo-600 p-2 rounded-xl text-white shadow-lg shadow-indigo-100">
                    <i data-lucide="layers" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="!text-base font-bold text-slate-800">Lupakan Batas</p>
                    <p class="!text-xs text-slate-500 leading-relaxed">Tambahkan terus data tanpa mengisi Target Indeks. Lihat seberapa panjang List bisa menampung datamu!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 divide-x divide-slate-200 py-6 rounded-3xl bg-slate-50 border border-slate-100 text-center shadow-inner shadow-slate-100">
        <div>
            <p class="text-[10px] uppercase tracking-widest font-black text-slate-400 mb-1">Jumlah Elemen</p>
            <h6 class="text-2xl font-black text-indigo-600" x-text="items.length">0</h6>
        </div>
        <div>
            <p class="text-[10px] uppercase tracking-widest font-black text-slate-400 mb-1">Indeks Awal</p>
            <h6 class="text-2xl font-black text-slate-800" x-text="items.length > 0 ? '0' : '-'">-</h6>
        </div>
        <div>
            <p class="text-[10px] uppercase tracking-widest font-black text-slate-400 mb-1">Indeks Akhir</p>
            <h6 class="text-2xl font-black text-slate-800" x-text="items.length > 0 ? items.length - 1 : '-'">-</h6>
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
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Nilai Elemen</label>
                <input type="text" x-model="inputValue" 
                    class="w-full py-4 px-6 rounded-2xl border-2 border-white bg-white shadow-sm focus:border-indigo-500 focus:ring-0 transition-all outline-none" 
                    placeholder="Masukkan data...">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Target Indeks</label>
                <input type="number" x-model="inputIndex" 
                    class="w-full py-4 px-6 rounded-2xl border-2 border-white bg-white shadow-sm focus:border-indigo-500 focus:ring-0 transition-all outline-none" 
                    placeholder="Kosongkan untuk akhir">
            </div>
        </div>
        
        <div class="flex flex-wrap gap-3 justify-center">
            <button @click="insertItem()" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-indigo-100 transition-all active:scale-95 text-xs tracking-wide">
                <i data-lucide="plus-circle" class="w-4 h-4"></i> INSERT
            </button>
            <button @click="updateItem()" class="flex items-center gap-2 bg-slate-800 hover:bg-black text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-slate-200 transition-all active:scale-95 text-xs tracking-wide">
                <i data-lucide="refresh-ccw" class="w-4 h-4"></i> UPDATE
            </button>
            <button @click="deleteItem()" class="flex items-center gap-2 bg-slate-500 hover:bg-slate-600 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-slate-100 transition-all active:scale-95 text-xs tracking-wide">
                <i data-lucide="trash-2" class="w-4 h-4"></i> DELETE
            </button>
            <button @click="resetSimulator()" class="flex items-center gap-2 bg-slate-300 hover:bg-slate-400 text-slate-700 px-6 py-3 rounded-2xl font-bold transition-all active:scale-95 text-xs tracking-wide">
                <i data-lucide="rotate-ccw" class="w-4 h-4"></i> RESET
            </button>
        </div>
    </div>

    <div class="bg-slate-100/50 rounded-[3rem] p-10 min-h-[300px] flex flex-col items-center justify-center border-2 border-dashed border-slate-200 shadow-inner shadow-slate-100">
        <h6 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-12">Visualisasi Memori List</h6>
        
        <div class="flex flex-wrap gap-6 justify-center items-center">
            <template x-for="(item, index) in items" :key="index">
                <div class="animate__animated animate__zoomIn text-center space-y-3">
                    <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center text-lg font-black shadow-sm border-2 transition-all duration-500"
                        :class="lastAccessed === index ? 'border-indigo-500 text-indigo-600 scale-110 shadow-xl shadow-indigo-100 bg-indigo-50' : 'border-white text-slate-700'">
                        <span x-text="item"></span>
                    </div>
                    <div class="font-black text-[10px] transition-colors uppercase tracking-wider" 
                        :class="lastAccessed === index ? 'text-indigo-600' : 'text-slate-400'" 
                        x-text="'Index [' + index + ']'"></div>
                </div>
            </template>

            <template x-if="items.length === 0">
                <div class="text-center opacity-30 space-y-2">
                    <i data-lucide="database" class="w-12 h-12 mx-auto text-slate-400"></i>
                    <p class="font-bold text-sm text-slate-500">List Kosong</p>
                </div>
            </template>
        </div>
    </div>

    <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
        <a href="{{ url('/materi/materi-list') }}" class="group text-slate-400 hover:text-indigo-600 font-bold flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i> Kembali ke List
        </a>
         <a href="{{ url('/materi/operasi-list-python') }}" class="group flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-200">
            Lanjut ke Operasi List dengan Python
            <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script>
    function listSimulator() {
        return {
            items: ['Andi', 'Budi', 'Caca'],
            inputValue: '',
            inputIndex: null,
            lastAccessed: null,
            explanation: 'Simulator List siap digunakan.',

            insertItem() {
                if (!this.inputValue) { this.explanation = "Gagal: Masukkan nilai data!"; return; }
                let idx = (this.inputIndex !== null && this.inputIndex !== '') ? parseInt(this.inputIndex) : this.items.length;
                
                if (idx < 0 || idx > this.items.length) {
                    this.explanation = "Gagal: Indeks di luar jangkauan!"; return;
                }

                this.items.splice(idx, 0, this.inputValue);
                this.lastAccessed = idx;
                this.explanation = `Insert: "${this.inputValue}" ditambahkan pada indeks [${idx}].`;
                this.resetForm();
            },

            updateItem() {
                let idx = parseInt(this.inputIndex);
                if (isNaN(idx) || idx < 0 || idx >= this.items.length) {
                    this.explanation = "Gagal: Tentukan indeks yang valid untuk diubah!"; return;
                }
                let oldVal = this.items[idx];
                this.items[idx] = this.inputValue || "Null";
                this.lastAccessed = idx;
                this.explanation = `Update: Indeks [${idx}] diubah dari "${oldVal}" menjadi "${this.items[idx]}".`;
                this.resetForm();
            },

            deleteItem() {
                if (this.items.length === 0) { this.explanation = "Gagal: List sudah kosong!"; return; }
                let idx = (this.inputIndex !== null && this.inputIndex !== '') ? parseInt(this.inputIndex) : this.items.length - 1;
                
                if (idx < 0 || idx >= this.items.length) {
                    this.explanation = "Gagal: Indeks tidak ditemukan!"; return;
                }
                
                let removed = this.items.splice(idx, 1);
                this.explanation = `Delete: Elemen "${removed}" pada indeks [${idx}] telah dihapus.`;
                this.lastAccessed = null;
                this.resetForm();
            },

            resetSimulator() {
                this.items = [];
                this.explanation = "List telah direset ke kosong.";
                this.resetForm();
            },

            resetForm() {
                this.inputValue = '';
                this.inputIndex = null;
                setTimeout(() => { this.lastAccessed = null; }, 1500);
            }
        }
    }
</script>
@endsection