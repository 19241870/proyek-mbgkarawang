@extends('layouts.app')
@section('page_title', 'Manajemen Keluhan')

@section('content')
<style>
    .complaint-card { transition: all 0.3s ease; cursor: pointer; }
    .complaint-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
    .status-badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
    .status-processed { background-color: #FEF08A; color: #854D0E; }
    .status-completed { background-color: #DBEAFE; color: #1E40AF; }
</style>

<div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black text-[#1a4d2e] tracking-tight">Manajemen Keluhan</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Pantau dan kelola semua keluhan dari sekolah</p>
        </div>
        <div class="bg-gray-50 px-6 py-3 rounded-2xl border border-gray-100">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Total Keluhan: <span class="text-[#1a4d2e] text-sm">3</span></p>
        </div>
    </div>

    <div id="complaintList" class="space-y-4">
        @php
            $keluhans = [
                ['id' => 1, 'sekolah' => 'SDN Karawang 2', 'kategori' => 'Kualitas Makanan', 'pesan' => 'Menu kemarin tidak fresh', 'status' => 'Diproses', 'tanggal' => '15 Des 2025', 'icon' => '⚠️', 'bg' => '#FFFBEB', 'border' => '#FEF3C7'],
                ['id' => 2, 'sekolah' => 'SDN Karawang 5', 'kategori' => 'Penolakan Makanan', 'pesan' => 'Pengiriman terlambat 1 jam', 'status' => 'Selesai', 'tanggal' => '12 Okt 2025', 'icon' => '✓', 'bg' => '#EFF6FF', 'border' => '#DBEAFE'],
                ['id' => 3, 'sekolah' => 'SDN Karawang 3', 'kategori' => 'Jumlah Kurang', 'pesan' => 'Hanya terima 400 porsi dari 450', 'status' => 'Diproses', 'tanggal' => '01 Des 2025', 'icon' => '⚠️', 'bg' => '#FFFBEB', 'border' => '#FEF3C7'],
            ];
        @endphp

        @foreach($keluhans as $k)
        <div onclick="bukaModalKeluhan('{{ $k['id'] }}', '{{ $k['sekolah'] }}', '{{ $k['kategori'] }}', '{{ $k['pesan'] }}', '{{ $k['status'] }}')" 
             class="complaint-card p-6 rounded-[25px] border"
             style="background-color: {{ $k['bg'] }}; border-color: {{ $k['border'] }};">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-xl shadow-sm">{{ $k['icon'] }}</div>
                        <div>
                            <h3 class="font-black text-gray-800 text-base" id="display-sekolah-{{ $k['id'] }}">{{ $k['sekolah'] }}</h3>
                            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider" id="display-kategori-{{ $k['id'] }}">{{ $k['kategori'] }}</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm ml-16 italic font-medium" id="display-pesan-{{ $k['id'] }}">"{{ $k['pesan'] }}"</p>
                </div>
                <div class="text-right flex flex-col items-end">
                    <span id="display-badge-{{ $k['id'] }}" class="status-badge {{ $k['status'] == 'Diproses' ? 'status-processed' : 'status-completed' }} mb-2">
                        {{ $k['status'] }}
                    </span>
                    <p class="text-[10px] text-gray-400 font-black uppercase">{{ $k['tanggal'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div id="modalEditKeluhan" class="fixed inset-0 bg-black/60 z-[100] hidden items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white w-full max-w-md rounded-[45px] p-10 shadow-2xl">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-black text-[#1a4d2e] tracking-tight">Edit Keluhan</h2>
            <button onclick="tutupModalKeluhan()" class="w-10 h-10 flex items-center justify-center bg-gray-50 rounded-full text-gray-400 hover:bg-red-50 hover:text-white transition-all">✕</button>
        </div>
        
        <input type="hidden" id="edit-id">
        
        <div class="space-y-5">
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-2">Nama Sekolah</label>
                <input type="text" id="edit-sekolah" class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold focus:outline-none focus:ring-4 focus:ring-green-100 transition-all">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-2">Kategori Masalah</label>
                <input type="text" id="edit-kategori" class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold focus:outline-none focus:ring-4 focus:ring-green-100 transition-all">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-2">Isi Keluhan</label>
                <textarea id="edit-pesan" rows="3" class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold focus:outline-none focus:ring-4 focus:ring-green-100 transition-all"></textarea>
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-2">Status Penanganan</label>
                <div class="relative">
                    <select id="edit-status" class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold focus:outline-none focus:ring-4 focus:ring-green-100 appearance-none cursor-pointer">
                        <option value="Diproses">⚠️ Diproses</option>
                        <option value="Selesai">✅ Selesai</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex gap-4">
                <button onclick="tutupModalKeluhan()" class="flex-1 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest bg-gray-100 text-gray-500 hover:bg-gray-200 transition">Batal</button>
                <button onclick="simpanPerubahanKeluhan()" class="flex-1 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest bg-black text-white hover:bg-[#1a4d2e] transition shadow-lg">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    const modalKeluhan = document.getElementById('modalEditKeluhan');

    function bukaModalKeluhan(id, sekolah, kategori, pesan, status) {
        modalKeluhan.classList.remove('hidden');
        modalKeluhan.style.display = 'flex';
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-sekolah').value = sekolah;
        document.getElementById('edit-kategori').value = kategori;
        document.getElementById('edit-pesan').value = pesan;
        document.getElementById('edit-status').value = status;
    }

    function tutupModalKeluhan() {
        modalKeluhan.classList.add('hidden');
        modalKeluhan.style.display = 'none';
    }

    function simpanPerubahanKeluhan() {
        const id = document.getElementById('edit-id').value;
        const sekolah = document.getElementById('edit-sekolah').value;
        const kategori = document.getElementById('edit-kategori').value;
        const pesan = document.getElementById('edit-pesan').value;
        const status = document.getElementById('edit-status').value;

        // Update UI
        document.getElementById('display-sekolah-' + id).innerText = sekolah;
        document.getElementById('display-kategori-' + id).innerText = kategori;
        document.getElementById('display-pesan-' + id).innerText = `"${pesan}"`;
        
        const badge = document.getElementById('display-badge-' + id);
        badge.innerText = status;
        badge.className = (status === 'Diproses') ? 'status-badge status-processed mb-2' : 'status-badge status-completed mb-2';

        tutupModalKeluhan();
    }

    window.onclick = function(event) {
        if (event.target == modalKeluhan) tutupModalKeluhan();
    }
</script>
@endsection