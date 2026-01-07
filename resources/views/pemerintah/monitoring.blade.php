@extends('layouts.app')

@section('title', 'Monitoring Sekolah')

@section('content')
    {{-- Header dengan Animasi Fade In --}}
    <header class="flex justify-between items-center mb-8 glass-card p-6 rounded-[35px] shadow-sm border border-white animate-fade-in">
        <div>
            <h1 class="text-2xl font-black text-[#1a4d2e]">Monitoring Sekolah</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Status Laporan Real-Time</p>
        </div>

        <div class="flex gap-3">
            <input type="text" placeholder="Cari nama sekolah..." class="px-6 py-3 rounded-full border border-gray-100 text-xs focus:outline-none focus:ring-2 focus:ring-green-500 w-64 bg-gray-50/50 font-semibold transition-all focus:bg-white">
            <button class="bg-[#1a4d2e] text-white px-8 py-3 rounded-full font-bold text-xs shadow-lg hover:bg-black hover:-translate-y-1 active:scale-95 transition-all uppercase tracking-widest">Filter Data</button>
        </div>
    </header>

    {{-- Tabel Utama --}}
    <div class="bg-white rounded-[40px] shadow-sm overflow-hidden border border-gray-50 animate-slide-up">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-50 uppercase text-[10px] font-black text-gray-400 tracking-widest">
                    <th class="px-8 py-6">Nama Sekolah</th>
                    <th class="px-8 py-6">Wilayah/Kecamatan</th>
                    <th class="px-8 py-6">Jam Lapor</th>
                    <th class="px-8 py-6 text-center">Status</th>
                    <th class="px-8 py-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @php $data_sekolah = [
                    ['nama' => 'SDN Karawang Barat 01', 'kec' => 'Karawang Barat', 'jam' => '08:15', 'status' => 'TERKIRIM'],
                    ['nama' => 'SDN Nagasari 02', 'kec' => 'Karawang Barat', 'jam' => '09:00', 'status' => 'TERKIRIM'],
                    ['nama' => 'SDN Karawang Wetan 04', 'kec' => 'Karawang Timur', 'jam' => '-', 'status' => 'MENUNGGU'],
                    ['nama' => 'SDN Adiarsa Timur 01', 'kec' => 'Karawang Timur', 'jam' => '07:45', 'status' => 'TERKIRIM'],
                    ['nama' => 'SDN Telukjambe 03', 'kec' => 'Telukjambe Timur', 'jam' => '-', 'status' => 'MENUNGGU'],
                ]; @endphp

                @foreach($data_sekolah as $s)
                <tr class="border-b border-gray-50 hover:bg-green-50/30 transition-all group">
                    <td class="px-8 py-5 font-bold text-gray-800 group-hover:text-[#1a4d2e] transition-colors">{{ $s['nama'] }}</td>
                    <td class="px-8 py-5 text-gray-500 font-semibold">{{ $s['kec'] }}</td>
                    <td class="px-8 py-5 text-gray-500">{{ $s['jam'] }}</td>
                    <td class="px-8 py-5 text-center">
                        <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest inline-block transition-transform group-hover:scale-110 {{ $s['status'] == 'TERKIRIM' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                            {{ $s['status'] }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <button onclick="bukaEdit('{{ $s['nama'] }}', '{{ $s['status'] }}')" class="text-[#1a4d2e] font-black text-[10px] hover:bg-[#1a4d2e] hover:text-white transition-all uppercase tracking-widest bg-gray-50 px-5 py-2.5 rounded-full">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal Edit --}}
    <div id="modalEdit" class="fixed inset-0 bg-black/40 z-[10000] hidden items-center justify-center backdrop-blur-md transition-all">
        <div class="bg-white w-full max-w-md rounded-[45px] p-10 shadow-2xl mx-4 transform transition-all scale-90 opacity-0" id="modalContent">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-black text-[#1a4d2e]">Edit Data Laporan</h2>
                <button onclick="tutupEdit()" class="w-10 h-10 flex items-center justify-center bg-gray-50 rounded-full text-gray-400 hover:text-black hover:bg-gray-100 transition">✕</button>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 ml-2">Nama Sekolah</label>
                    <input type="text" id="editNama" class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 ml-2">Status Laporan</label>
                    <select id="editStatus" class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                        <option value="TERKIRIM">TERKIRIM</option>
                        <option value="MENUNGGU">MENUNGGU</option>
                    </select>
                </div>
                <div class="pt-4 flex gap-3">
                    <button onclick="tutupEdit()" class="flex-1 py-4 rounded-2xl font-bold text-xs bg-gray-100 hover:bg-gray-200 transition-all uppercase">Batal</button>
                    <button onclick="alert('Data Tersimpan!')" class="flex-1 py-4 rounded-2xl font-bold text-xs bg-black text-white hover:bg-gray-800 uppercase tracking-widest shadow-lg active:scale-95 transition-all">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<style>
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeIn 0.5s ease-out; }
    .animate-slide-up { animation: slideUp 0.6s ease-out; }
</style>

<script>
    function bukaEdit(nama, status) {
        const modal = document.getElementById('modalEdit');
        const content = document.getElementById('modalContent');

        modal.classList.replace('hidden', 'flex');
        document.getElementById('editNama').value = nama;
        document.getElementById('editStatus').value = status;

        // Animasi pop-in modal
        setTimeout(() => {
            content.classList.replace('scale-90', 'scale-100');
            content.classList.replace('opacity-0', 'opacity-100');
        }, 10);
    }

    function tutupEdit() {
        const modal = document.getElementById('modalEdit');
        const content = document.getElementById('modalContent');

        content.classList.replace('scale-100', 'scale-90');
        content.classList.replace('opacity-100', 'opacity-0');

        setTimeout(() => {
            modal.classList.replace('flex', 'hidden');
        }, 200);
    }
</script>
@endpush
