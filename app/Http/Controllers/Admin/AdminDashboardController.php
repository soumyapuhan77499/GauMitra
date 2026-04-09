<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = Schema::hasTable('users') ? DB::table('users')->count() : 0;
        $totalAdmins = Schema::hasTable('admin_users') ? DB::table('admin_users')->count() : 0;
        $activeAdmins = Schema::hasTable('admin_users') ? DB::table('admin_users')->where('status', 'active')->count() : 0;
        $totalOtps = Schema::hasTable('login_otps') ? DB::table('login_otps')->count() : 0;
        $activeSessions = Schema::hasTable('sessions') ? DB::table('sessions')->count() : 0;

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'totalAdmins',
            'activeAdmins',
            'totalOtps',
            'activeSessions'
        ));
    }
}