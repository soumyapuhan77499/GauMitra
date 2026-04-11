@extends('admin.layouts.app')

@section('title', 'Users - GauMitra Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-box mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="quick-badge">User Management</span>
                <h2 class="mb-1">All Users</h2>
                <p class="text-muted mb-0">View registered users, contact details, status, and latest address information.</p>
            </div>

            <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex gap-2" style="max-width: 420px; width:100%;">
                <input
                    type="text"
                    name="search"
                    class="form-control search-box"
                    placeholder="Search by name, mobile or status"
                    value="{{ request('search') }}"
                >
                <button class="btn btn-dark px-4">Search</button>
            </form>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="user-summary-card">
                <div>
                    <h6>Total Users</h6>
                    <h3>{{ $users->total() }}</h3>
                </div>
                <div class="summary-icon bg-primary-subtle text-primary">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="user-summary-card">
                <div>
                    <h6>Verified Users</h6>
                    <h3>{{ \App\Models\User::whereNotNull('mobile_verified_at')->count() }}</h3>
                </div>
                <div class="summary-icon bg-success-subtle text-success">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="user-summary-card">
                <div>
                    <h6>Users With Address</h6>
                    <h3>{{ \App\Models\User::has('addresses')->count() }}</h3>
                </div>
                <div class="summary-icon bg-warning-subtle text-warning">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="table-panel">
        <div class="table-responsive">
            <table class="table align-middle user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Info</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Verification</th>
                        <th>Latest Address</th>
                        <th>Address Count</th>
                        <th>Last Login</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $key => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $key }}</td>

                            <td>
                                <div class="user-info-cell">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $user->name ?: 'N/A' }}</h6>
                                        <small class="text-muted">User ID: {{ $user->id }}</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="fw-semibold">{{ $user->mobile ?? 'N/A' }}</span>
                            </td>

                            <td>
                                @php
                                    $status = strtolower($user->status ?? 'inactive');
                                @endphp

                                @if($status === 'active')
                                    <span class="badge custom-badge bg-success-subtle text-success">Active</span>
                                @elseif($status === 'inactive')
                                    <span class="badge custom-badge bg-secondary-subtle text-secondary">Inactive</span>
                                @else
                                    <span class="badge custom-badge bg-warning-subtle text-warning">{{ ucfirst($user->status) }}</span>
                                @endif
                            </td>

                            <td>
                                @if($user->mobile_verified_at)
                                    <span class="badge custom-badge bg-success-subtle text-success">
                                        Verified
                                    </span>
                                    <div class="small text-muted mt-1">
                                        {{ $user->mobile_verified_at->format('d M Y, h:i A') }}
                                    </div>
                                @else
                                    <span class="badge custom-badge bg-danger-subtle text-danger">
                                        Not Verified
                                    </span>
                                @endif
                            </td>

                            <td style="min-width: 240px;">
                                @if($user->latestAddress)
                                    <div class="address-box">
                                        <div class="fw-semibold text-dark">
                                            {{ $user->latestAddress->city ?: ($user->latestAddress->district ?: 'Address Available') }}
                                        </div>
                                        <div class="small text-muted">
                                            {{ $user->latestAddress->full_address ?: 'No full address' }}
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">No address added</span>
                                @endif
                            </td>

                            <td>
                                <span class="badge rounded-pill text-bg-light border">{{ $user->addresses_count }}</span>
                            </td>

                            <td>
                                @if($user->last_login_at)
                                    <div class="fw-semibold">{{ $user->last_login_at->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $user->last_login_at->format('h:i A') }}</small>
                                @else
                                    <span class="text-muted">Never</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-dark rounded-pill px-3">
                                    <i class="bi bi-eye-fill me-1"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-people display-6 d-block mb-2"></i>
                                    No users found.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>

<style>
    .page-title-box {
        background: linear-gradient(135deg, #fff7ed, #ffffff);
        border: 1px solid #fde7d3;
        border-radius: 22px;
        padding: 24px;
    }

    .quick-badge {
        display: inline-block;
        background: #fff1e6;
        color: #ea580c;
        border: 1px solid #fed7aa;
        border-radius: 999px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .search-box {
        height: 46px;
        border-radius: 14px;
    }

    .user-summary-card {
        background: #fff;
        border-radius: 20px;
        padding: 20px;
        border: 1px solid #ececec;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.04);
        display: flex;
        justify-content: space-between;
        align-items: center;
        min-height: 110px;
    }

    .user-summary-card h6 {
        color: #6b7280;
        margin-bottom: 8px;
    }

    .user-summary-card h3 {
        margin-bottom: 0;
        font-weight: 700;
    }

    .summary-icon {
        width: 55px;
        height: 55px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .table-panel {
        background: #fff;
        border-radius: 22px;
        padding: 20px;
        border: 1px solid #ececec;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
    }

    .user-table thead th {
        font-size: 13px;
        font-weight: 700;
        color: #6b7280;
        border-bottom: 1px solid #e5e7eb;
        padding: 16px 14px;
        white-space: nowrap;
    }

    .user-table tbody td {
        padding: 16px 14px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    .user-table tbody tr:hover {
        background: #fffaf5;
        transition: 0.3s ease;
    }

    .user-info-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f97316, #fb923c);
        color: #fff;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .custom-badge {
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .address-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 10px 12px;
    }
</style>
@endsection