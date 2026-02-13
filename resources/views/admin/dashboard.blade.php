<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Cabelista</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Custom Colors based on image */
        .bg-cabelista-blue { background-color: #004aad; }
        .text-cabelista-blue { color: #004aad; }
        .bg-card-blue { background-color: #004aad; }
        
        /* Gradient Button Style */
        .btn-gradient {
            background: linear-gradient(90deg, #d946ef 0%, #3b82f6 100%);
        }
        .btn-red-gradient {
            background: linear-gradient(90deg, #ef4444 0%, #f97316 100%);
        }

        .logo img {
            height: 45px; /* ukuran logo */
            width: auto;
            display: block;
        }
    </style>
</head>
<body class="bg-white min-h-screen flex flex-col">

    <header class="bg-cabelista-blue text-white p-4 flex justify-between items-center shadow-md z-20 relative">
        <div class="flex items-center space-x-2 pl-4">
            <div class="logo">
                 <img src="/assets/img/logo-cabelista.png" alt="Logo Cabelista">
            </div>
        </div>

        <div class="flex space-x-4 pr-4">
            <button class="px-6 py-2 rounded-lg font-medium bg-blue-500 hover:bg-blue-600 transition shadow-lg border border-blue-400">
                <a href="{{ url('/') }}">Beranda</a>
            </button>
            <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="px-6 py-2 rounded-lg font-medium bg-red-500 hover:bg-red-600 transition shadow-lg border border-red-400 text-white">
        Logout
    </button>
</form>
        </div>
    </header>

    <div class="flex flex-1">
        <aside class="w-64 bg-cabelista-blue text-white hidden md:block pt-8">
            <nav class="space-y-2 px-4">
                <a href="#" class="flex items-center space-x-3 px-4 py-3 bg-white/10 rounded-lg text-white font-medium hover:bg-white/20 transition">
                    <i class="fa-solid fa-gauge-high w-6"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-white/80 hover:bg-white/10 rounded-lg transition hover:text-white">
                    <i class="fa-solid fa-clipboard-list w-6"></i>
                    <span>Kelola Materi</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-white/80 hover:bg-white/10 rounded-lg transition hover:text-white">
                    <i class="fa-regular fa-circle-play w-6"></i>
                    <span>Kelola Video</span>
                </a>
                <a href="{{ url('/analisisnilai') }}" class="flex items-center space-x-3 px-4 py-3 text-white/80 hover:bg-white/10 rounded-lg transition hover:text-white">
                    <i class="fa-solid fa-book-open w-6"></i>
                    <span>Analisis dan Nilai</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-8 md:p-12 overflow-y-auto">
            
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
                        <a href="{{ url('/tambahmateri') }}">Detail</a>
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
                        Detail
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
                    <button class="btn-gradient w-32 py-2 rounded-full font-semibold shadow-lg border-2 border-white/30 hover:shadow-xl hover:brightness-110 transition">
                        <a href="{{ url('/analisisnilai') }}">Detail</a>
                    </button>
                </div>

            </div>
        </main>
    </div>

</body>
</html>