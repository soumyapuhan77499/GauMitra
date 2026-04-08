@extends('admin.layouts.app')

@section('content')
    <div class="page-title">Dashboard</div>

    <div class="row">
        <div class="col-md-4">
            <div class="dashboard-card">
                <h5>Total Users</h5>
                <h3>120</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <h5>Total Admins</h5>
                <h3>8</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <h5>Total Reports</h5>
                <h3>35</h3>
            </div>
        </div>
    </div>

    <div class="dashboard-card">
        <h4>Welcome to Admin Dashboard</h4>
        <p>This page is using header, sidebar, footer, and common layout include system.</p>
    </div>
@endsection