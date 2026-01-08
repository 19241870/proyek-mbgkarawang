<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal MBG Karawang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f3f4f6; }
        .bg-custom { background: linear-gradient(135deg, #1a4d2e 0%, #062c1a 100%); }
        .login-card { animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .tab-btn.active { background-color: #1a4d2e; color: white; box-shadow: 0 10px 15px rgba(26, 77, 46, 0.2); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="login-card bg-white w-full max-w-[450px] rounded-[50px] shadow-2xl overflow-hidden border border-white">

        {{-- Header --}}
        <div class="bg-custom p-10 text-center text-white">
            {{-- Icon Sendok Garpu --}}
            <div class="w-20 h-20 bg-white/10 rounded-3xl mx-auto flex items-center justify-center mb-4 border border-white/20">
                <i class="fas fa-utensils text-3xl"></i>
            </div>
            <h1 class="text-2xl font-black italic tracking-tighter uppercase">MBG KARAWANG</h1>
            <p class="text-green-200 text-[10px] font-bold uppercase tracking-[0.2em] mt-1">Sistem Monitoring Makanan Bergizi</p>
        </div>

        <div class="p-10">
            {{-- Role Switcher --}}
            <div class="flex bg-gray-100 p-1.5 rounded-full mb-8">
                <button onclick="switchTab('sekolah')" id="btn-sekolah" class="tab-btn active flex-1 py-3 rounded-full text-[10px] font-black uppercase tracking-wider transition-all">
                    SEKOLAH
                </button>
                <button onclick="switchTab('pemerintah')" id="btn-pemerintah" class="tab-btn flex-1 py-3 rounded-full text-[10px] font-black text-gray-400 uppercase tracking-wider transition-all">
                    PEMERINTAH
                </button>
            </div>

            {{-- Form Login --}}
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label id="input-label" class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2 mb-2 block">Nomor Pokok Sekolah Nasional (NPSN)</label>
                    <input type="text" name="email" id="main-input" placeholder="Masukkan NPSN" required class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold text-sm focus:ring-2 focus:ring-green-500 outline-none transition-all">
                </div>

                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2 mb-2 block">Password</label>
                    <input type="password" name="password" placeholder="••••••••" required class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold text-sm focus:ring-2 focus:ring-green-500 outline-none transition-all">
                </div>

                <button type="submit" class="w-full bg-[#1a4d2e] text-white py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-lg hover:bg-black hover:-translate-y-1 transition-all active:scale-95 mt-4">
                    MASUK
                </button>
            </form>

            <div class="text-center mt-8">
                <a href="#" class="text-[10px] font-black text-gray-300 hover:text-[#1a4d2e] uppercase tracking-widest transition-colors">Lupa Password?</a>
            </div>
        </div>
    </div>

    <script>
        function switchTab(type) {
            const btnSekolah = document.getElementById('btn-sekolah');
            const btnPemerintah = document.getElementById('btn-pemerintah');
            const label = document.getElementById('input-label');
            const input = document.getElementById('main-input');

            if (type === 'sekolah') {
                btnSekolah.classList.add('active'); btnSekolah.classList.remove('text-gray-400');
                btnPemerintah.classList.remove('active'); btnPemerintah.classList.add('text-gray-400');
                label.innerText = 'Nomor Pokok Sekolah Nasional (NPSN)';
                input.placeholder = 'Masukkan NPSN';
            } else {
                btnPemerintah.classList.add('active'); btnPemerintah.classList.remove('text-gray-400');
                btnSekolah.classList.remove('active'); btnSekolah.classList.add('text-gray-400');
                label.innerText = 'NIP / Email Pemerintah';
                input.placeholder = 'Masukkan NIP atau Email';
            }
        }
    </script>
</body>
</html>
