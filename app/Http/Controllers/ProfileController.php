<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest; // Có thể dòng này sẽ thừa, nhưng cứ để
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule; // Quan trọng để check email trùng
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Hiển thị trang hồ sơ người dùng.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Cập nhật thông tin hồ sơ (Tên, Email, SĐT, Địa chỉ).
     */
    public function update(Request $request): RedirectResponse
    {
        // 1. Validate dữ liệu trực tiếp tại đây
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:255', 
                Rule::unique(User::class)->ignore($request->user()->id)
            ],
            // Thêm validate cho 2 trường mới
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        // 2. Cập nhật dữ liệu vào Model User
        $request->user()->fill($validated);

        // Nếu người dùng đổi email thì reset trạng thái xác thực
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // 3. Lưu vào Database
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Xóa tài khoản người dùng.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    /**
     * API: Cập nhật thông tin cá nhân
     * Endpoint: PUT /api/profile/update
     */
    public function apiUpdate(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật hồ sơ thành công!',
            'user' => $user
        ]);
    }
}