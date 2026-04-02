<x-workspace-layout>
    <style>
        body { background-color: #f8fafc; }
        .text-indigo { color: #5c60f5 !important; }
        .bg-indigo { background-color: #5c60f5 !important; }
        .bg-indigo-subtle { background-color: #eef0ff !important; }
        .border-indigo { border-color: #5c60f5 !important; }
        
        .card-eval { border-radius: 18px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }
        
        .sticky-panel { 
            position: sticky; 
            top: 120px; 
            z-index: 10; 
            border-top: 5px solid #10b981; /* Warna hijau untuk status Complete */
            border-radius: 20px; 
            max-height: calc(100vh - 110px);
            overflow-y: auto;
        }
        
        .answer-box { 
            background-color: #fcfdfe; 
            border: 1px solid #eef0ff;
            border-radius: 15px; 
            padding: 20px;
        }

        .label-mini { font-size: 0.65rem; font-weight: 800; letter-spacing: 1px; color: #94a3b8; text-transform: uppercase; }
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
                <div class="badge bg-success px-4 py-2 rounded-pill fw-bold shadow-sm">
                    <i class="bi bi-check-all me-1"></i> SESI SELESAI & DINILAI
                </div>
                <span class="badge bg-indigo-subtle text-indigo px-4 py-2 rounded-pill fw-bold" style="font-size: 0.85rem;">
                    KODE SESI: {{ $session->session_code }}
                </span>
            </div>
            
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <h1 class="fw-bold text-dark m-0">{{ $session->title }}</h1>
                    <p class="text-muted m-0">Hasil Akhir Kelompok: <span class="fw-bold text-dark">{{ $group->group_name }}</span></p>
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
                        <label class="label-mini mb-2 d-block text-indigo">Konteks Masalah:</label>
                        <div class="answer-box">
                            <div style="white-space: pre-wrap; color: #334155;">{{ $session->f1_context }}</div>
                        </div>
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
                                <small class="label-mini d-block mb-2">Jawaban Anda:</small>
                                <div class="text-dark small">{{ $group->f3_answers[$index] ?? '-' }}</div>
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
                        <label class="label-mini mb-2 d-block text-indigo">Source Code / Program:</label>
                        <div class="answer-box bg-dark" style="border: none; border-radius: 15px;">
                            <pre class="m-0" style="color: #f8f8f2; font-family: 'Courier New', monospace; font-size: 0.85rem; overflow-x: auto;"><code>{{ $group->f4_code ?? '// Tidak ada kode yang diunggah.' }}</code></pre>
                        </div>
                    </div>

                    <div class="px-2">
                        <p class="fw-bold mb-2 small">{{ $session->f4_question }}</p>
                        <div class="answer-box">
                            <small class="label-mini d-block mb-2">Deskripsi Sistem:</small>
                            <div class="text-dark small">{{ $group->f4_answers ?? '-' }}</div>
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
                                <small class="label-mini d-block mb-2">Refleksi Anda:</small>
                                <div class="text-dark small">{{ $group->f5_answers[$index] ?? '-' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sticky-panel card card-eval p-4 shadow-lg border-0">
                    <div class="text-center mb-4 pb-3 border-bottom">
                        <h6 class="fw-bold text-dark mb-1">Hasil Evaluasi Guru</h6>
                        <p class="text-muted small mb-0">Kelompok: {{ $group->group_name }}</p>
                    </div>

                    <div class="mb-4 text-center">
                        <label class="label-mini d-block mb-3">Final Score</label>
                        <div class="d-flex justify-content-center align-items-center bg-indigo-subtle border-indigo border py-3" 
                             style="border-radius: 18px; min-height: 100px;">
                            <span class="fw-bold text-indigo" style="font-size: 3.5rem;">
                                {{ $group->evaluation->score ?? '0' }}
                            </span>
                        </div>
                        <p class="text-muted small mt-2 italic">Nilai bersifat mutlak dan telah diarsipkan.</p>
                    </div>
                    
                    <div class="mb-4">
                        <label class="label-mini d-block mb-2">Feedback / Masukan Guru</label>
                        <div class="answer-box bg-light border-0" style="min-height: 150px; font-size: 0.95rem; line-height: 1.6;">
                            @if($group->evaluation && $group->evaluation->feedback_comment)
                                <i class="bi bi-quote text-indigo" style="font-size: 1.5rem;"></i>
                                <span class="text-dark">{{ $group->evaluation->feedback_comment }}</span>
                            @else
                                <span class="text-muted italic small">Guru tidak memberikan catatan tambahan.</span>
                            @endif
                        </div>
                    </div>

                    <a href="{{ route('beranda') }}" class="btn bg-indigo text-white w-100 py-3 fw-bold shadow-sm hover-lift" style="border-radius: 15px;">
                        <i class="bi bi-house-door me-2"></i> KEMBALI KE BERANDA
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-workspace-layout>