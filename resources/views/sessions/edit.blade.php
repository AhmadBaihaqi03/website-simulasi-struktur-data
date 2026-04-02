<x-app-layout>
    <style>
        /* ---------------------------------------------------------
           1. GLOBAL & THEME 
        ------------------------------------------------------------ */
        body { background-color: #f0f2f5; }
        .text-indigo { color: #5c60f5 !important; }
        .bg-indigo { background-color: #5c60f5 !important; }
        
        /* ---------------------------------------------------------
           2. KARTU & KONTEN (Fase PBL)
        ------------------------------------------------------------ */
        .phase-card { 
            background: white; border-radius: 20px; border: none; 
            margin-bottom: 2rem; box-shadow: 0 10px 25px rgba(0,0,0,0.02); 
            transition: 0.3s; 
        }
        
        .phase-icon { 
            width: 54px; height: 54px; border-radius: 16px; 
            display: flex; align-items: center; justify-content: center; 
            color: #5c60f5; background-color: #eef0ff; 
            margin-right: 18px; font-size: 1.4rem;
        }

        /* ---------------------------------------------------------
           3. FORMULIR & INPUT 
        ------------------------------------------------------------ */
        .label-custom { 
            font-weight: 800; color: #4a5568; font-size: 0.7rem; 
            text-transform: uppercase; letter-spacing: 1.2px; 
            margin-bottom: 0.8rem; display: block; 
        }

        .form-control-custom { 
            border-radius: 15px; border: 1px solid #e2e8f0; 
            padding: 15px; background-color: #f8fafc; 
            transition: all 0.2s ease-in-out; 
            font-size: 0.95rem; line-height: 1.6; resize: vertical;
        }

        .form-control-custom:focus { 
            background-color: white; border-color: #5c60f5; 
            box-shadow: 0 0 0 5px rgba(92, 96, 245, 0.08); outline: none; 
        }

        .is-invalid { border-color: #e53e3e !important; background-color: #fff5f5 !important; }

        /* ---------------------------------------------------------
           4. STICKY SIDEBAR (Konsep Konsisten)
        ------------------------------------------------------------ */
        .sticky-sidebar { 
            position: sticky; 
            top: 100px; 
            z-index: 10; 
            background: white;
            border-radius: 20px; 
            align-self: flex-start;
            max-height: calc(100vh - 110px); 
            overflow-y: auto;
            /* Border-top dihapus sesuai permintaan sebelumnya */
        }

        .btn-indigo-outline { 
            border: 2px solid #5c60f5; color: #5c60f5; 
            font-weight: 700; border-radius: 12px; transition: 0.3s; 
            padding: 8px 20px; font-size: 0.85rem;
        }
        .btn-indigo-outline:hover { background-color: #5c60f5; color: white; }

        .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="container py-5">
        <div class="mb-5">
            <h2 class="fw-black text-slate-900" style="font-size: 2.5rem; letter-spacing: -1px;">Update Sesi Anda</h2>
            <p class="text-muted italic">"Sempurnakan alur belajar untuk hasil yang maksimal."</p>
        </div>

        <form action="{{ route('sessions.update', $session) }}" method="POST" id="editPblForm">
            @csrf
            @method('PUT')
            
            <div class="row g-4 align-items-start">
                
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
                            <input type="text" name="title" class="form-control form-control-custom fw-bold" value="{{ old('title', $session->title) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="label-custom">Tujuan Pembelajaran</label>
                            <div id="objectives-container">
                                @php $outcomes = old('f1_learning_objectives', $session->f1_learning_objectives ?? ['']); @endphp
                                @foreach($outcomes as $index => $outcome)
                                <div class="mb-3 p-3 bg-light rounded-4 position-relative animate-fade-in">
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
                            <label class="label-custom">Narasi Permasalahan</label>
                            <textarea name="f1_context" class="form-control form-control-custom" rows="6" required>{{ old('f1_context', $session->f1_context) }}</textarea>
                        </div>
                    </div>

                    <div class="card phase-card p-4 p-md-5">
                        <div class="d-flex align-items-center mb-5">
                            <div class="phase-icon"><i class="bi bi-search"></i></div>
                            <div><small class="text-indigo fw-black small tracking-widest uppercase">Fase 3: Penyelidikan</small></div>
                        </div>
                        <div id="questions-container">
                            @php $questions = old('f3_questions', $session->f3_questions ?? ['']); @endphp
                            @foreach($questions as $index => $question)
                            <div class="mb-3 p-4 bg-light rounded-4 position-relative animate-fade-in">
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

                    </div>

                <div class="col-lg-4">
                    <div class="sticky-sidebar card phase-card p-4 text-center shadow-lg border-0">
                        <div class="mb-4">
                            <h5 class="fw-black mb-1">Finalisasi Perubahan</h5>
                            <p class="text-muted small">Pastikan data sudah benar sebelum menyimpan</p>
                        </div>
                        
                        <hr class="mb-4 opacity-50">

                        <button type="submit" class="btn bg-indigo text-white w-100 py-3 fw-bold shadow-lg mb-3" style="border-radius: 15px;">
                            <i class="bi bi-cloud-check-fill me-2"></i> UPDATE PBL SESSION
                        </button>

                        <div class="p-3 bg-light rounded-4 mb-3">
                            <p class="text-muted mb-0" style="font-size: 0.75rem; line-height: 1.4;">
                                Perubahan akan langsung diterapkan pada sesi yang sedang berjalan.
                            </p>
                        </div>

                        <a href="{{ route('dashboard') }}" class="btn btn-link btn-sm text-muted text-decoration-none fw-bold">
                            Batal & Kembali
                        </a>
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

            setupDynamicContainer('objectives-container', 'add-objective', 'f1_learning_objectives[]', 'Objective', 'Tujuan selanjutnya...', 2);
            setupDynamicContainer('questions-container', 'add-question', 'f3_questions[]', 'Investigation Question', 'Pertanyaan investigasi selanjutnya...', 3);
            setupDynamicContainer('reflection-container', 'add-reflection', 'f5_questions[]', 'Reflection Question', 'Pertanyaan refleksi selanjutnya...', 2);

            // Logic Remove & Re-indexing
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-btn')) {
                    const parent = e.target.closest('.mb-3');
                    const container = parent.parentElement;
                    
                    parent.style.opacity = '0';
                    parent.style.transform = 'translateY(10px)';
                    
                    setTimeout(() => {
                        parent.remove();
                        // Re-index Labels
                        const labelTextMap = {
                            'objectives-container': 'Objective',
                            'questions-container': 'Investigation Question',
                            'reflection-container': 'Reflection Question'
                        };
                        
                        if (labelTextMap[container.id]) {
                            container.querySelectorAll('.label-custom').forEach((label, idx) => {
                                label.innerText = `${labelTextMap[container.id]} ${idx + 1}`;
                            });
                        }
                    }, 300);
                }
            });

            // Submission Validation
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
                    alert('Mohon jangan biarkan ada kolom yang kosong!');
                }
            });
        });
    </script>
</x-app-layout>