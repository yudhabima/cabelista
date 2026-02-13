<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lab Virtual Jaringan - Level 2: Urutan Warna Kabel</title>
    
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
        
        @keyframes bounce {
            0%, 100% {
                transform: translateY(-5%);
            }
            50% {
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
        
        .animate-bounce {
            animation: bounce 1s ease-in-out infinite;
        }
        
        .wire-slot {
            transition: all 0.3s ease;
        }
        
        .wire-slot:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }
        
        .wire-item {
            cursor: grab;
            transition: all 0.3s ease;
        }
        
        .wire-item:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        
        .wire-item.dragging {
            opacity: 0.5;
            cursor: grabbing;
        }
        
        .wire-slot.over {
            background: rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
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
        
        .bg-clip-text {
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .pin-label {
            font-size: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-green-50 min-h-screen">
    <div class="p-4">
        <!-- Top Bar -->
        <div class="bg-white rounded-2xl shadow-xl p-4 mb-4 border-b-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-3 rounded-xl">
                        <i data-lucide="zap" class="text-yellow-300" style="width: 28px; height: 28px;"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            Lab Virtual Jaringan
                        </h1>
                        <p class="text-xs text-gray-500">Platform Pembelajaran Interaktif TKJ</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-xl p-3 shadow-md">
                        <div class="flex items-center gap-2">
                            <i data-lucide="zap" class="text-white" style="width: 20px; height: 20px;"></i>
                            <div class="text-white">
                                <div class="text-xs font-medium">XP Points</div>
                                <div class="text-xl font-bold" id="xp-value">500</div>
                            </div>
                        </div>
                        <div class="w-32 bg-white/30 rounded-full h-1.5 mt-1">
                            <div class="bg-white h-full rounded-full transition-all" id="xp-bar" style="width: 50%"></div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl p-3 shadow-md">
                        <div class="flex items-center gap-2">
                            <i data-lucide="star" class="text-yellow-300" style="width: 20px; height: 20px;"></i>
                            <div class="text-white">
                                <div class="text-xs font-medium">Skor Total</div>
                                <div class="text-xl font-bold" id="score-value">800</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-2xl shadow-lg bg-gradient-to-br from-yellow-400 to-orange-500 scale-100" id="badge-1" title="Pemula">
                            🥉
                        </div>
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-2xl shadow-lg bg-gray-300 opacity-50 scale-90" id="badge-2" title="Ahli Warna">
                            🎨
                        </div>
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-2xl shadow-lg bg-gray-300 opacity-50 scale-90" id="badge-3" title="Master Kabel">
                            🏆
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 bg-gray-100 rounded-xl p-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md">
                            L2
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-gray-700">Siswa SMK</div>
                            <div class="text-xs text-gray-500">TKJ - Level 2</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-4">
            <!-- Left Sidebar -->
            <div class="w-72 space-y-4">
                <div class="bg-white rounded-2xl shadow-xl p-5 border-t-4 border-blue-500">
                    <div class="flex items-center gap-2 mb-4">
                        <i data-lucide="book-open" class="text-blue-600" style="width: 24px; height: 24px;"></i>
                        <h3 class="font-bold text-lg text-gray-800">Jalur Pembelajaran</h3>
                    </div>
                    <div class="space-y-3" id="learning-path"></div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-5 border-t-4 border-green-500">
                    <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <i data-lucide="info" class="text-green-500" style="width: 20px; height: 20px;"></i>
                        Progres Level
                    </h3>
                    <div class="mb-3">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Penyelesaian</span>
                            <span class="text-green-600 font-bold" id="progress-percentage">0%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-400 to-green-600 h-full transition-all duration-500" id="progress-bar" style="width: 0%"></div>
                        </div>
                    </div>
                    
                    <div class="mt-4 space-y-2">
                        <div class="text-xs font-semibold text-gray-600 mb-2">Langkah Pembelajaran:</div>
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
                        </div>
                    </div>
                    
                    <div class="text-xs text-gray-600 bg-blue-50 p-3 rounded-lg mt-4">
                        💡 <span class="font-semibold">Tips:</span> Tarik kabel ke slot yang sesuai dengan standar T568A/B!
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1">
                <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-purple-500">
                    <div class="text-center mb-6">
                        <div class="inline-block bg-orange-100 px-4 py-2 rounded-full mb-3">
                            <span class="text-orange-700 font-semibold text-sm">Level 2: Urutan Warna Kabel</span>
                        </div>
                        <h2 class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-pink-600 bg-clip-text text-transparent mb-2">
                            Standar Pengkabelan T568A & T568B
                        </h2>
                        <p class="text-gray-600">Pelajari urutan warna kabel yang benar untuk instalasi jaringan</p>
                    </div>

                    <!-- Section 1: Introduction to Standards -->
                    <div id="section-1" class="content-section active animate-slideIn">
                        <div class="bg-gradient-to-br from-orange-50 to-pink-50 rounded-2xl p-6 mb-6 border-2 border-orange-200">
                            <div class="flex items-start gap-4">
                                <div class="bg-orange-500 p-3 rounded-xl">
                                    <i data-lucide="palette" class="text-white" style="width: 32px; height: 32px;"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-orange-900 mb-3">Standar Pengkabelan TIA/EIA-568</h3>
                                    <p class="text-gray-700 mb-3 leading-relaxed">
                                        <strong>TIA/EIA-568</strong> adalah standar internasional untuk pengkabelan telekomunikasi komersial. 
                                        Standar ini mendefinisikan urutan warna kabel yang harus diikuti untuk memastikan kompatibilitas dan kinerja yang konsisten.
                                    </p>
                                    <div class="bg-white rounded-lg p-4 mb-3">
                                        <p class="text-sm text-gray-700 mb-2"><strong>Dua Standar Utama:</strong></p>
                                        <ul class="space-y-2 text-sm text-gray-600">
                                            <li class="flex items-start gap-2">
                                                <span class="text-orange-500 font-bold">•</span>
                                                <span><strong>T568A:</strong> Standar yang digunakan terutama di instalasi pemerintah dan beberapa negara Eropa</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <span class="text-orange-500 font-bold">•</span>
                                                <span><strong>T568B:</strong> Standar yang paling umum digunakan di industri komersial dan instalasi di Amerika Utara</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                                        <p class="text-sm text-yellow-800">
                                            <strong>⚠️ Penting:</strong> Kedua standar memberikan performa yang sama. Yang terpenting adalah konsistensi - gunakan standar yang sama di seluruh instalasi jaringan Anda!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-5 rounded-xl border-2 border-blue-200">
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="bg-blue-500 p-2 rounded-lg">
                                        <span class="text-white font-bold text-lg">A</span>
                                    </div>
                                    <h4 class="font-bold text-blue-900">T568A</h4>
                                </div>
                                <p class="text-xs text-blue-700 mb-2">Urutan: Hijau-Putih, Hijau, Orange-Putih, Biru, Biru-Putih, Orange, Coklat-Putih, Coklat</p>
                                <p class="text-xs text-blue-600"><strong>Penggunaan:</strong> Instalasi pemerintah, crossover cable</p>
                            </div>

                            <div class="bg-gradient-to-br from-orange-50 to-red-50 p-5 rounded-xl border-2 border-orange-200">
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="bg-orange-500 p-2 rounded-lg">
                                        <span class="text-white font-bold text-lg">B</span>
                                    </div>
                                    <h4 class="font-bold text-orange-900">T568B</h4>
                                </div>
                                <p class="text-xs text-orange-700 mb-2">Urutan: Orange-Putih, Orange, Hijau-Putih, Biru, Biru-Putih, Hijau, Coklat-Putih, Coklat</p>
                                <p class="text-xs text-orange-600"><strong>Penggunaan:</strong> Instalasi komersial, straight-through cable</p>
                            </div>
                        </div>

                        <button onclick="nextSection(2)" class="w-full py-4 bg-gradient-to-r from-orange-500 to-pink-500 text-white rounded-xl font-bold text-lg hover:shadow-xl transition-all hover:scale-105 flex items-center justify-center gap-2">
                            Pelajari Standar T568A
                            <i data-lucide="chevron-right" style="width: 24px; height: 24px;"></i>
                        </button>
                    </div>

                    <!-- Section 2: T568A Standard -->
                    <div id="section-2" class="content-section">
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-6 mb-6 border-2 border-blue-300">
                            <h3 class="text-2xl font-bold text-blue-900 mb-4 flex items-center gap-2">
                                <div class="bg-blue-500 px-3 py-1 rounded-lg text-white">A</div>
                                Standar T568A
                            </h3>
                            
                            <div class="bg-white rounded-xl p-6 mb-4 shadow-md">
                                <h4 class="font-bold text-gray-800 mb-4 text-center">Urutan Kabel T568A</h4>
                                <div class="flex justify-center gap-1 mb-4">
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg" style="background: linear-gradient(45deg, #4ade80 50%, #fff 50%); border: 2px solid #22c55e;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 1</span>
                                        <span class="text-xs text-gray-500">Hijau-Putih</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg bg-green-500" style="border: 2px solid #16a34a;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 2</span>
                                        <span class="text-xs text-gray-500">Hijau</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg" style="background: linear-gradient(45deg, #fb923c 50%, #fff 50%); border: 2px solid #f97316;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 3</span>
                                        <span class="text-xs text-gray-500">Orange-Putih</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg bg-blue-500" style="border: 2px solid #3b82f6;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 4</span>
                                        <span class="text-xs text-gray-500">Biru</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg" style="background: linear-gradient(45deg, #60a5fa 50%, #fff 50%); border: 2px solid #3b82f6;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 5</span>
                                        <span class="text-xs text-gray-500">Biru-Putih</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg bg-orange-500" style="border: 2px solid #ea580c;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 6</span>
                                        <span class="text-xs text-gray-500">Orange</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg" style="background: linear-gradient(45deg, #92400e 50%, #fff 50%); border: 2px solid #78350f;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 7</span>
                                        <span class="text-xs text-gray-500">Coklat-Putih</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg bg-amber-900" style="border: 2px solid #78350f;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 8</span>
                                        <span class="text-xs text-gray-500">Coklat</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-blue-100 rounded-xl p-4 mb-4 border-l-4 border-blue-500">
                                <h5 class="font-bold text-blue-900 mb-2">💡 Cara Mengingat T568A:</h5>
                                <p class="text-sm text-blue-800 mb-2"><strong>"Hijau duluan, Orange kemudian"</strong></p>
                                <ul class="text-sm text-blue-700 space-y-1">
                                    <li>• PIN 1-2: Pasangan Hijau (Hijau-Putih, Hijau)</li>
                                    <li>• PIN 3: Orange-Putih (terpisah)</li>
                                    <li>• PIN 4-5: Pasangan Biru (Biru, Biru-Putih)</li>
                                    <li>• PIN 6: Orange (melengkapi pasangan)</li>
                                    <li>• PIN 7-8: Pasangan Coklat (Coklat-Putih, Coklat)</li>
                                </ul>
                            </div>
                        </div>

                        <button onclick="nextSection(3)" class="w-full py-4 bg-gradient-to-r from-orange-500 to-pink-500 text-white rounded-xl font-bold text-lg hover:shadow-xl transition-all hover:scale-105 flex items-center justify-center gap-2">
                            Pelajari Standar T568B
                            <i data-lucide="chevron-right" style="width: 24px; height: 24px;"></i>
                        </button>
                    </div>

                    <!-- Section 3: T568B Standard -->
                    <div id="section-3" class="content-section">
                        <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-6 mb-6 border-2 border-orange-300">
                            <h3 class="text-2xl font-bold text-orange-900 mb-4 flex items-center gap-2">
                                <div class="bg-orange-500 px-3 py-1 rounded-lg text-white">B</div>
                                Standar T568B (Paling Umum)
                            </h3>
                            
                            <div class="bg-white rounded-xl p-6 mb-4 shadow-md">
                                <h4 class="font-bold text-gray-800 mb-4 text-center">Urutan Kabel T568B</h4>
                                <div class="flex justify-center gap-1 mb-4">
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg" style="background: linear-gradient(45deg, #fb923c 50%, #fff 50%); border: 2px solid #f97316;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 1</span>
                                        <span class="text-xs text-gray-500">Orange-Putih</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg bg-orange-500" style="border: 2px solid #ea580c;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 2</span>
                                        <span class="text-xs text-gray-500">Orange</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg" style="background: linear-gradient(45deg, #4ade80 50%, #fff 50%); border: 2px solid #22c55e;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 3</span>
                                        <span class="text-xs text-gray-500">Hijau-Putih</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg bg-blue-500" style="border: 2px solid #3b82f6;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 4</span>
                                        <span class="text-xs text-gray-500">Biru</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg" style="background: linear-gradient(45deg, #60a5fa 50%, #fff 50%); border: 2px solid #3b82f6;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 5</span>
                                        <span class="text-xs text-gray-500">Biru-Putih</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg bg-green-500" style="border: 2px solid #16a34a;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 6</span>
                                        <span class="text-xs text-gray-500">Hijau</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg" style="background: linear-gradient(45deg, #92400e 50%, #fff 50%); border: 2px solid #78350f;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 7</span>
                                        <span class="text-xs text-gray-500">Coklat-Putih</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-32 rounded-lg bg-amber-900" style="border: 2px solid #78350f;"></div>
                                        <span class="pin-label mt-1 text-gray-600">PIN 8</span>
                                        <span class="text-xs text-gray-500">Coklat</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-orange-100 rounded-xl p-4 mb-4 border-l-4 border-orange-500">
                                <h5 class="font-bold text-orange-900 mb-2">💡 Cara Mengingat T568B:</h5>
                                <p class="text-sm text-orange-800 mb-2"><strong>"Orange duluan, Hijau kemudian"</strong></p>
                                <ul class="text-sm text-orange-700 space-y-1">
                                    <li>• PIN 1-2: Pasangan Orange (Orange-Putih, Orange)</li>
                                    <li>• PIN 3: Hijau-Putih (terpisah)</li>
                                    <li>• PIN 4-5: Pasangan Biru (Biru, Biru-Putih)</li>
                                    <li>• PIN 6: Hijau (melengkapi pasangan)</li>
                                    <li>• PIN 7-8: Pasangan Coklat (Coklat-Putih, Coklat)</li>
                                </ul>
                            </div>

                            <div class="bg-yellow-50 rounded-xl p-4 border-2 border-yellow-300">
                                <h5 class="font-bold text-yellow-900 mb-2 flex items-center gap-2">
                                    <i data-lucide="star" class="text-yellow-500" style="width: 20px; height: 20px;"></i>
                                    Mengapa T568B Lebih Populer?
                                </h5>
                                <ul class="text-sm text-yellow-800 space-y-1">
                                    <li>• Kompatibel dengan standar telephone wiring AT&T 258A yang sudah ada</li>
                                    <li>• Lebih mudah diingat karena urutan Orange-Hijau lebih intuitif</li>
                                    <li>• Standar de facto di industri komersial dan instalasi kabel baru</li>
                                </ul>
                            </div>
                        </div>

                        <button onclick="nextSection(4)" class="w-full py-4 bg-gradient-to-r from-orange-500 to-pink-500 text-white rounded-xl font-bold text-lg hover:shadow-xl transition-all hover:scale-105 flex items-center justify-center gap-2">
                            Praktik Urutan Kabel
                            <i data-lucide="chevron-right" style="width: 24px; height: 24px;"></i>
                        </button>
                    </div>

                    <!-- Section 4: Interactive Practice -->
                    <div id="section-4" class="content-section">
                        <div class="text-center mb-6">
                            <div class="inline-block bg-purple-100 px-4 py-2 rounded-full mb-3">
                                <span class="text-purple-700 font-semibold text-sm">🎮 Praktik Interaktif</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Susun Kabel Sesuai Standar</h3>
                            <p class="text-gray-600">Tarik dan lepaskan kabel ke slot yang benar</p>
                        </div>

                        <!-- Standard Selection -->
                        <div class="flex justify-center gap-4 mb-6">
                            <button onclick="selectStandard('T568A')" id="btn-t568a" class="px-6 py-3 bg-blue-500 text-white rounded-xl font-bold hover:bg-blue-600 transition-all">
                                Standar T568A
                            </button>
                            <button onclick="selectStandard('T568B')" id="btn-t568b" class="px-6 py-3 bg-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-400 transition-all">
                                Standar T568B
                            </button>
                        </div>

                        <!-- RJ45 Connector with Slots -->
                        <div class="bg-gradient-to-b from-gray-100 to-gray-200 rounded-2xl p-8 mb-6">
                            <div class="bg-gradient-to-b from-gray-300 to-gray-400 rounded-xl p-6 shadow-inner">
                                <div class="text-center mb-4">
                                    <h4 class="font-bold text-gray-700">Konektor RJ45</h4>
                                    <p class="text-xs text-gray-600">Tarik kabel dari bawah ke slot PIN</p>
                                </div>
                                
                                <div class="flex justify-center gap-1" id="wire-slots">
                                    <!-- Wire slots will be generated here -->
                                </div>
                            </div>

                            <!-- Available Wires -->
                            <div class="mt-8">
                                <h4 class="text-center font-bold text-gray-700 mb-4">Kabel Tersedia</h4>
                                <div class="flex flex-wrap justify-center gap-3" id="available-wires">
                                    <!-- Wires will be generated here -->
                                </div>
                            </div>
                        </div>

                        <!-- Validation Result -->
                        <div id="validation-result" class="mb-6" style="display: none;"></div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <button onclick="checkAnswer()" class="flex-1 py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold text-lg hover:shadow-xl transition-all hover:scale-105">
                                Periksa Jawaban
                            </button>
                            <button onclick="resetPractice()" class="px-6 py-4 bg-gray-500 text-white rounded-xl font-bold hover:bg-gray-600 transition-all">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="w-80 space-y-4">
                <div class="bg-white rounded-2xl shadow-xl p-5 border-t-4 border-orange-500">
                    <div class="flex items-center gap-2 mb-4">
                        <i data-lucide="target" class="text-orange-600" style="width: 24px; height: 24px;"></i>
                        <h3 class="font-bold text-lg text-gray-800">Misi Saat Ini</h3>
                    </div>
                    <div class="bg-gradient-to-r from-orange-500 to-pink-500 text-white rounded-xl p-5 mb-4 shadow-lg">
                        <h4 class="font-bold text-xl mb-2">Kuasai Urutan Warna</h4>
                        <p class="text-sm opacity-90 mb-3">Pelajari standar T568A & T568B</p>
                        <div class="flex items-center gap-2 text-xs bg-white/20 rounded-lg p-2">
                            <i data-lucide="award" style="width: 16px; height: 16px;"></i>
                            <span>Reward: 400 Poin + 200 XP</span>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 mb-4">
                        <h4 class="font-bold text-gray-700 text-sm mb-3 flex items-center gap-2">
                            <i data-lucide="check-circle" class="text-blue-500" style="width: 16px; height: 16px;"></i>
                            Tujuan Pembelajaran:
                        </h4>
                        <div class="space-y-2 text-sm" id="objectives-list"></div>
                    </div>

                    <div id="mission-complete" class="bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl p-4 text-center" style="display: none;">
                        <i data-lucide="check-circle" class="text-white mx-auto mb-2" style="width: 32px; height: 32px;"></i>
                        <div class="text-white font-bold">Misi Selesai!</div>
                        <div class="text-white text-sm opacity-90">Level 3 Terbuka</div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl shadow-xl p-5 border-2 border-blue-300">
                    <h4 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
                        <i data-lucide="info" class="text-blue-600" style="width: 20px; height: 20px;"></i>
                        Referensi Cepat
                    </h4>
                    
                    <div class="bg-white rounded-lg p-3 mb-3">
                        <h5 class="text-xs font-bold text-gray-700 mb-2">T568A (Hijau Duluan):</h5>
                        <div class="text-xs text-gray-600 space-y-1">
                            <div>1. Hijau-Putih</div>
                            <div>2. Hijau</div>
                            <div>3. Orange-Putih</div>
                            <div>4. Biru</div>
                            <div>5. Biru-Putih</div>
                            <div>6. Orange</div>
                            <div>7. Coklat-Putih</div>
                            <div>8. Coklat</div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg p-3">
                        <h5 class="text-xs font-bold text-gray-700 mb-2">T568B (Orange Duluan):</h5>
                        <div class="text-xs text-gray-600 space-y-1">
                            <div>1. Orange-Putih</div>
                            <div>2. Orange</div>
                            <div>3. Hijau-Putih</div>
                            <div>4. Biru</div>
                            <div>5. Biru-Putih</div>
                            <div>6. Hijau</div>
                            <div>7. Coklat-Putih</div>
                            <div>8. Coklat</div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl shadow-xl p-5 border-2 border-purple-300">
                    <div class="flex items-center gap-2 mb-3">
                        <i data-lucide="lightbulb" class="text-yellow-500" style="width: 20px; height: 20px;"></i>
                        <h4 class="font-bold text-purple-800">Tips Menghapal</h4>
                    </div>
                    <div class="text-sm text-purple-900 space-y-2">
                        <p>🎨 <strong>T568A:</strong> "Hijau dulu, Orange kemudian"</p>
                        <p>🔶 <strong>T568B:</strong> "Orange dulu, Hijau kemudian"</p>
                        <p>💙 Pasangan Biru & Coklat tetap sama di kedua standar (PIN 4-5 & 7-8)</p>
                        <p>✨ Yang bertukar hanya Orange dan Hijau di PIN 1-2-3-6</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        const state = {
            score: 800,
            xp: 500,
            currentSection: 1,
            selectedStandard: 'T568A',
            levels: [
                { id: 1, name: 'Pengenalan', icon: '📚', status: 'completed', desc: 'Dasar-dasar kabel UTP' },
                { id: 2, name: 'Urutan Warna', icon: '🎨', status: 'active', desc: 'Standar pewarnaan' },
                { id: 3, name: 'Kabel Straight', icon: '🔌', status: 'locked', desc: 'Praktik T568B' },
                { id: 4, name: 'Kabel Cross', icon: '⚡', status: 'locked', desc: 'Koneksi berbeda' },
                { id: 5, name: 'Troubleshooting', icon: '🔧', status: 'locked', desc: 'Pemecahan masalah' }
            ],
            objectives: [
                { id: 1, text: 'Memahami standar TIA/EIA-568', completed: false },
                { id: 2, text: 'Mengenal urutan T568A', completed: false },
                { id: 3, text: 'Mengenal urutan T568B', completed: false },
                { id: 4, text: 'Praktik menyusun kabel', completed: false }
            ],
            wires: [
                { id: 'gw', name: 'Hijau-Putih', bg: 'linear-gradient(45deg, #4ade80 50%, #fff 50%)' },
                { id: 'g', name: 'Hijau', bg: '#22c55e' },
                { id: 'ow', name: 'Orange-Putih', bg: 'linear-gradient(45deg, #fb923c 50%, #fff 50%)' },
                { id: 'bl', name: 'Biru', bg: '#3b82f6' },
                { id: 'bw', name: 'Biru-Putih', bg: 'linear-gradient(45deg, #60a5fa 50%, #fff 50%)' },
                { id: 'o', name: 'Orange', bg: '#ea580c' },
                { id: 'brw', name: 'Coklat-Putih', bg: 'linear-gradient(45deg, #92400e 50%, #fff 50%)' },
                { id: 'br', name: 'Coklat', bg: '#78350f' }
            ],
            standards: {
                T568A: ['gw', 'g', 'ow', 'bl', 'bw', 'o', 'brw', 'br'],
                T568B: ['ow', 'o', 'gw', 'bl', 'bw', 'g', 'brw', 'br']
            },
            placedWires: [null, null, null, null, null, null, null, null]
        };

        function renderLearningPath() {
            const container = document.getElementById('learning-path');
            container.innerHTML = state.levels.map((level, idx) => `
                <div class="relative">
                    ${idx > 0 ? `<div class="absolute left-6 -top-3 w-1 h-3 ${level.status === 'completed' ? 'bg-green-400' : 'bg-gray-300'}"></div>` : ''}
                    <div class="flex items-center gap-3 p-3 rounded-xl transition-all ${
                        level.status === 'active' ? 'bg-gradient-to-r from-orange-100 to-pink-50 border-2 border-orange-500 shadow-md' :
                        level.status === 'completed' ? 'bg-green-50 border-2 border-green-400' :
                        'bg-gray-50 border-2 border-gray-200 opacity-60'
                    }">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow-md ${
                            level.status === 'active' ? 'bg-gradient-to-br from-orange-500 to-pink-600' :
                            level.status === 'completed' ? 'bg-gradient-to-br from-green-500 to-green-600' :
                            'bg-gray-300'
                        }">
                            ${level.status === 'completed' ? '✓' : level.icon}
                        </div>
                        <div class="flex-1">
                            <div class="font-bold text-sm text-gray-800">${level.name}</div>
                            <div class="text-xs text-gray-500">${level.desc}</div>
                        </div>
                        ${level.status === 'active' ? '<div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>' : ''}
                    </div>
                </div>
            `).join('');
        }

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

        function updateProgress() {
            const completedCount = state.objectives.filter(o => o.completed).length;
            const percentage = (completedCount / 4) * 100;
            
            document.getElementById('progress-percentage').textContent = Math.round(percentage) + '%';
            document.getElementById('progress-bar').style.width = percentage + '%';
            
            renderObjectives();
            
            for (let i = 1; i <= 4; i++) {
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
            
            if (state.objectives.every(o => o.completed)) {
                document.getElementById('mission-complete').style.display = 'block';
            }
        }

        function updateScore(points, xp) {
            state.score += points;
            state.xp += xp;
            
            document.getElementById('score-value').textContent = state.score;
            document.getElementById('xp-value').textContent = state.xp;
            
            const xpPercentage = (state.xp % 1000) / 10;
            document.getElementById('xp-bar').style.width = xpPercentage + '%';
            
            if (state.score >= 1000) {
                document.getElementById('badge-2').classList.remove('opacity-50', 'scale-90');
                document.getElementById('badge-2').classList.add('bg-gradient-to-br', 'from-orange-400', 'to-pink-500', 'scale-100');
            }
        }

        function nextSection(sectionNum) {
            document.getElementById(`section-${state.currentSection}`).classList.remove('active');
            
            if (state.currentSection <= 4) {
                state.objectives[state.currentSection - 1].completed = true;
                updateScore(100, 50);
            }
            
            state.currentSection = sectionNum;
            document.getElementById(`section-${sectionNum}`).classList.add('active');
            document.getElementById(`section-${sectionNum}`).classList.add('animate-slideIn');
            
            if (sectionNum === 4) {
                initializePractice();
            }
            
            updateProgress();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function selectStandard(standard) {
            state.selectedStandard = standard;
            
            document.getElementById('btn-t568a').classList.remove('bg-blue-500', 'bg-gray-300');
            document.getElementById('btn-t568b').classList.remove('bg-blue-500', 'bg-gray-300');
            
            if (standard === 'T568A') {
                document.getElementById('btn-t568a').classList.add('bg-blue-500');
                document.getElementById('btn-t568b').classList.add('bg-gray-300');
            } else {
                document.getElementById('btn-t568a').classList.add('bg-gray-300');
                document.getElementById('btn-t568b').classList.add('bg-blue-500');
            }
            
            resetPractice();
        }

        function initializePractice() {
            renderWireSlots();
            renderAvailableWires();
            setupDragAndDrop();
        }

        function renderWireSlots() {
            const container = document.getElementById('wire-slots');
            container.innerHTML = state.placedWires.map((wire, idx) => {
                const wireData = wire ? state.wires.find(w => w.id === wire) : null;
                return `
                    <div class="wire-slot flex flex-col items-center" data-slot="${idx}">
                        <div class="w-14 h-36 rounded-lg border-2 ${
                            wireData ? 'border-gray-600' : 'border-dashed border-gray-400'
                        } bg-white flex items-center justify-center cursor-pointer transition-all"
                        style="${wireData ? `background: ${wireData.bg}; box-shadow: 0 4px 6px rgba(0,0,0,0.2);` : ''}">
                            ${!wireData ? `<span class="text-xs text-gray-400">${idx + 1}</span>` : ''}
                        </div>
                        <span class="pin-label mt-2 text-gray-700">PIN ${idx + 1}</span>
                    </div>
                `;
            }).join('');
        }

        function renderAvailableWires() {
            const container = document.getElementById('available-wires');
            const availableWires = state.wires.filter(w => !state.placedWires.includes(w.id));
            
            container.innerHTML = availableWires.map(wire => `
                <div class="wire-item w-20 h-20 rounded-xl shadow-md border-2 border-white cursor-grab transition-all"
                     style="background: ${wire.bg};"
                     data-wire="${wire.id}"
                     draggable="true"
                     title="${wire.name}">
                </div>
            `).join('');
        }

        function setupDragAndDrop() {
            const wires = document.querySelectorAll('.wire-item');
            const slots = document.querySelectorAll('.wire-slot');
            
            wires.forEach(wire => {
                wire.addEventListener('dragstart', handleDragStart);
                wire.addEventListener('dragend', handleDragEnd);
            });
            
            slots.forEach(slot => {
                slot.addEventListener('dragover', handleDragOver);
                slot.addEventListener('drop', handleDrop);
                slot.addEventListener('dragleave', handleDragLeave);
                slot.addEventListener('click', handleSlotClick);
            });
        }

        let draggedWire = null;

        function handleDragStart(e) {
            draggedWire = e.target.getAttribute('data-wire');
            e.target.classList.add('dragging');
        }

        function handleDragEnd(e) {
            e.target.classList.remove('dragging');
        }

        function handleDragOver(e) {
            e.preventDefault();
            e.currentTarget.classList.add('over');
        }

        function handleDragLeave(e) {
            e.currentTarget.classList.remove('over');
        }

        function handleDrop(e) {
            e.preventDefault();
            e.currentTarget.classList.remove('over');
            
            const slotIndex = parseInt(e.currentTarget.getAttribute('data-slot'));
            
            if (draggedWire && state.placedWires[slotIndex] === null) {
                state.placedWires[slotIndex] = draggedWire;
                renderWireSlots();
                renderAvailableWires();
                setupDragAndDrop();
            }
            
            draggedWire = null;
        }

        function handleSlotClick(e) {
            const slotIndex = parseInt(e.currentTarget.getAttribute('data-slot'));
            
            if (state.placedWires[slotIndex] !== null) {
                state.placedWires[slotIndex] = null;
                renderWireSlots();
                renderAvailableWires();
                setupDragAndDrop();
            }
        }

        function checkAnswer() {
            const correctOrder = state.standards[state.selectedStandard];
            const isCorrect = state.placedWires.every((wire, idx) => wire === correctOrder[idx]);
            
            const resultContainer = document.getElementById('validation-result');
            
            if (state.placedWires.includes(null)) {
                resultContainer.innerHTML = `
                    <div class="bg-yellow-100 border-2 border-yellow-500 rounded-xl p-4 text-center">
                        <i data-lucide="alert-triangle" class="text-yellow-600 mx-auto mb-2" style="width: 32px; height: 32px;"></i>
                        <div class="text-yellow-800 font-bold">Belum Lengkap!</div>
                        <div class="text-yellow-700 text-sm">Silakan lengkapi semua PIN terlebih dahulu</div>
                    </div>
                `;
            } else if (isCorrect) {
                resultContainer.innerHTML = `
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl p-6 text-center text-white animate-slideIn">
                        <i data-lucide="trophy" class="mx-auto mb-3" style="width: 48px; height: 48px;"></i>
                        <h3 class="text-2xl font-bold mb-2">Sempurna! 🎉</h3>
                        <p class="text-lg mb-2">Urutan kabel ${state.selectedStandard} Benar!</p>
                        <p class="text-sm opacity-90">+100 Poin | +50 XP</p>
                    </div>
                `;
                state.objectives[3].completed = true;
                updateScore(100, 50);
                updateProgress();
            } else {
                const wrongPins = state.placedWires.map((wire, idx) => 
                    wire !== correctOrder[idx] ? idx + 1 : null
                ).filter(pin => pin !== null);
                
                resultContainer.innerHTML = `
                    <div class="bg-red-100 border-2 border-red-500 rounded-xl p-4 text-center">
                        <i data-lucide="x-circle" class="text-red-600 mx-auto mb-2" style="width: 32px; height: 32px;"></i>
                        <div class="text-red-800 font-bold mb-2">Belum Benar!</div>
                        <div class="text-red-700 text-sm">Periksa kembali PIN: ${wrongPins.join(', ')}</div>
                        <div class="text-red-600 text-xs mt-2">Lihat referensi cepat di panel kanan</div>
                    </div>
                `;
            }
            
            resultContainer.style.display = 'block';
            lucide.createIcons();
        }

        function resetPractice() {
            state.placedWires = [null, null, null, null, null, null, null, null];
            renderWireSlots();
            renderAvailableWires();
            setupDragAndDrop();
            
            const resultContainer = document.getElementById('validation-result');
            resultContainer.style.display = 'none';
        }

        renderLearningPath();
        renderObjectives();
        updateProgress();
    </script>
</body>
</html>