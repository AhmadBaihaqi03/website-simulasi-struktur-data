<x-app-layout>
    <style>
        body { background-color: #f0f2f5; }
        .text-indigo { color: #5c60f5; }
        .card-custom { border-radius: 15px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .table-hover tbody tr:hover { background-color: #f8fafc; transition: 0.2s; }
        
        /* Box Kode Sesi yang lebih manis */
        .session-code-box {
            background-color: #ffffff;
            border: 2px dashed #5c60f5;
            border-radius: 10px;
            padding: 4px 15px;
            display: inline-block;
        }

        /* Opsi 2: Dedicated Search Row */
        .filter-row {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
        }
        .search-wrapper-full {
            position: relative;
            flex-grow: 1;
        }
        .search-wrapper-full i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }
        .search-input-full {
            padding-left: 45px;
            height: 45px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .search-input-full:focus {
            border-color: #5c60f5;
            box-shadow: 0 0 0 4px rgba(92, 96, 245, 0.1);
            background-color: #fff;
        }
    </style>

    <div class="container py-5" style="max-width: 900px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-indigo mb-0">Panel Evaluasi</h2>
                <p class="text-muted mb-0">Sesi: <span class="text-dark fw-semibold">{{ $session->title }}</span></p>
            </div>
            <div class="text-end">
                <span class="d-block text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.7rem;">Kode Sesi</span>
                <div class="session-code-box shadow-sm">
                    <h4 class="fw-bold text-indigo font-monospace mb-0" style="letter-spacing: 1px;">
                        {{ $session->session_code }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="card card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-people-fill text-indigo me-2"></i>Daftar Kelompok Mahasiswa
                </h5>
                <span class="badge bg-indigo bg-opacity-10 text-indigo px-3 py-2 rounded-pill fw-bold">
                    {{ $groups->count() }} Kelompok Terdaftar
                </span>
            </div>

            <div class="filter-row">
                <div class="search-wrapper-full">
                    <i class="bi bi-search fs-5"></i>
                    <input type="text" id="groupSearch" class="form-control search-input-full" placeholder="Ketik nama kelompok untuk mencari dengan cepat...">
                </div>
            </div>

            @if($groups->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="groupTable">
                        <thead class="text-muted small text-uppercase">
                            <tr>
                                <th class="py-3 px-4 border-0" style="width: 45%;">Nama Kelompok</th>
                                <th class="py-3 border-0" style="width: 30%;">Status Penilaian</th>
                                <th class="py-3 text-end border-0 px-4" style="width: 25%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            <tr class="group-row border-top">
                                <td class="px-4 py-3 border-0">
                                    <div class="fw-bold text-dark group-name">{{ $group->group_name }}</div>
                                    <small class="text-muted">ID: #{{ str_pad($group->id, 4, '0', STR_PAD_LEFT) }}</small>
                                </td>
                                <td class="border-0">
                                    @if($group->evaluation)
                                        <div class="d-flex align-items-center text-success fw-bold">
                                            <i class="bi bi-check-circle-fill me-2"></i>
                                            <span>Sudah Diberi Feedback</span>
                                            {{--  <span>Skor: {{ $group->evaluation->score }}</span> --}}
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center text-warning fw-bold">
                                            <i class="bi bi-hourglass-split me-2"></i>
                                            <span>Menunggu Feedback</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-end px-4 border-0">
                                    <a href="{{ route('groups.work', $group->id) }}" class="btn btn-indigo btn-sm rounded-pill px-4 shadow-sm fw-bold">
                                        Buka Tugas <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            <tr id="noResults" style="display: none;">
                                <td colspan="3" class="text-center py-5">
                                    <i class="bi bi-search text-muted mb-2 d-block" style="font-size: 2rem;"></i>
                                    <span class="text-muted">Maaf, kelompok dengan nama tersebut tidak ditemukan.</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <p class="text-muted">Belum ada aktivitas kelompok di sesi ini.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('groupSearch').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('.group-row');
            let hasResults = false;

            rows.forEach(row => {
                let name = row.querySelector('.group-name').textContent.toLowerCase();
                if (name.includes(filter)) {
                    row.style.display = "";
                    hasResults = true;
                } else {
                    row.style.display = "none";
                }
            });

            document.getElementById('noResults').style.display = hasResults ? "none" : "";
        });
    </script>
</x-app-layout>