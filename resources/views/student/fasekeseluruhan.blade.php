<x-workspace-layout>
    <style>
        body { background-color: #f8fafc; }
        .text-indigo { color: #5c60f5 !important; }
        .bg-indigo { background-color: #5c60f5 !important; }
        .bg-indigo-subtle { background-color: #eef0ff !important; }
        .border-indigo { border-color: #5c60f5 !important; }
        
        /* Card & UI Elements */
        .card-eval { border-radius: 18px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }
        .sticky-panel { top: 20px; border-top: 5px solid #5c60f5; position: sticky; border-radius: 20px; }
        
        /* Rounded Input Boxes */
        .answer-box-input { 
            background-color: #fcfdfe; 
            border: 2px solid #eef0ff;
            border-radius: 15px;
            padding: 15px;
            transition: all 0.3s;
        }
        .answer-box-input:focus {
            border-color: #5c60f5;
            box-shadow: 0 0 0 4px rgba(92, 96, 245, 0.1);
            outline: none;
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
        <form action="{{ route('student.save.all', [$session->session_code, $group->id]) }}" method="POST">
            @csrf
            
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-indigo-subtle text-indigo px-4 py-2 rounded-pill fw-bold">
                        SESI AKTIF: {{ $session->session_code }}
                    </span>
                    <div class="text-muted small fw-bold">
                        <i class="bi bi-clock-history me-1"></i> Progres otomatis tersimpan saat tombol simpan diklik
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h1 class="fw-bold text-dark m-0">{{ $session->title }}</h1>
                        <p class="text-muted m-0">Ruang Kerja Kelompok: <span class="fw-bold text-indigo">{{ $group->group_name }}</span></p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    
                    <div class="card card-eval p-4 mb-4 border-start border-indigo border-5">
                        <div class="phase-header">
                            <div class="icon-box"><i class="bi bi-rocket-takeoff-fill"></i></div>
                            <h5 class="fw-bold m-0">Phase 01: Orientasi Masalah</h5>
                        </div>
                        
                        <div class="mb-4 px-2">
                            <label class="label-mini mb-2 d-block text-indigo">Konteks & Masalah:</label>
                            <div class="p-3 bg-light" style="border-radius: 15px; white-space: pre-wrap;">{{ $session->f1_context }}</div>
                        </div>

                        <div class="px-2">
                            <label class="label-mini mb-2 d-block text-indigo">Learning Objectives:</label>
                            <div class="bg-indigo-subtle p-3" style="border-radius: 15px;">
                                <ul class="mb-0 list-unstyled">
                                    @foreach($session->f1_learning_objectives ?? [] as $outcome)
                                        <li class="text-dark small fw-semibold mb-1">• {{ $outcome }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card card-eval p-4 mb-4">
                        <div class="phase-header">
                            <div class="icon-box"><i class="bi bi-people-fill"></i></div>
                            <h5 class="fw-bold m-0">Phase 02: Organisasi Belajar</h5>
                        </div>
                        
                        <div class="px-2">
                            <label class="label-mini mb-3 d-block text-indigo">Daftar Anggota Kelompok:</label>
                            
                            <div id="members-container">
                                @php 
                                    // Kita ambil data anggota yang sudah tersimpan, jika belum ada buat minimal 1 input kosong
                                    $members = $group->student_data['members'] ?? ['']; 
                                @endphp
                                
                                @foreach($members as $index => $member)
                                    <div class="d-flex gap-2 mb-2 member-item">
                                        <input type="text" name="members[]" class="form-control answer-box-input" 
                                            placeholder="Nama Anggota {{ $index + 1 }}" value="{{ $member }}" required>
                                        <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 remove-member">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="add-member" class="btn btn-indigo-subtle text-indigo fw-bold btn-sm mt-2 rounded-pill px-4">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Anggota
                            </button>
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
                                {{-- Menggunakan null coalescing operator agar tidak error jika index belum ada --}}
                                <textarea name="f3_answers[{{ $index }}]" 
                                        class="form-control answer-box-input w-100" 
                                        rows="3" 
                                        placeholder="Tuliskan hasil diskusi kelompok di sini...">{{ old("f3_answers.$index", $group->f3_answers[$index] ?? '') }}</textarea>
                            </div>
                        @endforeach
                    </div>

                    <div class="card card-eval p-4 mb-4 border-start border-success border-5">
                        <div class="phase-header">
                            <div class="icon-box bg-success-subtle text-success"><i class="bi bi-cpu-fill"></i></div>
                            <h5 class="fw-bold m-0">Phase 04: C Programming Sandbox (Fast Engine)</h5>
                        </div>
                        
                        <div class="mb-3 px-2">
                            <label class="label-mini mb-2 d-block text-indigo">Editor Kode C:</label>
                            <textarea id="cEditor" name="f4_code" class="form-control" 
                                    style="font-family: 'Fira Code', monospace; height: 300px; background: #1e1e2e; color: #d1d5db; border-radius: 12px; padding: 15px; border: none;"
                            >{{ old('f4_code', $group->f4_code ?? "#include <stdio.h>\n\nint main() {\n    printf(\"Halo dari Glot.io!\\n\");\n    return 0;\n}") }}</textarea>
                        </div>

                        <div class="px-2 mb-3">
                            <button type="button" onclick="runCCode()" id="runBtn" class="btn btn-success w-100 py-2 fw-bold shadow-sm hover-lift">
                                <i class="bi bi-play-circle-fill me-2"></i> JALANKAN KODE
                            </button>
                        </div>

                        <div class="px-2">
                            <div class="bg-dark rounded-4 p-3 shadow-inner">
                                <label class="label-mini text-secondary d-block mb-2">Terminal Output:</label>
                                <div id="cOutput" style="font-family: 'Courier New', monospace; color: #10b981; min-height: 80px; font-size: 0.9rem; white-space: pre-wrap; overflow-y: auto;">> Siap menerima perintah...</div>
                            </div>
                        </div>
                        
                        <hr class="my-4 opacity-25">

                        <div class="px-2">
                            <label class="label-mini mb-2 d-block text-indigo">Analisis & Deskripsi Sistem:</label>
                            <p class="fw-bold mb-2 small">{{ $session->f4_question }}</p>
                            <textarea name="f4_answers" class="form-control answer-box-input" rows="3" 
                                    placeholder="Jelaskan logika kode di atas...">{{ old('f4_answers', $group->f4_answers) }}</textarea>
                        </div>
                    </div>

                    <div class="card card-eval p-4 mb-5">
                        <div class="phase-header">
                            <div class="icon-box"><i class="bi bi-chat-dots-fill"></i></div>
                            <h5 class="fw-bold m-0">Phase 05: Reflection</h5>
                        </div>
                        @foreach($session->f5_questions ?? [] as $index => $r)
                            <div class="mb-4 px-2">
                                <p class="fw-bold mb-2 text-dark small">{{ $r }}</p>
                                <textarea name="f5_answers[{{ $index }}]" 
                                        class="form-control answer-box-input" 
                                        rows="3" 
                                        placeholder="Apa yang kalian pelajari dari bagian ini?">{{ old("f5_answers.$index", $group->f5_answers[$index] ?? '') }}</textarea>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-eval p-4 sticky-panel shadow-lg border-0">
                        <div class="text-center mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold text-dark mb-1">Status Pengerjaan</h6>
                            <p class="text-muted small mb-0">Kelompok: {{ $group->group_name }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="label-mini d-block mb-3 text-center">Tindakan Kelompok</label>
                            
                            <button type="submit" name="action" value="save" class="btn bg-indigo text-white w-100 py-3 fw-bold shadow-sm hover-lift mb-3" style="border-radius: 15px;">
                                <i class="bi bi-cloud-arrow-up-fill me-2"></i> SIMPAN PROGRES
                            </button>

                            <button type="submit" name="action" value="submit" class="btn btn-dark w-100 py-3 fw-bold shadow-sm hover-lift" 
                                    style="border-radius: 15px;" 
                                    onclick="return confirm('Apakah kalian yakin ingin mengumpulkan? Jawaban tidak bisa diubah setelah ini.')">
                                <i class="bi bi-send-check-fill me-2"></i> SUBMIT TUGAS AKHIR
                            </button>
                        </div>

                        <div class="bg-indigo-subtle p-3 rounded-4 mt-2">
                            <div class="d-flex align-items-center gap-2 text-indigo mb-2">
                                <i class="bi bi-info-circle-fill"></i>
                                <span class="small fw-bold uppercase">Tips Diskusi</span>
                            </div>
                            <p class="small text-muted mb-0" style="font-size: 0.75rem;">
                                Pastikan setiap anggota kelompok memberikan masukan sebelum menekan tombol <strong>Submit Tugas Akhir</strong>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-member').addEventListener('click', function() {
            const container = document.getElementById('members-container');
            const newItem = document.createElement('div');
            newItem.className = 'd-flex gap-2 mb-2 member-item';
            newItem.innerHTML = `
                <input type="text" name="members[]" class="form-control answer-box-input" placeholder="Nama Anggota" required>
                <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 remove-member"><i class="bi bi-trash"></i></button>
            `;
            container.appendChild(newItem);
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-member')) {
                const items = document.querySelectorAll('.member-item');
                if (items.length > 1) {
                    e.target.closest('.member-item').remove();
                } else {
                    alert('Minimal harus ada 1 anggota kelompok.');
                }
            }
        });

        async function runCCode() {
            const outputBox = document.getElementById('cOutput');
            const btn = document.getElementById('runBtn');
            
            // Ambil konten kode (mendukung textarea biasa atau CodeMirror)
            const codeContent = typeof cEditor !== 'undefined' && cEditor.getValue 
                                ? cEditor.getValue() 
                                : document.getElementById('cEditor').value;

            // UI Loading State
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menjalankan...';
            outputBox.innerText = "> Sedang mengirim ke server Glot.io...";
            outputBox.style.color = "#fbbf24"; 

            try {
                const response = await fetch('https://run.glot.io/languages/c/latest', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Token 0c946e96-6644-4632-8419-798836587093' // Public Token
                    },
                    body: JSON.stringify({
                        "files": [
                            {
                                "name": "main.c",
                                "content": codeContent
                            }
                        ]
                    })
                });

                const data = await response.json();
                
                if (data.stdout) {
                    outputBox.innerText = data.stdout;
                    outputBox.style.color = "#34d399"; // Hijau sukses
                } else if (data.stderr) {
                    outputBox.innerText = "ERROR:\n" + data.stderr;
                    outputBox.style.color = "#f87171"; // Merah error
                } else if (data.error) {
                    outputBox.innerText = "SYSTEM ERROR:\n" + data.error;
                    outputBox.style.color = "#f87171";
                } else {
                    outputBox.innerText = "> Program selesai (tidak ada output).";
                    outputBox.style.color = "#94a3b8";
                }
            } catch (error) {
                outputBox.innerText = "Gagal terhubung ke API. Periksa koneksi internet.";
                outputBox.style.color = "#f87171";
                console.error(error);
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-play-circle-fill me-2"></i> JALANKAN KODE';
            }
        }
    </script>
</x-workspace-layout>