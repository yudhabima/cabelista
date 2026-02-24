<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Analisis Hasil Simulasi Crimping UTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cabelista: {
                            yellow: '#F2C300',
                            blue: '#0052CC',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-50 text-slate-800 antialiased p-4 md:p-8">

<div class="max-w-7xl mx-auto space-y-8">

    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}
    <div class="bg-white rounded-2xl shadow-xl p-4 mb-4 border-b-4 border-blue-500">
        <div class="flex justify-between">
    <div class="text-center space-y-2 mt-4 mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-cabelista-blue pb-2">
            Analisis Hasil Simulasi
        </h1>
        <p class="text-slate-500 font-medium flex items-center gap-2">
            Praktikum Crimping Kabel UTP (T568A & T568B)
        </p>
    </div>
    <div class="flex items-center gap-6">
    <a href="{{ route('admin.dashboard') }}" 
       class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-5 py-3 rounded-xl shadow-md flex items-center gap-2 transition-all">
        <span class="font-semibold">Dashboard Admin</span>
    </a>
    </div>
</div>
</div>

    {{-- ========================= --}}
    {{-- STATISTIK UTAMA --}}
    {{-- ========================= --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center justify-center hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <h2 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Total Peserta</h2>
            <p class="text-3xl font-black text-slate-700">{{ $totalPeserta }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center justify-center hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <h2 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Rata-rata Nilai</h2>
            <p class="text-3xl font-black text-cabelista-blue">{{ number_format($rataRata, 2) }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center justify-center hover:-translate-y-1 hover:shadow-md transition-all duration-300 border-b-4 border-b-emerald-400">
            <h2 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tertinggi</h2>
            <p class="text-3xl font-black text-emerald-500">{{ $nilaiTertinggi }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center justify-center hover:-translate-y-1 hover:shadow-md transition-all duration-300 border-b-4 border-b-rose-400">
            <h2 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Terendah</h2>
            <p class="text-3xl font-black text-rose-500">{{ $nilaiTerendah }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- ========================= --}}
        {{-- DISTRIBUSI NILAI --}}
        {{-- ========================= --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 lg:col-span-2 flex flex-col justify-center">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-slate-800">Distribusi Nilai</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($distribusi as $range => $jumlah)
                    <div class="bg-blue-50/50 border border-blue-100 p-4 rounded-xl text-center hover:bg-blue-100 transition-colors">
                        <p class="text-sm font-semibold text-cabelista-blue mb-1">{{ $range }}</p>
                        <p class="text-3xl font-bold text-cabelista-blue">{{ $jumlah }}</p>
                        <p class="text-xs text-blue-400 mt-1 font-medium">Peserta</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ========================= --}}
        {{-- TOP 5 PESERTA --}}
        {{-- ========================= --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h2 class="text-lg font-bold text-slate-800 mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-cabelista-yellow" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                Top 5 Peserta
            </h2>
            <ul class="space-y-3">
                @foreach($top5 as $index => $data)
                    <li class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-100 hover:bg-white hover:shadow-sm transition-all">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full {{ $loop->iteration <= 3 ? 'bg-cabelista-yellow text-slate-900 shadow-sm' : 'bg-slate-200 text-slate-600' }} font-bold text-sm">
                                {{ $loop->iteration }}
                            </span>
                            <span class="font-semibold text-slate-700 text-sm">{{ $data->name }}</span>
                        </div>
                        <span class="font-bold text-sm text-cabelista-blue bg-white px-3 py-1 rounded-full border border-slate-200 shadow-sm">
                            {{ $data->score }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- ========================= --}}
    {{-- TABEL DATA HASIL & FILTER --}}
    {{-- ========================= --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-lg font-bold text-slate-800 mb-4">Detail Hasil Simulasi</h2>
            
            {{-- Form Filter & Pencarian --}}
            <form action="" method="GET" class="flex flex-col md:flex-row gap-3">
                {{-- Pencarian --}}
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-cabelista-blue focus:border-cabelista-blue outline-none transition-all" placeholder="Cari nama atau absen peserta...">
                </div>

                {{-- Filter Kategori --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    <select name="kategori" class="w-full sm:w-48 px-3 py-2 border border-slate-200 rounded-lg text-sm text-slate-600 focus:ring-2 focus:ring-cabelista-blue outline-none bg-white cursor-pointer">
                        <option value="">Semua Kategori</option>
                        <option value="sangat_baik" {{ request('kategori') == 'sangat_baik' ? 'selected' : '' }}>Sangat Baik (≥85)</option>
                        <option value="baik" {{ request('kategori') == 'baik' ? 'selected' : '' }}>Baik (≥70)</option>
                        <option value="cukup" {{ request('kategori') == 'cukup' ? 'selected' : '' }}>Cukup (≥55)</option>
                        <option value="perlu_latihan" {{ request('kategori') == 'perlu_latihan' ? 'selected' : '' }}>Perlu Latihan (<55)</option>
                    </select>

                    <button type="submit" class="bg-cabelista-blue text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 transition-colors shadow-sm whitespace-nowrap">
                        Terapkan
                    </button>
                    
                    @if(request('search') || request('kategori'))
                        <a href="?" class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-200 transition-colors flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        @php
            function getKategori($score){
                if ($score >= 85) return ['label' => 'Sangat Baik', 'class' => 'bg-emerald-100 text-emerald-700 border-emerald-200'];
                if ($score >= 70) return ['label' => 'Baik', 'class' => 'bg-blue-100 text-blue-700 border-blue-200'];
                if ($score >= 55) return ['label' => 'Cukup', 'class' => 'bg-cabelista-yellow/20 text-yellow-700 border-cabelista-yellow/40'];
                return ['label' => 'Perlu Latihan', 'class' => 'bg-rose-100 text-rose-700 border-rose-200'];
            }
        @endphp

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50/50 text-slate-500 text-xs uppercase tracking-wider font-semibold border-b border-slate-200">
                    <tr>
                        <th class="p-4 text-center">No</th>
                        <th class="p-4">Nama Peserta</th>
                        <th class="p-4 text-center">Absen</th>
                        <th class="p-4 text-center">Skor</th>
                        <th class="p-4 text-center">Kategori</th>
                        <th class="p-4 text-center">T568A</th>
                        <th class="p-4 text-center">T568B</th>
                        <th class="p-4 text-center">Waktu</th>
                        <th class="p-4 text-center">Kabel</th>
                        <th class="p-4 text-center">RJ45</th>
                        <th class="p-4 text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($semuaData as $index => $data)
                    @php $kategori = getKategori($data->score); @endphp
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 text-center text-slate-400">{{ $index + 1 }}</td>
                        <td class="p-4 font-medium text-slate-800">{{ $data->name }}</td>
                        <td class="p-4 text-center">{{ $data->absen }}</td>
                        <td class="p-4 text-center">
                            <span class="font-bold text-slate-800">{{ $data->score }}</span>
                        </td>
                        <td class="p-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $kategori['class'] }}">
                                {{ $kategori['label'] }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            @if($data->status_t568a)
                                <span class="inline-flex items-center gap-1 text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md text-xs font-semibold border border-emerald-100">
                                    ✓
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-rose-600 bg-rose-50 px-2 py-1 rounded-md text-xs font-semibold border border-rose-100">
                                    ✕
                                </span>
                            @endif
                        </td>
                        <td class="p-4 text-center">
                            @if($data->status_t568b)
                                <span class="inline-flex items-center gap-1 text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md text-xs font-semibold border border-emerald-100">
                                    ✓
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-rose-600 bg-rose-50 px-2 py-1 rounded-md text-xs font-semibold border border-rose-100">
                                    ✕
                                </span>
                            @endif
                        </td>
                        <td class="p-4 text-center text-slate-500">{{ $data->time_used }}s</td>
                        <td class="p-4 text-center text-slate-500">{{ $data->cable_used }}</td>
                        <td class="p-4 text-center text-slate-500">{{ $data->rj45_used }}</td>
                        <td class="p-4 text-center text-slate-500">{{ $data->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="p-8 text-center text-slate-500">
                            Tidak ada data peserta yang cocok dengan filter pencarian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>