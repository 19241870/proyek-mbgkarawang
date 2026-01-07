@extends('layouts.app')

@section('title', 'Dashboard Analytics')

@section('content')
    <header class="flex justify-between items-center mb-10 glass-card p-6 rounded-[32px] shadow-sm border border-white">
        <div>
            <h1 class="text-3xl font-black text-[#1a4d2e] tracking-tight">Dashboard Analytics</h1>
            <p class="text-xs text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Monitoring MBG Karawang</p>
        </div>
        <div class="flex items-center gap-6">
            <button class="w-12 h-12 flex items-center justify-center bg-gray-50 rounded-2xl text-xl hover:bg-gray-100 transition">🔔</button>
            <div class="flex items-center gap-4 border-l pl-6 border-gray-100">
                <div class="text-right">
                    <p class="text-sm font-black text-gray-800 leading-none">Admin Utama</p>
                    <p class="text-[10px] font-bold text-green-600 uppercase mt-1">Pemerintah</p>
                </div>
                <div class="w-12 h-12 bg-[#1a4d2e] rounded-2xl flex items-center justify-center shadow-lg transform rotate-3 hover:rotate-0 transition-all">
                    <span class="text-white font-bold text-xl">A</span>
                </div>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-4 gap-6 mb-10">
        @php $stats = [
            ['label' => 'Total Sekolah', 'value' => '125', 'sub' => 'Peserta MBG', 'color' => 'bg-emerald-500', 'icon' => '🏫'],
            ['label' => 'Laporan Hari Ini', 'value' => '118/125', 'sub' => '94% Selesai', 'color' => 'bg-blue-500', 'icon' => '📝'],
            ['label' => 'Total Keluhan', 'value' => '5', 'sub' => 'Perlu Respon', 'color' => 'bg-orange-500', 'icon' => '⚠️'],
            ['label' => 'Siswa Terlayani', 'value' => '40.5K', 'sub' => 'Bulan Ini', 'color' => 'bg-purple-500', 'icon' => '👥'],
        ]; @endphp

        @foreach($stats as $s)
        <div class="bg-white p-7 rounded-[40px] shadow-sm hover:shadow-xl transition-all border border-gray-50 group relative overflow-hidden">
            <div class="absolute top-0 left-0 w-2 h-full {{ $s['color'] }}"></div>
            <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-4">{{ $s['label'] }}</p>
            <div class="flex justify-between items-end">
                <div>
                    <h3 class="text-4xl font-black text-gray-800 tracking-tighter">{{ $s['value'] }}</h3>
                    <p class="text-[11px] font-bold text-gray-400 mt-1">{{ $s['sub'] }}</p>
                </div>
                <div class="text-4xl opacity-20 group-hover:opacity-100 transform group-hover:scale-110 transition-all">{{ $s['icon'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-3 gap-8">
        <div class="col-span-2 bg-white p-8 rounded-[45px] shadow-sm border border-gray-50">
            <h4 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-6 flex items-center gap-2">
                <span class="w-2 h-5 bg-green-500 rounded-full"></span> Grafik Distribusi Harian
            </h4>
            <canvas id="barChart" height="150"></canvas>
        </div>

        <div class="bg-white p-8 rounded-[45px] shadow-sm border border-gray-50 flex flex-col items-center">
            <h4 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-6 self-start flex items-center gap-2">
                <span class="w-2 h-5 bg-purple-500 rounded-full"></span> Persentase Laporan
            </h4>
            <div class="relative w-full">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
            datasets: [{
                label: 'Laporan Masuk',
                data: [110, 115, 118, 120, 118, 105],
                backgroundColor: '#1a4d2e',
                borderRadius: 12,
            }]
        },
        options: { plugins: { legend: { display: false } } }
    });

    // Doughnut Chart
    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Selesai', 'Belum'],
            datasets: [{
                data: [118, 7],
                backgroundColor: ['#1a4d2e', '#E5E7EB'],
                borderWidth: 0
            }]
        },
        options: { cutout: '75%' }
    });
</script>
@endpush
