<x-app-layout>
    <style>
        body { background-color: #f0f2f5; }

        .text-indigo { color: #5c60f5 !important; }
        .bg-indigo   { background-color: #5c60f5 !important; }
        .bg-indigo-subtle { background-color: #eef0ff !important; }

        .phase-title {
            font-size: 1.05rem; 
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
            width: 48px; height: 48px; border-radius: 14px; 
            display: flex; align-items: center; justify-content: center; 
            color: #5c60f5; background-color: #eef0ff; 
            margin-right: 14px; font-size: 1.4rem;
            flex-shrink: 0;
        }

        .label-custom { 
            font-weight: 800; color: #4a5568; font-size: 0.9rem; 
            text-transform: uppercase; letter-spacing: 1.2px; 
            margin-bottom: 0.6rem; display: block; 
        }

        .form-control-custom { 
            background-color: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 15px; 
            padding: 12px 15px; 
            font-size: 1rem; 
            line-height: 1.6;
            resize: vertical;
            transition: all 0.2s ease-in-out;
            min-height: 44px;
        }

        .form-control-custom:focus { 
            background-color: white; border-color: #5c60f5; 
            box-shadow: 0 0 0 5px rgba(92, 96, 245, 0.08); outline: none; 
        }

        .is-invalid { border-color: #e53e3e !important; background-color: #fff5f5 !important; }

        .btn-indigo-outline { 
            border: 2px solid #5c60f5; color: #5c60f5; 
            font-weight: 700; border-radius: 12px; transition: 0.3s; 
            padding: 10px 20px; font-size: 0.9rem;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
        }

        .btn-indigo-outline:hover { background-color: #5c60f5; color: white; }

        /* Sidebar — hanya desktop */
        .sticky-sidebar { 
            position: sticky; top: 80px; z-index: 10; 
            background: white; border-radius: 20px; align-self: flex-start;
            max-height: calc(100vh - 90px); overflow-y: auto;
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 991px) {
            .form-bottom-spacer { padding-bottom: 90px; }
        }
    </style>

    <div class="container py-4 py-md-5">
        <div class="text-center mb-4 mb-md-5">
            <h2 class="fw-black text-slate-900" style="font-size: clamp(1.4rem, 5vw, 2rem); letter-spacing: -1px; font-weight: 700;">Perbarui Sesi PBL Anda</h2>
        </div>

        <form action="{{ route('sessions.update', $session) }}" method="POST" id="editPblForm">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                {{-- Konten Form: full-width di mobile, 8-col di desktop (KIRI) --}}
                <div class="col-12 col-lg-8 form-bottom-spacer">

                    <div class="card phase-card p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4 mb-md-5">
                            <div class="phase-icon"><i class="bi bi-journal-richtext"></i></div>
                            <div><span class="phase-title">Orientasi Masalah</span></div>
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
                            <button type="button" id="add-objective" class="btn btn-link text-indigo btn-sm p-0 text-decoration-none fw-bold" style="min-height:36px;">
                                <i class="bi bi-plus-circle-fill me-1"></i> Tambah Tujuan Pembelajaran
                            </button>
                        </div>

                        <div class="mb-2">
                            <label class="label-custom">Konteks/Narasi Masalah</label>
                            <textarea name="f1_context" class="form-control form-control-custom" rows="6" required>{{ old('f1_context', $session->f1_context) }}</textarea>
                        </div>
                    </div>

                    <div class="card phase-card p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4 mb-md-5">
                            <div class="phase-icon"><i class="bi bi-search"></i></div>
                            <div><span class="phase-title">Penyelidikan</span></div>
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
                        <div class="d-flex align-items-center mb-4 mb-md-5">
                            <div class="phase-icon"><i class="bi bi-code-square"></i></div>
                            <div><span class="phase-title">Mengembangkan dan Menyajikan Solusi</span></div>
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
                        <div class="d-flex align-items-center mb-4 mb-md-5">
                            <div class="phase-icon"><i class="bi bi-stars"></i></div>
                            <div><span class="phase-title">Evaluasi</span></div>
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
            </div>
        </form>
    </div>

    {{-- ===== FIXED BOTTOM BAR — hanya mobile/tablet (< lg) ===== --}}
    <div class="d-lg-none fixed-bottom border-top shadow-lg"
         style="background: rgba(255,255,255,0.97); backdrop-filter: blur(12px); z-index: 1050; padding: 12px 16px;">
        <div class="d-flex gap-2" style="max-width: 600px; margin: 0 auto;">
            <a href="{{ route('dashboard') }}" 
               class="btn btn-light fw-bold text-muted"
               style="border-radius: 14px; min-height: 52px; font-size: 0.85rem; display:flex; align-items:center; padding: 0 16px;">
                Batal
            </a>
            <button type="submit" form="editPblForm"
                    class="btn bg-indigo text-white fw-bold flex-grow-1 shadow-sm"
                    style="border-radius: 14px; font-size: 0.9rem; min-height: 52px; letter-spacing: 0.05em;">
                <i class="bi bi-cloud-check-fill me-2"></i> PERBARUI SESI
            </button>
        </div>
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