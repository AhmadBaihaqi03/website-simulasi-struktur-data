<x-app-layout>
   <style>
    /* ---------------------------------------------------------
       1. GLOBAL & BODY 
    ------------------------------------------------------------ */
    body { 
        background-color: #f0f2f5; 
    }

    /* Utilitas Warna Utama */
    .text-indigo { color: #5c60f5 !important; }
    .bg-indigo   { background-color: #5c60f5 !important; }


    /* ---------------------------------------------------------
       2. KARTU & KONTEN (Fase PBL)
    ------------------------------------------------------------ */
    .phase-card { 
        background: white;
        border-radius: 20px; 
        border: none; 
        margin-bottom: 2rem; 
        box-shadow: 0 10px 25px rgba(0,0,0,0.02); 
        transition: 0.3s; 
    }

    /* Ikon bulat di samping judul fase */
    .phase-icon { 
        width: 54px; 
        height: 54px; 
        border-radius: 16px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        color: #5c60f5; 
        background-color: #eef0ff; 
        margin-right: 18px; 
        font-size: 1.4rem;
    }


    /* ---------------------------------------------------------
       3. FORMULIR & INPUT 
    ------------------------------------------------------------ */
    /* Label teks kecil di atas input (Uppercase) */
    .label-custom { 
        font-weight: 800; 
        color: #4a5568; 
        font-size: 0.7rem; 
        text-transform: uppercase; 
        letter-spacing: 1.2px; 
        margin-bottom: 0.8rem; 
        display: block; 
    }

    /* Desain Input & Textarea kustom */
    .form-control-custom { 
        background-color: #f8fafc; 
        border: 1px solid #e2e8f0; 
        border-radius: 15px; 
        padding: 15px; 
        font-size: 0.95rem; 
        line-height: 1.6;
        resize: vertical; /* Memungkinkan guru memperbesar kotak teks */
        transition: all 0.2s ease-in-out; 
    }

    /* Efek saat input diklik (Focus) */
    .form-control-custom:focus { 
        background-color: white; 
        border-color: #5c60f5; 
        box-shadow: 0 0 0 5px rgba(92, 96, 245, 0.08); 
        outline: none; 
    }


    /* ---------------------------------------------------------
       4. TOMBOL (BUTTONS)
    ------------------------------------------------------------ */
    .btn-indigo-outline {  
        border: 2px solid #5c60f5; 
        color: #5c60f5; 
        font-weight: 700; 
        border-radius: 12px; 
        padding: 8px 20px; 
        font-size: 0.85rem;
        transition: 0.3s; 
    }

    .btn-indigo-outline:hover { 
        background-color: #5c60f5; 
        color: white; 
    }


    /* ---------------------------------------------------------
       5. SIDEBAR & NAVIGATION (Sticky Logic)
    ------------------------------------------------------------ */
    /* Bar navigasi bawah (jika ada) */
    .bottom-bar { 
        position: sticky; 
        bottom: 0; 
        padding: 25px 0; 
        background: rgba(255, 255, 255, 0.9); 
        backdrop-filter: blur(12px); 
        border-top: 1px solid #e2e8f0; 
        z-index: 100; 
    }

    /* Panel Kanan (Sticky Sidebar) */
    .sticky-sidebar { 
        position: sticky; 
        top: 100px; /* Jarak dari atas layar saat di-scroll */
        z-index: 10; 
        background: white;
        border-radius: 20px; 
        align-self: flex-start;
        
        /* Mengatur ketinggian maksimal agar tidak melebihi layar */
        max-height: calc(100vh - 110px); 
        overflow-y: auto;

        /* border-top: 6px solid #5c60f5 !important; <-- GARIS UNGU DIHAPUS DI SINI */
    }


    /* ---------------------------------------------------------
       6. ANIMASI
    ------------------------------------------------------------ */
    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

   <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-black text-slate-900" style="font-size: 2.5rem; letter-spacing: -1px;">Buat Sesi PBL Anda</h2>
        </div>

        <form action="{{ route('sessions.store') }}" method="POST" id="pblForm">
            @csrf
            
            <div class="row g-4">
                <div class="col-lg-8">
                    
                    <div class="card phase-card p-4 p-md-5">
                        <div class="d-flex align-items-center mb-5">
                            <div class="phase-icon"><i class="bi bi-journal-richtext"></i></div>
                            <div>
                                <small class="text-indigo fw-black small tracking-widest uppercase">Fase 1: Orientasi Masalah</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="label-custom">Judul Sesi</label>
                            <input type="text" name="title" class="form-control form-control-custom font-bold" placeholder="Judul besar sesi ini..." required>
                        </div>

                        <div class="mb-4">
                            <label class="label-custom">Tujuan Pembelajaran</label>
                            <div id="objectives-container">
                                <div class="mb-3 p-3 bg-light rounded-4 border-0 shadow-sm position-relative">
                                    <label class="label-custom">Tujuan 1</label>
                                    <textarea name="f1_learning_objectives[]" class="form-control form-control-custom" rows="2" placeholder="Contoh: Menganalisis cara kerja struktur data Queue..." required></textarea>
                                </div>
                            </div>
                            <button type="button" id="add-objective" class="btn btn-link text-indigo btn-sm p-0 text-decoration-none fw-bold">
                                <i class="bi bi-plus-circle-fill me-1"></i> Tambah Tujuan Pembelajaran
                            </button>
                        </div>

                        <div class="mb-2">
                            <label class="label-custom">Konteks Masalah</label>
                            <textarea name="f1_context" class="form-control form-control-custom" rows="6" placeholder="Tuliskan cerita/masalah yang harus diselesaikan siswa..." required></textarea>
                        </div>
                    </div>

                    <div class="card phase-card p-4 p-md-5">
                        <div class="d-flex align-items-center mb-5">
                            <div class="phase-icon"><i class="bi bi-search"></i></div>
                            <div>
                                <small class="text-indigo fw-black small tracking-widest uppercase">Fase 3: Penyelidikan</small>
                            </div>
                        </div>
                        <div id="questions-container">
                            <div class="mb-3 p-4 bg-light rounded-4 shadow-sm border-0 position-relative">
                                <label class="label-custom">Pertanyaan 1</label>
                                <textarea name="f3_questions[]" class="form-control form-control-custom" rows="3" placeholder="Berikan pertanyaan agar siswa mendiskusikan dan menganalisis permasalahan..." required></textarea>
                            </div>
                        </div>
                        <button type="button" id="add-question" class="btn btn-indigo-outline btn-sm px-4 mt-2">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Pertanyaan Lain
                        </button>
                    </div>

                    <div class="card phase-card p-4 p-md-5">
                        <div class="d-flex align-items-center mb-5">
                            <div class="phase-icon"><i class="bi bi-code-square"></i></div>
                            <div>
                                <small class="text-indigo fw-black small tracking-widest uppercase">Fase 4: Mengembangkan & Menyajikan Solusi</small>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="label-custom">Instruksi Implementasi</label>
                            <textarea name="f4_instruction" class="form-control form-control-custom" rows="5" placeholder="Instruksi spesifik untuk pembuatan kode program..." required></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="label-custom">Deskripsi Kode</label>
                            <textarea name="f4_question" class="form-control form-control-custom" rows="3" placeholder="Beri pertanyaan agar murid menjelaskan hasil kode yang mereka buat..." required></textarea>
                        </div>
                    </div>

                    <div class="card phase-card p-4 p-md-5">
                        <div class="d-flex align-items-center mb-5">
                            <div class="phase-icon"><i class="bi bi-stars"></i></div>
                            <div>
                                <small class="text-indigo fw-black small tracking-widest uppercase">Fase 5: Evaluasi</small>
                            </div>
                        </div>
                        <div id="reflection-container">
                            <div class="mb-3 p-4 bg-light rounded-4 shadow-sm border-0 position-relative">
                                <label class="label-custom">Pertanyaan Refleksi 1</label>
                                <textarea name="f5_questions[]" class="form-control form-control-custom" rows="2" placeholder="Pertanyaan untuk menutup sesi pembelajaran..." required></textarea>
                            </div>
                        </div>
                        <button type="button" id="add-reflection" class="btn btn-indigo-outline btn-sm px-4 mt-2">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Pertanyaan Refleksi
                        </button>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="sticky-sidebar">
                        <div class="card phase-card p-4 text-center border-0 shadow-lg">
                            <div class="mb-4">
                                <h5 class="fw-black mb-1">Finalisasi Sesi</h5>
                                <p class="text-muted small">Tinjau kembali data sebelum deploy</p>
                            </div>
                            
                            <hr class="mb-4 opacity-50">

                            <button type="submit" class="btn bg-indigo text-white w-100 py-3 fw-bold shadow-lg mb-3" style="border-radius: 15px;">
                                <i class="bi bi-rocket-takeoff-fill me-2"></i> DEPLOY PBL SESSION
                            </button>

                            <div class="p-3 bg-light rounded-4">
                                <p class="text-muted mb-0" style="font-size: 0.75rem; line-height: 1.4;">
                                    Pastikan semua Fase (1-5) telah terisi dengan instruksi yang jelas bagi siswa.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('pblForm');
            
            function setupDynamicContainer(containerId, buttonId, nameAttr, labelText, placeholder, rowCount) {
                const container = document.getElementById(containerId);
                const button = document.getElementById(buttonId);
                
                button.addEventListener('click', function() {
                    const count = container.querySelectorAll('textarea').length + 1;
                    const div = document.createElement('div');
                    
                    div.className = 'mb-3 p-4 bg-light rounded-4 shadow-sm border-0 position-relative mt-3 animate-fade-in';
                    div.innerHTML = `
                        <div class="d-flex justify-content-between mb-2">
                            <label class="label-custom">${labelText} ${count}</label>
                            <button type="button" class="btn-close btn-sm remove-btn"></button>
                        </div>
                        <textarea name="${nameAttr}" class="form-control form-control-custom" rows="${rowCount}" placeholder="${placeholder}" required></textarea>
                    `;
                    container.appendChild(div);
                });
            }

            // Inisialisasi dengan baris (rows) yang berbeda-beda sesuai konteks
            setupDynamicContainer('objectives-container', 'add-objective', 'f1_learning_objectives[]', 'Tujuan', 'Tujuan selanjutnya...', 2);
            setupDynamicContainer('questions-container', 'add-question', 'f3_questions[]', 'Pertanyaan', 'Pertanyaan investigasi selanjutnya...', 3);
            setupDynamicContainer('reflection-container', 'add-reflection', 'f5_questions[]', 'Pertanyaan Refleksi', 'Pertanyaan refleksi selanjutnya...', 2);

            // Logic Remove
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-btn')) {
                    const parent = e.target.closest('.mb-3');
                    parent.style.opacity = '0';
                    setTimeout(() => parent.remove(), 300);
                }
            });
        });
    </script>
</x-app-layout>