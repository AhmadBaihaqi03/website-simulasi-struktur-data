@extends('layouts.student')

@section('workspace_title')
    <div class="flex items-center gap-2 flex-wrap">
        <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">PBL Workspace | Sesi:</span>
        <span class="text-[11px] font-black text-indigo-600 tracking-widest uppercase italic">{{ $session->session_code }}</span>
    </div>

    <h1 class="text-2xl sm:text-3xl md:text-5xl font-black text-slate-900 tracking-tight leading-tight mt-2">
        {{ $session->title }}
    </h1>
@endsection

@section('content')
    <div class="py-2 sm:py-4">
        <div class="mb-6 sm:mb-10">
            <p class="text-slate-500 text-sm sm:text-base leading-relaxed">
                Pahami konteks permasalahan di bawah ini sebelum mulai berkolaborasi dengan tim di dalam ruang kerja digital
            </p>
        </div>

        {{-- Konteks Masalah --}}
        <div class="relative bg-slate-50/50 rounded-[1.5rem] sm:rounded-[2rem] p-1 border border-slate-100 mb-8 sm:mb-12">
            <div class="bg-white p-5 sm:p-8 md:p-12 rounded-[1.3rem] sm:rounded-[1.8rem] border border-indigo-50 shadow-sm relative overflow-hidden">
                <div class="absolute -top-6 -left-6 opacity-[0.03] text-indigo-600">
                    <i data-lucide="quote" class="w-24 h-24 sm:w-32 sm:h-32"></i>
                </div>
                
                <div class="mb-5 px-1">
                    <div class="p-4 sm:p-6 bg-slate-50 border border-slate-100 text-justify rounded-2xl text-slate-700 leading-relaxed whitespace-pre-line text-sm sm:text-base">
                        "{{ $session->f1_context }}"
                    </div>
                </div>

                {{-- Tujuan Pembelajaran --}}
                <div class="mb-8 sm:mb-12">
                    <div class="flex items-center gap-3 mb-4 sm:mb-6 ml-1">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-100 shrink-0">
                            <i data-lucide="target" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        </div>
                        <h3 class="text-[11px] sm:text-[12px] font-black text-slate-900 uppercase tracking-[0.3em]">Tujuan Pembelajaran</h3>
                    </div>

                    <div class="bg-white border border-slate-100 rounded-[1.5rem] sm:rounded-[2rem] p-5 sm:p-8 md:p-10 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50/50 rounded-bl-[5rem] -mr-10 -mt-10"></div>
                        
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
                </div>
            </div>
        </div>

        {{-- CTA Button --}}
        <div class="text-center py-4 sm:py-6">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-6">Siap Menuju Langkah Berikutnya?</p>
            
            <button type="button" 
                    onclick="document.getElementById('joinGroupModal').classList.remove('hidden')"
                    class="group w-full sm:w-auto inline-flex items-center justify-center gap-4 bg-slate-900 text-white px-8 sm:px-10 py-4 sm:py-5 rounded-2xl font-black text-sm tracking-widest hover:bg-indigo-600 hover:-translate-y-1 transition-all shadow-xl shadow-indigo-100 min-h-[56px]">
                SAYA SIAP MENGERJAKAN
                <i data-lucide="rocket" class="w-5 h-5 group-hover:animate-bounce"></i>
            </button>
        </div>
    </div>

    {{-- Modal Join Group --}}
    <div id="joinGroupModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>

        <div class="flex min-h-screen items-end sm:items-center justify-center p-0 sm:p-4">
            <div class="relative transform overflow-hidden rounded-t-[2.5rem] sm:rounded-[2.5rem] bg-white p-6 sm:p-8 md:p-12 text-center shadow-2xl transition-all w-full sm:max-w-md border border-indigo-50">
                <button onclick="document.getElementById('joinGroupModal').classList.add('hidden')" 
                        class="absolute top-5 right-5 text-slate-300 hover:text-slate-600 transition-colors w-11 h-11 flex items-center justify-center rounded-full hover:bg-slate-50">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>

                <div class="bg-indigo-50 text-indigo-600 w-16 h-16 sm:w-20 sm:h-20 rounded-3xl flex items-center justify-center mx-auto mb-5 shadow-inner">
                    <i data-lucide="users" class="w-8 h-8 sm:w-10 sm:h-10"></i>
                </div>
                
                <h4 class="text-xl sm:text-2xl font-black text-slate-900 mb-2 tracking-tight">Identitas Kelompok</h4>
                <p class="text-slate-500 text-sm mb-6 sm:mb-10 leading-relaxed">Masukkan nama kelompok untuk masuk ke workspace atau melanjutkan progres tim.</p>

                <form action="{{ route('student.join.group', $session->session_code) }}" method="POST" class="space-y-4 sm:space-y-6">
                    @csrf
                    <div class="text-left">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Nama Kelompok</label>
                        <input type="text" name="group_name" 
                               class="w-full px-5 sm:px-6 py-4 sm:py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-center font-bold text-base sm:text-lg placeholder:text-slate-300 tracking-wide" 
                               placeholder="CONTOH: TIM KODING" required autofocus
                               style="text-transform: uppercase;">
                    </div>

                    <button type="submit" class="w-full bg-slate-900 text-white py-4 sm:py-5 rounded-2xl font-black tracking-widest text-[13px] hover:bg-indigo-600 shadow-xl shadow-indigo-100 transition-all active:scale-[0.98] uppercase min-h-[56px]">
                        Masuk Ruang Kerja<i data-lucide="chevron-right" class="inline-block w-4 h-4 ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                document.getElementById('joinGroupModal').classList.add('hidden');
            }
        });

        window.onclick = function(event) {
            let modal = document.getElementById('joinGroupModal');
            let backdrop = modal.querySelector('.bg-slate-900\\/60');
            if (event.target == backdrop) {
                modal.classList.add('hidden');
            }
        }
    </script>
@endsection