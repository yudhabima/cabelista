<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabelista</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Navigation */
        nav {
            background: linear-gradient(135deg, #0052CC 0%, #0066FF 100%);
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .logo img {
            height: 45px; /* ukuran logo */
            width: auto;
            display: block;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #FFD700;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #0052CC 0%, #0066FF 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 100px 20px 80px;
            color: white;
        }

        .hero-logo {
    margin-bottom: 25px;
}

        .hero-logo img {
            height: 120px;        /* UKURAN LOGO HERO */
            width: auto;
            max-width: 90%;
            object-fit: contain;
        }

        .hero p {
            font-size: 18px;
            max-width: 700px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn-primary {
            background: linear-gradient(135deg, #FF00FF 0%, #FF1493 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255,0,255,0.4);
        }

        /* Video Tutorial Section */
        .video-section {
            padding: 80px 20px;
            background: #f5f5f5;
            text-align: center;
        }

        .video-section h2 {
            color: #0066FF;
            font-size: 42px;
            margin-bottom: 10px;
        }

        .video-section p {
            color: #0066FF;
            font-size: 18px;
            margin-bottom: 40px;
        }

        .video-container {
            max-width: 720px;        
            aspect-ratio: 16 / 9;    /* rasio video */
            margin: 0 auto;
            background: #000;
            border-radius: 16px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .video-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Materials Section */
        .materials-section {
            padding: 80px 20px;
            background: linear-gradient(135deg, #0052CC 0%, #0066FF 100%);
            text-align: center;
            color: white;
        }

        .materials-section h2 {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .materials-section > p {
            font-size: 18px;
            margin-bottom: 50px;
        }

        .materials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1500px;
            margin: 0 auto 40px;
        }

        .material-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .material-card:hover {
            transform: translateY(-10px);
        }

        .material-card img {
            width: 50px;
            height: 80px;
            margin-bottom: 20px;
        }

        .material-card h3 {
            color: #333;
            font-size: 22px;
            margin-bottom: 15px;
        }

        .material-card p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .btn-secondary {
            background: #0066FF;
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-secondary:hover {
            background: #0052CC;
        }

        .btn-module {
           background: linear-gradient(135deg, #FF00FF 0%, #FF1493 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;

            text-decoration: none;

            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: transform 0.3s;
        }

        .btn-module:hover {
            transform: translateY(-2px);
        }

        .btn-module::before {
            content: "";
        }

        /* CTA Section */
        .cta-section {
            padding: 80px 20px;
            background: #f5f5f5;
            text-align: center;
        }

        .cta-section h2 {
            color: #0066FF;
            font-size: 36px;
            margin-bottom: 30px;
        }

        .btn-action {
            background: linear-gradient(135deg, #FF00FF 0%, #FF1493 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }

        /* Footer */
        footer {
            background: white;
            padding: 60px 50px 30px;
            border-top: 1px solid #e0e0e0;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 50px;
            max-width: 1200px;
            margin: 0 auto 30px;
        }

        .footer-brand .logo {
            color: #FFD700;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .footer-brand p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-links a {
            color: #0066FF;
            font-size: 24px;
            text-decoration: none;
        }

        .footer-section h3 {
            color: #333;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .footer-section p {
            color: #666;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 8px;
        }

        .footer-bottom {
            text-align: center;
            color: #999;
            font-size: 14px;
            padding-top: 30px;
            border-top: 1px solid #e0e0e0;
        }

        @media (max-width: 768px) {
            nav {
                padding: 15px 20px;
            }

            .nav-links {
                gap: 15px;
            }

            .hero h1 {
                font-size: 42px;
            }

            .materials-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">
            <img src="/assets/img/logo-cabelista.png" alt="Logo Cabelista">
        </div>
        <ul class="nav-links">
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#simulasi">Simulasi</a></li>
            <li><a href="#materi">Materi</a></li>
            @auth
<li style="position:relative; list-style:none;">
    
    <div style="display:flex; align-items:center; gap:5px;">
        
        {{-- 1. FOTO PROFIL (Tetap link ke Dashboard) --}}
        <a href="{{ route('admin.dashboard') }}" title="Kembali ke Dashboard">
            <img 
                src="{{ asset('assets/img/user.png') }}" 
                alt="User"
                style="width:35px; height:35px; border-radius:50%; object-fit:cover; display:block; border: 2px solid white;"
            >
        </a>

        {{-- 2. TOMBOL PANAH (Pengganti Tulisan Admin) --}}
        {{-- Kita hapus nama, sisa panah saja untuk buka menu logout --}}
        <div onclick="toggleLogout()" style="cursor:pointer; padding: 0 5px; height: 35px; display: flex; align-items: center;">
            
        </div>

    </div>

    {{-- Dropdown Menu (Isi Tetap Sama) --}}
    <div id="logoutMenu"
         style="
            display:none;
            position:absolute;
            right:0;
            top: 45px;
            background:white;
            border-radius:8px;
            box-shadow:0 5px 20px rgba(0,0,0,0.2);
            overflow:hidden;
            min-width:140px;
            z-index: 100;
         ">

        <a href="{{ route('admin.dashboard') }}"
           style="display:block; padding:10px 15px; text-decoration:none; color:#333; border-bottom:1px solid #eee;">
           Dashboard
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                style="
                    width:100%;
                    padding:10px 15px;
                    border:none;
                    background:none;
                    text-align:left;
                    cursor:pointer;
                    color:red;
                    font-weight:bold;
                ">
                Logout
            </button>
        </form>
    </div>
</li>
@endauth

@guest
    <li>
        <a href="{{ url('/login') }}" style="color:white; text-decoration:none;">Login</a>
    </li>
@endguest
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="hero-logo">
    <img src="{{ asset('assets/img/logo-cabelista.png') }}" alt="Logo Cabelista">
</div>
        <p>Ikuti pengalaman belajar crimping kabel UTP dan kuasai teknik instalasi kabel jaringan tanpa keterbatasan alat</p>
        <a href="{{ url('/simulasi') }}" class="btn-primary">Mulai Sekarang</a>
    </section>

    <!-- Video Tutorial Section -->
    <section class="video-section">
        <h2>Video Tutorial</h2>
        <p>Pelajari Cabelista dengan video tutorial kami</p>
        <div class="video-container">
        <iframe 
        src="{{ $videoUrl ?? 'https://www.youtube.com/embed/5FBGJARktZQ' }}"
        title="Video Tutorial Crimping Kabel UTP"
        allowfullscreen>
        </iframe>
        </div>
    </section>

    <!-- Materials Section -->
    <section class="materials-section" id="materi">
        <h2>Materi</h2>
        <p>Rasakan serunya belajar di Cabelista</p>

    @if(isset($materials))
    @endif
        
    <div class="materials-grid">
    @forelse($materials as $material)
        <div class="material-card">
        <img src="{{ $material->image
            ? asset('storage/'.$material->image)
            : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 120 120%27%3E%3Cg%3E%3Crect x=%2720%27 y=%2730%27 width=%2730%27 height=%2740%27 fill=%27%2366BB6A%27/%3E%3Crect x=%2720%27 y=%2750%27 width=%2730%27 height=%2740%27 fill=%27%23EF5350%27/%3E%3Crect x=%2720%27 y=%2770%27 width=%2730%27 height=%2740%27 fill=%27%232196F3%27/%3E%3C/g%3E%3C/svg%3E'
            }}" alt="Material">
        <h3>{{ $material->title }}</h3>
        <p>{{ $material->description }}</p>
        <a href="{{ route('materi.show', $material->id)}}"
             class="btn-secondary">
            Pilih
        </a>
    </div>
    @empty
        <p style="color:white">Belum ada materi</p>
    @endforelse
    
            <div class="material-card">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 120'%3E%3Cg%3E%3Crect x='20' y='30' width='30' height='40' fill='%2366BB6A'/%3E%3Crect x='20' y='50' width='30' height='40' fill='%23EF5350'/%3E%3Crect x='20' y='70' width='30' height='40' fill='%232196F3'/%3E%3C/g%3E%3C/svg%3E" alt="Books">
                <h3>Susunan Warna Kabel</h3>
                <p>Mempelajari standar T568A dan T568B untuk susunan kabel straight dan cross</p>
                <a href="{{ url('/materi2') }}" class="btn-secondary">Pilih</a>
            </div>
            
            <div class="material-card">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 120'%3E%3Cg%3E%3Crect x='20' y='30' width='30' height='40' fill='%2366BB6A'/%3E%3Crect x='20' y='50' width='30' height='40' fill='%23EF5350'/%3E%3Crect x='20' y='70' width='30' height='40' fill='%232196F3'/%3E%3C/g%3E%3C/svg%3E" alt="Books">
                <h3>Teknik Crimping</h3>
                <p>Langkah-langkah praktis menggunakan tang crimping</p>
                <a href="{{ url('/materi3') }}" class="btn-secondary">Pilih</a>
            </div>
        </div>
    </div>

    <a href="https://drive.google.com/file/d/1MTXaLHeEaB4pcz1FKWBhCffKkGG-19LK/view?usp=sharing"
   class="btn-module"
   target="_blank"
   rel="noopener noreferrer">
   Lihat Bahan Belajar
</a>

    </section>

    <!-- CTA Section -->
    <section class="cta-section"  id="simulasi">
        <h2>Belajar Makin Mudah, Seru, Dan<br>Sesuai Gayamu!</h2>
        <a href="{{ url('/analisis') }}" class="btn-primary">
    Mainkan!
</a>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <div class="logo">
            <img src="/assets/img/logo-cabelista.png" alt="Logo Cabelista">
                <p>Dapatkan informasi terbaru Cabelista<br>dengan follow sosial media di bawah ini!</p>
                <div class="social-links">
                    <a href="#"></a>
                    <a href="#"></a>
                    <a href="#"></a>
                </div>
            </div>

            </div>
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p>cabelista@gmail.com</p>
                <p>0857-9151-3800</p>
            </div>

            <div class="footer-section">
                <h3>Location</h3>
                <p>Jl. Ketintang Wiyata<br>Ketintang, Kec. Gayungan,<br>Kota Surabaya, Jawa Timur<br>60231</p>
            </div>
        </div>

        <div class="footer-bottom">
            ©cabelista.2026
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navigation
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                nav.style.padding = '15px 50px';
            } else {
                nav.style.padding = '20px 50px';
            }
            
            lastScroll = currentScroll;
        });
    </script>
</body>
</html>