<x-app-layout>
    <style>
        body { background-color: #f0f2f5; }
        
        /* Indigo Theme Overrides */
        .text-indigo { color: #5c60f5 !important; }
        .bg-indigo { background-color: #5c60f5 !important; }
        .bg-indigo-subtle { background-color: #eef0ff !important; }
        
        .phase-card { border-radius: 15px; border: none; margin-bottom: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        
        .phase-icon { 
            width: 48px; height: 48px; border-radius: 12px; 
            display: flex; align-items: center; justify-content: center; 
            color: #5c60f5; background-color: #eef0ff; 
            margin-right: 15px; font-size: 1.25rem;
        }
        
        .label-custom { 
            font-weight: 700; color: #4a5568; font-size: 0.75rem; 
            text-transform: uppercase; letter-spacing: 0.8px; 
            margin-bottom: 0.6rem; display: block; 
        }

        .form-control-custom { 
            border-radius: 12px; border: 1px solid #e2e8f0; 
            padding: 12px 15px; background-color: #f8fafc; 
            transition: all 0.2s ease-in-out; 
        }

        .form-control-custom:focus { 
            background-color: white; border-color: #5c60f5; 
            box-shadow: 0 0 0 4px rgba(92, 96, 245, 0.1); outline: none; 
        }
        
        .btn-indigo-outline { 
            border: 2px solid #5c60f5; color: #5c60f5; 
            font-weight: 600; border-radius: 10px; transition: 0.3s; 
        }

        .btn-indigo-outline:hover { background-color: #5c60f5; color: white; }
        
        .bottom-bar { 
            padding: 40px 0; border-top: 1px solid #e2e8f0; margin-top: 20px;
        }
    </style>

    <div class="container py-5" style="max-width: 850px;">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #2d3748;">Update Learning Journey</h2>
            <p class="text-muted">Perbarui setiap fase untuk menyempurnakan sesi PBL ini.</p>
        </div>

        <form action="{{ route('sessions.update', $session) }}" method="POST">
            @csrf
            @method('PUT')
            
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
                    <input type="text" name="title" class="form-control form-control-custom" value="{{ old('title', $session->title) }}" required>
                </div>

                <div class="mb-4">
                    <label class="label-custom">Learning Objectives (Tujuan Pembelajaran)</label>
                    <div id="objectives-container">
                        @php $outcomes = old('f1_learning_objectives', $session->f1_learning_objectives ?? ['']); @endphp
                        @foreach($outcomes as $index => $outcome)
                        <div class="d-flex mb-2 align-items-center {{ $index > 0 ? 'mt-2' : '' }}">
                            <input type="text" name="f1_learning_objectives[]" class="form-control form-control-custom" value="{{ $outcome }}" required>
                            @if($index > 0)
                                <button type="button" class="btn-close ms-2 remove-btn"></button>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-objective" class="btn btn-link text-indigo btn-sm p-0 text-decoration-none fw-bold mt-1">
                        <i class="bi bi-plus-circle-fill me-1"></i> Tambah Poin Tujuan
                    </button>
                </div>

                <div class="mb-2">
                    <label class="label-custom">Problem Narrative</label>
                    <textarea name="f1_context" class="form-control form-control-custom" rows="4">{{ old('f1_context', $session->f1_context) }}</textarea>
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
                    @php $questions = old('f3_questions', $session->f3_questions ?? ['']); @endphp
                    @foreach($questions as $index => $question)
                    <div class="mb-3 p-3 border-0 bg-light shadow-sm" style="border-radius: 12px;">
                        <div class="d-flex justify-content-between mb-2">
                            <label class="label-custom">Question {{ $index + 1 }}</label>
                            @if($index > 0)
                                <button type="button" class="btn-close btn-sm remove-btn"></button>
                            @endif
                        </div>
                        <input type="text" name="f3_questions[]" class="form-control form-control-custom" value="{{ $question }}">
                    </div>
                    @endforeach
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
                    <textarea name="f4_instruction" class="form-control form-control-custom" rows="3">{{ old('f4_instruction', $session->f4_instruction) }}</textarea>
                </div>
                <div class="mb-2">
                    <label class="label-custom">System Description Question (Final Check)</label>
                    <input type="text" name="f4_question" class="form-control form-control-custom" value="{{ old('f4_question', $session->f4_question) }}">
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
                    @php $reflections = old('f5_questions', $session->f5_questions ?? ['']); @endphp
                    @foreach($reflections as $index => $reflection)
                    <div class="mb-3 p-3 border-0 bg-light shadow-sm" style="border-radius: 12px;">
                        <div class="d-flex justify-content-between mb-2">
                            <label class="label-custom">Reflection Question {{ $index + 1 }}</label>
                            @if($index > 0)
                                <button type="button" class="btn-close btn-sm remove-btn"></button>
                            @endif
                        </div>
                        <input type="text" name="f5_questions[]" class="form-control form-control-custom" value="{{ $reflection }}">
                    </div>
                    @endforeach
                </div>

                <button type="button" id="add-reflection" class="btn btn-indigo-outline btn-sm px-3 mt-2">
                    <i class="bi bi-plus-lg me-1"></i> Add Reflection Question
                </button>
            </div>

            <div class="bottom-bar">
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url()->previous() }}" class="btn btn-light btn-lg px-4 fw-bold" style="border-radius: 15px; border: 1px solid #e2e8f0; color: #64748b;">
                        Discard Changes
                    </a>
                    <button type="submit" class="btn bg-indigo text-white btn-lg px-5 fw-bold" style="border-radius: 15px;">
                        <i class="bi bi-cloud-check-fill me-2"></i> Update PBL Session
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            function setupDynamicContainer(containerId, buttonId, nameAttr, labelText, placeholder) {
                const container = document.getElementById(containerId);
                const button = document.getElementById(buttonId);

                button.addEventListener('click', function() {
                    const count = container.querySelectorAll('.form-control-custom').length + 1;
                    const div = document.createElement('div');
                    
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

            setupDynamicContainer('objectives-container', 'add-objective', 'f1_learning_objectives[]', 'Objective', 'Tujuan selanjutnya...');
            setupDynamicContainer('questions-container', 'add-question', 'f3_questions[]', 'Question', 'Pertanyaan investigasi selanjutnya...');
            setupDynamicContainer('reflection-container', 'add-reflection', 'f5_questions[]', 'Reflection Question', 'Pertanyaan refleksi selanjutnya...');

            // Global Remove & Re-indexing Logic
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-btn')) {
                    const targetDiv = e.target.closest('.mb-3') || e.target.closest('.d-flex');
                    const container = targetDiv.parentElement;
                    targetDiv.remove();

                    // Re-index labels if not objectives
                    if (container.id !== 'objectives-container') {
                        const labels = container.querySelectorAll('.label-custom');
                        labels.forEach((label, idx) => {
                            const labelText = container.id === 'questions-container' ? 'Question' : 'Reflection Question';
                            label.innerText = `${labelText} ${idx + 1}`;
                        });
                    }
                }
            });
        });
    </script>
</x-app-layout>