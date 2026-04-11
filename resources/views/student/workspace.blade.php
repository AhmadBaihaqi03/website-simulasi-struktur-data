@extends('layouts.student')

@section('workspace_title')
    <div class="flex items-center gap-2">
        <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">PBL Workspace | Sesi:</span>
        <span class="text-[11px] font-black text-indigo-600 tracking-widest uppercase italic">{{$session->session_code}}</span>
        <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]"> | </span>
        <span class="text-[11px] font-black text-indigo-600 tracking-widest uppercase italic">{{$group->group_name }}</span>
    </div>

    <h1 class="text-3xl md:text-5xl font-black text-slate-900 tracking-tight leading-tight">
        {{ $session->title }}
    </h1>
@endsection

@section('content')
    <div class="container mx-auto py-8 px-4 max-w-7xl">
        <form action="{{ route('student.save.all', [$session->session_code, $group->id]) }}" method="POST">
            @csrf
            @if(session('error'))
            <div id="notification-alert" class="mb-6 flex items-center gap-4 p-4 bg-red-50 border-2 border-red-100 rounded-2xl animate-in fade-in slide-in-from-top-4 duration-500">
                <div class="flex-shrink-0 w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center shadow-lg shadow-red-200">
                    <i data-lucide="alert-circle" class="text-white w-6 h-6"></i>
                </div>
                <div>
                    <h4 class="text-red-900 font-bold text-sm uppercase tracking-wider">Gagal Menyimpan!</h4>
                    <p class="text-red-600 text-sm font-medium">{{ session('error') }}</p>
                </div>
            </div>
            @endif
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-8 space-y-8">
                    
                    <div class="bg-white rounded-[2.5rem] border border-indigo-50 p-8 md:p-10 shadow-sm relative overflow-hidden">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="bg-indigo-600 text-white rounded-2xl p-3 shadow-lg shadow-indigo-100">
                                <i data-lucide="users" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">Orientasi Masalah & Kelompok Siswa</h2>
                        </div>

                        <div class="mb-8">
                            <label class="block text-[12px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-3">Konteks Masalah:</label>
                            <div class="p-6 bg-slate-50 border border-slate-100 rounded-2xl text-slate-700 leading-relaxed italic whitespace-pre-line text-justify">
                                "{{ $session->f1_context }}"
                            </div>
                        </div>

                        <div class="bg-white border border-slate-100 rounded-[2rem] p-8 md:p-10 shadow-sm relative overflow-hidden mb-8">
                            <label class="block text-[12px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-3">Tujuan Pembelajaran:</label>
                            <div class="text-slate-600 text-base leading-relaxed">
                                @if(is_array($session->f1_learning_objectives))
                                    <ul class="list-disc ml-5 space-y-2">
                                        @foreach($session->f1_learning_objectives as $objective)
                                            <li>{{ $objective }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $session->f1_learning_objectives ?? 'Tujuan pembelajaran belum ditentukan.' }}
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="block text-[12px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-3">Anggota Tim:</label>
                            <div id="members-container" class="space-y-3">
                                @php $members = $group->student_data['members'] ?? ['']; @endphp
                                @foreach($members as $index => $member)
                                    <div class="flex items-center gap-3 member-item group">
                                        <input type="text" name="members[]" class="flex-1 px-6 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none font-bold text-slate-700"
                                            placeholder="Nama Anggota" value="{{ $member }}" required> 
                                        <button type="button" class="remove-member p-3 text-slate-300 hover:text-red-500 transition-colors">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-member" class="inline-flex items-center gap-2 mt-4 text-[12px] font-black text-indigo-600 uppercase tracking-widest hover:opacity-70 transition-opacity">
                                <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Anggota
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] border border-indigo-50 p-8 md:p-10 shadow-sm">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="bg-indigo-600 text-white rounded-2xl p-3 shadow-lg shadow-indigo-100">
                                <i data-lucide="message-square" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">Penyelidikan</h2>
                        </div>

                        <div class="space-y-6">
                            @foreach($session->f3_questions ?? [] as $index => $q)
                                <div class="space-y-3">
                                    {{--<p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify"> {{ $index + 1 }}. {{ $q }}</p>--}}
                                    <p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify"> {{ $q }}</p>
                                    <textarea name="f3_answers[{{ $index }}]" rows="3" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-slate-700"
                                    placeholder="Hasil diskusi kelompok...">{{ old("f3_answers.$index", $group->f3_answers[$index] ?? '') }}</textarea>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] border border-indigo-50 p-8 md:p-10 shadow-sm">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="bg-indigo-600 text-white rounded-2xl p-3 shadow-lg shadow-indigo-100">
                                <i data-lucide="code" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">Mengembangkan Dan Menyajikan Solusi</h2>
                        </div>
                        
                        <div class="space-y-4 mt-10 mb-4">
                            <p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify">{{ $session->f4_instruction }}</p>
                        </div>

                        <div class="bg-indigo-50/40 border border-indigo-100 rounded-2xl p-6 mb-6">
                            <label class="block text-[12px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-3">
                                Lampiran Link Google Colab
                            </label>

                            <p class="text-base text-slate-700 leading-relaxed mb-4 text-justify">
                                Kembangkan solusi melalui google colab 
                                <a href="https://colab.research.google.com/" 
                                target="_blank"
                                class="font-bold text-indigo-600 hover:text-indigo-800 underline underline-offset-4">
                                Google Colab
                                </a>
                                lalu tempelkan link hasil pekerjaan pada kolom berikut.
                            </p>

                            <input 
                                type="url"
                                name="f4_link"
                                value="{{ old('f4_link', $group->f4_link ?? '') }}"
                                placeholder="https://colab.research.google.com/..."
                                class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl text-base text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none"
                            >
                        </div>
                        
                        {{--
                        <p class="text-base text-slate-900 leading-relaxed mt-3 mb-5 text-justify">
                            Atau gunakan editor di bawah untuk mengerjakan sintaks Python sederhana
                        </p>

                        <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm mb-6">
                            <div class="bg-[#1e1e2e] px-5 py-3 flex items-center gap-2 border-b border-white/5">
                                <span class="text-[10px] font-mono text-slate-500 ml-4 uppercase tracking-widest">main.py</span>
                            </div>
                            <textarea id="codeEditor" name="f4_code" class="w-full h-80 bg-[#1e1e2e] text-indigo-100 p-6 font-mono text-sm outline-none resize-none focus:ring-0">{{ old('f4_code', $group->f4_code ?? "# Tulis solusi Python di sini\n\nprint('Hello PBL Workspace!')") }}</textarea>
                        </div>

                        <button type="button" onclick="runPythonCode()" id="runBtn" class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black tracking-widest text-[12px] hover:bg-indigo-600 shadow-xl shadow-indigo-100 transition-all active:scale-[0.98] mb-8">
                            <i data-lucide="play" class="inline-block w-4 h-4 mr-2 fill-current"></i> JALANKAN PROGRAM
                        </button>

                        <div class="bg-slate-900 rounded-2xl p-6 mb-8 border border-slate-800 shadow-inner">
                            <div class="flex justify-between items-center mb-4 border-b border-slate-800 pb-3">
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Terminal Output</span>
                                <i data-lucide="terminal" class="w-4 h-4 text-slate-600"></i>
                            </div>
                            <div id="outputArea" class="font-mono text-sm text-emerald-400 min-h-[80px] whitespace-pre-wrap leading-relaxed">> Ready...</div>
                        </div>
                        --}}

                        <div class="space-y-4 mt-10">
                            <p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify">{{ $session->f4_question }}</p>
                            <textarea name="f4_answers" rows="4" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-slate-700"
                                      placeholder="Jelaskan logika solusi kalian...">{{ old('f4_answers', $group->f4_answers) }}</textarea>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] border border-indigo-50 p-8 md:p-10 shadow-sm mb-12">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="bg-indigo-600 text-white rounded-2xl p-3 shadow-lg shadow-indigo-100">
                                <i data-lucide="sparkles" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">Evaluasi</h2>
                        </div>
                        
                        <div class="space-y-8">
                            @foreach($session->f5_questions ?? [] as $index => $r)
                                <div class="space-y-3">
                                    <p class="font-bold text-slate-800 leading-snug small whitespace-pre-line text-justify">{{ $r }}</p>
                                    <textarea name="f5_answers[{{ $index }}]" rows="3" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-slate-700"
                                    placeholder="Hasil diskusi kelompok...">{{ old("f5_answers.$index", $group->f5_answers[$index] ?? '') }}</textarea>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="sticky top-8 space-y-4">
                        <div class="bg-white rounded-[2rem] border border-indigo-50 p-8 shadow-xl shadow-indigo-100/20">
                            <h6 class="text-center text-[12px] font-black text-slate-900 tracking-[0.2em] uppercase mb-6">Panel Kontrol</h6>
                            
                            <div class="flex flex-col gap-3">
                                <button type="submit" name="action" value="save" class="group flex items-center justify-center gap-3 bg-white border-2 border-slate-100 py-4 rounded-2xl font-black text-xs tracking-widest text-slate-600 hover:border-indigo-600 hover:text-indigo-600 transition-all">
                                    <i data-lucide="cloud-upload" class="w-4 h-4 transition-transform group-hover:-translate-y-1"></i> SIMPAN PERUBAHAN
                                </button>

                                <button type="submit" name="action" value="submit" id="submitBtn" 
                                        class="flex items-center justify-center gap-3 bg-slate-900 text-white py-4 rounded-2xl font-black text-xs tracking-widest hover:bg-indigo-600 shadow-lg shadow-slate-200 transition-all active:scale-[0.98]">
                                    <i data-lucide="send" class="w-4 h-4"></i> KUMPULKAN TUGAS
                                </button>
                            </div>

                            <div class="mt-8 p-5 bg-indigo-50/50 rounded-2xl border border-indigo-100/50">
                                <div class="flex gap-3">
                                    <i data-lucide="info" class="w-5 h-5 text-indigo-600 shrink-0"></i>
                                    <p class="text-[11px] font-medium text-indigo-900/70 leading-relaxed">
                                        Simpan perubahan secara berkala agar tidak hilang saat bergantian perangkat.
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4 p-5 bg-indigo-50/50 rounded-2xl border border-indigo-100/50">
                                <div class="flex gap-3">
                                    <i data-lucide="info" class="w-5 h-5 text-indigo-600 shrink-0"></i>
                                    <p class="text-[11px] font-medium text-indigo-900/70 leading-relaxed">
                                        Setelah dikumpulkan, tugas akan dikirim ke guru untuk diberi umpan balik dan kalian tidak bisa mengubah jawabannya lagi.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // untuk menghapus notifikasi otomatis
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('notification-alert');
            if (alert) {
                // Notifikasi akan hilang otomatis setelah 5 detik
                setTimeout(() => {
                    dismissAlert();
                }, 5000);
            }
        });

        function dismissAlert() {
            const alert = document.getElementById('notification-alert');
            if (alert) {
                // Animasi halus sebelum dihapus
                alert.style.transition = "all 0.6s ease";
                alert.style.opacity = "0";
                alert.style.transform = "translateY(-20px)";
                
                setTimeout(() => {
                    alert.remove();
                }, 600);
            }
        }

        // Variabel untuk menampung timer agar tidak terlalu sering menembak database (Debounce)
        let nameTimer;

        // 1. FUNGSI TAMBAH ANGGOTA (Disesuaikan dengan Tailwind & Lucide)
        document.getElementById('add-member').addEventListener('click', function() {
            const container = document.getElementById('members-container');
            const newItem = document.createElement('div');
            
            // Mengubah struktur sedikit menjadi col agar pesan error muncul rapi di bawah input
            newItem.className = 'flex flex-col gap-1 member-item group animate-in fade-in slide-in-from-top-1 duration-300'; 
            newItem.innerHTML = `
                <div class="flex items-center gap-3">
                    <input type="text" name="members[]" 
                        class="flex-1 px-6 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none font-bold text-slate-700"
                        placeholder="Nama Anggota" required> 
                    <button type="button" class="remove-member p-3 text-slate-300 hover:text-red-500 transition-colors">
                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                    </button>
                </div>`;
            
            container.appendChild(newItem);
            
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        // 2. FUNGSI HAPUS ANGGOTA
        document.addEventListener('click', function(e) {
            const removeBtn = e.target.closest('.remove-member');
            if (removeBtn) {
                const items = document.querySelectorAll('.member-item');
                if (items.length > 1) {
                    removeBtn.closest('.member-item').remove();
                } else {
                    alert('Minimal harus ada 1 anggota kelompok.');
                }
            }
        });

        // VALIDATION NAMA KELOMPOK
        document.addEventListener('input', function(e) {
            if (e.target.name === 'members[]') {
                clearTimeout(nameTimer);
                const input = e.target;
                const name = input.value.trim();
                
                // Reset state visual setiap kali mengetik
                input.classList.remove('border-red-500', 'bg-red-50', 'text-red-600');
                const existingError = input.closest('.member-item').querySelector('.error-msg');
                if (existingError) existingError.remove();

                if (name.length < 3) return; // Minimal 3 huruf baru cek ke server

                nameTimer = setTimeout(async () => {
                    try {
                        const response = await fetch('{{ route("student.check.name") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ 
                                name: name,
                                group_id: '{{ $group->id }}' 
                            })
                        });
                        const data = await response.json();

                        if (data.exists) {
                            input.classList.add('border-red-500', 'bg-red-50', 'text-red-600');
                            const msg = document.createElement('span');
                            msg.className = 'error-msg text-[9px] text-red-500 font-bold uppercase ml-4 tracking-widest animate-pulse';
                            msg.innerText = '⚠️ Nama sudah terdaftar di sistem!';
                            input.closest('.member-item').appendChild(msg);
                        }
                    } catch (err) {
                        console.error("Gagal validasi nama:", err);
                    }
                }, 700); // Tunggu 0.7 detik setelah berhenti mengetik
            }
        });

        // 3. FUNGSI RUN PYTHON CODE (Tetap)
        async function runPythonCode() {
            const editor = document.getElementById('codeEditor');
            const outputArea = document.getElementById('outputArea');
            const btn = document.getElementById('runBtn');
            const codeValue = editor.value;

            btn.disabled = true;
            btn.innerHTML = `<svg class="animate-spin h-4 w-4 text-white inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> MENJALANKAN...`;
            outputArea.innerText = "> Processing...";
            outputArea.style.color = "#fbbf24";

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
                    outputArea.style.color = "#f87171";
                    outputArea.innerText = "ERROR:\n" + data.error + (data.output ? "\n" + data.output : "");
                } else {
                    outputArea.style.color = "#34d399";
                    outputArea.innerText = data.output || "> Program selesai tanpa output.";
                }
            } catch (e) {
                outputArea.style.color = "#f87171";
                outputArea.innerText = "FATAL ERROR: Gagal terhubung ke server eksekusi.";
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i data-lucide="play" class="inline-block w-4 h-4 mr-2 fill-current"></i> JALANKAN PROGRAM';
                if (typeof lucide !== 'undefined') lucide.createIcons();
            }
        }

        // 4. VALIDASI SUBMIT
        document.getElementById('submitBtn').addEventListener('click', function(e) {
            // Cek apakah masih ada error nama ganda
            const hasNameError = document.querySelector('.error-msg');
            if (hasNameError) {
                e.preventDefault();
                alert('Terdapat nama anggota yang sudah terdaftar di sistem. Harap perbaiki sebelum mengirim.');
                return;
            }
            
            const f4Link = document.querySelector('input[name="f4_link"]').value.trim();
            const f4Code = document.getElementById('codeEditor').value.trim();
            const otherTextareas = document.querySelectorAll('textarea:not(#codeEditor)');
            
            let allFilled = true;

            // 1. Cek textarea selain editor kode (pertanyaan diskusi tetap wajib)
            otherTextareas.forEach(ta => {
                if (!ta.value.trim()) {
                    allFilled = false;
                    ta.classList.add('border-red-500', 'ring-4', 'ring-red-500/10');
                } else {
                    ta.classList.remove('border-red-500', 'ring-4', 'ring-red-500/10');
                }
            });

            // 2. Logika BARU: Cek apakah salah satu (Link atau Code) sudah diisi
            const isSolutionProvided = f4Link !== "" || f4Code !== "" && f4Code !== "# Tulis solusi Python di sini\n\nprint('Hello PBL Workspace!')";

            if (!allFilled) {
                e.preventDefault();
                alert('Mohon lengkapi semua jawaban diskusi.');
                return;
            }

            if (!isSolutionProvided) {
                e.preventDefault();
                alert('Mohon berikan solusi: Lampirkan Link Google Colab ATAU tuliskan kode Python.');
                return;
            }

            if (!confirm('Kirim sekarang? Jawaban tidak dapat diubah lagi.')) {
                e.preventDefault();
            }
        });
    </script>
@endsection