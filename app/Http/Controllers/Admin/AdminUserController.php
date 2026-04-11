<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::with(['latestAddress'])
            ->withCount('addresses')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('mobile', 'like', "%{$search}%")
                      ->orWhere('status', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'search'));
    }

    public function show($id)
    {
        $user = User::with([
            'addresses' => function ($query) {
                $query->latest();
            },
            'loginOtps' => function ($query) {
                $query->latest();
            }
        ])->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }
}