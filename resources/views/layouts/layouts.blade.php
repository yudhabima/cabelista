<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assest/icons/cabelista1.php') }}">
    <title>Cabelista</title>

    <!-- Add this in your HTML head section -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('assest/css/style.css') }}">

    <style>
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

body {
margin: 0;
font-family: 'Segoe UI', sans-serif;
background-color: #ffffff;
}


main {
min-height: 70vh;
padding: 60px 80px;
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
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ url('/login') }}">Login</a></li>
        </ul>
    </nav>')

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
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


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        const navbar = document.querySelector(".navbar");
        const navLinks = document.querySelectorAll(".nav-link");

        window.addEventListener("scroll", () => {
          // Cek apakah berada di halaman home (misalnya berdasarkan URL)
          const isHomePage = window.location.pathname === "/"; // Asumsikan halaman home berada di URL "/"

          if (window.scrollY > 50) {
            // Navbar dengan latar belakang putih dan shadow
            navbar.classList.add("bg-white", "shadow");

            // Teks navbar hitam jika di halaman home, tetap hitam di halaman lain
            navLinks.forEach(link => {
              if (isHomePage) {
                link.classList.remove("text-light");
                link.classList.add("text-dark");
              } else {
                link.classList.remove("text-light");
                link.classList.add("text-dark");
              }
            });
          } else {
            // Navbar transparan jika di atas scroll
            navbar.classList.remove("bg-white", "shadow");

            // Teks navbar putih jika di halaman home, tetap hitam di halaman lain
            navLinks.forEach(link => {
              if (isHomePage) {
                link.classList.remove("text-dark");
                link.classList.add("text-light");
              } else {
                // Pastikan teks navbar tetap hitam di halaman non-home
                link.classList.remove("text-light");
                link.classList.add("text-dark");
              }
            });
          }
        });

        // Set default text color for non-home page
        if (window.location.pathname !== "/") {
          navLinks.forEach(link => {
            link.classList.remove("text-light");
            link.classList.add("text-dark");
          });
        }

        // AOS Animation
        AOS.init();
    </script>
</body>
</html>
