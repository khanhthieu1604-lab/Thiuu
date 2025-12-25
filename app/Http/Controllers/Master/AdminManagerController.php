<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminManagerController extends Controller
{
    // Hiển thị danh sách tất cả Admin và User
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        $users = User::where('role', 'user')->get();
        return view('master.admins.index', compact('admins', 'users'));
    }

    // Xử lý tạo tài khoản Admin mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Mặc định gán quyền admin
            'email_verified_at' => now(),
        ]);

        return back()->with('success', 'Đã tạo tài khoản Admin thành công!');
    }

    // Cấp quyền Admin cho một User có sẵn
    public function promote($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'admin';
        $user->save();

        return back()->with('success', 'Đã nâng cấp tài khoản lên Admin!');
    }
}