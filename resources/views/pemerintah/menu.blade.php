@extends('layouts.app')

@section('title', 'Kelola Menu MBG')

@section('content')
<style>
    /* Desain Card sesuai Gambar */
    .menu-card { 
        background: white; 
        border: 1px solid #e5e7eb; 
        border-radius: 24px; 
        padding: 20px 15px; 
        text-align: center;
        transition: all 0.3s ease;
    }
    .day-badge {
        font-size: 12px;
        font-weight: 900;
        color: #1a4d2e;
        letter-spacing: 1px;
        margin-bottom: 15px;
        display: block;
    }
    .makanan-text {
        font-size: 11px;
        font-weight: 700;
        color: #374151;
        min-height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1.4;
        margin-bottom: 10px;
    }
    .stats-text {
        font-size: 10px;
        color: #9ca3af;
        font-weight: 600;
    }
    .stats-value {
        color: #111827;
        font-weight: 800;
    }
    /* Tombol Edit mungil sesuai UI */
    .btn-edit-pill {
        background-color: #4ade80;
        color: white;
        font-size: 10px;
        font-weight: 800;
        padding: 4px 15px;
        border-radius: 999px;
        margin-top: 15px;
        transition: 0.2s;
    }
    .btn-edit-pill:hover { background-color: #166534; }

    /* Mode Edit Inline */
    .input-inline {
        width: 100%;
        background-color: #f3f4f6;
        border: none;
        border-radius: 8px;
        padding: 5px;
        font-size: 10px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 5px;
    }
    .hidden-mode { display: none !important; }
</style>

<div class="bg-white p-10 rounded-[45px] shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-12">
        <div>
            <h1 class="text-3xl font-black text-[#1a4d2e] tracking-tight">Kelola Menu MBG</h1>
            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Dashboard Monitoring MBG Karawang</p>
        </div>
        <button class="bg-[#1a4d2e] text-white px-6 py-3 rounded-2xl font-black text-xs hover:scale-105 transition-all shadow-lg flex items-center gap-2">
            <span class="text-lg">+</span> UPLOAD MENU BARU
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-7 gap-3">
        @php
            $menus = [
                ['id' => 'senin', 'hari' => 'SENIN', 'makanan' => 'Nasi Kuning + Ayam', 'kalori' => '550', 'protein' => '22'],
                ['id' => 'selasa', 'hari' => 'SELASA', 'makanan' => 'Nasi Goreng + Telur', 'kalori' => '580', 'protein' => '20'],
                ['id' => 'rabu', 'hari' => 'RABU', 'makanan' => 'Bubur Ayam + Sayur', 'kalori' => '480', 'protein' => '18'],
                ['id' => 'kamis', 'hari' => 'KAMIS', 'makanan' => 'Nasi Putih + Ikan', 'kalori' => '520', 'protein' => '24'],
                ['id' => 'jumat', 'hari' => 'JUMAT', 'makanan' => 'Nasi Merah + Daging', 'kalori' => '600', 'protein' => '26'],
                ['id' => 'sabtu', 'hari' => 'SABTU', 'makanan' => 'Libur MBG', 'kalori' => '-', 'protein' => '-'],
                ['id' => 'minggu', 'hari' => 'MINGGU', 'makanan' => 'Libur MBG', 'kalori' => '-', 'protein' => '-'],
            ];
        @endphp

        @foreach($menus as $m)
        <div id="card-{{ $m['id'] }}" class="menu-card">
            <span class="day-badge">{{ $m['hari'] }}</span>

            <div id="view-{{ $m['id'] }}">
                <div class="makanan-text">{{ $m['makanan'] }}</div>
                <div class="space-y-1">
                    <p class="stats-text">Kalori: <span class="stats-value">{{ $m['kalori'] }}{{ $m['kalori'] != '-' ? 'kcal' : '' }}</span></p>
                    <p class="stats-text">Protein: <span class="stats-value">{{ $m['protein'] }}{{ $m['protein'] != '-' ? 'g' : '' }}</span></p>
                </div>
                <button onclick="editInline('{{ $m['id'] }}')" class="btn-edit-pill">Edit</button>
            </div>

            <div id="form-{{ $m['id'] }}" class="hidden-mode">
                <textarea id="in-makan-{{ $m['id'] }}" class="input-inline h-12" placeholder="Menu">{{ $m['makanan'] }}</textarea>
                <div class="flex gap-1">
                    <input type="text" id="in-kcal-{{ $m['id'] }}" class="input-inline" value="{{ $m['kalori'] }}" placeholder="kcal">
                    <input type="text" id="in-prot-{{ $m['id'] }}" class="input-inline" value="{{ $m['protein'] }}" placeholder="g">
                </div>
                <div class="flex gap-1 mt-3">
                    <button onclick="cancelInline('{{ $m['id'] }}')" class="flex-1 bg-gray-100 text-gray-500 py-2 rounded-lg text-[9px] font-black uppercase">Batal</button>
                    <button onclick="saveInline('{{ $m['id'] }}')" class="flex-1 bg-black text-white py-2 rounded-lg text-[9px] font-black uppercase">Simpan</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function editInline(id) {
        document.getElementById('view-' + id).classList.add('hidden-mode');
        document.getElementById('form-' + id).classList.remove('hidden-mode');
        document.getElementById('card-' + id).style.borderColor = '#4ade80';
        document.getElementById('card-' + id).style.boxShadow = '0 10px 15px -3px rgba(74, 222, 128, 0.1)';
    }

    function cancelInline(id) {
        document.getElementById('view-' + id).classList.remove('hidden-mode');
        document.getElementById('form-' + id).classList.add('hidden-mode');
        document.getElementById('card-' + id).style.borderColor = '#e5e7eb';
        document.getElementById('card-' + id).style.boxShadow = 'none';
    }

    function saveInline(id) {
        // Ambil data baru
        const makanan = document.getElementById('in-makan-' + id).value;
        const kcal = document.getElementById('in-kcal-' + id).value;
        const prot = document.getElementById('in-prot-' + id).value;

        // Update UI View
        const viewDiv = document.getElementById('view-' + id);
        viewDiv.querySelector('.makanan-text').innerText = makanan;
        
        const stats = viewDiv.querySelectorAll('.stats-value');
        stats[0].innerText = kcal + (kcal !== '-' ? 'kcal' : '');
        stats[1].innerText = prot + (prot !== '-' ? 'g' : '');

        // Kembali ke tampilan normal
        cancelInline(id);
        
        // Logika Sukses (Bisa diganti dengan toast notif kecil di pojok jika perlu)
        console.log("Menu " + id + " updated.");
    }
</script>
@endsection