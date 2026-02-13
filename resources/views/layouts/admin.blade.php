<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Adjust body to ensure content does not overlap with navbar and prevent horizontal scroll */
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        /* Sidebar adjustments */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 80px; /* Push sidebar below navbar */
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }

        .main-content {
            margin-left: 250px; /* Push content to the right to prevent overlap with sidebar */
            padding: 20px;
            min-height: 100vh; /* Ensure content fills the available height */
        }

        /* Logo and Admin Panel text in navbar */
        .navbar .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar .navbar-brand img {
            height: 40px;
            width: 40px;
            margin-right: 10px;
        }

        .navbar .navbar-brand h4 {
            margin: 0;
            font-size: 1.25rem;
            color: #343a40;
            font-weight: bold;
        }

        /* Adjust navbar to fill the entire width */
        .navbar {
            width: 100%;
            padding-left: 25px; /* Add 50px padding on the left */
            padding-right: 25px; /* Add 50px padding on the right */
            z-index: 10; /* Ensure the navbar is above the sidebar */
        }

        /* Ensure the main content occupies the full width of the page */
        .container-fluid {
            max-width: 100%;
            padding-left: 0;
            padding-right: 0;
        }
    </style>
</head>

<body>
    <!-- Navbar with Logo and Admin Panel -->
    <nav class="navbar navbar-expand-lg py-3 fixed-top bg-light shadow">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assest/icons/cabelista1.png') }}" alt="Logo">
            <h4>SMCC Admin Panel</h4>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Add additional navbar items here if needed -->
            </ul>

            <div class="d-flex">
                @auth
                    <!-- Navbar for authenticated users -->
                    <a href="/" class="btn btn-primary me-2">Home</a>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark">Logout</button>
                    </form>
                
                @endauth
            </div>
        </div>
    </nav>

    <div class="row" style="margin-top: 80px;">
        <!-- Sidebar -->
        <div class="sidebar">
            <ul class="nav flex-column px-3">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('blog') }}" class="nav-link text-white">
                        <i class="fas fa-newspaper me-2"></i> Kelola Blog Artikel
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('photo') }}" class="nav-link text-white">
                        <i class="fas fa-camera-retro me-2"></i> Kelola Foto
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tentang') }}" class="nav-link text-white">
                        <i class="fas fa-users me-2"></i> Kelola Profil
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('add_video') }}" class="nav-link text-white">
                        <i class="fas fa-video me-2"></i> Kelola Video
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content col">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Magnific Popup for image links
            $('.image-link').magnificPopup({ type: 'image' });

            // Initialize Summernote editors
            $('#summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        // Close modal when image is uploaded
                        $('.modal-backdrop').remove();
                    }
                }
            });

            $('#vision').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        // Close modal when image is uploaded
                        $('.modal-backdrop').remove();
                    }
                }
            });

            $('#mission').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        // Close modal when image is uploaded
                        $('.modal-backdrop').remove();
                    }
                }
            });
        });
    </script>
</body>

</html>
