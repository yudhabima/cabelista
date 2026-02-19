<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $material->title }} - Pembelajaran</title>
    
    {{-- Menggunakan Tailwind CSS via CDN (Gratis & Cepat) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Font Google --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* Animasi Progress Bar */
        .progress-bar { transition: width 0.5s ease-in-out; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- === HEADER === --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            
            {{-- Logo & Judul Materi --}}
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 text-white p-2 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div>
                    <h1 class="font-bold text-gray-800 leading-tight">{{ $material->title }}</h1>
                    <p class="text-xs text-gray-500">Mode Belajar Interaktif</p>
                </div>
            </div>

            {{-- Info XP & User --}}
            <div class="flex items-center gap-4">
                {{-- XP User Saat Ini --}}
                <div class="hidden md:flex items-center gap-2 bg-yellow-50 px-3 py-1 rounded-full border border-yellow-200">
                    <span class="text-yellow-600 font-bold">⚡ {{ Auth::user()->total_xp }} XP</span>
                </div>
                
                {{-- Tombol Keluar --}}
                <a href="{{ route('welcome') }}" class="text-gray-500 hover:text-red-500 font-medium text-sm">
                    Keluar
                </a>
            </div>
        </div>
    </header>

    {{-- === KONTEN UTAMA === --}}
    <main class="flex-1 max-w-7xl w-full mx-auto p-4 md:p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- BAGIAN KIRI: MATERI (2/3 Layar) --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Kartu Konten --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden min-h-[500px] flex flex-col">
                
                {{-- Judul Langkah --}}
                <div class="bg-gray-50 px-8 py-6 border-b border-gray-100">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-blue-600 font-bold tracking-wider text-xs uppercase">Langkah {{ $currentStepData->step_number }} dari {{ $totalSteps }}</span>
                        <span class="text-green-600 font-bold text-xs bg-green-100 px-2 py-1 rounded">Hadiah: +{{ $material->xp_reward }} XP</span>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">{{ $currentStepData->title }}</h2>
                </div>

                {{-- Isi Materi --}}
                <div class="p-8 text-gray-700 leading-relaxed text-lg flex-1">
                    {{-- nl2br(e(...)) berfungsi agar Enter di database jadi baris baru di HTML --}}
                    {!! nl2br(e($currentStepData->content)) !!}
                </div>

                {{-- Footer: Tombol Navigasi --}}
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-100 flex justify-between items-center">
                    
                    {{-- Tombol Sebelumnya (Opsional, logika sederhana) --}}
                    @if($currentStepData->step_number > 1)
                        <a href="{{ route('learning.show', ['id' => $material->id, 'step' => $currentStepData->step_number - 1]) }}" class="text-gray-500 hover:text-gray-700 font-bold px-4 py-2">
                            &larr; Sebelumnya
                        </a>
                    @else
                        <div></div> {{-- Spacer kosong --}}
                    @endif

                    {{-- Tombol Lanjut --}}
                    <form action="{{ route('learning.next', ['id' => $material->id, 'currentStep' => $currentStepData->step_number]) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition transform hover:scale-105 flex items-center gap-2">
                            <span>{{ $currentStepData->step_number == $totalSteps ? 'Selesai & Ambil XP' : 'Lanjut' }}</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>

        {{-- BAGIAN KANAN: PROGRESS (1/3 Layar) --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sticky top-24">
                
                <h3 class="font-bold text-gray-800 text-lg mb-4">Progress Belajar</h3>
                
                {{-- Progress Bar --}}
                <div class="mb-6">
                    <div class="flex justify-between text-sm font-bold text-gray-500 mb-2">
                        <span>{{ $progressPercent }}% Selesai</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-blue-600 h-2.5 rounded-full progress-bar" style="width: {{ $progressPercent }}%"></div>
                    </div>
                </div>

                <hr class="border-gray-100 my-6">

                {{-- Daftar Langkah --}}
                <div class="space-y-3">
                    @foreach($material->steps as $step)
                        @php
                            $isActive = $step->step_number == $currentStepData->step_number;
                            $isDone = $step->step_number < $currentStepData->step_number;
                            // Langkah masa depan dikunci kecuali langkah selanjutnya persis
                            $isLocked = $step->step_number > ($progress->current_step ?? 1);
                        @endphp

                        <a href="{{ !$isLocked ? route('learning.show', ['id' => $material->id, 'step' => $step->step_number]) : '#' }}" 
                           class="flex items-center gap-3 p-3 rounded-lg transition {{ $isActive ? 'bg-blue-50 border border-blue-200' : '' }} {{ $isLocked ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50' }}">
                            
                            {{-- Indikator Nomor/Centang --}}
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold shrink-0 
                                {{ $isDone ? 'bg-green-500 text-white' : ($isActive ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500') }}">
                                @if($isDone) ✓ @else {{ $step->step_number }} @endif
                            </div>

                            {{-- Judul Langkah di Sidebar --}}
                            <div class="text-sm font-medium {{ $isActive ? 'text-blue-700' : 'text-gray-600' }}">
                                {{ $step->title }}
                            </div>

                            {{-- Icon Gembok (Jika Terkunci) --}}
                            @if($isLocked)
                                <svg class="w-4 h-4 text-gray-400 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            @endif
                        </a>
                    @endforeach
                </div>

            </div>
        </div>

    </main>

</body>
</html>