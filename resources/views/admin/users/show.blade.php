@extends('admin.layouts.app')

@section('title', 'User Details - GauMitra Admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <span class="quick-badge">User Profile</span>
            <h2 class="mb-1">User Details</h2>
            <p class="text-muted mb-0">Complete user information with address history and login OTP activity.</p>
        </div>

        <a href="{{ route('admin.users.index') }}" class="btn btn-dark rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i> Back to Users
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="detail-card profile-card text-center">
                <div class="profile-avatar mx-auto mb-3">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>

                <h4 class="mb-1">{{ $user->name ?: 'N/A' }}</h4>
                <p class="text-muted mb-3">{{ $user->mobile ?: 'N/A' }}</p>

                <div class="d-flex justify-content-center gap-2 flex-wrap mb-3">
                    @if(($user->status ?? '') === 'active')
                        <span class="badge custom-badge bg-success-subtle text-success">Active</span>
                    @else
                        <span class="badge custom-badge bg-secondary-subtle text-secondary">{{ ucfirst($user->status ?? 'Inactive') }}</span>
                    @endif

                    @if($user->mobile_verified_at)
                        <span class="badge custom-badge bg-success-subtle text-success">Verified</span>
                    @else
                        <span class="badge custom-badge bg-danger-subtle text-danger">Not Verified</span>
                    @endif
                </div>

                <div class="info-list text-start">
                    <div class="info-row">
                        <span>User ID</span>
                        <strong>{{ $user->id }}</strong>
                    </div>
                    <div class="info-row">
                        <span>Last Login</span>
                        <strong>{{ $user->last_login_at ? $user->last_login_at->format('d M Y, h:i A') : 'Never' }}</strong>
                    </div>
                    <div class="info-row">
                        <span>Total Addresses</span>
                        <strong>{{ $user->addresses->count() }}</strong>
                    </div>
                    <div class="info-row">
                        <span>Total OTP Logs</span>
                        <strong>{{ $user->loginOtps->count() }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="detail-card mb-4">
                <div class="section-title">
                    <h4><i class="bi bi-person-lines-fill me-2"></i>Basic Information</h4>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-box">
                            <label>Full Name</label>
                            <div>{{ $user->name ?: 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <label>Mobile Number</label>
                            <div>{{ $user->mobile ?: 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <label>Status</label>
                            <div>{{ ucfirst($user->status ?? 'Inactive') }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <label>Mobile Verified At</label>
                            <div>{{ $user->mobile_verified_at ? $user->mobile_verified_at->format('d M Y, h:i A') : 'Not Verified' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="detail-card mb-4">
                <div class="section-title">
                    <h4><i class="bi bi-geo-alt-fill me-2"></i>Address Details</h4>
                </div>

                @forelse($user->addresses as $address)
                    <div class="address-card">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="info-box">
                                    <label>Full Address</label>
                                    <div>{{ $address->full_address ?: 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <label>Street</label>
                                    <div>{{ $address->street ?: 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <label>Village</label>
                                    <div>{{ $address->village ?: 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <label>Police Station</label>
                                    <div>{{ $address->police_station ?: 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <label>City</label>
                                    <div>{{ $address->city ?: 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <label>District</label>
                                    <div>{{ $address->district ?: 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <label>State</label>
                                    <div>{{ $address->state ?: 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <label>Pincode</label>
                                    <div>{{ $address->pincode ?: 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <label>Area Name</label>
                                    <div>{{ $address->area_name ?: 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <label>Google Place ID</label>
                                    <div>{{ $address->google_place_id ?: 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <label>Latitude</label>
                                    <div>{{ $address->latitude ?: 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <label>Longitude</label>
                                    <div>{{ $address->longitude ?: 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-geo-alt display-6 d-block mb-2"></i>
                        No address records found for this user.
                    </div>
                @endforelse
            </div>

            <div class="detail-card">
                <div class="section-title">
                    <h4><i class="bi bi-key-fill me-2"></i>Recent OTP Logs</h4>
                </div>

                <div class="table-responsive">
                    <table class="table otp-table align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mobile</th>
                                <th>Purpose</th>
                                <th>Expires At</th>
                                <th>Verified At</th>
                                <th>Used</th>
                                <th>Attempts</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->loginOtps->take(10) as $key => $otp)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $otp->mobile }}</td>
                                    <td>{{ $otp->purpose ?: 'N/A' }}</td>
                                    <td>{{ $otp->expires_at ? \Carbon\Carbon::parse($otp->expires_at)->format('d M Y, h:i A') : 'N/A' }}</td>
                                    <td>{{ $otp->verified_at ? \Carbon\Carbon::parse($otp->verified_at)->format('d M Y, h:i A') : 'Not Verified' }}</td>
                                    <td>
                                        @if($otp->is_used)
                                            <span class="badge bg-success-subtle text-success custom-badge">Used</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning custom-badge">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $otp->attempts ?? 0 }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No OTP logs found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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

    .detail-card {
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 22px;
        padding: 22px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
    }

    .profile-card {
        position: sticky;
        top: 20px;
    }

    .profile-avatar {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f97316, #fb923c);
        color: #fff;
        font-size: 32px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .section-title h4 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .info-list {
        margin-top: 16px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        border-bottom: 1px dashed #e5e7eb;
        padding: 10px 0;
        font-size: 14px;
    }

    .info-row span {
        color: #6b7280;
    }

    .info-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 14px;
        height: 100%;
    }

    .info-box label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        margin-bottom: 6px;
        text-transform: uppercase;
    }

    .address-card {
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 18px;
        margin-bottom: 16px;
        background: linear-gradient(180deg, #ffffff, #fffaf5);
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 18px;
        color: #64748b;
    }

    .custom-badge {
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .otp-table thead th {
        font-size: 13px;
        color: #6b7280;
        font-weight: 700;
    }

    .otp-table tbody td {
        padding-top: 14px;
        padding-bottom: 14px;
    }
</style>
@endsection