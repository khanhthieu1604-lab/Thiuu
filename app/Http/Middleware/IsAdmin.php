<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra role admin (dựa trên Model User bạn đã có)
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Nếu không phải admin thì đẩy về trang chủ
        return redirect('/')->with('error', 'Bạn không có quyền truy cập quản trị.');
    }
}