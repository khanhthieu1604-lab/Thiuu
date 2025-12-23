<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'CarRental')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        :root {
            --primary: #0f172a;
            --primary: #2563eb;
            --bg: #f8fafc;
            --text: #0f172a;
            --muted: #64748b;
            --card: #ffffff;
            --border: #e5e7eb;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ===== LAYOUT ===== */
        .app {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        main {
            flex: 1;
            padding: 40px 0;
        }

        /* ===== HEADER ===== */
        header {
            background: linear-gradient(90deg, #020617, #020617);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .header-inner {
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: 700;
            color: #fff;
        }

        .logo span {
            font-size: 14px;
            font-weight: 400;
            color: #94a3b8;
        }

        nav {
            display: flex;
            gap: 24px;
        }

        nav a {
            color: #cbd5f5;
            font-weight: 500;
            font-size: 15px;
            position: relative;
        }

        nav a:hover {
            color: #fff;
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: .2s;
        }

        nav a:hover::after {
            width: 100%;
        }

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-outline {
            border: 1px solid #334155;
            color: #e5e7eb;
        }

        .btn-outline:hover {
            background: rgba(255,255,255,0.06);
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        /* ===== FOOTER ===== */
        footer {
            background: #020617;
            color: #94a3b8;
            font-size: 14px;
        }

        .footer-inner {
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* ===== PAGE COMMON ===== */
        h1 {
            font-size: 28px;
            margin-bottom: 24px;
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }

        .card {
            background: var(--card);
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: transform .2s, box-shadow .2s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.08);
        }

        .card h3 {
            margin-bottom: 8px;
            font-size: 18px;
        }

        .muted {
            color: var(--muted);
            font-size: 14px;
        }

        .price {
            margin: 12px 0;
            font-weight: 700;
            color: #16a34a;
        }

        .link {
            color: var(--primary);
            font-weight: 500;
            font-size: 14px;
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div class="app">

    {{-- HEADER --}}
    <header>
        <div class="container header-inner">
            <a href="{{ route('vehicles.index') }}" class="logo">
                🚗 CarRental
                <span>Thuê & mua xe</span>
            </a>

            <nav>
                <a href="{{ route('vehicles.index') }}">Trang chủ</a>
                <a href="#">Thuê xe</a>
                <a href="#">Mua xe</a>
                <a href="#">Liên hệ</a>
            </nav>

            <div class="header-actions">
                <a href="#" class="btn btn-outline">Đăng nhập</a>
                <a href="#" class="btn btn-primary">Thuê ngay</a>
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="container footer-inner">
            <span>© {{ date('Y') }} CarRental Project</span>
            <span>Laravel</span>
        </div>
    </footer>

</div>
</body>
</html>
