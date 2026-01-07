@extends('layouts.app')

@section('title', 'Manajemen Sekolah')

@section('content')
    <div class="animate-fade-in">
        {{-- Header Section --}}
        <div class="bg-white p-10 rounded-[45px] shadow-sm border border-gray-100 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-black text-[#1a4d2e] tracking-tight">Kelola Data Sekolah</h1>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Dashboard Monitoring MBG Karawang</p>
                </div>
                <button onclick="openModal('tambah')" class="bg-[#1a4d2e] text-white px-8 py-4 rounded-2xl font-black text-sm hover:bg-black hover:-translate-y-1 active:scale-95 transition-all shadow-lg">
                    + TAMBAH SEKOLAH
                </button>
            </div>
        </div>

        {{-- School List with Staggered Animation --}}
        <div id="schoolList" class="space-y-4">
            @php $initial_schools = [
                ['id' => 1, 'nama' => 'SDN Karawang Barat 01', 'npsn' => '20334567'],
                ['id' => 2, 'nama' => 'SDN Nagasari 02', 'npsn' => '20334568'],
                ['id' => 3, 'nama' => 'SDN Karawang Wetan 04', 'npsn' => '20334569']
            ]; @endphp

            @foreach($initial_schools as $index => $s)
            <div class="school-card bg-white border border-gray-100 rounded-[30px] p-6 flex items-center justify-between hover:shadow-xl hover:shadow-gray-100 transition-all duration-300 animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-green-50 rounded-3xl flex items-center justify-center text-3xl shadow-inner group-hover:scale-110 transition-transform">🏫</div>
                    <div>
                        <h3 class="text-lg font-black text-gray-800 name-text">{{ $s['nama'] }}</h3>
                        <p class="text-xs font-bold text-gray-400 npsn-text uppercase tracking-widest">NPSN: {{ $s['npsn'] }}</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button onclick="openModal('edit', {{ $s['id'] }})" class="bg-blue-50 text-blue-600 px-6 py-2.5 rounded-xl font-black text-[10px] uppercase hover:bg-blue-600 hover:text-white transition-all tracking-widest">Edit</button>
                    <button onclick="hapusSekolah(this)" class="bg-red-50 text-red-500 px-6 py-2.5 rounded-xl font-black text-[10px] uppercase hover:bg-red-500 hover:text-white transition-all tracking-widest">Hapus</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Modal Management --}}
    <div id="modalContainer" class="fixed inset-0 bg-black/40 z-[10000] hidden items-center justify-center backdrop-blur-md transition-all">
        <div class="bg-white w-full max-w-md rounded-[45px] p-10 shadow-2xl mx-4 transform transition-all scale-90 opacity-0" id="modalContent">
            <h2 id="modalTitle" class="text-2xl font-black text-[#1a4d2e] mb-8 text-center uppercase tracking-tighter">Tambah Sekolah</h2>
            <input type="hidden" id="edit-id">

            <div class="space-y-6">
                <div class="group">
                    <label class="text-[10px] font-black text-gray-400 mb-2 block uppercase px-2 tracking-widest group-focus-within:text-green-600 transition-colors">Nama Sekolah</label>
                    <input type="text" id="input-name" class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                </div>
                <div class="group">
                    <label class="text-[10px] font-black text-gray-400 mb-2 block uppercase px-2 tracking-widest group-focus-within:text-green-600 transition-colors">Nomor NPSN</label>
                    <input type="text" id="input-npsn" class="w-full bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl font-bold focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                </div>
                <div class="pt-6 flex gap-4">
                    <button onclick="closeModal()" class="flex-1 py-4 rounded-2xl font-black text-[10px] bg-gray-100 hover:bg-gray-200 transition-all uppercase tracking-widest">BATAL</button>
                    <button onclick="saveData()" class="flex-1 py-4 rounded-2xl font-black text-[10px] bg-black text-white hover:bg-[#1a4d2e] transition-all uppercase tracking-widest shadow-lg">SIMPAN DATA</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<style>
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideOut { from { opacity: 1; transform: translateX(0); } to { opacity: 0; transform: translateX(50px); } }

    .animate-fade-in { animation: fadeIn 0.5s ease-out; }
    .animate-slide-up { animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-slide-out { animation: slideOut 0.4s ease-in forwards; }
</style>

<script>
    let schoolCounter = 3;
    const modal = document.getElementById('modalContainer');
    const content = document.getElementById('modalContent');

    function openModal(type, id = null) {
        modal.classList.replace('hidden', 'flex');

        if (type === 'edit') {
            document.getElementById('modalTitle').innerText = 'Edit Sekolah';
            const card = event.target.closest('.school-card');
            document.getElementById('edit-id').value = id;
            document.getElementById('input-name').value = card.querySelector('.name-text').innerText;
            document.getElementById('input-npsn').value = card.querySelector('.npsn-text').innerText.replace('NPSN: ', '');
        } else {
            document.getElementById('modalTitle').innerText = 'Tambah Sekolah';
            document.getElementById('edit-id').value = '';
            document.getElementById('input-name').value = '';
            document.getElementById('input-npsn').value = '';
        }

        setTimeout(() => {
            content.classList.replace('scale-90', 'scale-100');
            content.classList.replace('opacity-0', 'opacity-100');
        }, 10);
    }

    function closeModal() {
        content.classList.replace('scale-100', 'scale-90');
        content.classList.replace('opacity-100', 'opacity-0');
        setTimeout(() => { modal.classList.replace('flex', 'hidden'); }, 200);
    }

    function saveData() {
        const id = document.getElementById('edit-id').value;
        const name = document.getElementById('input-name').value;
        const npsn = document.getElementById('input-npsn').value;

        if (!name || !npsn) return alert("Mohon isi semua data!");

        if (id) {
            // Update Logika (Visual)
            const cards = document.querySelectorAll('.school-card');
            cards.forEach(card => {
                // Di sini biasanya pakai ID asli, ini simulasi sederhana
                if(card.querySelector('.name-text').innerText.includes(name) || card.innerHTML.includes(`openModal('edit', ${id})`)) {
                    card.querySelector('.name-text').innerText = name;
                    card.querySelector('.npsn-text').innerText = 'NPSN: ' + npsn;
                }
            });
        } else {
            schoolCounter++;
            const list = document.getElementById('schoolList');
            const newCard = document.createElement('div');
            newCard.className = "school-card bg-white border border-gray-100 rounded-[30px] p-6 flex items-center justify-between animate-slide-up shadow-xl";
            newCard.innerHTML = `
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-green-50 rounded-3xl flex items-center justify-center text-3xl">🏫</div>
                    <div>
                        <h3 class="text-lg font-black text-gray-800 name-text">${name}</h3>
                        <p class="text-xs font-bold text-gray-400 npsn-text uppercase tracking-widest">NPSN: ${npsn}</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button onclick="openModal('edit', ${schoolCounter})" class="bg-blue-50 text-blue-600 px-6 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest">Edit</button>
                    <button onclick="hapusSekolah(this)" class="bg-red-50 text-red-500 px-6 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest">Hapus</button>
                </div>
            `;
            list.prepend(newCard); // Tambah di paling atas
        }
        closeModal();
    }

    function hapusSekolah(btn) {
        if(confirm('Hapus data sekolah ini?')) {
            const card = btn.closest('.school-card');
            card.classList.add('animate-slide-out');
            setTimeout(() => card.remove(), 400);
        }
    }
</script>
@endpush
