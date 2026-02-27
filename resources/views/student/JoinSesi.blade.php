<x-workspace-layout>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="card phase-card p-5 shadow-lg border-0 text-center" style="max-width: 450px; width: 100%;">
            <h3 class="fw-bold text-indigo mb-4">Masuk Sesi PBL</h3>
            
            <form action="{{ route('student.join.check') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="label-custom d-block mb-2">Kode Sesi dari Guru</label>
                    <input type="text" name="session_code" 
                           class="form-control form-control-custom text-center fw-bold fs-3 text-uppercase" 
                           placeholder="CONTOH: PBL-01" required autofocus>
                    @if(session('error'))
                        <small class="text-danger mt-2 d-block fw-bold">{{ session('error') }}</small>
                    @endif
                </div>

                <button type="submit" class="btn bg-indigo text-white w-100 py-3 rounded-4 fw-bold shadow-sm">
                    LIHAT MASALAH <i class="bi bi-arrow-right ms-2"></i>
                </button>
            </form>
        </div>
    </div>
</x-workspace-layout>