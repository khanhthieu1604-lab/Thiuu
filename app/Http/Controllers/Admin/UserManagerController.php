<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagerController extends Controller
{
    // 1. Danh sách người dùng
    public function index()
    {
        // Lấy danh sách user và admin (trừ bản thân người đang đăng nhập)
        $users = User::select('id', 'name', 'email', 'role', 'phone', 'created_at')
                    ->where('id', '!=', auth()->id()) 
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // 2. Cấp/Thu hồi quyền Admin
    public function toggleRole($id)
    {
        // Chỉ cho phép Master hoặc Admin thực hiện (Middleware đã chặn User thường)
        $user = User::findOrFail($id);

        // Bảo vệ: Không cho phép hạ quyền của tài khoản Master
        if ($user->role === 'master') {
            return back()->with('error', 'Không thể thay đổi quyền hạn của tài khoản Master.');
        }

        // Logic cũ: Đảo ngược role
        $user->role = ($user->role === 'admin') ? 'user' : 'admin';
        $user->save();

        return back()->with('success', 'Đã cập nhật quyền hạn cho ' . $user->name);
    }

    // 3. Xóa tài khoản
    public function destroy($id)
    {
        $currentUser = auth()->user();
        $targetUser = User::findOrFail($id);

        // Logic phân quyền chặt chẽ:
        // 1. Không ai được xóa Master
        if ($targetUser->role === 'master') {
            return back()->with('error', 'Không thể xóa tài khoản hệ thống (Master).');
        }

        // 2. Nếu người xóa là Admin thường (không phải Master) -> Không được xóa Admin khác
        if ($currentUser->role !== 'master' && $targetUser->role === 'admin') {
            return back()->with('error', 'Bạn không đủ quyền để xóa một Quản trị viên khác.');
        }

        $targetUser->delete();
        return back()->with('success', 'Đã xóa tài khoản thành công.');
    }
}