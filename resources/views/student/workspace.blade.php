@extends('layouts.student')

@section('workspace_title')
    <div class="flex items-center gap-2 flex-wrap">
        <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">PBL Workspace | Sesi:</span>
        <span class="text-[11px] font-black text-indigo-600 tracking-widest uppercase italic">{{$session->session_code}}</span>
        <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">|</span>
        <span class="text-[11px] font-black text-indigo-600 tracking-widest uppercase italic">{{$group->group_name }}</span>
    </div>

    <h1 class="text-2xl sm:text-3xl md:text-5xl font-black text-slate-900 tracking-tight leading-tight mt-2">
        {{ $session->title }}
    </h1>
@endsection

@section('content')
    <div class="relative">
        <form action="{{ route('student.save.all', [$session->session_code, $group->id]) }}" method="POST">
            @csrf
            @if(session('error'))
            <div id="notification-alert" class="mb-5 flex items-center gap-3 p-4 bg-red-50 border-2 border-red-100 rounded-2xl">
                <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-red-500 rounded-xl flex items-center justify-center shadow-lg shadow-red-200">
                    <i data-lucide="alert-circle" class="text-white w-5 h-5 sm:w-6 sm:h-6"></i>
                </div>
                <div>
                    <h4 class="text-red-900 font-bold text-xs uppercase tracking-wider">Gagal Menyimpan!</h4>
                    <p class="text-red-600 text-sm font-medium">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            {{-- Layout: stack di mobile, 12-col grid di lg --}}
            <div class="flex flex-col lg:grid lg:grid-cols-12 gap-6 lg:gap-8">

                {{-- ===== KONTEN KIRI ===== --}}
                <div class="lg:col-span-8 space-y-6 sm:space-y-8">
                    
                    {{-- Fase 1: Orientasi & Kelompok --}}
                    <div class="bg-white rounded-[2rem] border border-indigo-50 p-4 sm:p-8 md:p-10 shadow-sm relative overflow-hidden">
                        <div class="flex items-center gap-3 sm:gap-4 mb-6 sm:mb-8">
                            <div class="bg-indigo-600 text-white rounded-xl sm:rounded-2xl p-2.5 sm:p-3 shadow-lg shadow-indigo-100 shrink-0">
                                <i data-lucide="users" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                            </div>
                            <h2 class="text-base sm:text-xl font-black text-slate-900 tracking-tight uppercase leading-tight">Orientasi Masalah & Kelompok Siswa</h2>
                        </div>

                        {{-- Konteks Masalah --}}
                        <div class="mb-6 sm:mb-8">
                            <label class="block text-[11px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-2 sm:mb-3">Konteks Masalah:</label>
                            <div class="p-4 sm:p-6 bg-slate-50 border border-slate-100 rounded-2xl text-slate-700 leading-relaxed italic whitespace-pre-line text-justify text-sm sm:text-base">
                                "{{ $session->f1_context }}"
                            </div>
                        </div>

                        {{-- Tujuan Pembelajaran --}}
                        <div class="bg-white border border-slate-100 rounded-[1.5rem] sm:rounded-[2rem] p-4 sm:p-8 md:p-10 shadow-sm relative overflow-hidden mb-6 sm:mb-8">
                            <label class="block text-[11px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-2 sm:mb-3">Tujuan Pembelajaran:</label>
                            <div class="text-slate-600 text-sm sm:text-base leading-relaxed">
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

                        {{-- Anggota Tim --}}
                        <div class="mb-6 sm:mb-8">
                            <label class="block text-[11px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-2 sm:mb-3">Anggota Tim:</label>
                            <div id="members-container" class="space-y-3">
                                @php $members = $group->student_data['members'] ?? ['']; @endphp
                                @foreach($members as $index => $member)
                                    <div class="flex items-center gap-2 sm:gap-3 member-item group">
                                        <input type="text" name="members[]" 
                                               class="flex-1 px-4 sm:px-6 py-3 sm:py-4 bg-slate-50 border border-slate-100 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none font-bold text-slate-700 text-sm sm:text-base min-h-[44px]"
                                               placeholder="Nama Anggota" value="{{ $member }}" required> 
                                        <button type="button" class="remove-member p-2 sm:p-3 text-slate-300 hover:text-red-500 transition-colors min-h-[44px] min-w-[44px] flex items-center justify-center">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-member" class="inline-flex items-center gap-2 mt-4 text-[11px] sm:text-[12px] font-black text-indigo-600 uppercase tracking-widest hover:opacity-70 transition-opacity min-h-[44px]">
                                <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Anggota
                            </button>
                        </div>

                        {{-- Kelas --}}
                        <div>
                            <label class="block text-[11px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-2 sm:mb-3">Kelas:</label>
                            <input 
                                type="text"
                                name="class_name"
                                value="{{ old('class_name', $group->class_name ?? '') }}"
                                placeholder="Contoh: X Mekatronika"
                                class="w-full px-4 sm:px-6 py-3 sm:py-4 bg-slate-50 border border-slate-100 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none font-bold text-slate-700 text-sm sm:text-base min-h-[44px]"
                                required
                            >
                        </div>
                    </div>

                    {{-- Fase 3: Penyelidikan --}}
                    <div class="bg-white rounded-[2rem] border border-indigo-50 p-4 sm:p-8 md:p-10 shadow-sm">
                        <div class="flex items-center gap-3 sm:gap-4 mb-6 sm:mb-8">
                            <div class="bg-indigo-600 text-white rounded-xl sm:rounded-2xl p-2.5 sm:p-3 shadow-lg shadow-indigo-100 shrink-0">
                                <i data-lucide="message-square" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                            </div>
                            <h2 class="text-base sm:text-xl font-black text-slate-900 tracking-tight uppercase leading-tight">Penyelidikan</h2>
                        </div>

                        <div class="space-y-5 sm:space-y-6">
                            @foreach($session->f3_questions ?? [] as $index => $q)
                                <div class="space-y-2 sm:space-y-3">
                                    <p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify text-sm sm:text-base">{{ $q }}</p>
                                    <textarea name="f3_answers[{{ $index }}]" rows="3" 
                                              class="w-full px-4 sm:px-6 py-3 sm:py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-slate-700 text-sm sm:text-base"
                                              placeholder="Hasil diskusi kelompok...">{{ old("f3_answers.$index", $group->f3_answers[$index] ?? '') }}</textarea>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Fase 4: Solusi --}}
                    <div class="bg-white rounded-[2rem] border border-indigo-50 p-4 sm:p-8 md:p-10 shadow-sm">
                        <div class="flex items-center gap-3 sm:gap-4 mb-6 sm:mb-8">
                            <div class="bg-indigo-600 text-white rounded-xl sm:rounded-2xl p-2.5 sm:p-3 shadow-lg shadow-indigo-100 shrink-0">
                                <i data-lucide="code" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                            </div>
                            <h2 class="text-base sm:text-xl font-black text-slate-900 tracking-tight uppercase leading-tight">Mengembangkan Dan Menyajikan Solusi</h2>
                        </div>
                        
                        <div class="space-y-4 mt-4 sm:mt-10 mb-4">
                            <p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify text-sm sm:text-base">{{ $session->f4_instruction }}</p>
                        </div>

                        <div class="bg-indigo-50/40 border border-indigo-100 rounded-2xl p-4 sm:p-6 mb-6">
                            <label class="block text-[11px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-2 sm:mb-3">
                                Lampiran Link Google Colab
                            </label>

                            <p class="text-sm sm:text-base text-slate-700 leading-relaxed mb-4 text-justify">
                                Kembangkan solusi melalui 
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
                                class="w-full px-4 sm:px-6 py-3 sm:py-4 bg-white border border-slate-200 rounded-2xl text-sm sm:text-base text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none min-h-[44px]"
                            >
                        </div>

                        <div class="space-y-3 sm:space-y-4 mt-6 sm:mt-10">
                            <p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify text-sm sm:text-base">{{ $session->f4_question }}</p>
                            <textarea name="f4_answers" rows="4" 
                                      class="w-full px-4 sm:px-6 py-3 sm:py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-slate-700 text-sm sm:text-base"
                                      placeholder="Jelaskan logika solusi kalian...">{{ old('f4_answers', $group->f4_answers) }}</textarea>
                        </div>
                    </div>

                    {{-- Fase 5: Evaluasi --}}
                    <div class="bg-white rounded-[2rem] border border-indigo-50 p-4 sm:p-8 md:p-10 shadow-sm mb-6 sm:mb-12 pb-32 sm:pb-10">
                        <div class="flex items-center gap-3 sm:gap-4 mb-6 sm:mb-8">
                            <div class="bg-indigo-600 text-white rounded-xl sm:rounded-2xl p-2.5 sm:p-3 shadow-lg shadow-indigo-100 shrink-0">
                                <i data-lucide="sparkles" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                            </div>
                            <h2 class="text-base sm:text-xl font-black text-slate-900 tracking-tight uppercase leading-tight">Evaluasi</h2>
                        </div>
                        
                        <div class="space-y-6 sm:space-y-8">
                            @foreach($session->f5_questions ?? [] as $index => $r)
                                <div class="space-y-2 sm:space-y-3">
                                    <p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify text-sm sm:text-base">{{ $r }}</p>
                                    <textarea name="f5_answers[{{ $index }}]" rows="3" 
                                              class="w-full px-4 sm:px-6 py-3 sm:py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-slate-700 text-sm sm:text-base"
                                              placeholder="Hasil diskusi kelompok...">{{ old("f5_answers.$index", $group->f5_answers[$index] ?? '') }}</textarea>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ===== PANEL KONTROL DESKTOP (kanan) ===== --}}
                <div class="hidden lg:block lg:col-span-4">
                    <div class="sticky top-8 space-y-4">
                        <div class="bg-white rounded-[2rem] border border-indigo-50 p-6 sm:p-8 shadow-xl shadow-indigo-100/20">
                            <h6 class="text-center text-[12px] font-black text-slate-900 tracking-[0.2em] uppercase mb-6">Panel Kontrol</h6>
                            
                            <div class="flex flex-col gap-3">
                                <button type="submit" name="action" value="save" 
                                        class="group flex items-center justify-center gap-3 bg-white border-2 border-slate-100 py-4 rounded-2xl font-black text-xs tracking-widest text-slate-600 hover:border-indigo-600 hover:text-indigo-600 transition-all min-h-[52px]">
                                    <i data-lucide="cloud-upload" class="w-4 h-4 transition-transform group-hover:-translate-y-1"></i> SIMPAN PERUBAHAN
                                </button>

                                <button type="submit" name="action" value="submit" id="submitBtnDesktop" 
                                        class="flex items-center justify-center gap-3 bg-slate-900 text-white py-4 rounded-2xl font-black text-xs tracking-widest hover:bg-indigo-600 shadow-lg shadow-slate-200 transition-all active:scale-[0.98] min-h-[52px]">
                                    <i data-lucide="send" class="w-4 h-4"></i> KUMPULKAN TUGAS
                                </button>
                            </div>

                            <div class="mt-6 sm:mt-8 p-4 sm:p-5 bg-indigo-50/50 rounded-2xl border border-indigo-100/50">
                                <div class="flex gap-3">
                                    <i data-lucide="info" class="w-5 h-5 text-indigo-600 shrink-0 mt-0.5"></i>
                                    <p class="text-[11px] font-medium text-indigo-900/70 leading-relaxed">
                                        Simpan perubahan secara berkala agar tidak hilang saat bergantian perangkat.
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3 sm:mt-4 p-4 sm:p-5 bg-indigo-50/50 rounded-2xl border border-indigo-100/50">
                                <div class="flex gap-3">
                                    <i data-lucide="info" class="w-5 h-5 text-indigo-600 shrink-0 mt-0.5"></i>
                                    <p class="text-[11px] font-medium text-indigo-900/70 leading-relaxed">
                                        Setelah dikumpulkan, tugas tidak bisa diubah lagi.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== FIXED BOTTOM BAR — hanya muncul di mobile ===== --}}
            <div class="fixed bottom-0 left-0 right-0 z-50 lg:hidden bg-white/95 backdrop-blur-md border-t border-slate-100 shadow-2xl shadow-slate-900/10 px-4 py-3 safe-bottom">
                <div class="flex gap-3 max-w-xl mx-auto">
                    <button type="submit" name="action" value="save" 
                            class="flex-1 flex items-center justify-center gap-2 bg-slate-100 border border-slate-200 py-3 rounded-2xl font-black text-xs tracking-widest text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 transition-all min-h-[52px]">
                        <i data-lucide="cloud-upload" class="w-4 h-4"></i>
                        <span>SIMPAN</span>
                    </button>

                    <button type="submit" name="action" value="submit" id="submitBtn"
                            class="flex-1 flex items-center justify-center gap-2 bg-slate-900 text-white py-3 rounded-2xl font-black text-xs tracking-widest hover:bg-indigo-600 shadow-lg transition-all active:scale-[0.98] min-h-[52px]">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        <span>KUMPULKAN</span>
                    </button>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // Auto-dismiss notification
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('notification-alert');
            if (alert) {
                setTimeout(() => dismissAlert(), 5000);
            }
        });

        function dismissAlert() {
            const alert = document.getElementById('notification-alert');
            if (alert) {
                alert.style.transition = "all 0.6s ease";
                alert.style.opacity = "0";
                alert.style.transform = "translateY(-20px)";
                setTimeout(() => alert.remove(), 600);
            }
        }

        let nameTimer;

        // Tambah Anggota
        document.getElementById('add-member').addEventListener('click', function() {
            const container = document.getElementById('members-container');
            const newItem = document.createElement('div');
            
            newItem.className = 'flex flex-col gap-1 member-item group animate-in fade-in slide-in-from-top-1 duration-300'; 
            newItem.innerHTML = `
                <div class="flex items-center gap-2 sm:gap-3">
                    <input type="text" name="members[]" 
                        class="flex-1 px-4 sm:px-6 py-3 sm:py-4 bg-slate-50 border border-slate-100 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none font-bold text-slate-700 text-sm sm:text-base min-h-[44px]"
                        placeholder="Nama Anggota" required> 
                    <button type="button" class="remove-member p-2 sm:p-3 text-slate-300 hover:text-red-500 transition-colors min-h-[44px] min-w-[44px] flex items-center justify-center">
                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                    </button>
                </div>`;
            
            container.appendChild(newItem);
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });

        // Hapus Anggota
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

        // Validasi nama ganda
        document.addEventListener('input', function(e) {
            if (e.target.name === 'members[]') {
                clearTimeout(nameTimer);
                const input = e.target;
                const name = input.value.trim();
                
                input.classList.remove('border-red-500', 'bg-red-50', 'text-red-600');
                const existingError = input.closest('.member-item').querySelector('.error-msg');
                if (existingError) existingError.remove();

                if (name.length < 3) return;

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
                }, 700);
            }
        });

        // Validasi Submit (berlaku untuk semua tombol submit)
        function validateSubmit(e) {
            const hasNameError = document.querySelector('.error-msg');
            if (hasNameError) {
                e.preventDefault();
                alert('Terdapat nama anggota yang sudah terdaftar. Harap perbaiki sebelum mengirim.');
                return;
            }
            
            const f4Link = document.querySelector('input[name="f4_link"]').value.trim();
            const otherTextareas = document.querySelectorAll('textarea');
            let allFilled = true;

            otherTextareas.forEach(ta => {
                if (!ta.value.trim()) {
                    allFilled = false;
                    ta.classList.add('border-red-500', 'ring-4', 'ring-red-500/10');
                } else {
                    ta.classList.remove('border-red-500', 'ring-4', 'ring-red-500/10');
                }
            });

            const isSolutionProvided = f4Link !== "";

            if (!allFilled) {
                e.preventDefault();
                alert('Mohon lengkapi semua jawaban diskusi.');
                return;
            }

            if (!isSolutionProvided) {
                e.preventDefault();
                alert('Mohon tempelkan Link Google Colab pada kolom yang tersedia.');
                return;
            }

            if (!confirm('Kirim sekarang? Jawaban tidak dapat diubah lagi.')) {
                e.preventDefault();
            }
        }

        // Pasang listener ke kedua tombol submit (mobile + desktop)
        ['submitBtn', 'submitBtnDesktop'].forEach(id => {
            const btn = document.getElementById(id);
            if (btn) btn.addEventListener('click', validateSubmit);
        });
    </script>
@endsection