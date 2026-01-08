@php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Request;

    // Cara paling aman: Cek apakah URL mengandung kata 'pemerintah' atau 'sekolah'
    // Ini akan tetap TRUE selama URL-mu ada kata tersebut, meskipun route name-nya error.
    $isPemerintah = Request::is('*pemerintah*') || Request::is('*sekolah*');
@endphp

<aside class="w-72 bg-[#1a4d2e] h-screen flex flex-col p-6 fixed left-0 top-0 text-white z-50 shadow-2xl">
    <div class="mb-10 mt-4 text-center">
        <h1 class="text-xl font-black tracking-tighter italic uppercase">MBG KARAWANG</h1>
        <div class="h-[5px] w-10 bg-green-400 mx-auto mt-2 rounded-full"></div>
    </div>

    <nav class="flex-1 overflow-y-auto pr-2 custom-scrollbar">
        {{-- Jika isPemerintah true, atau jika kita ingin menu ini selalu muncul di dashboard admin --}}
    
            @endforeach
        @endif
    </nav>

    <div class="mt-auto pt-6 border-t border-white/10">
        <div class="px-2 mb-4">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Admin Pemerintah</p>
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse shadow-[0_0_8px_#4ade80]"></div>
                <span class="text-[10px] text-green-400 font-black uppercase tracking-tighter">Sistem Online</span>
            </div>
        </div>
        <a href="{{ route('landing') }}" class="block w-full text-center bg-white text-black py-3 rounded-2xl font-black text-xs hover:bg-red-500 hover:text-white transition-all shadow-lg uppercase decoration-none">Keluar</a>
    </div>
</aside>
