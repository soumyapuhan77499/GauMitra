@extends('admin.layouts.app')

@section('content')
    <div class="page-title mb-4">Dashboard</div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="dashboard-card p-4 shadow-sm rounded">
                <h5>Total Users</h5>
                <h3>120</h3>
                <p class="text-muted mb-0">Registered users in system</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="dashboard-card p-4 shadow-sm rounded">
                <h5>Total Admins</h5>
                <h3>8</h3>
                <p class="text-muted mb-0">Authorized admin accounts</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="dashboard-card p-4 shadow-sm rounded">
                <h5>Total Reports</h5>
                <h3>35</h3>
                <p class="text-muted mb-0">Submitted system reports</p>
            </div>
        </div>
    </div>

    <div class="dashboard-card p-4 shadow-sm rounded mt-3">
        <h4>Welcome, {{ session('admin_name') }}</h4>
        <p class="mb-0">You have successfully logged in to the GauMitra admin dashboard.</p>
    </div>
@endsection