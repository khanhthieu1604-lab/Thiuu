<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /* ============================================================
        PHẦN 1: XỬ LÝ CHO GIAO DIỆN WEB (TRÌNH DUYỆT)
    ============================================================ */

    // Hiển thị form đăng nhập
    public function showLogin() {
        return view('auth.login');
    }

    // Xử lý đăng nhập Web
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Chào mừng bạn quay trở lại!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    // Hiển thị form đăng ký
    public function showRegister() {
        return view('auth.register');
    }

    // Xử lý đăng ký Web
    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', 
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user', // Mặc định là user
        ]);

        Auth::login($user); 

        return redirect('/')->with('success', 'Đăng ký tài khoản thành công!');
    }

    // Đăng xuất Web
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Đã đăng xuất thành công.');
    }


    /* ============================================================
        PHẦN 2: XỬ LÝ CHO API (POSTMAN / MOBILE APP)
    ============================================================ */

    /**
     * API Đăng nhập và cấp Token (Sanctum)
     * Endpoint: POST /api/login
     */
    public function apiLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Kiểm tra user và mật khẩu
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email hoặc mật khẩu không chính xác.'
            ], 401);
        }

        // Tạo Token thực tế cho Postman/Mobile
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Đăng nhập API thành công',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]
        ], 200);
    }

    /**
     * API Đăng xuất và hủy Token
     * Endpoint: POST /api/logout (Yêu cầu Bearer Token)
     */
    public function apiLogout(Request $request) {
        // Hủy token đang sử dụng
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Đã hủy Token và đăng xuất thành công.'
        ], 200);
    }
}