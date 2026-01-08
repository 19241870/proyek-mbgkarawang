<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MBG Karawang - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800;900&display=swap" rel="stylesheet">
    <style>
        /* Reset total */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F3F4F6;
            overflow-x: hidden;
        }

        .app-container { display: flex; min-height: 100vh; }

        /* Sidebar Fix: Menghilangkan Scrollbar & Potongan */
        aside {
            width: 288px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #1a4d2e;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            padding: 24px;
            /* overflow: hidden untuk memastikan tidak ada scrollbar di sidebar utama */
            overflow: hidden;
        }

        .main-content {
            flex: 1;
            margin-left: 288px;
            padding: 40px;
            min-width: 0;
        }

        /* Navigasi tanpa scrollbar */
        nav {
            flex: 1;
            /* Hapus overflow-y-auto untuk menghilangkan scrollbar */
            overflow: visible;
        }

        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }

        /* Utility */
        .no-underline { text-decoration: none; }
    </style>
</head>
<body>
    <div class="app-container">
        @php
            $isPemerintah = Request::is('*pemerintah*') || Request::is('manajemen-sekolah*');

            // Tambahkan sedikit margin lateral (mx-2) agar saat scale tidak mentok dinding
            $activeBtn = "bg-black text-white shadow-xl scale-105 mx-2 hover:bg-gray-800";
            $inactiveBtn = "bg-white text-black hover:bg-gray-100 hover:scale-105 mx-2";

            $baseStyle = "flex items-center justify-center px-4 py-3 rounded-full font-black transition-all duration-300 text-[13px] mb-4 text-center no-underline block";
        @endphp

        <aside>
            <div class="mb-12 mt-4 text-center">
                <h1 class="text-xl font-black tracking-tighter italic text-white uppercase">MBG KARAWANG</h1>
                <div class="h-[5px] w-10 bg-green-400 mx-auto mt-2 rounded-full"></div>
            </div>

            <nav>
                @if($isPemerintah)
                    <a href="{{ route('pemerintah.dashboard') }}" class="{{ $baseStyle }} {{ Route::is('pemerintah.dashboard') ? $activeBtn : $inactiveBtn }}">Dashboard</a>
                    <a href="{{ route('pemerintah.monitoring') }}" class="{{ $baseStyle }} {{ Route::is('pemerintah.monitoring') ? $activeBtn : $inactiveBtn }}">Monitoring Sekolah</a>
                    <a href="{{ route('pemerintah.laporan') }}" class="{{ $baseStyle }} {{ Route::is('pemerintah.laporan') ? $activeBtn : $inactiveBtn }}">Laporan Harian</a>
                    <a href="{{ route('pemerintah.keluhan') }}" class="{{ $baseStyle }} {{ Route::is('pemerintah.keluhan') ? $activeBtn : $inactiveBtn }}">Keluhan</a>
                    <a href="{{ route('pemerintah.menu') }}" class="{{ $baseStyle }} {{ Route::is('pemerintah.menu') ? $activeBtn : $inactiveBtn }}">Kelola Menu</a>
                    <a href="{{ route('pemerintah.sekolah') }}" class="{{ $baseStyle }} {{ Route::is('pemerintah.sekolah') ? $activeBtn : $inactiveBtn }}">Manajemen Sekolah</a>
                @endif
            </nav>

            <div class="mt-auto pt-6 border-t border-white/10">
                <div class="px-4 mb-6 text-white">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Admin Pemerintah</p>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-[10px] text-green-400 font-black uppercase tracking-tighter">Sistem Online</span>
                    </div>
                </div>
                <a href="{{ route('landing') }}" class="mx-2 block text-center bg-white text-black py-3 rounded-2xl font-black text-xs hover:bg-red-500 hover:text-white transition-all no-underline uppercase shadow-lg">
                    Keluar
                </a>
            </div>
        </aside>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>
