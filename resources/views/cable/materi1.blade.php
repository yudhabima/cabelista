<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Materi Cabelista</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
        
        @keyframes ping {
            75%, 100% {
                transform: scale(2);
                opacity: 0;
            }
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        .animate-ping {
            animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
        
        .animate-slideIn {
            animation: slideIn 0.5s ease-out forwards;
        }
        
        .tooltip {
            position: absolute;
            z-index: 50;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .tooltip.active {
            opacity: 1;
        }
        
        .bg-clip-text {
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .quiz-option {
            transition: all 0.3s ease;
        }
        
        .quiz-option:hover {
            transform: translateX(8px);
        }
        
        .quiz-option.correct {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border-color: #059669;
        }
        
        .quiz-option.wrong {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border-color: #dc2626;
        }
        
        .content-section {
            display: none;
        }
        
        .content-section.active {
            display: block;
        }
        
        .step-indicator {
            transition: all 0.3s ease;
        }
        
        .step-indicator.completed {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        
        .step-indicator.active {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            transform: scale(1.1);
        }

        .logo img {
            height: 45px; /* ukuran logo */
            width: auto;
            display: block;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-green-50 min-h-screen">
    <div class="p-4">
        <!-- Top Bar -->
        <div class="bg-white rounded-2xl shadow-xl p-4 mb-4 border-b-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                        <div class="logo">
                 <img src="/assets/img/logo-cabelista.png" alt="Logo Cabelista">
                    </div>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-xl p-3 shadow-md">
                        <div class="flex items-center gap-2">
                            <i data-lucide="zap" class="text-white" style="width: 20px; height: 20px;"></i>
                            <div class="text-white">
                                <div class="text-xs font-medium">XP Points</div>
                                <div class="text-xl font-bold" id="xp-value">0</div>
                            </div>
                        </div>
                        <div class="w-32 bg-white/30 rounded-full h-1.5 mt-1">
                            <div class="bg-white h-full rounded-full transition-all" id="xp-bar" style="width: 0%"></div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl p-3 shadow-md">
                        <div class="flex items-center gap-2">
                            <i data-lucide="star" class="text-yellow-300" style="width: 20px; height: 20px;"></i>
                            <div class="text-white">
                                <div class="text-xs font-medium">Skor Total</div>
                                <div class="text-xl font-bold" id="score-value">0</div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-gray-100">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-4">
            <!-- Left Sidebar -->
            <div class="w-72 space-y-4">
                <div class="bg-white rounded-2xl shadow-xl p-5 border-t-4 border-blue-500">
                    <div class="flex items-center gap-2 mb-4">
                        <h3 class="font-bold text-lg text-gray-800">Jalur Pembelajaran</h3>
                    </div>
                    <div class="space-y-3" id="learning-path">
                        <!-- Level items will be inserted here -->
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1">
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-purple-500">
                    <div class="text-center mb-6">
                        <div class="inline-block bg-blue-100 px-4 py-2 rounded-full mb-3">
                            <span class="text-blue-700 font-semibold text-sm">Pengenalan Kabel UTP</span>
                        </div>
                        <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                            Mengenal Kabel UTP
                        </h2>
                        <p class="text-gray-600">Unshielded Twisted Pair - Standar Kabel Jaringan Komputer</p>
                    </div>

                    <!-- Section 1: Introduction -->
                    <div id="section-1" class="content-section active animate-slideIn">
                        <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 mb-6 border-2 border-blue-200">
                            <div class="flex items-start gap-4">
                                <div class="bg-blue-500 p-3 rounded-xl">
                                    <i data-lucide="graduation-cap" class="text-white" style="width: 32px; height: 32px;"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-blue-900 mb-3">Apa itu Kabel UTP?</h3>
                                    <p class="text-gray-700 mb-3 leading-relaxed">
                                        <strong>UTP (Unshielded Twisted Pair)</strong> adalah jenis kabel jaringan yang paling umum digunakan dalam instalasi jaringan komputer lokal (LAN). 
                                        Kabel ini terdiri dari <strong>4 pasang kabel tembaga</strong> yang saling dipilin (twisted) untuk mengurangi interferensi elektromagnetik.
                                    </p>
                                    <div class="bg-white rounded-lg p-4 mb-3">
                                        <p class="text-sm text-gray-700 mb-2"><strong>Karakteristik Utama:</strong></p>
                                        <ul class="space-y-2 text-sm text-gray-600">
                                            <li class="flex items-start gap-2">
                                                <span class="text-blue-500">✓</span>
                                                <span><strong>Tidak memiliki pelindung metal</strong> (unshielded) sehingga lebih fleksibel dan murah</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <span class="text-blue-500">✓</span>
                                                <span><strong>Menggunakan konektor RJ-45</strong> untuk menghubungkan perangkat</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <span class="text-blue-500">✓</span>
                                                <span><strong>Panjang maksimal efektif 100 meter</strong> untuk menjaga kualitas sinyal</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <span class="text-blue-500">✓</span>
                                                <span><strong>Digunakan untuk koneksi Ethernet</strong> (10 Mbps hingga 10 Gbps)</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-4 rounded-xl border-2 border-green-200">
                                <div class="text-3xl mb-2">🌐</div>
                                <h4 class="font-bold text-green-900 mb-1">Aplikasi</h4>
                                <p class="text-xs text-green-700">Jaringan LAN, telepon, CCTV, sistem keamanan</p>
                            </div>
                            <div class="bg-gradient-to-br from-orange-50 to-amber-50 p-4 rounded-xl border-2 border-orange-200">
                                <div class="text-3xl mb-2">💰</div>
                                <h4 class="font-bold text-orange-900 mb-1">Ekonomis</h4>
                                <p class="text-xs text-orange-700">Harga terjangkau dan mudah dipasang</p>
                            </div>
                            <div class="bg-gradient-to-br from-purple-50 to-violet-50 p-4 rounded-xl border-2 border-purple-200">
                                <div class="text-3xl mb-2">⚡</div>
                                <h4 class="font-bold text-purple-900 mb-1">Performa</h4>
                                <p class="text-xs text-purple-700">Mendukung hingga 10 Gbps (Cat6a)</p>
                            </div>
                        </div>

                        <button onclick="nextSection(2)" class="w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold text-lg hover:shadow-xl transition-all hover:scale-105 flex items-center justify-center gap-2">
                            Lanjutkan ke Struktur Kabel
                            <i data-lucide="chevron-right" style="width: 24px; height: 24px;"></i>
                        </button>
                    </div>

                    <!-- Section 2: Cable Structure -->
                    <div id="section-2" class="content-section">
                        <div class="bg-gradient-to-b from-gray-50 to-gray-100 rounded-2xl p-8 mb-6">
                            <div class="text-center mb-8">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Struktur Kabel UTP</h3>
                                <p class="text-sm text-gray-600">Klik pada setiap bagian untuk melihat penjelasan detail</p>
                            </div>

                            <!-- Cable Illustration -->
                            <div class="relative flex items-center justify-center mb-8">
                                <!-- Outer Jacket - Left -->
                                <div class="relative cursor-pointer transition-all hover:scale-105" data-part="jacket">
                                    <div class="w-32 h-24 bg-gradient-to-r from-gray-600 to-gray-700 rounded-l-full flex items-center justify-center shadow-lg">
                                        <span class="text-white font-bold text-xs">JACKET</span>
                                    </div>
                                </div>

                                <!-- Inner Wires -->
                                <div class="relative flex flex-col gap-1 bg-gray-200 px-6 py-4 shadow-inner">
                                    <div class="flex gap-1 cursor-pointer transition-all hover:scale-110" data-part="pair1">
                                        <div class="w-4 h-4 rounded-full bg-orange-200 border-2 border-orange-500 shadow-md"></div>
                                        <div class="w-4 h-4 rounded-full bg-orange-500 border-2 border-orange-700 shadow-md"></div>
                                    </div>
                                    <div class="flex gap-1 cursor-pointer transition-all hover:scale-110" data-part="pair2">
                                        <div class="w-4 h-4 rounded-full bg-green-200 border-2 border-green-500 shadow-md"></div>
                                        <div class="w-4 h-4 rounded-full bg-green-500 border-2 border-green-700 shadow-md"></div>
                                    </div>
                                    <div class="flex gap-1 cursor-pointer transition-all hover:scale-110" data-part="pair3">
                                        <div class="w-4 h-4 rounded-full bg-blue-200 border-2 border-blue-500 shadow-md"></div>
                                        <div class="w-4 h-4 rounded-full bg-blue-500 border-2 border-blue-700 shadow-md"></div>
                                    </div>
                                    <div class="flex gap-1 cursor-pointer transition-all hover:scale-110" data-part="pair4">
                                        <div class="w-4 h-4 rounded-full bg-amber-200 border-2 border-amber-700 shadow-md"></div>
                                        <div class="w-4 h-4 rounded-full bg-amber-800 border-2 border-amber-900 shadow-md"></div>
                                    </div>
                                </div>

                                <!-- Outer Jacket - Right -->
                                <div class="relative cursor-pointer transition-all hover:scale-105" data-part="copper">
                                    <div class="w-32 h-24 bg-gradient-to-l from-gray-600 to-gray-700 rounded-r-full flex items-center justify-center shadow-lg">
                                        <span class="text-white font-bold text-xs">COPPER</span>
                                    </div>
                                </div>

                                <!-- Tooltips -->
                                <div id="tooltip-jacket" class="tooltip absolute bg-gray-800 text-white p-3 rounded-lg shadow-xl w-64" style="display: none;">
                                    <div class="font-bold mb-1">Jacket (Pelindung Luar)</div>
                                    <div class="text-xs">Lapisan plastik PVC yang melindungi kabel dari kerusakan fisik, kelembaban, dan faktor lingkungan</div>
                                </div>
                                <div id="tooltip-pair1" class="tooltip absolute bg-orange-600 text-white p-3 rounded-lg shadow-xl w-64" style="display: none;">
                                    <div class="font-bold mb-1">Twisted Pair 1 (Orange)</div>
                                    <div class="text-xs">Pasangan pertama untuk transmit data (TX). Pilinan mengurangi crosstalk dan EMI</div>
                                </div>
                                <div id="tooltip-pair2" class="tooltip absolute bg-green-600 text-white p-3 rounded-lg shadow-xl w-64" style="display: none;">
                                    <div class="font-bold mb-1">Twisted Pair 2 (Green)</div>
                                    <div class="text-xs">Pasangan kedua untuk receive data (RX). Konsistensi pilinan penting untuk kualitas sinyal</div>
                                </div>
                                <div id="tooltip-pair3" class="tooltip absolute bg-blue-600 text-white p-3 rounded-lg shadow-xl w-64" style="display: none;">
                                    <div class="font-bold mb-1">Twisted Pair 3 (Blue)</div>
                                    <div class="text-xs">Pasangan ketiga untuk komunikasi bidirectional pada Gigabit Ethernet</div>
                                </div>
                                <div id="tooltip-pair4" class="tooltip absolute bg-amber-800 text-white p-3 rounded-lg shadow-xl w-64" style="display: none;">
                                    <div class="font-bold mb-1">Twisted Pair 4 (Brown)</div>
                                    <div class="text-xs">Pasangan keempat, total 8 kabel dalam 4 pasang twisted pair untuk transmisi full-duplex</div>
                                </div>
                                <div id="tooltip-copper" class="tooltip absolute bg-gray-800 text-white p-3 rounded-lg shadow-xl w-64" style="display: none;">
                                    <div class="font-bold mb-1">Copper Wire (Kawat Tembaga)</div>
                                    <div class="text-xs">Inti konduktor dari tembaga murni dengan diameter 0.4-0.6mm untuk transmisi sinyal listrik</div>
                                </div>
                            </div>

                            <!-- Legend -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white p-4 rounded-xl shadow-md border-2 border-gray-200">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-6 h-6 rounded-full bg-gray-600"></div>
                                        <span class="font-bold text-sm text-gray-800">Outer Jacket</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Pelindung luar dari PVC atau LSZH (Low Smoke Zero Halogen) untuk keamanan dan durabilitas</p>
                                </div>
                                <div class="bg-white p-4 rounded-xl shadow-md border-2 border-gray-200">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="flex gap-1">
                                            <div class="w-3 h-6 rounded bg-orange-500"></div>
                                            <div class="w-3 h-6 rounded bg-green-500"></div>
                                            <div class="w-3 h-6 rounded bg-blue-500"></div>
                                            <div class="w-3 h-6 rounded bg-amber-800"></div>
                                        </div>
                                        <span class="font-bold text-sm text-gray-800">4 Twisted Pairs</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Masing-masing pair memiliki jumlah pilinan per inch yang berbeda untuk meminimalkan interferensi</p>
                                </div>
                            </div>
                        </div>

                        <button onclick="nextSection(3)" class="w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold text-lg hover:shadow-xl transition-all hover:scale-105 flex items-center justify-center gap-2">
                            Lanjutkan ke Fungsi Twisted Pair
                            <i data-lucide="chevron-right" style="width: 24px; height: 24px;"></i>
                        </button>
                    </div>

                    <!-- Section 3: Twisted Pair Function -->
                    <div id="section-3" class="content-section">
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 mb-6 border-2 border-green-200">
                            <div class="flex items-start gap-4 mb-6">
                                <div class="bg-green-500 p-3 rounded-xl">
                                    <i data-lucide="zap" class="text-white" style="width: 32px; height: 32px;"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-green-900 mb-3">Mengapa Kabel Harus "Twisted" (Dipilin)?</h3>
                                    <p class="text-gray-700 leading-relaxed mb-4">
                                        Pilinan pada kabel UTP bukan hanya desain estetika, tetapi merupakan solusi teknis yang sangat penting untuk mengatasi masalah interferensi elektromagnetik dalam transmisi data.
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-white rounded-xl p-5 shadow-md">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="bg-red-100 p-2 rounded-lg">
                                            <i data-lucide="alert-triangle" class="text-red-600" style="width: 20px; height: 20px;"></i>
                                        </div>
                                        <h4 class="font-bold text-gray-800">Masalah: EMI & Crosstalk</h4>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">
                                        <strong>EMI (Electromagnetic Interference):</strong> Gangguan dari perangkat listrik lain yang menghasilkan medan elektromagnetik
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <strong>Crosstalk:</strong> Interferensi antara pasangan kabel yang berdekatan dalam satu bundle
                                    </p>
                                </div>

                                <div class="bg-white rounded-xl p-5 shadow-md">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="bg-green-100 p-2 rounded-lg">
                                            <i data-lucide="shield-check" class="text-green-600" style="width: 20px; height: 20px;"></i>
                                        </div>
                                        <h4 class="font-bold text-gray-800">Solusi: Twisted Pair</h4>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">
                                        <strong>Noise Cancellation:</strong> Pilinan membuat noise yang ditangkap kedua kabel saling membatalkan (canceling effect)
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <strong>Balanced Transmission:</strong> Sinyal differential yang stabil dan tahan terhadap gangguan eksternal
                                    </p>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl p-5 shadow-md mb-4">
                                <h4 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                    <i data-lucide="info" class="text-blue-500" style="width: 20px; height: 20px;"></i>
                                    Fakta Menarik tentang Pilinan
                                </h4>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-start gap-2">
                                        <span class="text-green-500 font-bold">•</span>
                                        <span>Kabel Cat5e memiliki rata-rata <strong>1.5-2 pilinan per inch</strong>, sedangkan Cat6 memiliki lebih banyak untuk performa lebih baik</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-green-500 font-bold">•</span>
                                        <span>Teknologi twisted pair pertama kali dipatenkan oleh <strong>Alexander Graham Bell pada tahun 1881</strong> untuk sistem telepon</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-green-500 font-bold">•</span>
                                        <span>Pilinan yang tepat dapat <strong>mengurangi noise hingga 60-70 dB</strong>, meningkatkan kualitas transmisi secara signifikan</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <button onclick="nextSection(4)" class="w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold text-lg hover:shadow-xl transition-all hover:scale-105 flex items-center justify-center gap-2">
                            Lanjutkan ke Kategori Kabel
                            <i data-lucide="chevron-right" style="width: 24px; height: 24px;"></i>
                        </button>
                    </div>

                    <!-- Section 4: Cable Categories -->
                    <div id="section-4" class="content-section">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Kategori Kabel UTP</h3>
                            <p class="text-gray-600 mb-6">Kabel UTP memiliki berbagai kategori berdasarkan bandwidth dan kecepatan transmisi data. Semakin tinggi kategori, semakin baik performanya.</p>
                            
                            <div class="space-y-4">
                                <!-- Cat5 -->
                                <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-gray-400">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-800 mb-2">Cat5 (Category 5)</h4>
                                            <div class="space-y-1 text-sm">
                                                <p class="text-gray-600"><strong>Bandwidth:</strong> 100 MHz</p>
                                                <p class="text-gray-600"><strong>Kecepatan:</strong> Hingga 100 Mbps</p>
                                                <p class="text-gray-600"><strong>Status:</strong> <span class="text-orange-600">Sudah usang, jarang digunakan</span></p>
                                                <p class="text-gray-600"><strong>Aplikasi:</strong> Jaringan Fast Ethernet lama</p>
                                            </div>
                                        </div>
                                        <div class="text-4xl">📊</div>
                                    </div>
                                </div>

                                <!-- Cat5e -->
                                <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-blue-500">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <h4 class="text-lg font-bold text-gray-800">Cat5e (Category 5 Enhanced)</h4>
                                                <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-semibold">Paling Populer</span>
                                            </div>
                                            <div class="space-y-1 text-sm">
                                                <p class="text-gray-600"><strong>Bandwidth:</strong> 100 MHz</p>
                                                <p class="text-gray-600"><strong>Kecepatan:</strong> Hingga 1 Gbps (Gigabit Ethernet)</p>
                                                <p class="text-gray-600"><strong>Status:</strong> <span class="text-green-600">Standar industri untuk rumah dan kantor</span></p>
                                                <p class="text-gray-600"><strong>Aplikasi:</strong> Jaringan LAN, VoIP, CCTV IP</p>
                                                <p class="text-gray-600"><strong>Keunggulan:</strong> Harga terjangkau, performa bagus untuk kebutuhan umum</p>
                                            </div>
                                        </div>
                                        <div class="text-4xl">⭐</div>
                                    </div>
                                </div>

                                <!-- Cat6 -->
                                <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-purple-500">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <h4 class="text-lg font-bold text-gray-800">Cat6 (Category 6)</h4>
                                                <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full font-semibold">Recommended</span>
                                            </div>
                                            <div class="space-y-1 text-sm">
                                                <p class="text-gray-600"><strong>Bandwidth:</strong> 250 MHz</p>
                                                <p class="text-gray-600"><strong>Kecepatan:</strong> Hingga 10 Gbps (jarak hingga 55m)</p>
                                                <p class="text-gray-600"><strong>Status:</strong> <span class="text-green-600">Standar modern untuk instalasi baru</span></p>
                                                <p class="text-gray-600"><strong>Aplikasi:</strong> Data center, server room, gaming, streaming 4K</p>
                                                <p class="text-gray-600"><strong>Keunggulan:</strong> Crosstalk lebih rendah, future-proof</p>
                                            </div>
                                        </div>
                                        <div class="text-4xl">🚀</div>
                                    </div>
                                </div>

                                <!-- Cat6a -->
                                <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-green-500">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-800 mb-2">Cat6a (Category 6 Augmented)</h4>
                                            <div class="space-y-1 text-sm">
                                                <p class="text-gray-600"><strong>Bandwidth:</strong> 500 MHz</p>
                                                <p class="text-gray-600"><strong>Kecepatan:</strong> Hingga 10 Gbps (jarak penuh 100m)</p>
                                                <p class="text-gray-600"><strong>Status:</strong> <span class="text-green-600">Enterprise level, instalasi profesional</span></p>
                                                <p class="text-gray-600"><strong>Aplikasi:</strong> Data center besar, backbone network, PoE++</p>
                                                <p class="text-gray-600"><strong>Keunggulan:</strong> Performa maksimal, shielding lebih baik</p>
                                            </div>
                                        </div>
                                        <div class="text-4xl">💎</div>
                                    </div>
                                </div>

                                <!-- Cat7 -->
                                <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-yellow-500">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-800 mb-2">Cat7 (Category 7)</h4>
                                            <div class="space-y-1 text-sm">
                                                <p class="text-gray-600"><strong>Bandwidth:</strong> 600 MHz</p>
                                                <p class="text-gray-600"><strong>Kecepatan:</strong> Hingga 10 Gbps</p>
                                                <p class="text-gray-600"><strong>Status:</strong> <span class="text-orange-600">Specialized, tidak standar TIA/EIA</span></p>
                                                <p class="text-gray-600"><strong>Aplikasi:</strong> Instalasi khusus dengan interferensi tinggi</p>
                                                <p class="text-gray-600"><strong>Catatan:</strong> Memiliki shielding (bukan UTP murni)</p>
                                            </div>
                                        </div>
                                        <div class="text-4xl">🔒</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 rounded-xl p-5 mb-6 border-2 border-blue-200">
                            <h4 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
                                <i data-lucide="lightbulb" class="text-yellow-500" style="width: 20px; height: 20px;"></i>
                                Rekomendasi Pemilihan Kabel
                            </h4>
                            <ul class="space-y-2 text-sm text-blue-800">
                                <li class="flex items-start gap-2">
                                    <span>🏠</span>
                                    <span><strong>Rumah/Kantor Kecil:</strong> Cat5e sudah cukup untuk kebutuhan internet hingga 1 Gbps</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span>🏢</span>
                                    <span><strong>Kantor/Bisnis:</strong> Cat6 untuk instalasi baru, lebih tahan lama dan future-proof</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span>🏭</span>
                                    <span><strong>Data Center/Enterprise:</strong> Cat6a untuk performa maksimal dan jarak penuh 100m pada 10 Gbps</span>
                                </li>
                            </ul>
                        </div>

                        <button onclick="nextSection(5)" class="w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold text-lg hover:shadow-xl transition-all hover:scale-105 flex items-center justify-center gap-2">
                            Lanjutkan ke Kuis Akhir
                            <i data-lucide="chevron-right" style="width: 24px; height: 24px;"></i>
                        </button>
                    </div>

                    <!-- Section 5: Quiz -->
                    <div id="section-5" class="content-section">
                        <div class="text-center mb-6">
                            <div class="inline-block bg-yellow-100 px-4 py-2 rounded-full mb-3">
                                <span class="text-yellow-700 font-semibold text-sm">🎯 Kuis Pemahaman</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Uji Pemahaman Anda</h3>
                            <p class="text-gray-600">Jawab pertanyaan berikut untuk menyelesaikan materi ini</p>
                        </div>

                        <div id="quiz-container" class="space-y-6">
                            <!-- Question 1 -->
                            <div class="bg-white rounded-xl p-6 shadow-md border-2 border-gray-200" data-question="1">
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="bg-blue-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold flex-shrink-0">1</div>
                                    <p class="text-gray-800 font-semibold">Apa kepanjangan dari UTP?</p>
                                </div>
                                <div class="space-y-2 ml-11">
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">A. Universal Twisted Protocol</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="correct">
                                        <span class="text-gray-700">B. Unshielded Twisted Pair</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">C. Ultra Transmission Pair</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">D. Unified Telecommunication Protocol</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Question 2 -->
                            <div class="bg-white rounded-xl p-6 shadow-md border-2 border-gray-200" data-question="2">
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="bg-blue-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold flex-shrink-0">2</div>
                                    <p class="text-gray-800 font-semibold">Berapa jumlah pasangan kabel (twisted pair) dalam kabel UTP?</p>
                                </div>
                                <div class="space-y-2 ml-11">
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">A. 2 pasang (4 kabel)</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="correct">
                                        <span class="text-gray-700">B. 4 pasang (8 kabel)</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">C. 6 pasang (12 kabel)</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">D. 8 pasang (16 kabel)</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Question 3 -->
                            <div class="bg-white rounded-xl p-6 shadow-md border-2 border-gray-200" data-question="3">
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="bg-blue-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold flex-shrink-0">3</div>
                                    <p class="text-gray-800 font-semibold">Apa fungsi utama pilinan (twist) pada kabel UTP?</p>
                                </div>
                                <div class="space-y-2 ml-11">
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">A. Membuat kabel lebih kuat dan tahan lama</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="correct">
                                        <span class="text-gray-700">B. Mengurangi interferensi elektromagnetik (EMI) dan crosstalk</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">C. Membuat instalasi lebih mudah dan fleksibel</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">D. Meningkatkan estetika penampilan kabel</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Question 4 -->
                            <div class="bg-white rounded-xl p-6 shadow-md border-2 border-gray-200" data-question="4">
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="bg-blue-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold flex-shrink-0">4</div>
                                    <p class="text-gray-800 font-semibold">Berapa panjang maksimal efektif kabel UTP untuk menjaga kualitas sinyal?</p>
                                </div>
                                <div class="space-y-2 ml-11">
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">A. 50 meter</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">B. 75 meter</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="correct">
                                        <span class="text-gray-700">C. 100 meter</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">D. 150 meter</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Question 5 -->
                            <div class="bg-white rounded-xl p-6 shadow-md border-2 border-gray-200" data-question="5">
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="bg-blue-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold flex-shrink-0">5</div>
                                    <p class="text-gray-800 font-semibold">Kategori kabel UTP mana yang paling umum digunakan untuk jaringan Gigabit Ethernet di rumah dan kantor?</p>
                                </div>
                                <div class="space-y-2 ml-11">
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">A. Cat5</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="correct">
                                        <span class="text-gray-700">B. Cat5e</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">C. Cat6a</span>
                                    </div>
                                    <div class="quiz-option p-3 rounded-lg border-2 border-gray-300 cursor-pointer hover:border-blue-500 hover:bg-blue-50" data-answer="wrong">
                                        <span class="text-gray-700">D. Cat7</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="quiz-result" class="mt-6" style="display: none;">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl p-6 text-center text-white">
                                <i data-lucide="trophy" class="mx-auto mb-3" style="width: 48px; height: 48px;"></i>
                                <h3 class="text-2xl font-bold mb-2">Selamat!</h3>
                                <p class="text-lg mb-4">Skor Anda: <span id="final-score" class="font-bold">0</span>/5</p>
                                <p class="mb-4">Anda telah menyelesaikan semuanya dan siap melanjutkan ke perjalanan selanjutnya!</p>
                                <button class="px-6 py-2 rounded-lg font-medium bg-blue-500 hover:bg-blue-600 transition shadow-lg border border-blue-400">
                                    <a href="{{ url('/') }}">Finish</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full sm:w-72 md:w-80">
<div class="bg-white rounded-2xl shadow-xl p-5 border-t-4 border-green-500">

    <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
        <i data-lucide="info" class="text-green-500" style="width: 20px; height: 20px;"></i>
        Progres Level
    </h3>

    <!-- Progress Bar -->
    <div class="mb-3">
        <div class="flex justify-between text-sm mb-2">
            <span class="text-gray-600">Penyelesaian</span>
            <span class="text-green-600 font-bold" id="progress-percentage">0%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
            <div
                class="bg-gradient-to-r from-green-400 to-green-600 h-full transition-all duration-500"
                id="progress-bar"
                style="width: 0%">
            </div>
        </div>
    </div>

    <!-- Step Indicators -->
    <div class="mt-4 space-y-2">
        <div class="text-xs font-semibold text-gray-600 mb-2">
            Langkah Pembelajaran:
        </div>

        <div class="flex items-center gap-2">
            <div class="step-indicator w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-white text-xs font-bold" data-step="1">1</div>
            <div class="flex-1 h-1 bg-gray-300"></div>
        </div>

        <div class="flex items-center gap-2">
            <div class="step-indicator w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-white text-xs font-bold" data-step="2">2</div>
            <div class="flex-1 h-1 bg-gray-300"></div>
        </div>

        <div class="flex items-center gap-2">
            <div class="step-indicator w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-white text-xs font-bold" data-step="3">3</div>
            <div class="flex-1 h-1 bg-gray-300"></div>
        </div>

        <div class="flex items-center gap-2">
            <div class="step-indicator w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-white text-xs font-bold" data-step="4">4</div>
            <div class="flex-1 h-1 bg-gray-300"></div>
        </div>

        <div class="flex items-center gap-2">
            <div class="step-indicator w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-white text-xs font-bold" data-step="5">5</div>
        </div>
    </div>

    <!-- Divider -->
    <div class="my-4 border-t border-dashed border-gray-300"></div>

    <!-- Tips Box (DIBERI BATAS) -->
    <div class="text-xs text-gray-600 bg-blue-50 p-3 rounded-lg border border-blue-200 max-h-24 overflow-auto">
        💡 <span class="font-semibold">Tips:</span>
        Klik pada bagian kabel dan jawab kuis untuk melanjutkan!
    </div>

</div>

        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Application State
        const state = {
            score: 0,
            xp: 0,
            currentSection: 1,
            quizAnswers: [false, false, false, false, false],
            completedSections: [false, false, false, false, false],
            levels: [
                { id: 1, name: 'Pengenalan', icon: '📚', status: 'active', desc: 'Dasar-dasar kabel UTP' },
                { id: 2, name: 'Urutan Warna', icon: '🎨', status: 'locked', desc: 'Standar pewarnaan' },
                { id: 3, name: 'Kabel Straight', icon: '🔌', status: 'locked', desc: 'Praktik T568B' },
                { id: 4, name: 'Kabel Cross', icon: '⚡', status: 'locked', desc: 'Koneksi berbeda' },
                { id: 5, name: 'Troubleshooting', icon: '🔧', status: 'locked', desc: 'Pemecahan masalah' }
            ],
            objectives: [
                { id: 1, text: 'Memahami definisi UTP', completed: false },
                { id: 2, text: 'Mengenali struktur kabel', completed: false },
                { id: 3, text: 'Memahami fungsi twisted pair', completed: false },
                { id: 4, text: 'Mengetahui kategori kabel', completed: false },
                { id: 5, text: 'Menyelesaikan kuis akhir', completed: false }
            ]
        };

        // Render Learning Path
        function renderLearningPath() {
            const container = document.getElementById('learning-path');
            container.innerHTML = state.levels.map((level, idx) => `
                <div class="relative">
                    ${idx > 0 ? `<div class="absolute left-6 -top-3 w-1 h-3 ${level.status === 'completed' ? 'bg-green-400' : 'bg-gray-300'}"></div>` : ''}
                    <div class="flex items-center gap-3 p-3 rounded-xl transition-all ${
                        level.status === 'active' ? 'bg-gradient-to-r from-blue-100 to-blue-50 border-2 border-blue-500 shadow-md scale-105' :
                        level.status === 'completed' ? 'bg-green-50 border-2 border-green-400 cursor-pointer hover:scale-105' :
                        'bg-gray-50 border-2 border-gray-200 opacity-60'
                    }">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow-md ${
                            level.status === 'active' ? 'bg-gradient-to-br from-blue-500 to-blue-600' :
                            level.status === 'completed' ? 'bg-gradient-to-br from-green-500 to-green-600' :
                            'bg-gray-300'
                        }">
                            ${level.status === 'completed' ? '✓' : level.icon}
                        </div>
                        <div class="flex-1">
                            <div class="font-bold text-sm text-gray-800">${level.name}</div>
                            <div class="text-xs text-gray-500">${level.desc}</div>
                        </div>
                        ${level.status === 'active' ? '<div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>' : ''}
                    </div>
                </div>
            `).join('');
        }

        // Render Objectives
        function renderObjectives() {
            const container = document.getElementById('objectives-list');
            container.innerHTML = state.objectives.map(obj => `
                <div class="flex items-center gap-2 p-2 rounded-lg transition-all ${
                    obj.completed ? 'bg-green-100 text-green-700' : 'bg-white text-gray-500'
                }">
                    ${obj.completed 
                        ? '<i data-lucide="check-circle" class="text-green-600" style="width: 16px; height: 16px;"></i>'
                        : '<div class="w-4 h-4 border-2 border-gray-400 rounded-full"></div>'
                    }
                    <span>${obj.text}</span>
                </div>
            `).join('');
            lucide.createIcons();
        }

        // Update Progress
        function updateProgress() {
            const completedCount = state.objectives.filter(o => o.completed).length;
            const percentage = (completedCount / 5) * 100;
            
            document.getElementById('progress-percentage').textContent = Math.round(percentage) + '%';
            document.getElementById('progress-bar').style.width = percentage + '%';
            
            renderObjectives();
            
            // Update step indicators
            for (let i = 1; i <= 5; i++) {
                const step = document.querySelector(`[data-step="${i}"]`);
                if (i < state.currentSection) {
                    step.classList.add('completed');
                    step.classList.remove('active');
                } else if (i === state.currentSection) {
                    step.classList.add('active');
                    step.classList.remove('completed');
                } else {
                    step.classList.remove('completed', 'active');
                }
            }
            
            // Check if all completed
            if (state.objectives.every(o => o.completed)) {
                document.getElementById('mission-complete').style.display = 'block';
            }
        }

        // Update Score and XP
        function updateScore(points, xp) {
            state.score += points;
            state.xp += xp;
            
            document.getElementById('score-value').textContent = state.score;
            document.getElementById('xp-value').textContent = state.xp;
            
            const xpPercentage = (state.xp % 100) / 10;
            document.getElementById('xp-bar').style.width = xpPercentage + '%';
            
        }

        // Next Section
        function nextSection(sectionNum) {
            // Hide current section
            document.getElementById(`section-${state.currentSection}`).classList.remove('active');
            
            // Mark objective as completed
            if (state.currentSection <= 5) {
                state.objectives[state.currentSection - 1].completed = true;
                state.completedSections[state.currentSection - 1] = true;
                updateScore(100, 60);
            }
            
            // Show next section
            state.currentSection = sectionNum;
            document.getElementById(`section-${sectionNum}`).classList.add('active');
            document.getElementById(`section-${sectionNum}`).classList.add('animate-slideIn');
            
            updateProgress();
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Handle Cable Part Interaction
        document.querySelectorAll('[data-part]').forEach(element => {
            const part = element.getAttribute('data-part');
            const tooltip = document.getElementById('tooltip-' + part);
            
            if (tooltip) {
                element.addEventListener('mouseenter', (e) => {
                    tooltip.style.display = 'block';
                    tooltip.classList.add('active');
                    
                    const rect = element.getBoundingClientRect();
                    tooltip.style.left = (rect.left + rect.width / 2 - 128) + 'px';
                    tooltip.style.top = (rect.top - 80) + 'px';
                });
                
                element.addEventListener('mouseleave', () => {
                    tooltip.classList.remove('active');
                    setTimeout(() => {
                        tooltip.style.display = 'none';
                    }, 300);
                });
            }
        });

        // Quiz Functionality
        let correctAnswers = 0;
        const answeredQuestions = new Set();
        
        document.querySelectorAll('.quiz-option').forEach(option => {
            option.addEventListener('click', function() {
                const questionDiv = this.closest('[data-question]');
                const questionNum = questionDiv.getAttribute('data-question');
                
                // Prevent re-answering
                if (answeredQuestions.has(questionNum)) return;
                
                const isCorrect = this.getAttribute('data-answer') === 'correct';
                const allOptions = questionDiv.querySelectorAll('.quiz-option');
                
                // Disable all options in this question
                allOptions.forEach(opt => {
                    opt.style.pointerEvents = 'none';
                    if (opt.getAttribute('data-answer') === 'correct') {
                        opt.classList.add('correct');
                    } else if (opt === this && !isCorrect) {
                        opt.classList.add('wrong');
                    }
                });
                
                answeredQuestions.add(questionNum);
                
                if (isCorrect) {
                    correctAnswers++;
                    updateScore(100, 60);
                }
                
                // Check if all questions answered
                if (answeredQuestions.size === 5) {
                    setTimeout(() => {
                        showQuizResult();
                    }, 1000);
                }
            });
        });

        function showQuizResult() {
            document.getElementById('final-score').textContent = correctAnswers;
            document.getElementById('quiz-result').style.display = 'block';
            
            // Mark quiz objective as completed
            state.objectives[4].completed = true;
            updateProgress();
            
            // Scroll to result
            document.getElementById('quiz-result').scrollIntoView({ behavior: 'smooth' });
        }

        function completeLevel() {
            alert('Selamat! Anda telah menyelesaikan Level 1: Pengenalan Kabel UTP.\n\nLevel 2: Urutan Warna akan segera dibuka!');
            // Here you can redirect to Level 2 or update the state
            state.levels[0].status = 'completed';
            state.levels[1].status = 'active';
            renderLearningPath();
        }

        // Initialize
        renderLearningPath();
        renderObjectives();
        updateProgress();
    </script>
</body>
</html>