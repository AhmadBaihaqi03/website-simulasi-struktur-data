<x-app-layout>
    <style>
        body { background-color: #f8fafc; }
        .text-indigo { color: #5c60f5 !important; }
        .bg-indigo { background-color: #5c60f5 !important; }
        .bg-indigo-subtle { background-color: #eef0ff !important; }
        .border-indigo { border-color: #5c60f5 !important; }
        
        /* Card & UI Elements */
        .card-eval { border-radius: 18px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }
        .sticky-panel { top: 20px; border-top: 5px solid #5c60f5; position: sticky; border-radius: 20px; }
        
        /* Rounded Answer Boxes */
        .answer-box { 
            background-color: #fcfdfe; 
            border: 1px solid #eef0ff;
            border-radius: 15px; /* Kelengkungan yang diminta */
            padding: 20px;
        }

        .label-mini { font-size: 0.65rem; font-weight: 800; letter-spacing: 1px; color: #94a3b8; text-transform: uppercase; }
        
        /* Symmetrical Icon Alignment */
        .phase-header { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .icon-box { 
            width: 38px; height: 38px; 
            display: flex; align-items: center; justify-content: center; 
            border-radius: 10px; background-color: #eef0ff; color: #5c60f5;
        }

        .hover-lift { transition: transform 0.2s; }
        .hover-lift:hover { transform: translateY(-2px); }
    </style>

    <div class="container py-5">
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ url()->previous() }}" class="text-decoration-none text-indigo fw-bold small hover-lift">
                    <i class="bi bi-chevron-left"></i> KEMBALI KE PANEL EVALUASI
                </a>
                <span class="badge bg-indigo-subtle text-indigo px-4 py-2 rounded-pill fw-bold" style="font-size: 0.85rem;">
                    KODE SESI: {{ $session->session_code }}
                </span>
            </div>
            
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <h1 class="fw-bold text-dark m-0">{{ $session->title }}</h1>
                    <p class="text-muted m-0">Menilai Kelompok: <span class="fw-bold text-dark">{{ $group->group_name }}</span></p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                
                <div class="card card-eval p-4 mb-4">
                    <div class="phase-header">
                        <div class="icon-box"><i class="bi bi-rocket-takeoff-fill"></i></div>
                        <h5 class="fw-bold m-0">Phase 01 & 02: Initiation</h5>
                    </div>
                    
                    <div class="mb-4 px-2">
                        <label class="label-mini mb-2 d-block text-indigo">Konteks Masalah (The Hook):</label>
                        <div class="answer-box">
                            <div style="white-space: pre-wrap; color: #334155;">{{ $session->f1_context }}</div>
                        </div>
                    </div>

                    <div class="px-2">
                        <label class="label-mini mb-2 d-block text-indigo">Learning Objectives:</label>
                        <div class="bg-indigo-subtle p-3" style="border-radius: 15px;">
                            <ul class="mb-0 list-unstyled">
                                @forelse($session->f1_learning_objectives ?? [] as $outcome)
                                    <li class="text-dark small fw-semibold mb-1">• {{ $outcome }}</li>
                                @empty
                                    <li class="text-muted small italic">Belum ada tujuan pembelajaran.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card card-eval p-4 mb-4 shadow-sm">
                    <div class="phase-header">
                        <div class="icon-box"><i class="bi bi-people-fill"></i></div>
                        <h6 class="fw-bold m-0">Anggota Kelompok</h6>
                    </div>
                    <div class="d-flex flex-wrap gap-2 px-2">
                        @php 
                            $members = is_array($group->student_data) ? ($group->student_data['members'] ?? $group->student_data) : json_decode($group->student_data, true);
                        @endphp
                        @foreach($members as $member)
                            <span class="badge bg-light border text-dark px-3 py-2 rounded-pill shadow-sm hover-lift fw-bold">
                                {{ $member }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="card card-eval p-4 mb-4">
                    <div class="phase-header">
                        <div class="icon-box"><i class="bi bi-card-checklist"></i></div>
                        <h5 class="fw-bold m-0">Phase 03: Inquiry & Investigation</h5>
                    </div>
                    @foreach($session->f3_questions ?? [] as $index => $q)
                        <div class="mb-4 px-2">
                            <p class="fw-bold mb-2 text-dark" style="font-size: 0.95rem;">{{ $index + 1 }}. {{ $q }}</p>
                            <div class="answer-box">
                                <small class="label-mini d-block mb-2">Jawaban Kelompok:</small>
                                <div class="text-dark small">{{ $group->student_data['answers_f3'][$index] ?? 'Siswa belum mengisi jawaban.' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card card-eval p-4 mb-4">
                    <div class="phase-header">
                        <div class="icon-box"><i class="bi bi-code-slash"></i></div>
                        <h5 class="fw-bold m-0">Phase 04: Implementation</h5>
                    </div>
                    
                    <div class="mb-4 px-2">
                        <p class="fw-bold mb-2 small">{{ $session->f4_instruction }}</p>
                        <div class="answer-box text-center" style="border-style: dashed !important;">
                            @if(isset($group->student_data['f4_code_link']))
                                <a href="{{ $group->student_data['f4_code_link'] }}" target="_blank" class="btn btn-indigo text-white fw-bold px-4 rounded-pill shadow-sm">
                                    <i class="bi bi-link-45deg me-1"></i> Buka Link Project
                                </a>
                            @else
                                <span class="text-muted small italic">Siswa belum menyertakan link project.</span>
                            @endif
                        </div>
                    </div>

                    <div class="px-2">
                        <p class="fw-bold mb-2 small">{{ $session->f4_question }}</p>
                        <div class="answer-box">
                            <small class="label-mini d-block mb-2">Deskripsi Sistem:</small>
                            <div class="text-dark small">{{ $group->student_data['f4_answer'] ?? 'Belum ada deskripsi sistem.' }}</div>
                        </div>
                    </div>
                </div>

                <div class="card card-eval p-4 mb-4">
                    <div class="phase-header">
                        <div class="icon-box"><i class="bi bi-chat-dots-fill"></i></div>
                        <h5 class="fw-bold m-0">Phase 05: Reflection</h5>
                    </div>
                    @foreach($session->f5_questions ?? [] as $index => $r)
                        <div class="mb-4 px-2">
                            <p class="fw-bold mb-2 text-dark small">{{ $r }}</p>
                            <div class="answer-box">
                                <small class="label-mini d-block mb-2">Refleksi:</small>
                                <div class="text-dark small">{{ $group->student_data['answers_f5'][$index] ?? 'Belum mengisi refleksi.' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-eval p-4 sticky-panel shadow-lg border-0">
                    <div class="text-center mb-4 pb-3 border-bottom">
                        <h6 class="fw-bold text-dark mb-1">Teacher Evaluation</h6>
                        <p class="text-muted small mb-0">Kelompok: {{ $group->group_name }}</p>
                    </div>

                    <form action="{{ route('groups.evaluate', $group->id) }}" method="POST">
                        @csrf
                        <div class="mb-4 text-center">
                            <label class="label-mini d-block mb-3">Final Score (0-100)</label>
                            <div class="d-flex justify-content-center">
                                <input type="number" name="score" 
                                       class="form-control form-control-lg fw-bold text-center text-indigo border-indigo shadow-sm" 
                                       style="font-size: 2.5rem; border-radius: 18px; width: 140px; height: 90px; background-color: #fcfdfe;" 
                                       value="{{ $group->evaluation->score ?? '' }}" required min="0" max="100">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="label-mini d-block mb-2">Feedback Comment</label>
                            <textarea name="feedback_comment" class="form-control bg-light border-0 p-3 shadow-inner" 
                                      rows="8" style="border-radius: 18px; font-size: 0.9rem;"
                                      placeholder="Berikan masukan...">{{ $group->evaluation->feedback_comment ?? '' }}</textarea>
                        </div>

                        <button type="submit" class="btn bg-indigo text-white w-100 py-3 fw-bold shadow-sm hover-lift" style="border-radius: 15px;">
                            <i class="bi bi-check2-all me-2"></i> SIMPAN PENILAIAN
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>