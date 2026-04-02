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
        }

        .phase-title { color: #1e293b; font-weight: 800; }

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
            font-size: 0.85rem;
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
                style="font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 900; color: #0f172a; letter-spacing: -0.025em; line-height: 1.2;">
                {{ $session->title }}
            </h1>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                
                <div class="card card-eval p-4 mb-4">
                    <div class="phase-header">
                        <div class="icon-box"><i class="bi bi-rocket-takeoff-fill"></i></div>
                        <h5 class="phase-title m-0">FASE 1: ORIENTASI MASALAH & FASE 2: MENGORGANISASI SISWA</h5>
                    </div>
                    
                    <div class="mb-4 px-2">
                        <label class="label-mini mb-2 d-block text-indigo">Konteks Masalah:</label>
                        <div class="answer-box">
                            <div class="content-text">{{ $session->f1_context }}</div>
                        </div>
                    </div>

                    <div class="mb-4 px-2">
                        <label class="label-mini mb-2 d-block text-indigo">Tujuan Pembelajaran:</label>
                        <div class="row g-2">
                            @forelse($session->f1_learning_objectives ?? [] as $outcome)
                                <div class="col-md-6">
                                    <div class="bg-indigo-subtle p-3 h-100 shadow-sm" style="border-radius: 12px; border-left: 4px solid #5c60f5;">
                                        <div class="content-text small fw-semibold">{{ $outcome }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-muted small italic">Belum ada tujuan pembelajaran.</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="px-2 mt-4 pt-3 border-top">
                        <label class="label-mini mb-2 d-block text-indigo">Anggota Kelompok:</label>
                        <div class="d-flex flex-wrap gap-2">
                            @php
                                $members = is_array($group->student_data) ? ($group->student_data['members'] ?? $group->student_data) : json_decode($group->student_data, true);
                            @endphp
                            @foreach($members ?? [] as $name)
                                <span class="member-tag"><i class="bi bi-person-fill me-1"></i> {{ $name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card card-eval p-4 mb-4">
                    <div class="phase-header">
                        <div class="icon-box"><i class="bi bi-card-checklist"></i></div>
                        <h5 class="phase-title m-0">FASE 3: PENYELIDIKAN</h5>
                    </div>
                    @foreach($session->f3_questions ?? [] as $index => $q)
                        <div class="mb-4 px-2">
                            <div class="question-text mb-2">{{ $index + 1 }}. {{ $q }}</div>
                            <div class="answer-box">
                                <small class="label-mini d-block mb-2">Jawaban Kelompok:</small>
                                <div class="content-text small">{{ $group->f3_answers[$index] ?? 'Kosong.' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card card-eval p-4 mb-4 border-0 shadow-sm" style="border-radius: 20px;">
                    <div class="phase-header mb-4">
                        <div class="icon-box"><i class="bi bi-code-slash"></i></div>
                        <h5 class="phase-title m-0">FASE 4: MENGEMBANGKAN & MENYAJIKAN SOLUSI</h5>
                    </div>

                    <div class="bg-light p-3 mb-0 d-flex align-items-start gap-3" style="border-radius: 15px; border-left: 4px solid #5c60f5;">
                        <i class="bi bi-info-circle text-indigo mt-1"></i>
                        <div class="small text-muted">
                            Guru dapat memodifikasi kode untuk pengujian. Perubahan bersifat sementara dan tidak mengubah jawaban asli siswa. Gunakan tombol <strong>Reset Kode</strong> untuk mengembalikan.
                        </div>
                    </div>

                    <div class="px-2">
                        <div class="mb-2">
                            <div class="question-text p-3">
                                {{ $session->f4_instruction ?? 'Implementasikan solusi koding di bawah ini.' }}
                            </div>
                        </div>

                        <div class="code-window mb-3" style="background: #1e1e2e; border-radius: 15px; border: none;">
                            <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom border-secondary" style="background: rgba(255,255,255,0.05);">
                                <span class="text-secondary" style="font-size: 0.7rem; font-family: monospace; letter-spacing: 1px;">MAIN.PY</span>
                                <button type="button" onclick="resetCode()" class="btn btn-link btn-sm text-secondary text-decoration-none p-0" style="font-size: 0.7rem;">
                                    <i class="bi bi-arrow-counterclockwise"></i> RESET KODE
                                </button>
                            </div>
                            <textarea id="codeEditor" class="code-editor-textarea" 
                                style="height: 320px; background: transparent; color: #e0e0e0; border: none; width: 100%; padding: 20px; font-family: 'Fira Code', monospace; outline: none; resize: none;" 
                                spellcheck="false">{{ $group->f4_code ?? '' }}</textarea>
                        </div>

                        <button type="button" onclick="runCode()" class="btn w-100 py-3 mb-4 shadow-sm hover-lift" 
                            style="background: #1e1e2e; color: white; border-radius: 12px; font-weight: 700; letter-spacing: 1px;">
                            <i class="bi bi-play-fill me-2"></i> JALANKAN PROGRAM
                        </button>

                        <div class="terminal-box mb-2" style="background: #0f172a; border-radius: 15px; overflow: hidden;">
                            <div class="px-3 py-2 border-bottom border-secondary" style="background: rgba(255,255,255,0.03);">
                                <div class="d-flex justify-content-between">
                                    <span class="text-secondary fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">TERMINAL OUTPUT</span>
                                    <span id="statusBadge" class="text-secondary" style="font-size: 0.65rem;">&gt; Ready...</span>
                                </div>
                            </div>
                            <pre id="outputArea" class="p-3 m-0" 
                                style="min-height: 120px; color: #10b981; font-family: 'Fira Code', monospace; font-size: 13px; white-space: pre-wrap;">&gt; Menunggu eksekusi...</pre>
                        </div>

                        <div class="mb-3">
                            <div class="question-text mb-3" style="font-size: 0.95rem;">
                                {{ $session->f4_question ?? 'Jelaskan bagaimana sistem yang Anda buat bekerja.' }}
                            </div>
                            
                            <div class="answer-box shadow-sm" style="background: #fcfdfe; border: 1px solid #eef0ff;">
                                <small class="label-mini d-block mb-2 text-muted">Jawaban Deskripsi Siswa:</small>
                                <div class="content-text small">{{ $group->f4_answers ?? 'Siswa tidak memberikan penjelasan.' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-eval p-4 mb-4">
                    <div class="phase-header">
                        <div class="icon-box"><i class="bi bi-chat-dots-fill"></i></div>
                        <h5 class="phase-title m-0">FASE 5: REFLEKSI</h5>
                    </div>
                    @foreach($session->f5_questions ?? [] as $index => $r)
                        <div class="mb-4 px-2">
                            <div class="question-text mb-2">{{ $r }}</div>
                            <div class="answer-box">
                                <small class="label-mini d-block mb-2">Refleksi Kelompok:</small>
                                <div class="content-text small">{{ $group->f5_answers[$index] ?? 'Kosong.' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sticky-panel card card-eval p-4 shadow-lg border-0">
                    <div class="text-center mb-4 pb-3 border-bottom">
                        <h6 class="fw-bold text-dark mb-1">Evaluasi Guru</h6>
                        <p class="text-muted small mb-0">{{ $group->group_name }}</p>
                    </div>

                    <form action="{{ route('groups.evaluate', $group->id) }}" method="POST">
                        @csrf
                        {{--
                        <div class="mb-4 text-center">
                            <label class="label-mini d-block mb-3">Final Score</label>
                            <input type="number" name="score" 
                                class="form-control form-control-lg fw-bold text-center text-indigo border-indigo" 
                                style="font-size: 2.5rem; border-radius: 18px; height: 90px;" 
                                value="{{ $group->evaluation->score ?? '' }}" 
                                required min="0" max="100">
                        </div>
                        --}}
                        
                        <div class="mb-4">
                            <label class="label-mini d-block mb-2">Umpan Balik</label>
                            <textarea name="feedback_comment" class="form-control bg-light border-0 p-3" 
                                rows="6" style="border-radius: 18px; font-size: 0.9rem;"
                                placeholder="Tulis feedback..." required>{{ $group->evaluation->feedback_comment ?? '' }}</textarea>
                        </div>

                        <button type="submit" class="btn bg-indigo text-white w-100 py-3 fw-bold shadow-sm hover-lift" style="border-radius: 15px;">
                            SIMPAN UMPAN BALIK
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Simpan kode asli murid di variabel JavaScript agar bisa di-reset
    const originalCode = `{!! addslashes($group->f4_code ?? '') !!}`;

    function resetCode() {
        if(confirm('Kembalikan kode ke jawaban asli siswa?')) {
            document.getElementById('codeEditor').value = originalCode;
            const outputArea = document.getElementById('outputArea');
            const statusBadge = document.getElementById('statusBadge');
            
            outputArea.innerText = 'Kode telah di-reset.';
            outputArea.style.color = "#aaa";
            statusBadge.innerText = "Ready";
            statusBadge.className = "label-mini text-secondary";
        }
    }

    async function runCode() {
        const editor = document.getElementById('codeEditor');
        const outputArea = document.getElementById('outputArea');
        const statusBadge = document.getElementById('statusBadge');
        
        const codeValue = editor.value;
        
        statusBadge.innerText = "Running...";
        statusBadge.className = "label-mini text-warning";
        outputArea.innerText = "Executing...";

        try {
            const response = await fetch('/run-python', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ code: codeValue })
            });

            const data = await response.json();

            if (data.error) {
                statusBadge.innerText = "Error";
                statusBadge.className = "label-mini text-danger";
                outputArea.style.color = "#ff6b6b";
                outputArea.innerText = data.error + (data.output ? "\n" + data.output : "");
            } else {
                statusBadge.innerText = "Success";
                statusBadge.className = "label-mini text-success";
                outputArea.style.color = "#a3be8c"; 
                outputArea.innerText = data.output || "Program selesai (tanpa output).";
            }
        } catch (e) {
            statusBadge.innerText = "Network Error";
            statusBadge.className = "label-mini text-danger";
            outputArea.innerText = "Gagal menghubungi server: " + e.message;
        }
    }
</script>
</x-app-layout>