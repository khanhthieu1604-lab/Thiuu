<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra: Đã đăng nhập VÀ role là 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Nếu không phải admin -> Đẩy về trang chủ
        return redirect('/');
    }
}