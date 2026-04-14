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
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-8 space-y-8">
                
                <div class="bg-white rounded-[2.5rem] border border-indigo-50 p-8 md:p-10 shadow-sm relative overflow-hidden">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="bg-indigo-600 text-white rounded-2xl p-3 shadow-lg shadow-indigo-100">
                            <i data-lucide="users" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">Orientasi Masalah dan Pembentukan Kelompok</h2>
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

                    <div class mb-8>
                        <label class="block text-[12px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-3">Anggota Tim:</label>
                        <div class="flex flex-wrap gap-2">
                            @php $members = $group->student_data['members'] ?? []; @endphp
                            @forelse($members as $member)
                                <span class="px-4 py-2 bg-indigo-50 text-indigo-700 rounded-xl font-bold text-sm border border-indigo-100">
                                    {{ $member }}
                                </span>
                            @empty
                                <span class="text-slate-400 italic text-sm">Tidak ada data anggota.</span>
                            @endforelse
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-50">
                        <label class="block text-[12px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-2">Kelas:</label>
                        <p class="text-lg font-bold text-slate-700 ml-1">{{ $group->class_name ?? '-' }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] border border-indigo-50 p-8 md:p-10 shadow-sm">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="bg-indigo-600 text-white rounded-2xl p-3 shadow-lg shadow-indigo-100">
                            <i data-lucide="message-square" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">Penyelidikan</h2>
                    </div>

                    <div class="space-y-8">
                        @foreach($session->f3_questions ?? [] as $index => $q)
                            <div class="space-y-3">
                                {{--<p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify"> {{ $index + 1 }}. {{ $q }}</p>--}}
                                <p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify"> {{ $q }}</p>
                                <div class="p-6 bg-slate-50 border border-slate-100 rounded-2xl text-slate-700 text-sm leading-relaxed whitespace-pre-line text-justify">
                                    {{ $group->f3_answers[$index] ?? '-' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] border border-indigo-50 p-8 md:p-10 shadow-sm">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="bg-indigo-600 text-white rounded-2xl p-3 shadow-lg shadow-indigo-100">
                            <i data-lucide="code" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">Mengembangkan dan Menyajikan Solusi</h2>
                    </div>

                    <div class="space-y-4 mt-10 mb-4">
                        <p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify">{{ $session->f4_instruction }}</p>
                    </div>

                    <div class="mb-8">
                        <label class="block text-[12px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-3">Tautan Eksternal Pekerjaan:</label>
                        <a href="{{ $group->f4_link }}" target="_blank" 
                        class="group flex items-center gap-6 p-6 bg-slate-50 border-2 border-indigo-500 rounded-[2rem] transition-all hover:bg-indigo-50 hover:scale-[1.01] shadow-sm">
                            
                            <div class="bg-indigo-600 text-white p-4 rounded-2xl shadow-lg shadow-indigo-200">
                                <i data-lucide="external-link" class="w-8 h-8"></i>
                            </div>

                            <div class="overflow-hidden flex-grow">
                                <div class="text-indigo-600 font-black text-sm truncate tracking-tight mb-1">
                                    {{ $group->f4_link }}
                                </div>
                                <p class="text-slate-500 text-sm font-bold uppercase tracking-widest flex items-center gap-2">
                                    Klik untuk meninjau hasil di Google Colab <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="space-y-4 mt-10 mb-4">
                        <p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify">{{ $session->f4_question }}</p>
                    </div>

                    <div class="p-6 bg-slate-50 border border-slate-100 rounded-2xl">
                        <p class="text-slate-600 text-sm whitespace-pre-line text-justify">"{{ $group->f4_answers ?? '-' }}"</p>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] border border-indigo-50 p-8 md:p-10 shadow-sm">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="bg-indigo-600 text-white rounded-2xl p-3 shadow-lg shadow-indigo-100">
                            <i data-lucide="sparkles" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">Evaluasi</h2>
                    </div>

                    <div class="space-y-8">
                        @foreach($session->f5_questions ?? [] as $index => $r)
                            <div class="space-y-3">
                                {{--<p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify"> {{ $index + 1 }}. {{ $q }}</p>--}}
                                <p class="font-bold text-slate-800 leading-snug whitespace-pre-line text-justify"> {{ $r }}</p>
                                <div class="p-6 bg-slate-50 border border-slate-100 rounded-2xl text-slate-700 text-sm leading-relaxed whitespace-pre-line text-justify">
                                    {{ $group->f5_answers[$index] ?? '-' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="sticky top-28 space-y-6">
                    <div class="bg-white rounded-[2.5rem] border border-indigo-50 p-8 shadow-xl shadow-indigo-100/20">
                        <div class="text-center pb-6 border-b border-slate-50">
                            <h6 class="text-[11px] font-black text-slate-900 tracking-[0.2em] uppercase mb-2">Hasil Evaluasi Guru</h6>
                        </div>

                        <div class="mb-8">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3 text-center">Feedback Guru</label>
                            <div class="relative p-6 bg-slate-50 rounded-3xl border border-slate-100 min-h-[120px]">
                                <i data-lucide="quote" class="absolute top-4 right-4 w-8 h-8 text-indigo-100"></i>
                                @if($group->evaluation && $group->evaluation->feedback_comment)
                                    <p class="text-sm text-slate-700 leading-relaxed relative z-10 font-medium italic">
                                        {{ $group->evaluation->feedback_comment }}
                                    </p>
                                @else
                                    <p class="text-[11px] text-slate-400 italic text-center mt-4 uppercase font-bold tracking-wider">Belum ada feedback.</p>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('beranda') }}" class="flex items-center justify-center gap-3 bg-indigo-600 text-white py-4 rounded-2xl font-black text-xs tracking-widest hover:bg-slate-900 shadow-lg shadow-indigo-100 transition-all active:scale-[0.98] group">
                            <i data-lucide="home" class="w-4 h-4 transition-transform group-hover:-translate-y-1"></i> KEMBALI KE BERANDA
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection