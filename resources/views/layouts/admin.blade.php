<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIJAD - Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background: #f4f7fb;
            color: #0f172a;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 270px;
            background: linear-gradient(180deg, #003b8f, #001f4d);
            color: white;
            padding: 24px 18px;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand img {
            width: 110px;
            height: 110px;
            object-fit: contain;
            margin-bottom: 12px;
        }

        .brand h1 {
            font-size: 42px;
            letter-spacing: 2px;
            color: white;
        }

        .brand p {
            font-size: 13px;
            color: #dbeafe;
            line-height: 1.5;
            margin-top: 6px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 14px 16px;
            margin-bottom: 9px;
            color: #eaf2ff;
            text-decoration: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 600;
            transition: 0.25s;
        }

        .menu a:hover,
        .menu a.active {
            background: #ffd400;
            color: #003b8f;
            transform: translateX(5px);
            font-weight: 800;
        }

        .logout-line {
            height: 1px;
            background: rgba(255,255,255,0.25);
            margin: 18px 0;
        }

        .logout-form {
            margin: 0;
            padding: 0;
        }

        .logout-btn {
            width: 100%;
            border: none;
            background: transparent;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 14px 16px;
            margin-bottom: 9px;
            color: #eaf2ff;
            text-decoration: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 600;
            transition: 0.25s;
            cursor: pointer;
            text-align: left;
        }

        .logout-btn:hover {
            background: #ffd400;
            color: #003b8f;
            transform: translateX(5px);
            font-weight: 800;
        }

        .main {
            margin-left: 270px;
            width: calc(100% - 270px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            height: 72px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        }

        .topbar-left {
            font-size: 22px;
            color: #001f4d;
            font-weight: bold;
        }

        .admin-box {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notif {
            position: relative;
            width: 42px;
            height: 42px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notif span {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ffd400;
            color: #001f4d;
            font-size: 11px;
            font-weight: bold;
            width: 19px;
            height: 19px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8fafc;
            padding: 8px 12px;
            border-radius: 14px;
        }

        .profile-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #003b8f;
            color: #ffd400;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
        }

        .profile h4 {
            font-size: 14px;
            color: #0f172a;
        }

        .profile small {
            color: #64748b;
        }

        .content {
            padding: 30px;
            flex: 1;
        }

        @media (max-width: 900px) {
            .wrapper {
                flex-direction: column;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                padding: 0 18px;
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
<div class="wrapper">

    <aside class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo-narotama.png') }}" alt="Logo Narotama">
            <h1>SIJAD</h1>
            <p>Sistem Informasi<br>Jurnal Akademik Dosen</p>
        </div>

        <nav class="menu">
            <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                🏠 Dashboard
            </a>

            <a href="{{ route('admin.lecturers') }}"
            class="{{ request()->routeIs('admin.lecturers') ? 'active' : '' }}">
                👨‍🏫 Data Dosen
            </a>

            <a href="{{ route('admin.journals') }}"
            class="{{ request()->routeIs('admin.journals') && !request('status') ? 'active' : '' }}">
                📚 Data Jurnal
            </a>

            <a href="{{ route('admin.journals', ['status' => 'Menunggu']) }}"
            class="{{ request()->routeIs('admin.journals') && request('status') == 'Menunggu' ? 'active' : '' }}">
                📝 Pengajuan Jurnal
            </a>

            <a href="{{ route('admin.journals', ['status' => 'Review']) }}"
            class="{{ request()->routeIs('admin.journals') && request('status') == 'Review' ? 'active' : '' }}">
                🔍 Review Jurnal
            </a>

            <a href="#">
                🏅 Akreditasi
            </a>

            <a href="{{ route('admin.reports') }}"
            class="{{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                📊 Laporan
            </a>

            <a href="{{ route('admin.settings') }}"
            class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                ⚙️ Pengaturan
            </a>

            <div class="logout-line"></div>

            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    🚪 Logout
                </button>
            </form>
        </nav>
    </aside>

    <main class="main">
        <header class="topbar">
            <div class="topbar-left">☰</div>

            <div class="admin-box">
                <div class="notif">
                    🔔
                    <span>3</span>
                </div>

                <div class="profile">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4>{{ auth()->user()->name }}</h4>
                        <small>{{ auth()->user()->email }}</small>
                    </div>
                </div>
            </div>
        </header>

        <section class="content">
            @yield('content')
        </section>
    </main>

</div>
</body>
</html>