<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Analisis Data Otomatis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 text-white">
    <div class="container mx-auto p-6" x-data="dashboardApp()" x-init="init()">
        
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold mb-2 bg-gradient-to-r from-blue-400 to-emerald-400 bg-clip-text text-transparent">
                Dashboard Analisis Data Otomatis
            </h1>
            <p class="text-slate-300">Import Data dari Google Spreadsheet Secara Real-time</p>
        </div>

        <div class="mb-6 bg-slate-800/50 backdrop-blur rounded-xl p-6 shadow-xl">
            <label class="block text-sm font-medium mb-2 text-slate-300">Link Google Spreadsheet:</label>
            <div class="flex gap-2 mb-4">
                <input type="text" x-model="spreadsheetUrl" placeholder="https://docs.google.com/spreadsheets/d/..."
                    class="flex-1 bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                <button @click="loadDataFromSheet(true)" :disabled="loading"
                    class="bg-blue-500 hover:bg-blue-600 disabled:bg-slate-600 px-6 py-2 rounded-lg font-medium transition-all flex items-center gap-2">
                    <template x-if="loading">
                        <div class="flex items-center gap-2">
                            <i data-lucide="refresh-cw" class="w-4 h-4 animate-spin"></i>
                            <span>Loading...</span>
                        </div>
                    </template>
                    <template x-if="!loading">
                        <div class="flex items-center gap-2">
                            <i data-lucide="download" class="w-4 h-4"></i>
                            <span>Load Data</span>
                        </div>
                    </template>
                </button>
            </div>

            <div class="border-t border-slate-700 pt-4 mt-4">
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2">
                        <button @click="toggleAutoRefresh()"
                            :class="autoRefresh ? 'bg-emerald-500 hover:bg-emerald-600' : 'bg-slate-600 hover:bg-slate-700'"
                            class="px-4 py-2 rounded-lg font-medium transition-all flex items-center gap-2">
                            <template x-if="autoRefresh">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="pause" class="w-4 h-4"></i>
                                    <span>Auto-Refresh ON</span>
                                </div>
                            </template>
                            <template x-if="!autoRefresh">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="play" class="w-4 h-4"></i>
                                    <span>Auto-Refresh OFF</span>
                                </div>
                            </template>
                        </button>
                        <template x-if="autoRefresh">
                            <div class="flex items-center gap-2 bg-slate-700 px-4 py-2 rounded-lg">
                                <i data-lucide="refresh-cw" class="w-4 h-4 text-emerald-400"></i>
                                <span class="text-sm">Refresh dalam: <strong x-text="countdown + 's'"></strong></span>
                            </div>
                        </template>
                    </div>
                    <div class="flex items-center gap-2">
                        <label class="text-sm text-slate-300">Interval:</label>
                        <select x-model="refreshInterval" @change="resetAutoRefresh()"
                            class="bg-slate-700 border border-slate-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="10">10 detik</option>
                            <option value="30">30 detik</option>
                            <option value="60">1 menit</option>
                            <option value="120">2 menit</option>
                            <option value="300">5 menit</option>
                        </select>
                    </div>
                    <template x-if="lastUpdate">
                        <div class="text-sm text-slate-400">
                            Update terakhir: <strong x-text="formatTime(lastUpdate)"></strong>
                        </div>
                    </template>
                </div>
            </div>

            <template x-if="error">
                <div class="mt-3 p-3 bg-red-500/20 border border-red-500/50 rounded-lg text-red-200 text-sm">
                    <strong>Error:</strong> <span x-text="error"></span>
                    <div class="mt-2 text-xs">Pastikan spreadsheet sudah di-set ke "Anyone with the link can view" di sharing settings.</div>
                </div>
            </template>

            <template x-if="data.length > 0 && !error">
                <div class="mt-3 p-3 bg-emerald-500/20 border border-emerald-500/50 rounded-lg text-emerald-200 text-sm flex items-center justify-between">
                    <span>✓ Data berhasil dimuat: <strong x-text="data.length + ' baris data'"></strong></span>
                    <template x-if="autoRefresh">
                        <span class="text-xs bg-emerald-500/30 px-2 py-1 rounded">🔄 Auto-refresh aktif</span>
                    </template>
                </div>
            </template>
        </div>

        <div class="flex gap-2 mb-6 bg-slate-800/50 p-2 rounded-lg backdrop-blur">
            <button @click="activeTab = 'dashboard'"
                :class="activeTab === 'dashboard' ? 'bg-blue-500 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700'"
                class="px-6 py-2 rounded-lg font-medium transition-all">Dashboard</button>
            <button @click="activeTab = 'data'"
                :class="activeTab === 'data' ? 'bg-blue-500 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700'"
                class="px-6 py-2 rounded-lg font-medium transition-all">Data Spreadsheet</button>
        </div>

        <template x-if="data.length === 0">
            <div class="bg-slate-800/50 backdrop-blur rounded-xl p-12 text-center">
                <i data-lucide="alert-circle" class="w-16 h-16 mx-auto mb-4 text-slate-400"></i>
                <h3 class="text-xl font-semibold mb-2">Tidak Ada Data</h3>
                <p class="text-slate-400">Masukkan link Google Spreadsheet dan klik "Load Data" untuk memulai</p>
            </div>
        </template>

        <div x-show="activeTab === 'dashboard' && data.length > 0" x-cloak>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm">Total Peserta</p>
                            <p class="text-3xl font-bold mt-1" x-text="stats.totalStudents"></p>
                        </div>
                        <i data-lucide="users" class="w-12 h-12 text-blue-200 opacity-80"></i>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-6 shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-100 text-sm">Rata-rata Nilai</p>
                            <p class="text-3xl font-bold mt-1" x-text="stats.avgScore"></p>
                        </div>
                        <i data-lucide="trending-up" class="w-12 h-12 text-emerald-200 opacity-80"></i>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-6 shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-amber-100 text-sm">Nilai Tertinggi</p>
                            <p class="text-3xl font-bold mt-1" x-text="stats.maxScore"></p>
                        </div>
                        <i data-lucide="award" class="w-12 h-12 text-amber-200 opacity-80"></i>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-6 shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-100 text-sm">Nilai Terendah</p>
                            <p class="text-3xl font-bold mt-1" x-text="stats.minScore"></p>
                        </div>
                        <i data-lucide="alert-circle" class="w-12 h-12 text-red-200 opacity-80"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-slate-800/50 backdrop-blur rounded-xl p-6 shadow-xl">
                    <h3 class="text-xl font-semibold mb-4 text-blue-400">Distribusi Nilai</h3>
                    <canvas id="scoreDistributionChart" height="300"></canvas>
                </div>
                <div class="bg-slate-800/50 backdrop-blur rounded-xl p-6 shadow-xl">
                    <h3 class="text-xl font-semibold mb-4 text-emerald-400">Kategori Performa</h3>
                    <canvas id="performanceCategoriesChart" height="300"></canvas>
                </div>
            </div>

            <div class="bg-slate-800/50 backdrop-blur rounded-xl p-6 shadow-xl mb-6">
                <h3 class="text-xl font-semibold mb-4 text-purple-400">Performa Individu</h3>
                <canvas id="individualPerformanceChart" height="400"></canvas>
            </div>

            <div class="bg-slate-800/50 backdrop-blur rounded-xl p-6 shadow-xl">
                <h3 class="text-xl font-semibold mb-4 text-yellow-400">🏆 Top 5 Peserta Terbaik</h3>
                <div class="space-y-3">
                    <template x-for="(student, idx) in topPerformers" :key="idx">
                        <div class="flex items-center justify-between bg-slate-700/50 rounded-lg p-4 hover:bg-slate-700 transition">
                            <div class="flex items-center gap-4">
                                <div :class="{'bg-yellow-500': idx === 0, 'bg-gray-400': idx === 1, 'bg-amber-600': idx === 2, 'bg-slate-600': idx > 2}"
                                    class="w-10 h-10 rounded-full flex items-center justify-center font-bold">
                                    <span x-text="idx + 1"></span>
                                </div>
                                <div>
                                    <p class="font-semibold" x-text="student.name"></p>
                                    <p class="text-sm text-slate-400" x-text="student.correct + ' dari ' + student.totalQ + ' soal benar'"></p>
                                </div>
                            </div>
                            <div class="text-2xl font-bold text-emerald-400" x-text="student.score"></div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div x-show="activeTab === 'data' && data.length > 0" x-cloak>
            <div class="bg-slate-800/50 backdrop-blur rounded-xl shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-700">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Absen</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Nilai</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Total Soal</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Benar</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Salah</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(row, idx) in data" :key="idx">
                                <tr class="border-b border-slate-700 hover:bg-slate-700/30">
                                    <td class="px-4 py-3" x-text="idx + 1"></td>
                                    <td class="px-4 py-3">
                                        <input type="text" x-model="row.name" class="bg-transparent border-b border-slate-600 focus:border-blue-400 outline-none w-full"/>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="text" x-model="row.absence" class="bg-transparent border-b border-slate-600 focus:border-blue-400 outline-none w-16"/>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" x-model="row.score" class="bg-transparent border-b border-slate-600 focus:border-blue-400 outline-none w-16"/>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" x-model="row.totalQ" class="bg-transparent border-b border-slate-600 focus:border-blue-400 outline-none w-16"/>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" x-model="row.correct" class="bg-transparent border-b border-slate-600 focus:border-blue-400 outline-none w-16"/>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" x-model="row.wrong" class="bg-transparent border-b border-slate-600 focus:border-blue-400 outline-none w-16"/>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-slate-400" x-text="row.timestamp"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function dashboardApp() {
            return {
                activeTab: 'dashboard',
                spreadsheetUrl: 'https://docs.google.com/spreadsheets/d/1uhmNqxRDCXui8ojXzaKYk7WIj0ZqyTmE_ba3Da0VQiw/edit?gid=0#gid=0',
                data: [],
                loading: false,
                error: '',
                autoRefresh: false,
                refreshInterval: 30,
                lastUpdate: null,
                countdown: 0,
                intervalId: null,
                countdownId: null,
                charts: { scoreDistribution: null, performanceCategories: null, individualPerformance: null },

                init() {
                    this.loadDataFromSheet(true);
                    lucide.createIcons();
                    this.$watch('data', () => {
                        this.$nextTick(() => {
                            this.updateCharts();
                            lucide.createIcons();
                        });
                    });
                },

                extractSheetId(url) {
                    const match = url.match(/\/d\/([a-zA-Z0-9-_]+)/);
                    return match ? match[1] : null;
                },

                extractGid(url) {
                    const match = url.match(/gid=([0-9]+)/);
                    return match ? match[1] : '0';
                },

                async loadDataFromSheet(showLoading = true) {
                    if (showLoading) this.loading = true;
                    this.error = '';
                    try {
                        const sheetId = this.extractSheetId(this.spreadsheetUrl);
                        const gid = this.extractGid(this.spreadsheetUrl);
                        if (!sheetId) throw new Error('URL spreadsheet tidak valid');
                        const csvUrl = `https://docs.google.com/spreadsheets/d/${sheetId}/export?format=csv&gid=${gid}`;
                        const response = await fetch(csvUrl);
                        if (!response.ok) throw new Error('Gagal mengambil data. Pastikan spreadsheet di-set ke "Anyone with the link can view"');
                        const csvText = await response.text();
                        const lines = csvText.split('\n');
                        const parsedData = [];
                        for (let i = 1; i < lines.length; i++) {
                            if (!lines[i].trim()) continue;
                            const values = lines[i].match(/(".*?"|[^,]+)(?=\s*,|\s*$)/g) || [];
                            const cleanValues = values.map(v => v.trim().replace(/^"|"$/g, ''));
                            if (cleanValues.length < 3) continue;
                            const row = {
                                name: cleanValues[0] || `Peserta ${i}`,
                                absence: cleanValues[1] || '-',
                                score: parseInt(cleanValues[2]) || 0,
                                totalQ: parseInt(cleanValues[3]) || 25,
                                correct: parseInt(cleanValues[4]) || 0,
                                wrong: parseInt(cleanValues[5]) || 0,
                                timestamp: cleanValues[8] || ''
                            };
                            parsedData.push(row);
                        }
                        if (parsedData.length === 0) throw new Error('Tidak ada data yang ditemukan');
                        this.data = parsedData;
                        this.lastUpdate = new Date();
                        if (showLoading) this.loading = false;
                    } catch (err) {
                        this.error = err.message;
                        if (showLoading) this.loading = false;
                    }
                },

                toggleAutoRefresh() {
                    this.autoRefresh = !this.autoRefresh;
                    if (this.autoRefresh) {
                        this.startAutoRefresh();
                    } else {
                        this.stopAutoRefresh();
                    }
                },

                startAutoRefresh() {
                    this.countdown = this.refreshInterval;
                    this.intervalId = setInterval(() => {
                        this.loadDataFromSheet(false);
                        this.countdown = this.refreshInterval;
                    }, this.refreshInterval * 1000);
                    this.countdownId = setInterval(() => {
                        if (this.countdown <= 1) {
                            this.countdown = this.refreshInterval;
                        } else {
                            this.countdown--;
                        }
                    }, 1000);
                },

                stopAutoRefresh() {
                    if (this.intervalId) clearInterval(this.intervalId);
                    if (this.countdownId) clearInterval(this.countdownId);
                    this.countdown = 0;
                },

                resetAutoRefresh() {
                    if (this.autoRefresh) {
                        this.stopAutoRefresh();
                        this.startAutoRefresh();
                    }
                },

                formatTime(date) {
                    if (!date) return '-';
                    return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                },

                get stats() {
                    if (this.data.length === 0) return { avgScore: 0, avgCorrect: 0, maxScore: 0, minScore: 0, totalStudents: 0 };
                    const avgScore = (this.data.reduce((sum, item) => sum + item.score, 0) / this.data.length).toFixed(1);
                    const avgCorrect = (this.data.reduce((sum, item) => sum + item.correct, 0) / this.data.length).toFixed(1);
                    const maxScore = Math.max(...this.data.map(item => item.score));
                    const minScore = Math.min(...this.data.map(item => item.score));
                    return { avgScore, avgCorrect, maxScore, minScore, totalStudents: this.data.length };
                },

                get scoreDistribution() {
                    const ranges = { '0-40': 0, '41-60': 0, '61-80': 0, '81-100': 0 };
                    this.data.forEach(item => {
                        if (item.score <= 40) ranges['0-40']++;
                        else if (item.score <= 60) ranges['41-60']++;
                        else if (item.score <= 80) ranges['61-80']++;
                        else ranges['81-100']++;
                    });
                    return ranges;
                },

                get performanceCategories() {
                    const categories = { 'Sangat Baik': 0, 'Baik': 0, 'Cukup': 0, 'Perlu Perbaikan': 0 };
                    this.data.forEach(item => {
                        if (item.score >= 85) categories['Sangat Baik']++;
                        else if (item.score >= 70) categories['Baik']++;
                        else if (item.score >= 55) categories['Cukup']++;
                        else categories['Perlu Perbaikan']++;
                    });
                    return categories;
                },

                get topPerformers() {
                    return [...this.data].sort((a, b) => b.score - a.score).slice(0, 5);
                },

                updateCharts() {
                    if (this.data.length === 0) return;
                    const scoreCtx = document.getElementById('scoreDistributionChart');
                    if (scoreCtx) {
                        if (this.charts.scoreDistribution) this.charts.scoreDistribution.destroy();
                        const dist = this.scoreDistribution;
                        this.charts.scoreDistribution = new Chart(scoreCtx, {
                            type: 'bar',
                            data: {
                                labels: Object.keys(dist),
                                datasets: [{ label: 'Jumlah Peserta', data: Object.values(dist), backgroundColor: '#3b82f6', borderRadius: 8 }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { display: false } },
                                scales: {
                                    y: { beginAtZero: true, ticks: { color: '#94a3b8' }, grid: { color: '#334155' } },
                                    x: { ticks: { color: '#94a3b8' }, grid: { display: false } }
                                }
                            }
                        });
                    }
                    const perfCtx = document.getElementById('performanceCategoriesChart');
                    if (perfCtx) {
                        if (this.charts.performanceCategories) this.charts.performanceCategories.destroy();
                        const perf = this.performanceCategories;
                        this.charts.performanceCategories = new Chart(perfCtx, {
                            type: 'pie',
                            data: {
                                labels: Object.keys(perf),
                                datasets: [{ data: Object.values(perf), backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444'] }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { position: 'bottom', labels: { color: '#e2e8f0' } } }
                            }
                        });
                    }
                    const indivCtx = document.getElementById('individualPerformanceChart');
                    if (indivCtx) {
                        if (this.charts.individualPerformance) this.charts.individualPerformance.destroy();
                        this.charts.individualPerformance = new Chart(indivCtx, {
                            type: 'line',
                            data: {
                                labels: this.data.map(d => d.name),
                                datasets: [
                                    { label: 'Nilai', data: this.data.map(d => d.score), borderColor: '#8b5cf6', backgroundColor: 'rgba(139, 92, 246, 0.1)', tension: 0.4 },
                                    { label: 'Jawaban Benar', data: this.data.map(d => d.correct), borderColor: '#10b981', backgroundColor: 'rgba(16, 185, 129, 0.1)', tension: 0.4 }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { position: 'top', labels: { color: '#e2e8f0' } } },
                                scales: {
                                    y: { beginAtZero: true, ticks: { color: '#94a3b8' }, grid: { color: '#334155' } },
                                    x: { ticks: { color: '#94a3b8', maxRotation: 45, minRotation: 45 }, grid: { display: false } }
                                }
                            }
                        });
                    }
                }
            }
        }
    </script>
</body>
</html>