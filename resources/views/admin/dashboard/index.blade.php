@extends('admin.layouts.app')

@section('title', 'Dashboard - GauMitra Admin')

@section('content')
    <div class="page-title-box">
        <span class="quick-badge">Welcome Back</span>
        <h2>Hello, {{ session('admin_name', 'Admin') }} 👋</h2>
        <p>
            This is your GauMitra admin control panel. Monitor user activity, admin access,
            OTP records, and session health from one place.
        </p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div>
                        <h6>Total Users</h6>
                        <h3>{{ $totalUsers }}</h3>
                        <p>All registered users in system</p>
                    </div>
                    <div class="stat-icon bg-orange">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div>
                        <h6>Total Admins</h6>
                        <h3>{{ $totalAdmins }}</h3>
                        <p>Admin accounts created</p>
                    </div>
                    <div class="stat-icon bg-blue">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div>
                        <h6>Active Admins</h6>
                        <h3>{{ $activeAdmins }}</h3>
                        <p>Currently active admin records</p>
                    </div>
                    <div class="stat-icon bg-green">
                        <i class="bi bi-shield-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div>
                        <h6>OTP Records</h6>
                        <h3>{{ $totalOtps }}</h3>
                        <p>Total login OTP entries</p>
                    </div>
                    <div class="stat-icon bg-purple">
                        <i class="bi bi-key-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="dashboard-panel">
                <h4>System Quick Report</h4>

                <div class="report-item">
                    <div class="label">Registered Users</div>
                    <div class="value">{{ $totalUsers }}</div>
                </div>

                <div class="report-item">
                    <div class="label">Admin Accounts</div>
                    <div class="value">{{ $totalAdmins }}</div>
                </div>

                <div class="report-item">
                    <div class="label">Active Admin Accounts</div>
                    <div class="value">{{ $activeAdmins }}</div>
                </div>

                <div class="report-item">
                    <div class="label">Saved OTP Logs</div>
                    <div class="value">{{ $totalOtps }}</div>
                </div>

                <div class="report-item">
                    <div class="label">Active Sessions</div>
                    <div class="value">{{ $activeSessions }}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="dashboard-panel">
                <h4>Admin Overview</h4>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Admin Health</label>
                    <div class="progress" style="height: 10px; border-radius: 10px;">
                        <div class="progress-bar bg-success" style="width: {{ $totalAdmins > 0 ? ($activeAdmins / $totalAdmins) * 100 : 0 }}%"></div>
                    </div>
                    <small class="text-muted">
                        {{ $activeAdmins }} of {{ $totalAdmins }} admins are active
                    </small>
                </div>

                <div class="p-3 rounded-4" style="background:#fff7ed; border:1px solid #fed7aa;">
                    <h6 class="fw-bold mb-2">Platform Status</h6>
                    <p class="mb-2 text-muted">Your admin panel is running successfully.</p>
                    <ul class="mb-0 ps-3 text-muted">
                        <li>Session login system working</li>
                        <li>Dashboard stats loaded</li>
                        <li>Sidebar, header and footer added</li>
                        <li>Responsive design enabled</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection