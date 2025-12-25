<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // Giữ nguyên dòng này

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ĐỔI DÒNG NÀY: Từ useBootstrapFive() sang useTailwind()
        Paginator::useTailwind(); 
    }
}