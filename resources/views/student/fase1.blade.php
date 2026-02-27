<x-workspace-layout>
    <div class="container py-5" style="max-width: 850px;">
        <div class="card phase-card p-5 border-0 shadow-lg mb-4">
            <h2 class="fw-bold text-dark text-center mb-4">{{ $session->title }}</h2>
            
            {{-- Narasi dari Guru --}}
            <div class="p-4 bg-light rounded-4 border-start border-indigo border-5 mb-5">
                <p class="fs-5 text-secondary italic mb-0" style="white-space: pre-wrap;">"{{ $session->f1_context }}"</p>
            </div>

            <hr class="my-5">

            {{-- Tombol Pemicu Modal --}}
            <div class="text-center">
                <button type="button" class="btn bg-indigo text-white btn-lg px-5 py-3 fw-bold rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#joinGroupModal">
                    SAYA SIAP MENGERJAKAN <i class="bi bi-rocket-takeoff ms-2"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- MODAL MELAYANG --}}
    <div class="modal fade" id="joinGroupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="phase-icon mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-people-fill fs-3"></i>
                    </div>
                    <h4 class="fw-bold text-indigo">Identitas Kelompok</h4>
                    <p class="text-muted small mb-4">Masukkan nama kelompok untuk melanjutkan progres atau membuat baru.</p>
                    
                    <form action="{{ route('student.join.group', $session->session_code) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="text" name="group_name" 
                                   class="form-control form-control-custom text-center fw-bold" 
                                   placeholder="Contoh: Tim Algoritma" required autofocus>
                        </div>
                        <button type="submit" class="btn bg-indigo text-white w-100 py-3 fw-bold rounded-3">
                            MASUK PBL WORKSPACE <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-workspace-layout>