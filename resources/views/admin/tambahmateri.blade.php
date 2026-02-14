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
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-white/80 hover:bg-white/10 rounded-lg transition hover:text-white">
                    <i class="fa-solid fa-gauge-high w-6"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 bg-white/10 rounded-lg text-white font-medium hover:bg-white/20 transition">
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

            <main class="flex-1 overflow-y-auto bg-white p-8">
                
                <h1 class="text-2xl font-bold text-[#004aad] mb-6">Halaman Materi</h1>

                <div class="mb-6">
                    <a href="{{ url('/course/edit') }}" class="px-6 py-2 rounded-lg font-medium bg-blue-500 hover:bg-blue-600 transition shadow-lg border border-blue-400 text-white font-semibold rounded shadow-md transition">
                        Buat Materi
                    </a>
                </div>

                <div class="bg-white border border-gray-300 rounded-sm overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-gray-300">
                                <th class="p-4 border-r border-gray-300 w-16 font-bold text-gray-800">No</th>
                                <th class="p-4 border-r border-gray-300 w-48 font-bold text-gray-800">Image</th>
                                <th class="p-4 border-r border-gray-300 font-bold text-gray-800">Judul</th>
                                <th class="p-4 font-bold text-gray-800 w-48">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-300 hover:bg-gray-50">
                                <td class="p-4 border-r border-gray-300">1</td>
                                <td class="p-4 border-r border-gray-300">
                                    <div class="w-24 h-16 bg-gray-400 rounded-md"></div>
                                </td>
                                <td class="p-4 border-r border-gray-300 font-medium text-gray-900">
                                    Pengenalan Kabel UTP
                                </td>
                                <td class="p-4">
                                    <div class="flex gap-2">
                                        <a href="#" class="px-4 py-1.5 bg-amber-400 hover:bg-amber-500 text-black text-sm font-medium rounded transition">
                                            Edit
                                        </a>
                                        <button class="px-4 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded transition">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            </tbody>
                    </table>
                </div>

            </main>
        </div>
    </div>

</body>
</html>