<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagerController extends Controller
{
    public function index()
    {
        // Lấy danh sách, tuyệt đối không truy vấn 'password' để bảo mật
        $users = User::select('id', 'name', 'email', 'role', 'phone', 'created_at')
                    ->where('id', '!=', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function toggleRole($id)
    {
        $user = User::findOrFail($id);
        $user->role = ($user->role === 'admin') ? 'user' : 'admin';
        $user->save();

        return back()->with('success', 'Đã cập nhật quyền hạn cho ' . $user->name);
    }

    public function destroy($id)
    {
        // Chỉ Master Admin mới có quyền xóa tài khoản
        if (auth()->user()->email !== 'admin@gmail.com') {
            return back()->with('error', 'Chỉ tài khoản Master mới có quyền thực hiện xóa người dùng.');
        }

        User::findOrFail($id)->delete();
        return back()->with('success', 'Đã xóa tài khoản thành công.');
    }
}