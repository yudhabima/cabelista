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
        body { font-family: 'Poppins', sans-serif; }
        .bg-cabelista-blue { background-color: #004aad; }
        .text-cabelista-blue { color: #004aad; }
        .bg-card-blue { background-color: #004aad; }
        
        .btn-gradient {
            background: linear-gradient(90deg, #d946ef 0%, #3b82f6 100%);
        }
        .logo img {
            height: 45px;
            width: auto;
            display: block;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col overflow-hidden">

    <header class="bg-cabelista-blue text-white p-4 flex justify-between items-center shadow-md z-20 relative shrink-0">
        <div class="flex items-center space-x-2 pl-4">
            <div class="logo">
                 <img src="/assets/img/logo-cabelista.png" alt="Logo Cabelista">
            </div>
        </div>

        <div class="flex space-x-4 pr-4">
            <a href="{{ url('/') }}" class="px-6 py-2 rounded-lg font-medium bg-blue-500 hover:bg-blue-600 transition shadow-lg border border-blue-400 text-white flex items-center">
                Beranda
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-6 py-2 rounded-lg font-medium bg-red-500 hover:bg-red-600 transition shadow-lg border border-red-400 text-white">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <div class="flex flex-1 h-full overflow-hidden">
        <aside class="w-64 bg-cabelista-blue text-white hidden md:block pt-8 shrink-0 overflow-y-auto">
            <nav class="space-y-2 px-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-white/80 hover:bg-white/10 rounded-lg transition hover:text-white">
                    <i class="fa-solid fa-gauge-high w-6"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('materi.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white/80 hover:bg-white/10 rounded-lg transition hover:text-white">
                    <i class="fa-solid fa-clipboard-list w-6"></i>
                    <span>Kelola Materi</span>
                </a>
                <a href="{{ route('admin.video.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white/80 hover:bg-white/10 rounded-lg transition hover:text-white">
                    <i class="fa-regular fa-circle-play w-6"></i>
                    <span>Kelola Video</span>
                </a>
                <a href="{{ url('/analisisnilai') }}" class="flex items-center space-x-3 px-4 py-3 text-white/80 hover:bg-white/10 rounded-lg transition hover:text-white">
                    <i class="fa-solid fa-book-open w-6"></i>
                    <span>Analisis dan Nilai</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col relative overflow-y-auto bg-white w-full">
            @yield('content')
        </main>
    </div>
</body>
</html>