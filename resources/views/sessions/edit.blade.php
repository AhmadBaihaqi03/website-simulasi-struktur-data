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
        .bg-indigo-subtle { background-color: #eef0ff !important; }

        /* ---------------------------------------------------------
           2. KARTU & KONTEN (Fase PBL)
        ------------------------------------------------------------ */
        .phase-title {
            font-size: 1.2rem; 
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #5c60f5;
            display: block;
        }

        .phase-card { 
            background: white;
            border-radius: 20px; 
            border: none; 
            margin-bottom: 1rem; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.02); 
            transition: 0.3s; 
        }

        .phase-icon { 
            width: 54px; height: 54px; border-radius: 16px; 
            display: flex; align-items: center; justify-content: center; 
            color: #5c60f5; background-color: #eef0ff; 
            margin-right: 18px; font-size: 1.6rem;
        }

        /* ---------------------------------------------------------
           3. FORMULIR & INPUT 
        ------------------------------------------------------------ */
        .label-custom { 
            font-weight: 800; color: #4a5568; font-size: 1rem; 
            text-transform: uppercase; letter-spacing: 1.2px; 
            margin-bottom: 0.8rem; display: block; 
        }

        .form-control-custom { 
            background-color: #ffffff; /* Ubah ke putih agar kontras dengan border */
            border: 2px solid #e2e8f0; /* Pertegas border (sama dengan box evaluasi) */
            border-radius: 15px; 
            padding: 15px; 
            font-size: 1rem; 
            line-height: 1.6;
            resize: vertical; /* Memungkinkan guru memperbesar kotak teks */
            transition: all 0.2s ease-in-out;
        }

        .form-control-custom:focus { 
            background-color: white; border-color: #5c60f5; 
            box-shadow: 0 0 0 5px rgba(92, 96, 245, 0.08); outline: none; 
        }

        /* Error Feedback */
        .is-invalid { border-color: #e53e3e !important; background-color: #fff5f5 !important; }

        /* ---------------------------------------------------------
           4. TOMBOL (BUTTONS)
        ------------------------------------------------------------ */
        .btn-indigo-outline { 
            border: 2px solid #5c60f5; color: #5c60f5; 
            font-weight: 700; border-radius: 12px; transition: 0.3s; 
            padding: 8px 20px; font-size: 0.9rem;
        }

        .btn-indigo-outline:hover { background-color: #5c60f5; color: white; }

        /* ---------------------------------------------------------
           5. SIDEBAR & NAVIGATION (Sticky Logic)
        ------------------------------------------------------------ */
        .sticky-sidebar { 
            position: sticky; top: 100px; z-index: 10; 
            background: white; border-radius: 20px; align-self: flex-start;
            max-height: calc(100vh - 110px); overflow-y: auto;
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
            <h2 class="fw-black text-slate-900" style="font-size: 2rem; letter-spacing: -1px; font-weight: 700;">Perbarui Sesi PBL Anda</h2>
        </div>

        <form action="{{ route('sessions.update', $session) }}" method="POST" id="editPblForm">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-lg-8">
                    
                    <div class="card phase-card p-4 p-md-5">
                        <div class="d-flex align-items-center mb-5">
                            <div class="phase-icon"><i class="bi bi-journal-richtext"></i></div>
                            <div>
                                <span class="phase-title">Orientasi Masalah</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="label-custom">Judul Sesi</label>
                            <input type="text" name="title" class="form-control form-control-custom font-bold" value="{{ old('title', $session->title) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="label-custom">Tujuan Pembelajaran</label>
                            <div id="objectives-container">
                                @php $outcomes = old('f1_learning_objectives', $session->f1_learning_objectives ?? ['']); @endphp
                                @foreach($outcomes as $index => $outcome)
                                <div class="mb-3 p-3 bg-light rounded-4 border-0 shadow-sm position-relative animate-fade-in">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label class="label-custom">Tujuan {{ $index + 1 }}</label>
                                        @if($index > 0) <button type="button" class="btn-close btn-sm remove-btn"></button> @endif
                                    </div>
                                    <textarea name="f1_learning_objectives[]" class="form-control form-control-custom" rows="2" required>{{ $outcome }}</textarea>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-objective" class="btn btn-link text-indigo btn-sm p-0 text-decoration-none fw-bold">
                                <i class="bi bi-plus-circle-fill me-1"></i> Tambah Tujuan Pembelajaran
                            </button>
                        </div>

                        <div class="mb-2">
                            <label class="label-custom">Konteks/Narasi Masalah</label>
                            <textarea name="f1_context" class="form-control form-control-custom" rows="6" required>{{ old('f1_context', $session->f1_context) }}</textarea>
                        </div>
                    </div>

                    <div class="card phase-card p-4 p-md-5">
                        <div class="d-flex align-items-center mb-5">
                            <div class="phase-icon"><i class="bi bi-search"></i></div>
                            <div>
                                <span class="phase-title">Penyelidikan</span>
                            </div>
                        </div>
                        
                        <div id="questions-container">
                            @php $questions = old('f3_questions', $session->f3_questions ?? ['']); @endphp
                            @foreach($questions as $index => $question)
                            <div class="mb-3 p-4 bg-light rounded-4 shadow-sm border-0 position-relative animate-fade-in">
                                <div class="d-flex justify-content-between mb-2">
                                    <label class="label-custom">Pertanyaan {{ $index + 1 }}</label>
                                    @if($index > 0) <button type="button" class="btn-close btn-sm remove-btn"></button> @endif
                                </div>
                                <textarea name="f3_questions[]" class="form-control form-control-custom" rows="3" required>{{ $question }}</textarea>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" id="add-question" class="btn btn-indigo-outline btn-sm px-4 mt-2">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Pertanyaan Lain
                        </button>
                    </div>

                    <div class="card phase-card p-4 p-md-5">
                        <div class="d-flex align-items-center mb-5">
                            <div class="phase-icon"><i class="bi bi-code-square"></i></div>
                            <div>
                                <span class="phase-title">Mengembangkan dan Menyajikan Solusi</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="label-custom">Instruksi Implementasi</label>
                            <textarea name="f4_instruction" class="form-control form-control-custom" rows="5" required>{{ old('f4_instruction', $session->f4_instruction) }}</textarea>
                        </div>
                        <div class="mb-2">
                            <label class="label-custom">Deskripsi Kode</label>
                            <textarea name="f4_question" class="form-control form-control-custom" rows="3" required>{{ old('f4_question', $session->f4_question) }}</textarea>
                        </div>
                    </div>

                    <div class="card phase-card p-4 p-md-5">
                        <div class="d-flex align-items-center mb-5">
                            <div class="phase-icon"><i class="bi bi-stars"></i></div>
                            <div>
                                <span class="phase-title">Evaluasi</span>
                            </div>
                        </div>

                        <div id="reflection-container">
                            @php $reflections = old('f5_questions', $session->f5_questions ?? ['']); @endphp
                            @foreach($reflections as $index => $reflection)
                            <div class="mb-3 p-4 bg-light rounded-4 shadow-sm border-0 position-relative animate-fade-in">
                                <div class="d-flex justify-content-between mb-2">
                                    <label class="label-custom">Pertanyaan {{ $index + 1 }}</label>
                                    @if($index > 0) <button type="button" class="btn-close btn-sm remove-btn"></button> @endif
                                </div>
                                <textarea name="f5_questions[]" class="form-control form-control-custom" rows="2" required>{{ $reflection }}</textarea>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" id="add-reflection" class="btn btn-indigo-outline btn-sm px-4 mt-2">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Pertanyaan
                        </button>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sticky-sidebar">
                        <div class="card phase-card p-4 text-center border-0">
                            <div class="mb-4">
                                <h5 class="fw-black mb-1" style="font-size: 1rem; font-weight:700;">Simpan Perubahan</h5>
                                <p class="text-muted" style="font-size: 1rem;">Pastikan konten sudah sesuai sebelum melakukan pembaruan.</p>
                            </div>
                            
                            <hr class="mb-4 opacity-50">

                            <button type="submit" class="btn bg-indigo text-white w-100 py-3 fw-bold shadow-lg mb-3" style="border-radius: 15px; font-size: 0.9rem;">
                                <i class="bi bi-cloud-check-fill me-2"></i> PERBARUI SESI
                            </button>

                            <a href="{{ route('dashboard') }}" class="btn btn-light w-100 py-2 fw-bold text-muted" style="border-radius: 12px; font-size: 0.9rem;">
                                Batalkan Perubahan
                            </a>

                            <div class="mt-4 p-3 bg-light rounded-4">
                                <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.4;">
                                    Siswa akan langsung melihat perubahan ini pada dashboard mereka setelah Anda menekan tombol perbarui sesi.
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
            const form = document.getElementById('editPblForm');
            
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

            setupDynamicContainer('objectives-container', 'add-objective', 'f1_learning_objectives[]', 'Tujuan', 'Tujuan selanjutnya...', 2);
            setupDynamicContainer('questions-container', 'add-question', 'f3_questions[]', 'Pertanyaan', 'Pertanyaan selanjutnya...', 3);
            setupDynamicContainer('reflection-container', 'add-reflection', 'f5_questions[]', 'Pertanyaan', 'Pertanyaan selanjutnya...', 2);

            // Logic Remove & Re-indexing
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-btn')) {
                    const parent = e.target.closest('.mb-3');
                    const container = parent.parentElement;
                    
                    parent.style.opacity = '0';
                    parent.style.transform = 'translateY(10px)';
                    
                    setTimeout(() => {
                        parent.remove();
                        const labelTextMap = {
                            'objectives-container': 'Tujuan',
                            'questions-container': 'Pertanyaan',
                            'reflection-container': 'Pertanyaan Refleksi'
                        };
                        
                        if (labelTextMap[container.id]) {
                            container.querySelectorAll('.label-custom').forEach((label, idx) => {
                                label.innerText = `${labelTextMap[container.id]} ${idx + 1}`;
                            });
                        }
                    }, 300);
                }
            });

            // Form Validation
            form.addEventListener('submit', function(e) {
                let isValid = true;
                const requiredInputs = form.querySelectorAll('[required]');
                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    alert('Mohon lengkapi semua kolom yang wajib diisi!');
                }
            });
        });
    </script>
</x-app-layout>