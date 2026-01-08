<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MBG Karawang - Selamat Datang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white">

    <nav class="bg-[#064E3B] text-white px-10 py-4 flex justify-between items-center shadow-md">
        <div class="flex items-center gap-3">
        <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center overflow-hidden">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
        </div>
            <div>
                <h1 class="font-bold leading-none">MBG Karawang</h1>
                <p class="text-[10px] opacity-80">Monitoring Makanan Bergizi Gratis</p>
            </div>
        </div>
        
        <div class="flex items-center gap-8 font-medium">
            <a href="#" class="hover:text-green-300">Fitur</a>
            <a href="#" class="hover:text-green-300">Visi & Misi</a>
            <a href="#" class="hover:text-green-300">Tentang Kami</a>
            <a href="{{ route('login') }}" class="bg-white text-[#064E3B] px-8 py-2 rounded-full font-bold hover:bg-gray-100 transition shadow-lg">Login</a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-16 text-center">
        <div class="flex justify-center mb-6">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center border-4 border-[#064E3B] shadow-lg overflow-hidden">
    <img src="{{ asset('img/karawang.jpg') }}" alt="Lambang Daerah" class="w-full h-full object-contain p-2">
    </div>
        </div>

        <h2 class="text-4xl font-extrabold text-[#064E3B] mb-12">
            Selamat Datang di <span class="border-b-4 border-yellow-400">MBG Karawang</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-16">
            <div class="group">
                <div class="bg-gray-200 rounded-2xl h-48 overflow-hidden shadow-xl transform group-hover:scale-105 transition duration-300">
                    <img src="{{ asset('img/anak anak.jpg') }}" alt="Kegiatan 1" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="group">
                <div class="bg-gray-200 rounded-2xl h-48 overflow-hidden shadow-xl transform group-hover:scale-105 transition duration-300">
                    <img src="{{ asset('img/embege.jpg') }}" alt="Kegiatan 2" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="group">
                <div class="bg-gray-200 rounded-2xl h-48 overflow-hidden shadow-xl transform group-hover:scale-105 transition duration-300">
                    <img src="{{ asset('img/dapur.jpg') }}" alt="Kegiatan 3" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="group">
                <div class="bg-gray-200 rounded-2xl h-48 overflow-hidden shadow-xl transform group-hover:scale-105 transition duration-300">
                    <img src="{{ asset('img/embegesd.jpg') }}" alt="Kegiatan 4" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <div class="max-w-2xl mx-auto">
            <p class="text-[#064E3B] font-semibold text-lg leading-relaxed">
                Platform monitoring dan pelaporan Makanan Bergizi Gratis untuk Kabupaten Karawang
            </p>
        </div>
    </main>

    <footer class="mt-10 py-6 border-t border-gray-100 text-center text-gray-400 text-sm">
        &copy; 2026 Pemerintah Kabupaten Karawang. All Rights Reserved.
    </footer>

</body>
</html>