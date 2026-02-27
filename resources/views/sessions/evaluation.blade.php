<x-app-layout>
    <style>
        body { background-color: #f0f2f5; }
        .text-indigo { color: #5c60f5; }
        .card-custom { border-radius: 15px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .table-hover tbody tr:hover { background-color: #f8fafc; transition: 0.2s; }
        .progress-custom { height: 8px; border-radius: 10px; background-color: #e2e8f0; }
        .progress-bar-custom { background-color: #5c60f5; border-radius: 10px; }
    </style>

    <div class="container py-5" style="max-width: 1000px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('dashboard') }}" class="text-muted text-decoration-none mb-2 d-inline-block">
                    <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
                </a>
                <h2 class="fw-bold text-indigo mb-0">Evaluation Panel</h2>
                <p class="text-muted">Session: <strong>{{ $session->title }}</strong></p>
            </div>
            <div class="text-end">
                <span class="d-block text-muted small text-uppercase fw-bold">Session Code</span>
                <h3 class="fw-bold text-dark font-monospace mb-0 border px-3 py-1 rounded bg-white shadow-sm">
                    {{ $session->session_code }}
                </h3>
            </div>
        </div>

        <div class="card card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0"><i class="bi bi-people text-indigo me-2"></i>Student Groups</h5>
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Total: {{ $session->groups->count() }} Groups</span>
            </div>

            @if($session->groups->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="text-muted small text-uppercase" style="background-color: #f8fafc;">
                            <tr>
                                <th class="py-3 px-4 rounded-start" style="width: 30%;">Group Name</th>
                                <th class="py-3" style="width: 30%;">Learning Progress</th>
                                <th class="py-3" style="width: 20%;">Grading Status</th>
                                <th class="py-3 text-end rounded-end px-4" style="width: 20%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($session->groups as $group)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="fw-bold text-dark">{{ $group->group_name }}</div>
                                    <small class="text-muted">Joined: {{ $group->created_at->format('d M Y') }}</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress progress-custom flex-grow-1">
                                            {{-- Progress dihitung dari current_phase (1-5) --}}
                                            <div class="progress-bar progress-bar-custom" role="progressbar" style="width: {{ ($group->current_phase / 5) * 100 }}%"></div>
                                        </div>
                                        <small class="text-muted fw-bold">Phase {{ $group->current_phase }}/5</small>
                                    </div>
                                </td>
                                <td>
                                    @if($group->evaluation)
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success px-2 py-1 rounded-pill">Score: {{ $group->evaluation->score }}</span>
                                    @else
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-2 py-1 rounded-pill">Needs Grading</span>
                                    @endif
                                </td>
                                <td class="text-end px-4">
                                    <a href="{{ route('groups.work', $group->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                        <i class="bi bi-eye me-1"></i> View Work
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-person-plus text-muted" style="font-size: 4rem; opacity: 0.5;"></i>
                    </div>
                    <h5 class="fw-bold">No Groups Registered</h5>
                    <p class="text-muted mb-4">Give code <strong class="text-dark">{{ $session->session_code }}</strong> to your students.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>