@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
    <div class="container-fluid px-4 py-4">
        <!-- Header Section -->
        <div class="card border-0 rounded-4 p-4 mb-4 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="fw-bold" style="color: var(--dark-gray);">Manajemen User</h1>
                    <p class="text-muted mb-0">Kelola data siswa dan admin</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">

            @php
                $userCards = [
                    [
                        'title' => 'Total User',
                        'value' => $users->total(),
                        'icon' => 'bi-people',
                        'color' => 'primary',
                    ],
                    [
                        'title' => 'Pending Approval',
                        'value' => $pendingCount,
                        'icon' => 'bi-hourglass-split',
                        'color' => 'warning',
                    ],
                    [
                        'title' => 'Siswa Aktif',
                        'value' => $users->where('role', 'siswa')->where('status', 'approved')->count(),
                        'icon' => 'bi-mortarboard',
                        'color' => 'success',
                    ],
                ];
            @endphp

            @foreach ($userCards as $card)
                <div class="col-md-4">
                    <div class="card stat-card border-0 rounded-4 p-4 text-center shadow-sm">
                        <div class="icon-box mb-3 bg-{{ $card['color'] }} bg-opacity-10 text-{{ $card['color'] }} rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width:60px;height:60px;">
                            <i class="bi {{ $card['icon'] }} fs-4"></i>
                        </div>
                        <h6 class="text-muted mb-2">{{ $card['title'] }}</h6>
                        <h2 class="fw-bold mb-0">{{ $card['value'] }}</h2>
                    </div>
                </div>
            @endforeach

        </div>



        <!-- Users Table Card -->
        <!-- Filter Section -->

        <div class="row mb-4 g-3">
            <div class="col-md-6">
                <div class="search-box d-flex align-items-center gap-3">
                    <i class="bi bi-search text-muted"></i>
                    <input type="text" class="form-control" id="searchUser" placeholder="Cari nama, email, atau kelas..."
                        class="border-0 bg-transparent w-100" onkeyup="filterTable()">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select filter-select" id="roleFilter" onchange="filterTable()">
                    <option value="all">Semua Role</option>
                    <option value="siswa">Siswa</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select filter-select" id="statusFilter" onchange="filterTable()">
                    <option value="all">Semua Status</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>
        <div class="card border-0 rounded-4 p-4 bg-light">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5><i class="bi bi-list me-2" style="color: var(--primary-blue);"></i> Daftar Semua User</h5>
                <p>Total {{ $users->total() }} user terdaftar dalam sistem</p>
            </div>

            <div class="card-body p-0">
                @if ($users->count() > 0)
                    <div class="table-responsive px-2">
                        <table class="table align-middle custom-table mb-0 rounded-3 overflow-hidden" id="usersTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Kelas</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                                                    style="width: 35px; height: 35px;">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                                <div>
                                                    <strong>{{ $user->name }}</strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-envelope me-2 text-muted"></i>
                                                {{ $user->email }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($user->kelas)
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-book me-2 text-muted"></i>
                                                    {{ $user->kelas }}
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="badge-custom {{ $user->role == 'admin' ? 'badge-admin' : 'badge-siswa' }}">
                                                <i
                                                    class="bi bi-{{ $user->role == 'admin' ? 'shield' : 'person' }} me-1"></i>
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($user->status == 'approved')
                                                <span class="badge-custom badge-approved">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Approved
                                                </span>
                                            @elseif($user->status == 'pending')
                                                <span class="badge-custom badge-pending">
                                                    <i class="bi bi-clock me-1"></i>
                                                    Pending
                                                </span>
                                            @else
                                                <span class="badge-custom badge-rejected">
                                                    <i class="bi bi-x-circle me-1"></i>
                                                    Rejected
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-calendar me-2 text-muted"></i>
                                                {{ $user->created_at->format('d/m/Y') }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($user->role == 'siswa' && $user->status == 'pending')
                                                <div class="btn-action-group">
                                                    <form action="{{ route('admin.users.approve', $user->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn-approve" title="Setujui">
                                                            <i class="bi bi-check-lg me-1"></i>
                                                            Approve
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.users.reject', $user->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn-reject" title="Tolak">
                                                            <i class="bi bi-x-lg me-1"></i>
                                                            Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            @elseif($user->role == 'siswa')
                                                <button class="btn-detail" onclick="showUserDetail({{ $user->id }})">
                                                    <i class="bi bi-eye me-1"></i>
                                                    Detail
                                                </button>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="p-4 border-top">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-people"></i>
                        <h4>Belum ada user terdaftar</h4>
                        <p class="text-muted">User akan muncul disini setelah melakukan registrasi</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="userDetailModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold">Detail User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4 pt-3" id="userDetailContent">
                    <!-- Dynamic content -->
                </div>
            </div>
        </div>
    </div>
@endsection
