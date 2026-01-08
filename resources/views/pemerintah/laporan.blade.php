@extends('layouts.app')

@section('title', 'Laporan Harian')

@section('content')
    {{-- Header --}}
    <header class="flex justify-between items-center mb-8 animate-fade-in">
        <div>
            <h1 class="text-3xl font-black text-[#1a4d2e] tracking-tight">Laporan Harian/Mingguan</h1>
            <p class="text-sm text-gray-500 font-bold uppercase tracking-widest">Dashboard Monitoring MBG Karawang</p>
        </div>
        <div class="flex items-center gap-4">
            <button class="p-3 bg-white rounded-full shadow-sm hover:bg-gray-50 transition transform hover:rotate-12">🔔</button>
            <div class="flex items-center gap-3 bg-white p-2 pr-6 rounded-full shadow-sm border border-white">
                <div class="w-10 h-10 bg-[#1a4d2e] rounded-full flex items-center justify-center text-white font-bold shadow-inner">A</div>
                <div class="text-[10px] font-black uppercase tracking-tight leading-tight">Admin <br><span class="text-gray-400">Pemerintah</span></div>
            </div>
        </div>
    </header>

    <div class="bg-white rounded-[45px] p-10 shadow-sm border border-white animate-slide-up">

        {{-- Filter & Export --}}
        <div class="flex flex-wrap justify-between items-end gap-6 mb-10">
            <div class="flex gap-6 items-center flex-1">
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">Periode Laporan</label>
                    <div class="relative">
                        <select class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold text-sm focus:outline-none focus:ring-2 focus:ring-green-500 appearance-none cursor-pointer hover:bg-gray-100 transition">
                            <option>Harian</option>
                            <option>Mingguan</option>
                            <option>Bulanan</option>
                        </select>
                        <span class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none">▼</span>
                    </div>
                </div>
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">Dari Tanggal</label>
                    <input type="date" class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold text-sm focus:outline-none focus:ring-2 focus:ring-green-500 hover:bg-gray-100 transition">
                </div>
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">Sampai Tanggal</label>
                    <input type="date" class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold text-sm focus:outline-none focus:ring-2 focus:ring-green-500 hover:bg-gray-100 transition">
                </div>
            </div>
            <button class="bg-[#1a4d2e] text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg flex items-center gap-3 hover:bg-black hover:-translate-y-1 active:scale-95 transition-all">
                Export PDF <span class="text-lg">📥</span>
            </button>
        </div>

        {{-- Statistik Cards --}}
        <div class="grid grid-cols-3 gap-8 mb-12">
            <div class="bg-blue-50 border-l-[12px] border-blue-400 p-8 rounded-[35px] group hover:shadow-xl hover:shadow-blue-100 transition-all duration-300 transform hover:-translate-y-1">
                <p class="text-[10px] font-black text-blue-900 uppercase tracking-widest mb-2">Total Menu Tersalurkan</p>
                <h2 class="text-5xl font-black text-blue-900 tracking-tighter group-hover:scale-105 transition-transform origin-left">5,847</h2>
                <p class="text-[11px] font-bold text-blue-900/60 mt-1 uppercase">Porsi</p>
            </div>

            <div class="bg-green-50 border-l-[12px] border-green-400 p-8 rounded-[35px] group hover:shadow-xl hover:shadow-green-100 transition-all duration-300 transform hover:-translate-y-1">
                <p class="text-[10px] font-black text-green-900 uppercase tracking-widest mb-2">Pemerataan Distribusi</p>
                <h2 class="text-5xl font-black text-green-900 tracking-tighter group-hover:scale-105 transition-transform origin-left">94%</h2>
                <p class="text-[11px] font-bold text-green-900/60 mt-1 uppercase">Terjangkau ke Sekolah</p>
            </div>

            <div class="bg-red-50 border-l-[12px] border-red-400 p-8 rounded-[35px] group hover:shadow-xl hover:shadow-red-100 transition-all duration-300 transform hover:-translate-y-1">
                <p class="text-[10px] font-black text-red-900 uppercase tracking-widest mb-2">Keluhan Total</p>
                <h2 class="text-5xl font-black text-red-900 tracking-tighter group-hover:scale-105 transition-transform origin-left">5</h2>
                <p class="text-[11px] font-bold text-red-900/60 mt-1 uppercase">Masalah Terjadi</p>
            </div>
        </div>

        {{-- Chart Section --}}
        <div class="border border-gray-100 rounded-[40px] p-10 bg-gray-50/30">
            <div class="flex items-center gap-3 mb-8 ml-2">
                <div class="w-2 h-6 bg-[#1a4d2e] rounded-full"></div>
                <h3 class="text-sm font-black text-[#1a4d2e] uppercase tracking-widest">Analisis Keluhan Per Kategori</h3>
            </div>
            <div class="h-[350px] w-full bg-white p-6 rounded-[30px] border border-white shadow-sm">
                <canvas id="complaintChart"></canvas>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeIn 0.6s ease-out; }
    .animate-slide-up { animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1); }

    input[type="date"]::-webkit-calendar-picker-indicator { cursor: pointer; opacity: 0.5; filter: invert(20%) sepia(20%) saturate(2000%) hue-rotate(90deg); }
</style>

<script>
    const ctx = document.getElementById('complaintChart').getContext('2d');

    // Gradient untuk bar chart agar lebih premium
    const bgGradient = ctx.createLinearGradient(0, 0, 400, 0);
    bgGradient.addColorStop(0, '#1a4d2e');
    bgGradient.addColorStop(1, '#34d399');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Kualitas', 'Terlambat', 'Kurang', 'Kebersihan', 'Lainnya'],
            datasets: [{
                label: 'Jumlah Keluhan',
                data: [1.2, 0.8, 1.5, 0.4, 0.9],
                backgroundColor: bgGradient,
                hoverBackgroundColor: '#000',
                borderRadius: 20,
                barThickness: 32,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1a4d2e',
                    titleFont: { family: 'Poppins', size: 14, weight: 'bold' },
                    bodyFont: { family: 'Poppins', size: 12 },
                    padding: 12,
                    cornerRadius: 12,
                    displayColors: false
                }
            },
            scales: {
                x: {
                    grid: { display: true, color: '#f3f4f6', drawBorder: false },
                    ticks: { font: { family: 'Poppins', weight: '600', size: 11 }, color: '#9ca3af' }
                },
                y: {
                    grid: { display: false },
                    ticks: { font: { family: 'Poppins', weight: '800', size: 12 }, color: '#1a4d2e' }
                }
            }
        }
    });
</script>
@endpush
