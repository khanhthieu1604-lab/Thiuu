<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu đã đăng nhập và có quyền admin hoặc master
        if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'master')) {
            return $next($request);
        }

        // Nếu không có quyền, chuyển hướng về trang chủ kèm thông báo lỗi
        return redirect('/')->with('error', 'Bạn không có quyền truy cập khu vực Admin.');
    }
}