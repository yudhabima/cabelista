@extends('layouts.admin')

@section('content')
        <section class="flex-1 p-8 md:p-12 overflow-y-auto">
            
            <div class="text-center mb-12 mt-4">
                <h1 class="text-4xl font-bold text-cabelista-blue mb-4">Halaman Admin</h1>
                <p class="text-cabelista-blue/80 text-lg">
                    Selamat datang di halaman Admin Cabelista, kelola semua konten kegiatan dengan mudah
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                
                <div class="bg-card-blue rounded-[2rem] p-8 text-center text-white flex flex-col items-center shadow-xl hover:scale-105 transition duration-300">
                    <div class="bg-white w-full h-32 rounded-2xl mb-6 flex items-center justify-center text-gray-300">
                         <i class="fa-solid fa-book text-4xl text-gray-200"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Materi Pembelajaran</h3>
                    <p class="text-sm text-blue-100 mb-8 flex-1">
                        Kelola materi pembelajaran instalasi kabel UTP
                    </p>
                    <button class="btn-gradient w-32 py-2 rounded-full font-semibold shadow-lg border-2 border-white/30 hover:shadow-xl hover:brightness-110 transition">
                        <a href="{{  route('materi.index')  }}" class="text-white">Detail</a>
                    </button>
                </div>

                <div class="bg-card-blue rounded-[2rem] p-8 text-center text-white flex flex-col items-center shadow-xl hover:scale-105 transition duration-300">
                    <div class="bg-white w-full h-32 rounded-2xl mb-6 flex items-center justify-center">
                        <i class="fa-solid fa-play text-4xl text-gray-200"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Video</h3>
                    <p class="text-sm text-blue-100 mb-8 flex-1">
                        Kelola video tutorial penggunaan Cabelista
                    </p>
                    <button class="btn-gradient w-32 py-2 rounded-full font-semibold shadow-lg border-2 border-white/30 hover:shadow-xl hover:brightness-110 transition">
                        <a href="{{ route('admin.video.index') }}" class="text-white">Detail</a>
                    </button>
                </div>

                <div class="bg-card-blue rounded-[2rem] p-8 text-center text-white flex flex-col items-center shadow-xl hover:scale-105 transition duration-300">
                    <div class="bg-white w-full h-32 rounded-2xl mb-6 flex items-center justify-center">
                        <i class="fa-solid fa-chart-simple text-4xl text-gray-200"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Hasil Analisis dan Nilai Simulasi</h3>
                    <p class="text-sm text-blue-100 mb-8 flex-1">
                        Memantau nilai dan hasil evaluasi simulasi crimping kabel UTP
                    </p>
                    <a href="{{ url('/analisis') }}" class="btn-gradient w-32 py-2 rounded-full font-semibold shadow-lg border-2 border-white/30 hover:shadow-xl hover:brightness-110 transition inline-block text-center">
                    Detail
                    </a>
                </div>

            </div>
        </section>
@endsection