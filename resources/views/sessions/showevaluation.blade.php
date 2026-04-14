<x-app-layout>
    <style>
        body { background-color: #f8fafc; }
        .text-indigo { color: #5c60f5 !important; }
        .bg-indigo { background-color: #5c60f5 !important; }
        .bg-indigo-subtle { background-color: #eef0ff !important; }
        
        /* Card & UI Elements */
        .card-eval { border-radius: 18px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }
        
        .sticky-panel { 
            position: sticky; 
            top: 100px; 
            z-index: 10; 
            border-top: 5px solid #5c60f5; 
            border-radius: 20px; 
            max-height: calc(100vh - 110px); 
            overflow-y: auto;
        }
        
        /* Font Soal Seragam */
        .question-text {
            font-size: 1rem;
            font-weight: 600;
            color: #475569;
            white-space: pre-line;
            text-align: justify;
            line-height: 1.5;
        }

        /* Konten Jawaban */
        .content-text { 
            white-space: pre-line; 
            word-wrap: break-word;
            text-align: justify;
            color: #475569; 
            font-weight: 400;
            line-height: 1.6;
            display: block;
            font-size: 1rem;
        }

        /* Label tiap fase */
        .phase-title {
            font-size: 1.2rem; 
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #5c60f5;
            display: block;
        }

        .answer-box { 
            background-color: #ffffff; /* Putih bersih agar teks lebih kontras */
            border: 2px solid #e2e8f0; /* Dipertebal dari 1px ke 2px, warna lebih gelap */
            border-radius: 15px; 
            padding: 20px;
            /* Memberikan efek kedalaman agar area jawaban terlihat 'masuk' ke dalam card */
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); 
        }

        .label-mini{
            font-weight: 800; 
            color: #4a5568; 
            font-size: 1rem; 
            text-transform: uppercase; 
            letter-spacing: 1.2px; 
            margin-bottom: 0.8rem; 
            display: block; 
        }
        
        .phase-header { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .icon-box { 
            width: 54px; height: 54px; 
            display: flex; align-items: center; justify-content: center; 
            border-radius: 10px; background-color: #eef0ff; color: #5c60f5;
            font-size: 1.6rem;
        }

        /* Editor / Code Block Styling */
        .code-window {
            background: #1e1e1e;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid #333;
        }
        .code-header {
            background: #2d2d2d;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #3d3d3d;
        }
        .dot-container { display: flex; gap: 6px; }
        .dot { width: 10px; height: 10px; border-radius: 50%; }
        .dot-red { background: #ff5f56; }
        .dot-yellow { background: #ffbd2e; }
        .dot-green { background: #27c93f; }
        
        pre {
            margin: 0;
            padding: 20px;
            max-height: 400px;
            overflow: auto;
            scrollbar-width: thin;
            scrollbar-color: #444 #1e1e1e;
        }
        code {
            font-family: 'Fira Code', 'Cascadia Code', Consolas, monospace !important;
            font-size: 13px !important;
            color: #dcdcaa;
            line-height: 1.5;
        }

        .member-tag {
            background: #f1f5f9;
            color: #475569;
            padding: 5px 12px;
            border-radius: 8px;
            font-weight: 600;
            border: 1px solid #e2e8f0;
        }

        .hover-lift { transition: transform 0.2s; }
        .hover-lift:hover { transform: translateY(-2px); }
    </style>

    <div class="container py-5">
        <div class="mb-5">
            <a href="{{ url()->previous() }}" class="text-decoration-none border-end pe-3 me-3" style="color: #5c60f5;">
                <i class="bi bi-grid-1x2-fill"></i> Kembali Ke Panel Evaluasi
            </a>

            <div class="d-flex align-items-center gap-2 mb-2">
                <span style="font-size: 10px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 0.2em;">Evaluasi | Sesi: </span>
                <span style="font-size: 11px; font-weight: 900; color: #5c60f5; letter-spacing: 0.1em; text-transform: uppercase; font-style: italic;">{{ $session->session_code }}</span>
                <span style="font-size: 10px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 0.2em;">| Kelompok:</span>
                <span style="font-size: 11px; font-weight: 900; color: #5c60f5; letter-spacing: 0.1em; text-transform: uppercase; font-style: italic;">{{ $group->group_name }}</span>
            </div>

            <h1 class="font-black text-slate-900 tracking-tight leading-tight" 
                style="font-size: clamp(1.8rem, 5vw, 2rem); font-weight: 700; color: #0f172a; letter-spacing: -0.025em; line-height: 1.2;">
                {{ $session->title }}
            </h1>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                
                <div class="card card-eval p-4 mb-4">
                    <div class="phase-header">
                        <div class="icon-box"><i class="bi bi-rocket-takeoff-fill"></i></div>
                        <h5 class="phase-title m-0">ORIENTASI MASALAH & KELOMPOK SISWA</h5>
                    </div>
                    
                    <div class="mb-4 px-2">
                        <label class="label-mini mb-2">Konteks Masalah:</label>
                        <div class="answer-box">
                            <div class="content-text">{{ $session->f1_context }}</div>
                        </div>
                    </div>

                    <div class="mb-4 px-2">
                        <label class="label-mini mb-2">Tujuan Pembelajaran:</label>
                        <div class="row g-2">
                            @forelse($session->f1_learning_objectives ?? [] as $outcome)
                                <div class="col-md-6">
                                    <div class="bg-indigo-subtle p-3 h-100 shadow-sm" style="border-radius: 12px; border-left: 4px solid #5c60f5;">
                                        <div class="content-text">{{ $outcome }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-muted small italic">Belum ada tujuan pembelajaran.</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="mb-4 px-2 mt-4 pt-3 border-top">
                        <label class="label-mini mb-2">Anggota Kelompok:</label>
                        <div class="content-text d-flex flex-wrap gap-2">
                            @php
                                $members = is_array($group->student_data) ? ($group->student_data['members'] ?? $group->student_data) : json_decode($group->student_data, true);
                            @endphp
                            @foreach($members ?? [] as $name)
                                <span class="member-tag"><i class="bi bi-person-fill me-1"></i> {{ $name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="px-2 ">
                        <label class="label-mini mb-2" style="margin-left: 2px;">KELAS:</label>
                        <div>
                            <span class="member-tag d-flex align-items-center" 
                                style="background-color: #eef0ff; color: #5c60f5; border: 1.5px solid #d0d7ff; width: fit-content;">
                                <i class="bi bi-door-open-fill me-2" style="font-size: 0.85rem;"></i>
                                {{ $group->class_name ?? '-' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card card-eval p-4 mb-4">
                    <div class="phase-header">
                        <div class="icon-box"><i class="bi bi-card-checklist"></i></div>
                        <h5 class="phase-title m-0">PENYELIDIKAN</h5>
                    </div>
                    @foreach($session->f3_questions ?? [] as $index => $q)
                        <div class="mb-4 px-2">
                            <div class="question-text mb-2">{{ $q }}</div>
                            <div class="answer-box">
                                <span class="label-mini d-block mb-2">Jawaban Kelompok:</span>
                                <div class="content-text">{{ $group->f3_answers[$index] ?? 'Kosong.' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card card-eval p-4 mb-4 border-0 shadow-sm" style="border-radius: 20px;">
                    <div class="phase-header mb-1">
                        <div class="icon-box"><i class="bi bi-code-slash"></i></div>
                        <h5 class="phase-title m-0">MENGEMBANGKAN & MENYAJIKAN SOLUSI</h5>
                    </div>

                    <div class="px-2">
                        <div class="mb-3">
                            <div class="question-text">
                                {{ $session->f4_instruction ?? 'Implementasikan solusi koding di bawah ini.' }}
                            </div>
                        </div>

                        <div class="px-2">
                            <label class="label-mini mb-2" style="font-size: 1rem; color: #475569;">TAUTAN EKSTERNAL SISWA:</label>
                            <a href="{{ $group->f4_link }}" target="_blank" 
                            class="answer-box d-flex align-items-center gap-4 text-decoration-none hover-lift shadow-sm w-100" 
                            style="transition: all 0.2s; border-color: #5c60f5; background: #f8faff; padding: 25px;">
                                
                                <div class="icon-box shadow-sm" style="width: 65px; height: 65px; min-width: 65px; font-size: 2rem; background: #eef0ff; border-radius: 15px; color: #5c60f5;">
                                    <i class="bi bi-link-45deg"></i>
                                </div>

                                <div class="overflow-hidden flex-grow-1">
                                    <div class="text-indigo fw-bold text-truncate" style="font-size: 1.25rem; letter-spacing: -0.01em; margin-bottom: 4px;">
                                        {{ $group->f4_link }}
                                    </div>
                                    <div class="text-muted" style="font-size: 0.95rem; font-weight: 500;">
                                        <i class="bi bi-box-arrow-up-right me-1"></i> Klik untuk meninjau hasil kode siswa di tab baru
                                    </div>
                                </div>

                                <div class="ms-auto text-indigo opacity-50">
                                    <i class="bi bi-chevron-right" style="font-size: 1.8rem;"></i>
                                </div>
                            </a>
                        </div>

                        <div class="mb-3">
                            <div class="question-text mb-3" style="font-size: 0.95rem;">
                                {{ $session->f4_question ?? 'Jelaskan bagaimana sistem yang Anda buat bekerja.' }}
                            </div>
                            
                            <div class="answer-box">
                                <small class="label-mini d-block mb-2 text-muted">Jawaban Kelompok:</small>
                                <div class="content-text">{{ $group->f4_answers ?? 'Siswa tidak memberikan penjelasan.' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-eval p-4 mb-4">
                    <div class="phase-header">
                        <div class="icon-box"><i class="bi bi-chat-dots-fill"></i></div>
                        <h5 class="phase-title m-0">EVALUASI</h5>
                    </div>
                    @foreach($session->f5_questions ?? [] as $index => $r)
                        <div class="mb-4 px-2">
                            <div class="question-text mb-2">{{ $r }}</div>
                            <div class="answer-box">
                                <small class="label-mini d-block mb-2">Jawaban Kelompok:</small>
                                <div class="content-text">{{ $group->f5_answers[$index] ?? 'Kosong.' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sticky-panel card card-eval p-4 shadow-lg border-0">
                    <div class="text-center mb-4 pb-3 border-bottom">
                        <h6 class="mb-1" style="font-size: 1rem; font-weight:700;" >EVALUASI GURU</h6>
                        <p class="mb-0">{{ $group->group_name }}</p>
                    </div>

                    <form action="{{ route('groups.evaluate', $group->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="label-mini d-block mb-2">Umpan Balik</label>
                            <textarea name="feedback_comment" class="form-control bg-light border-0 p-3" 
                                rows="6" style="border-radius: 18px; font-size: 1rem;"
                                placeholder="Tulis feedback..." required>{{ $group->evaluation->feedback_comment ?? '' }}</textarea>
                        </div>

                        <button type="submit" class="btn bg-indigo  text-white w-100 py-3 fw-bold shadow-lg mb-3" style="border-radius: 15px; font-size: 0.9rem;";">
                            SIMPAN DAN PERBARUI UMPAN BALIK
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>