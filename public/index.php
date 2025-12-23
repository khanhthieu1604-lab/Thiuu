<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

// --- BẮT ĐẦU ĐOẠN BẪY LỖI ---
try {
    $response = $kernel->handle(
        $request = Request::capture()
    );
    
    $response->send();
    
    $kernel->terminate($request, $response);
} catch (\Throwable $e) {
    // Nếu có lỗi, in toạc móng heo ra màn hình luôn
    echo "<div style='background: #ffebee; color: #b71c1c; padding: 20px; border: 2px solid red; font-family: monospace;'>";
    echo "<h1>🔥 LỖI BẮT ĐƯỢC:</h1>";
    echo "<h3>" . $e->getMessage() . "</h3>";
    echo "<p><strong>File:</strong> " . $e->getFile() . " (Line: " . $e->getLine() . ")</p>";
    echo "<hr>";
    echo "<h3>Stack Trace:</h3>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
    echo "</div>";
    die();
}
// --- KẾT THÚC ĐOẠN BẪY LỖI ---