<x-app-layout>
    <style>
        body { background-color: #f0f2f5; }
        
        /* Indigo Theme Overrides */
        .text-indigo { color: #5c60f5 !important; }
        .bg-indigo { background-color: #5c60f5 !important; }
        .bg-indigo-subtle { background-color: #eef0ff !important; }
        
        .phase-card { border-radius: 15px; border: none; margin-bottom: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        
        /* Icon Style: Seragam Indigo */
        .phase-icon { 
            width: 48px; 
            height: 48px; 
            border-radius: 12px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: #5c60f5; 
            background-color: #eef0ff; 
            margin-right: 15px; 
            font-size: 1.25rem;
        }

        .label-custom { 
            font-weight: 700; 
            color: #4a5568; 
            font-size: 0.75rem; 
            text-transform: uppercase; 
            letter-spacing: 0.8px; 
            margin-bottom: 0.6rem; 
            display: block; 
        }

        .form-control-custom { 
            border-radius: 12px; 
            border: 1px solid #e2e8f0; 
            padding: 12px 15px; 
            background-color: #f8fafc; 
            transition: all 0.2s ease-in-out; 
        }

        .form-control-custom:focus { 
            background-color: white; 
            border-color: #5c60f5; 
            box-shadow: 0 0 0 4px rgba(92, 96, 245, 0.1); 
            outline: none; 
        }
        
        .btn-indigo-outline { 
            border: 2px solid #5c60f5; 
            color: #5c60f5; 
            font-weight: 600; 
            border-radius: 10px;
            transition: 0.3s; 
        }

        .btn-indigo-outline:hover { 
            background-color: #5c60f5; 
            color: white; 
        }
        
        .bottom-bar { 
            bottom: 0; 
            padding: 20px 0; 
            border-top: 1px solid #e2e8f0; 
            z-index: 100; 
        }
    </style>

    <div class="container py-5" style="max-width: 850px;">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #2d3748;">Design the Learning Journey</h2>
            <p class="text-muted">Lengkapi setiap fase untuk menciptakan sesi PBL yang terstruktur.</p>
        </div>

        <form action="{{ route('sessions.store') }}" method="POST">
            @csrf
            
            <div class="card phase-card p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="phase-icon"><i class="bi bi-journal-text"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0">Scenario Narrative</h5>
                        <small class="text-muted fw-bold small">PHASE 01: THE HOOK</small>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="label-custom">Session Title</label>
                    <input type="text" name="title" class="form-control form-control-custom" placeholder="e.g., Optimizing Supply Chain Logic with Linked Lists" required>
                </div>

                <div class="mb-4">
                    <label class="label-custom">Learning Objectives (Tujuan Pembelajaran)</label>
                    <div id="objectives-container">
                        <div class="d-flex mb-2">
                            <input type="text" name="f1_learning_objectives[]" class="form-control form-control-custom" placeholder="Contoh: Siswa mampu menganalisis efisiensi algoritma" required>
                        </div>
                    </div>
                    <button type="button" id="add-objective" class="btn btn-link text-indigo btn-sm p-0 text-decoration-none fw-bold mt-1">
                        <i class="bi bi-plus-circle-fill me-1"></i> Tambah Poin Tujuan
                    </button>
                </div>

                <div class="mb-2">
                    <label class="label-custom">Problem Narrative</label>
                    <textarea name="f1_context" class="form-control form-control-custom" rows="4" placeholder="Ceritakan sebuah cerita tantangan yang menarik bagi siswa..."></textarea>
                </div>
            </div>

            <div class="card phase-card p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="phase-icon"><i class="bi bi-search"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0">Investigation Questions</h5>
                        <small class="text-muted fw-bold small">PHASE 03: INQUIRY</small>
                    </div>
                </div>
                
                <div id="questions-container">
                    <div class="mb-3 p-3 border-0 bg-light shadow-sm" style="border-radius: 12px;">
                        <label class="label-custom">Question 1</label>
                        <input type="text" name="f3_questions[]" class="form-control form-control-custom" placeholder="e.g., Bagaimana pengaruh variabel X terhadap output Y?">
                    </div>
                </div>

                <button type="button" id="add-question" class="btn btn-indigo-outline btn-sm px-3 mt-2">
                    <i class="bi bi-plus-lg me-1"></i> Add Investigation Task
                </button>
            </div>

            <div class="card phase-card p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="phase-icon"><i class="bi bi-code-slash"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0">Implementation Task</h5>
                        <small class="text-muted fw-bold small">PHASE 04: IMPLEMENTATION</small>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="label-custom">System Implementation Instruction</label>
                    <textarea name="f4_instruction" class="form-control form-control-custom" rows="3" placeholder="Deskripsikan kebutuhan teknis yang harus diimplementasikan siswa..."></textarea>
                </div>
                <div class="mb-2">
                    <label class="label-custom">System Description Question (Final Check)</label>
                    <input type="text" name="f4_question" class="form-control form-control-custom" placeholder="e.g., Jelaskan bagaimana algoritma anda menangani kebocoran memori.">
                    <small class="text-muted d-block mt-2">Pertanyaan ini dijawab murid untuk mendeskripsikan hasil kerja mereka.</small>
                </div>
            </div>

            <div class="card phase-card p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="phase-icon"><i class="bi bi-chat-left-text-fill"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0">Evaluation & Reflection</h5>
                        <small class="text-muted fw-bold small">PHASE 05: SYNTHESIS</small>
                    </div>
                </div>

                <div id="reflection-container">
                    <div class="mb-3 p-3 border-0 bg-light shadow-sm" style="border-radius: 12px;">
                        <label class="label-custom">Reflection Question 1</label>
                        <input type="text" name="f5_questions[]" class="form-control form-control-custom" placeholder="Apa bagian paling menantang dari sesi ini?">
                    </div>
                </div>

                <button type="button" id="add-reflection" class="btn btn-indigo-outline btn-sm px-3 mt-2">
                    <i class="bi bi-plus-lg me-1"></i> Add Reflection Question
                </button>
            </div>

            <div class="bottom-bar">
                <div class="container d-flex justify-content-center">
                    <button type="submit" class="btn bg-indigo text-white btn-lg px-5 fw-bold py-3" style="border-radius: 15px;">
                        <i class="bi bi-rocket-takeoff-fill me-2"></i> Launch Unified PBL Session
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Reusable Function for Dynamic Inputs
            function setupDynamicContainer(containerId, buttonId, nameAttr, labelText, placeholder) {
                const container = document.getElementById(containerId);
                const button = document.getElementById(buttonId);
                let count = 1;

                button.addEventListener('click', function() {
                    count++;
                    const div = document.createElement('div');
                    // Styling beda untuk Fase 1 (tanpa bg-light) dan Fase 3/5 (dengan bg-light)
                    if(containerId === 'objectives-container') {
                        div.className = 'd-flex mb-2 align-items-center mt-2 animate__animated animate__fadeIn';
                        div.innerHTML = `
                            <input type="text" name="${nameAttr}" class="form-control form-control-custom" placeholder="${placeholder}">
                            <button type="button" class="btn-close ms-2 remove-btn"></button>
                        `;
                    } else {
                        div.className = 'mb-3 p-3 border-0 bg-light shadow-sm mt-3 animate__animated animate__fadeIn';
                        div.style.borderRadius = '12px';
                        div.innerHTML = `
                            <div class="d-flex justify-content-between mb-2">
                                <label class="label-custom">${labelText} ${count}</label>
                                <button type="button" class="btn-close btn-sm remove-btn"></button>
                            </div>
                            <input type="text" name="${nameAttr}" class="form-control form-control-custom" placeholder="${placeholder}">
                        `;
                    }
                    container.appendChild(div);
                });
            }

            // Inisialisasi semua kontainer dinamis
            setupDynamicContainer('objectives-container', 'add-objective', 'f1_learning_objectives[]', 'Objective', 'Tujuan selanjutnya...');
            setupDynamicContainer('questions-container', 'add-question', 'f3_questions[]', 'Question', 'Pertanyaan investigasi selanjutnya...');
            setupDynamicContainer('reflection-container', 'add-reflection', 'f5_questions[]', 'Reflection Question', 'Pertanyaan refleksi selanjutnya...');

            // Global Remove Button Logic
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-btn')) {
                    const target = e.target.closest('.mb-3') || e.target.closest('.d-flex');
                    target.remove();
                }
            });
        });
    </script>
</x-app-layout>