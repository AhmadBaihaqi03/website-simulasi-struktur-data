<x-app-layout>
    <style>
        body { background-color: #f8f9fa; }
        .card-stat { border-radius: 15px; border: none; min-height: 75px; }
        .text-indigo { color: #5c60f5; }
        .bg-indigo { background-color: #5c60f5; }
        .btn-indigo { background-color: #5c60f5; color: white; border-radius: 20px; padding: 10px 25px; }
        .btn-indigo:hover { background-color: #4a4ed4; color: white; }
        .status-badge { border-radius: 20px; padding: 5px 15px; font-size: 0.75rem; font-weight: bold; }
        .action-icon { color: #8a8da3; transition: 0.3s; border: none; background: none; padding: 0; }
        .action-icon:hover { color: #5c60f5; transform: scale(1.1); }
        .banner-new { background: linear-gradient(90deg, #5c60f5 0%, #3f42b5 100%); border-radius: 20px; color: white; }
    </style>

    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4 alert-dismissible fade show" style="border-radius: 15px;">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="mb-4">
            <h1 class="fw-bold h2 mb-1">Good morning, {{ Auth::user()->name }}</h1>
            <p class="text-muted">Manage your problem-based learning sessions and student evaluations.</p>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card card-stat shadow-sm p-3 border-0">
                    <div class="d-flex justify-content-between text-muted small fw-bold">
                        <span>NEED GRADING</span>
                        <i class="bi bi-pencil-square text-warning"></i>
                    </div>
                    <h1 class="fw-bold mt-2 mb-0 display-6 text-indigo">{{ sprintf('%02d', $stats['pending']) }}</h1>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-stat shadow-sm p-3 border-0">
                    <div class="d-flex justify-content-between text-muted small fw-bold">
                        <span>GRADED GROUPS</span>
                        <i class="bi bi-check-all text-success"></i>
                    </div>
                    <h1 class="fw-bold mt-2 mb-0 display-6 text-indigo">{{ sprintf('%02d', $stats['graded'] ?? 0) }}</h1>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-stat shadow-sm p-3 border-0">
                    <div class="d-flex justify-content-between text-muted small fw-bold">
                        <span>TOTAL GROUPS</span>
                        <i class="bi bi-people text-primary"></i>
                    </div>
                    <h1 class="fw-bold mt-2 mb-0 display-6 text-indigo">{{ sprintf('%02d', $stats['total_groups'] ?? 0) }}</h1>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-stat shadow-sm p-3 border-0">
                    <div class="d-flex justify-content-between text-muted small fw-bold">
                        <span>ACTIVE SESSIONS</span>
                        <i class="bi bi-broadcast text-success"></i>
                    </div>
                    <h1 class="fw-bold mt-2 mb-0 display-6 text-indigo">{{ sprintf('%02d', $stats['active']) }}</h1>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-stat shadow-sm p-3 border-0">
                    <div class="d-flex justify-content-between text-muted small fw-bold">
                        <span>INACTIVE SESSIONS</span>
                        <i class="bi bi-pause-circle text-secondary"></i>
                    </div>
                    <h1 class="fw-bold mt-2 mb-0 display-6 text-indigo">{{ sprintf('%02d', $stats['total'] - $stats['active']) }}</h1>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-stat shadow-sm p-3 border-0">
                    <div class="d-flex justify-content-between text-muted small fw-bold">
                        <span>TOTAL SESSIONS</span>
                        <i class="bi bi-layers text-indigo"></i>
                    </div>
                    <h1 class="fw-bold mt-2 mb-0 display-6 text-indigo">{{ sprintf('%02d', $stats['total']) }}</h1>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4 gap-3">
                    
                    <div class="input-group shadow-sm flex-grow-1" style="border-radius: 12px; overflow: hidden;">
                        <span class="input-group-text bg-white border-0 ps-3">
                            <i class="bi bi-search text-indigo"></i>
                        </span>
                        <input type="text" 
                            id="searchInput"
                            class="form-control bg-white border-0 py-2 fw-medium text-indigo" 
                            placeholder="Cari berdasarkan nama atau kode sesi..."
                            style="box-shadow: none;">
                    </div>

                    <div class="flex-shrink-0">
                        <a href="{{ route('sessions.create') }}" class="btn btn-indigo shadow-sm fw-bold px-4 py-2 d-inline-flex align-items-center">
                            <i class="bi bi-plus-lg me-2"></i> Tambah Sesi
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle" id="sessionTable">
                        <thead class="text-muted small">
                            <tr>
                                <th>SESSION NAME</th>
                                <th>CODE</th>
                                <th>STUDENTS</th>
                                <th>STATUS</th>
                                <th class="text-end">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sessions as $session)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark session-title">{{ $session->title }}</div>
                                    <small class="text-muted">Created: {{ $session->created_at->format('d M Y') }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 font-monospace session-code">{{ $session->session_code }}</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="text-muted small">
                                            <i class="bi bi-people me-1"></i> {{ $session->groups->count() }} Groups
                                        </span>
                                        @if($session->pending_evaluations_count > 0)
                                            <div class="mt-1">
                                                <span class="badge rounded-pill bg-danger shadow-sm" style="font-size: 0.65rem;">
                                                    {{ $session->pending_evaluations_count }} Need Grading
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($session->is_active)
                                        <span class="status-badge bg-success-subtle text-success border border-success">ACTIVE</span>
                                    @else
                                        <span class="status-badge bg-light text-muted border">INACTIVE</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end align-items-center gap-2">
                                        <form action="{{ route('sessions.toggle', $session) }}" method="POST" class="m-0">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-sm shadow-sm d-flex align-items-center justify-content-center {{ $session->is_active ? 'btn-success' : 'btn-secondary' }}" style="border-radius: 8px; width: 38px; height: 38px;">
                                                <i class="bi {{ $session->is_active ? 'bi-toggle-on' : 'bi-toggle-off' }} fs-5"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('sessions.evaluations', $session) }}" class="btn btn-sm shadow-sm d-flex align-items-center justify-content-center {{ $session->pending_evaluations_count > 0 ? 'btn-primary text-white' : 'btn-outline-primary' }}" style="border-radius: 8px; width: 38px; height: 38px;">
                                            <i class="bi bi-mortarboard-fill fs-5"></i>
                                        </a>
                                        <a href="{{ route('sessions.edit', $session) }}" class="btn btn-sm btn-outline-warning shadow-sm d-flex align-items-center justify-content-center" style="border-radius: 8px; width: 38px; height: 38px;">
                                            <i class="bi bi-pencil-fill fs-6"></i>
                                        </a>
                                        <form action="{{ route('sessions.destroy', $session) }}" method="POST" class="m-0" onsubmit="return confirm('Hapus sesi ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm d-flex align-items-center justify-content-center" style="border-radius: 8px; width: 38px; height: 38px;">
                                                <i class="bi bi-trash3-fill fs-6"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">No sessions found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#sessionTable tbody tr');

            rows.forEach(row => {
                // Kita ambil teks dari judul sesi dan kode sesi
                let title = row.querySelector('.session-title')?.textContent.toLowerCase() || "";
                let code = row.querySelector('.session-code')?.textContent.toLowerCase() || "";
                    
                // Jika salah satu mengandung kata kunci, tampilkan barisnya
                if (title.includes(filter) || code.includes(filter)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>
</x-app-layout>