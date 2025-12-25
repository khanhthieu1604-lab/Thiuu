<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
   public function handle(Request $request, Closure $next): Response
{
    // Cho phép cả 'admin' VÀ 'master' đi qua
    if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'master')) {
        return $next($request);
    }

    // Nếu là user thường cố tình vào -> đẩy ra trang lỗi hoặc trang chủ
    return redirect('/');
}
}