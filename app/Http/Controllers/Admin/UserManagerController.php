<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserManagerController extends Controller
{
    // 1. Danh sách người dùng (Không truy vấn mật khẩu để bảo mật)
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'role', 'phone', 'created_at')
                    ->where('id', '!=', auth()->id()) // Không hiện chính mình
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 2. Form thêm người dùng mới
    public function create()
    {
        return view('admin.users.create');
    }

    // 3. Xử lý lưu người dùng mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,user'], 
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Tạo tài khoản thành công!');
    }

    // 4. Form sửa thông tin
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // 5. Xử lý cập nhật thông tin
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required', 'in:admin,user'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'Cập nhật thành công!');
    }

    // 6. Xóa tài khoản
    public function destroy($id)
    {
        if ($id == auth()->id()) {
            return back()->with('error', 'Bạn không thể tự xóa chính mình!');
        }
        
        User::findOrFail($id)->delete();
        return back()->with('success', 'Đã xóa tài khoản!');
    }
}