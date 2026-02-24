<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabelista - Connected Lab</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        /* CSS SAMA SEPERTI SEBELUMNYA */
        :root { --primary: #0f172a; --secondary: #334155; --accent: #f59e0b; --bg: #f1f5f9; --danger: #ef4444; --success: #22c55e; --white: #ffffff; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; user-select: none; }
        body { background-color: var(--bg); height: 100vh; display: flex; flex-direction: column; overflow: hidden; }
        header { background: linear-gradient(135deg, #0052CC 0%, #0066FF 100%);
                padding: 10px 20px; 
                display: flex; 
                justify-content: space-between; 
                align-items: center; 
                border-bottom: 4px solid var(--accent); 
                box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
            }
        .brand { font-size: 1.5em; font-weight: 800; display: flex; align-items: center; gap: 10px; }
        .reset-btn { background: var(--danger); color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.2s; }
        .reset-btn:hover { background: #dc2626; }
        .status-bar { background: var(--white); padding: 10px 20px; display: flex; gap: 20px; justify-content: flex-end; font-weight: 600; color: var(--secondary); border-bottom: 1px solid #e2e8f0; }
        .metric { display: flex; align-items: center; gap: 6px; background: #e2e8f0; padding: 5px 12px; border-radius: 20px; font-size: 0.9em; }
        .lab-container { flex: 1; display: flex; padding: 15px; gap: 15px; overflow: hidden; }
        .sidebar { width: 200px; background: #F2C300;  border-radius: 12px; display: flex; flex-direction: column; align-items: center; padding: 15px; gap: 15px; color: white; box-shadow: 2px 0 10px rgba(0,0,0,0.1); }
        .sidebar h3 { font-size: 1.3em; text-transform: uppercase; letter-spacing: 1px; color: #020202; border-bottom: 1px solid #000000; width: 100%; text-align: center; padding-bottom: 5px; }
        .tool-box { width: 100px; height: 90px; background: rgba(255, 255, 255, 0.44); border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: grab; transition: all 0.2s; position: relative; border: 1px solid transparent; }
        .tool-box:hover { background: rgba(255, 255, 255, 0.96); border-color: var(--accent); }
        .tool-box:active { cursor: grabbing; transform: scale(0.95); }
        .tool-icon { font-size: 2.5em; margin-bottom: 5px; }
        .tool-name { font-size: 0.7em; text-align: center; color: #000000; }
        .workspace { flex: 1; background: #D3D4D5; border-radius: 12px; border: 2px dashed #94a3b8; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; padding-bottom: 0; overflow: hidden; }
        .toast { position: absolute; top: 20px; padding: 10px 20px; border-radius: 20px; font-weight: bold; color: white; display: none; z-index: 50; box-shadow: 0 5px 15px rgba(0,0,0,0.2); animation: slideDown 0.3s; }
        .toast-err { background: var(--danger); } .toast-info { background: var(--secondary); }
        .cable-assembly { position: relative; width: 280px; height: 320px; display: flex; justify-content: center; align-items: flex-end; transition: transform 0.3s; }
        .cable-jacket { width: 170px; height: 300px; background: #64748b; border: 3px solid #475569; border-bottom: none; border-radius: 12px 12px 0 0; position: absolute; bottom: 0; z-index: 20; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.3); font-weight: bold; writing-mode: vertical-rl; transition: height 0.4s ease; }
        .wires-zone { position: absolute; bottom: 0; width: 100%; height: 250px; z-index: 10; display: flex; justify-content: center; gap: 4px; padding: 0 10px; opacity: 0; transition: opacity 0.3s; }
        .wire { width: 14px; height: 100%; border-radius: 3px; cursor: grab; position: relative; }
        .w-o { background: #f97316; } .w-wo { background: repeating-linear-gradient(45deg, #f97316, #f97316 4px, #fff 4px, #fff 8px); }
        .w-g { background: #22c55e; } .w-wg { background: repeating-linear-gradient(45deg, #22c55e, #22c55e 4px, #fff 4px, #fff 8px); }
        .w-b { background: #3b82f6; } .w-wb { background: repeating-linear-gradient(45deg, #3b82f6, #3b82f6 4px, #fff 4px, #fff 8px); }
        .w-br { background: #78350f; } .w-wbr { background: repeating-linear-gradient(45deg, #78350f, #78350f 4px, #fff 4px, #fff 8px); }
        .connector-slot-area { position: absolute; top: 20px; background: rgba(255,255,255,0.9); padding: 10px; border-radius: 8px; border: 1px solid #94a3b8; display: none; box-shadow: 0 10px 20px rgba(0,0,0,0.1); z-index: 40; }
        .connector-grid { display: grid; grid-template-columns: repeat(8, 1fr); gap: 2px; width: 200px; height: 60px; border-bottom: 4px solid var(--accent); }
        .pin-slot { border: 1px dashed #cbd5e1; height: 100%; background: rgba(0,0,0,0.05); }
        .tester-overlay { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: var(--secondary); color: white; padding: 20px; border-radius: 15px; display: none; flex-direction: column; align-items: center; gap: 15px; box-shadow: 0 20px 50px rgba(0,0,0,0.5); z-index: 100; border: 2px solid var(--accent); width: 300px; }
        .led-row { display: flex; gap: 5px; }
        .led { width: 15px; height: 15px; border-radius: 50%; background: #1e293b; border: 1px solid #475569; }
        .led.active { background: #22c55e; box-shadow: 0 0 10px #22c55e; }
        .led.error { background: #ef4444; box-shadow: 0 0 10px #ef4444; }
        .modal-bg { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); backdrop-filter: blur(5px); display: flex; justify-content: center; align-items: center; z-index: 200; }
        .modal-box { background: #F2C300; padding: 30px; border-radius: 15px; width: 90%; max-width: 450px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
        .input-f { width: 100%; padding: 12px; margin: 10px 0; border: 2px solid #e2e8f0; border-radius: 8px; }
        .btn-start { background: #004AAD; color: white; padding: 12px; width: 100%; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; }
        .hidden { display: none !important; }
        @keyframes slideDown { from { transform: translateY(-20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        @keyframes cutAnim { 0% { opacity: 1; } 50% { opacity: 0; transform: scale(0.9); } 100% { opacity: 1; transform: scale(1); } }
        /* Container Crimp Tool */
.crimpTool {
    position: absolute;
    left: 50%;
    /* Geser posisi sedikir agar kepala hitam pas di tengah RJ45 */
    transform: translateX(-40px) scale(1.5);
    transform-origin: 40px center;
    width: 280px;
    height: 180px;
    display: none;
    z-index: 60;
    pointer-events: none;
}

/* Bagian atas kepala (kotak kecil bergaris biru/abu) */
.head-top {
    position: absolute;
    left: 15px;
    top: 15px;
    width: 50px;
    height: 15px;
    border: 5px solid #64748b;
    border-bottom: none;
    background: transparent;
}

/* Gagang panjang abu-abu di sebelah kanan */
.crimper-handle {
    position: absolute;
    left: 80px; /* Mulai setelah kepala hitam */
    top: 30px;
    width: 200px;
    height: 80px;
    background: #6b6b6b;
}

/* Kepala utama tang (kotak hitam) */
.head-main {
    position: absolute;
    left: 0;
    top: 30px;
    width: 80px;
    height: 80px;
    background: #000000;
    z-index: 2;
}

/* Bagian bawah berstruktur "H" */
.head-bottom {
    position: absolute;
    left: 0;
    top: 110px;
    width: 80px;
    height: 60px;
    border: 5px solid #64748b;
    border-top: none;
    background: transparent;
}

/* Garis tengah horizontal pembentuk huruf "H" */
.head-bottom::before {
    content: '';
    position: absolute;
    top: 15px;
    left: -5px; /* Sesuaikan dengan tebal border */
    width: calc(100% + 10px);
    height: 5px;
    background: #64748b;
}

.pin-locked {
    background: orange !important;
    transition: 0.3s;
}

.cable-shake {
    animation: shake 0.3s ease;
}

@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-3px); }
    50% { transform: translateX(3px); }
    75% { transform: translateX(-3px); }
    100% { transform: translateX(0); }
}
        .logo img {
            height: 45px; /* ukuran logo */
            width: auto;
            display: block;
        }
        .info-box {
            background:#f1f5f9;
            padding:6px 12px;
            border-radius:6px;
            min-width:120px;
            text-align:center;
            font-size:0.85em;
        }
        .footer-bottom {
            text-align: center;
            color: #004AAD;
            font-size: 14px;
            padding-top: 3px;
            padding-bottom: 20px;
            font-weight: 500;
        }
        .tool-icon img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }
        .btn-primary { background: var(--danger); color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.2s; }
        /* Loading Spinner */
        .spinner { border: 4px solid #f3f3f3; border-top: 4px solid var(--accent); border-radius: 50%; width: 20px; height: 20px; animation: spin 2s linear infinite; display: inline-block; margin-right:10px; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        /* ================= INTRO OVERLAY ================= */
.intro-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.7);
    backdrop-filter: blur(6px);
    z-index: 999;
}

.intro-highlight {
    position: absolute;
}

.intro-box {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #ffffff;
    width: 400px;
    max-width: 90%;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    z-index: 1000;
}

.intro-box h2 {
    margin-bottom: 10px;
    color: #0f172a;
}

.intro-box p {
    font-size: 0.9em;
    margin-bottom: 15px;
}

.intro-buttons {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.intro-buttons button {
    padding: 8px 16px;
    border: none;
    background: #004AAD;
    color: white;
    border-radius: 6px;
    cursor: pointer;
}
.introIcon {
    width: 150px;        /* atur lebar di sini */
    height: 150px;       /* atur tinggi di sini */
    margin: 0 auto 15px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.introIcon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
.intro-icon img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

    </style>
</head>
<body>

    <header class="flex items-center justify-between px-4 py-2">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
        <div class="logo">
            <img src="/assets/img/logo-cabelista.png" alt="Logo Cabelista" class="h-10">
        </div>
    </div>

    <!-- Tombol -->
    <div class="flex items-center space-x-4">
        <button class="reset-btn" onclick="hardReset()">Reset</button>
        <button class="btn-primary" onclick="window.location.href='{{ url('/') }}'">Beranda</button>
    </div>
</header>


    <div class="status-bar">
        <div class="metric">👤 <span id="dispName">-</span></div>
        <div class="metric">⏱️ <span id="timer">00:00</span></div>
        <div class="metric">✂️ Used: <span id="cableMetric">0</span> cm</div>
        <div class="metric">🔌 RJ45: <span id="rjMetric">0</span></div>
    </div>

    <div class="lab-container">
        <div class="sidebar">
            <h3>Tools <span style="font-size:0.7em">(Drag)</span></h3>
            <div class="tool-box" onclick="toggleGloves()">
                <div class="tool-icon">🧤</div><div class="tool-name">Safety Gloves</div>
                <div id="gloveStatus" style="position:absolute; top:5px; right:5px; width:10px; height:10px; border-radius:50%; background:red;"></div>
            </div>
            <div class="tool-box" draggable="true" ondragstart="dragTool(event, 'stripper')">
                <div class="tool-icon">
                    <img src="{{ asset('assets/img/Cable-Stripper.png') }}" 
                         alt="Cable Stripper" 
                         class="w-10 h-10 object-contain">
                </div><div class="tool-name">Cable Stripper</div>
            </div>
            <div class="tool-box" draggable="true" ondragstart="dragTool(event, 'cutter')">
                <div class="tool-icon">
                    <img src="{{ asset('assets/img/cable-cutter.png') }}"
                         alt="Cable Cutter" 
                         class="w-10 h-10 object-contain">
                </div><div class="tool-name">Cable Cutter</div>
            </div>
        </div>

        <div class="workspace" ondrop="dropTool(event)" ondragover="allowDrop(event)">
            <div id="toast" class="toast toast-err">Message</div>
            <div class="connector-slot-area" id="connectorArea">
                <div style="text-align:center; font-size:0.8em; color:#64748b; margin-bottom:5px;">RJ45 PIN 1-8</div>
                <div class="connector-grid" id="pinSlots"></div>
            </div>
            <div class="cable-assembly" id="cableAssembly">
                <div id="cableJacket" class="cable-jacket"></div>
                <div id="wiresZone" class="wires-zone"></div>
                <div id="rj45Visual" style="position:absolute; top:-20px; display:none; font-size:2em;">
                    <img src="{{ asset('assets/img/rj45.png') }}" alt="RJ45" class="w-12 h-12 object-contain">
                </div>
                <div id="crimpTool" class="crimpTool">
                    <div class="head-top"></div>
                    <div class="crimper-handle"></div>
                    <div class="head-main"></div>
                    <div class="head-bottom"></div>
</div>
            </div>
        </div>

        <div class="sidebar">
            <h3>Equip <span style="font-size:0.7em">(Tap)</span></h3>
            <div class="tool-box" onclick="equipRJ45()">
                <div class="tool-icon">
                <img src="{{ asset('assets/img/rj45.png') }}" 
             alt="RJ45" 
             class="w-10 h-10 object-contain">   
                </div><div class="tool-name">RJ45 Conn</div>
            </div>
            <div class="tool-box" onclick="useCrimper()">
                <div class="tool-icon">
                <img src="{{ asset('assets/img/crimp-tool.png') }}"
             alt="Crimper"             class="w-10 h-10 object-contain">
                </div><div class="tool-name">Crimp Tool</div>
            </div>
            <div class="tool-box" onclick="openTester()">
                <div class="tool-icon">📟</div><div class="tool-name">Tester</div>
            </div>
        </div>
    </div>

    <div id="testerModal" class="tester-overlay">
        <h3>LAN TESTER</h3>
        <div class="led-row" id="leds"></div>
        <div id="testerResult" style="font-weight:bold; font-size:1.2em; color:#94a3b8;">READY</div>
        <div style="display:flex; gap:10px;">
            <button class="reset-btn" style="background:#334155;" onclick="closeTester()">Close</button>
            <button class="reset-btn" style="background:var(--accent); color:black;" onclick="runTest()">RUN TEST</button>
        </div>
        <button class="btn-start" style="margin-top:10px; background:var(--success);" onclick="finishExam()">Submit & Score</button>
    </div>

    <div id="welcomeModal" class="modal-bg">
        <div class="modal-box">
            <h2 style="color:var(--primary);">Welcome!</h2>
            <p style="color:#00000; margin-bottom:15px;">Data akan tersimpan otomatis.</p>
            <input type="text" id="inpName" class="input-f" placeholder="Nama Lengkap">
            <input type="number" id="inpAbsen" class="input-f" placeholder="Nomor Absen">
            <button class="btn-start" onclick="startSim()">MULAI PRAKTIKUM</button>
        </div>
    </div>

    <div id="scoreModal" class="modal-bg hidden">
        <div class="modal-box">
            <h1 id="finalScore" style="font-size:4em; color:var(--primary); margin:0;">0</h1>
            <div style="font-weight:bold; color:#00000;">NILAI AKHIR</div>
            
            <div style="background:#f1f5f9; padding:15px; border-radius:10px; margin:20px 0; text-align:left;">
                <div style="display:flex; justify-content:space-between;"><span>Nama:</span> <strong id="resName">-</strong></div>
                <div style="display:flex; justify-content:space-between;"><span>Nomor Absen:</span> <strong id="resAbsen">-</strong></div>
            </div>

            <div style="display:flex; flex-wrap:wrap; gap:10px; justify-content:center;">
                <div class="info-box">Standar: <strong id="resStd">-</strong></div>
                <div class="info-box">Waktu: <strong id="resTime">-</strong></div>
                <div class="info-box">RJ45: <strong id="resRJ45">-</strong></div>
                <div class="info-box">Cable: <strong id="resCable">-</strong></div>
                <div class="info-box">Status Upload: <strong id="resUploadStatus">-</strong></div>
            </div>

            <button class="btn-start" style="background:#0f172a; margin-top:10px;" onclick="downloadResultImage()">Download Hasil 📥</button>
            <button class="btn-start" style="background:var(--success); margin-top:10px;" onclick="shareWA()">Share ke WhatsApp 📲</button>
            <button class="reset-btn" style="width:100%; margin-top:10px; background:#004AAD;" onclick="hardReset()">Play Again</button>
        </div>
    </div>

    <!-- GAME INTRO TUTORIAL -->
<div id="gameIntro" class="intro-overlay hidden">
    <div class="intro-highlight" id="introHighlight"></div>

    <div class="intro-box">
        <h2 id="introTitle">Tutorial</h2>
        <div id="introIcon"></div>
        <p id="introText">Penjelasan</p>

        <div class="intro-buttons">
            <button onclick="prevIntro()">Back</button>
            <button onclick="nextIntro()">Next</button>
            <button onclick="closeIntro()" id="introStartBtn" style="display:none;">Start Practicum</button>
        </div>
    </div>
</div>

    <!-- Footer -->
    <div class="footer-bottom">
            ©cabelista.2026
        </div>

    <script>
        // ============================================
        // CONFIG & DATA
        // ============================================
        
        const STANDARDS = {
            'T568A': ['w-wg', 'w-g', 'w-wo', 'w-b', 'w-wb', 'w-o', 'w-wbr', 'w-br'],
            'T568B': ['w-wo', 'w-o', 'w-wg', 'w-b', 'w-wb', 'w-g', 'w-wbr', 'w-br']
        };
        const WIRES = [
            {id:'wo',c:'w-wo'}, {id:'o',c:'w-o'}, {id:'wg',c:'w-wg'}, {id:'g',c:'w-g'},
            {id:'wb',c:'w-wb'}, {id:'b',c:'w-b'}, {id:'wbr',c:'w-wbr'}, {id:'br',c:'w-br'}
        ];

        // State default
        let defaultState = {
            name: '', 
            absen: '', 
            elapsedTime: 0, // simpan detik berjalan
            gloves: false, 
            stripped: false, 
            rj45Attached: false, 
            isCrimped: false,
            cableUsed: 0, 
            rjCount: 0, 
            finalResult: null,
            wiresInSlots: [null, null, null, null, null, null, null, null] // Posisi kabel
        };

        let s = { ...defaultState };
        let timerInt;

        // ============================================
        // INIT & RESTORE SESSION
        // ============================================
        window.onload = () => {
    generateSlots();
    generateLEDs();
    restoreSession();

    // CEK apakah tutorial sudah pernah dilihat
    const introSeen = localStorage.getItem("cabelista_intro_seen");

    if (!introSeen) {
        setTimeout(() => {
            startIntro();
        }, 500);
    }
};

        function restoreSession() {
            // Ambil data dari Cookies/LocalStorage
            const savedData = localStorage.getItem('cabelista_session');
            
            if (savedData) {
                try {
                    s = JSON.parse(savedData);
                    
                    // Jika nama ada, berarti sesi aktif
                    if (s.name) {
                        // 1. Restore Identitas
                        document.getElementById('inpName').value = s.name;
                        document.getElementById('inpAbsen').value = s.absen;
                        document.getElementById('dispName').innerText = s.name;
                        document.getElementById('welcomeModal').classList.add('hidden');

                        // 2. Restore Metrics
                        document.getElementById('cableMetric').innerText = s.cableUsed;
                        document.getElementById('rjMetric').innerText = s.rjCount;
                        
                        // 3. Restore Visual Gloves
                        if (s.gloves) {
                            document.getElementById('gloveStatus').style.background = '#22c55e';
                        }

                        // 4. Restore Kondisi Kabel
                        if (s.stripped) {
                            // Skip animasi, langsung set kondisi visual
                            document.getElementById('cableJacket').style.height = '60px';
                            document.getElementById('wiresZone').style.opacity = '1';
                            document.getElementById('wiresZone').style.zIndex = '30';
                            document.getElementById('connectorArea').style.display = 'block';
                            
                            // Restore kabel (spawn ulang)
                            spawnWires(true); 
                        } else {
                            // Jika belum strip, spawn wires di belakang layar
                            spawnWires(false); 
                        }

                        if (s.rj45Attached) {
                            document.getElementById('rj45Visual').style.display = 'block';
                        }

                        if (s.isCrimped) {
                            // Jika sudah di-crimping, tampilkan efek visual
                            const visual = document.getElementById('rj45Visual');
                            visual.style.transform = "scale(1)";
                            visual.style.filter = "none";
                        }

                        // 5. Lanjutkan Timer
                        timerInt = setInterval(updateTimer, 1000);
                        showToast("Sesi dipulihkan ✅", "info");
                    }
                } catch (e) {
                    console.error("Gagal restore session", e);
                    localStorage.removeItem('cabelista_session');
                }
            } else {
                // Sesi baru, spawn kabel default
                spawnWires(false);
            }
        }

        function saveSession() {
            // Simpan posisi kabel saat ini di slot
            const slots = document.querySelectorAll('.pin-slot');
            let currentArrangement = [];
            slots.forEach(slot => {
                if(slot.firstChild) {
                    currentArrangement.push(slot.firstChild.id);
                } else {
                    currentArrangement.push(null);
                }
            });
            s.wiresInSlots = currentArrangement;

            // Simpan ke LocalStorage
            localStorage.setItem('cabelista_session', JSON.stringify(s));
        }

        // ============================================
        // CORE LOGIC
        // ============================================

        function startSim() {
            const n = document.getElementById('inpName').value;
            const a = document.getElementById('inpAbsen').value;
            if(!n || !a) return alert("Isi Data Lengkap!");
            
            s.name = n; s.absen = a;
            document.getElementById('dispName').innerText = n;
            document.getElementById('welcomeModal').classList.add('hidden');
            
            // Mulai timer
            if(!timerInt) timerInt = setInterval(updateTimer, 1000);
            saveSession(); // Simpan awal
        }

        function hardReset() {
    if (confirm("Hapus data sesi dan mulai dari awal?")) {
        clearInterval(timerInt); // hentikan autosave timer
        localStorage.removeItem('cabelista_session');
        location.reload();
    }
}

        function updateTimer() {
            s.elapsedTime++; // Tambah 1 detik
            
            const d = s.elapsedTime;
            const m = Math.floor(d/60).toString().padStart(2,'0');
            const sec = (d%60).toString().padStart(2,'0');
            document.getElementById('timer').innerText = `${m}:${sec}`;
            
            saveSession(); // AUTO SAVE SETIAP DETIK
        }

        function showToast(msg, type='err') {
            const t = document.getElementById('toast');
            t.className = `toast toast-${type}`;
            t.innerText = msg;
            t.style.display = 'block';
            setTimeout(() => t.style.display='none', 2000);
        }

        // --- TOOLS ---
        function useCrimper() {

    if(!s.gloves) return showToast("PAKAI GLOVES! 🧤");
    if(!s.rj45Attached) return showToast("Pasang RJ45 dulu!");
    if(s.isCrimped) return showToast("Sudah di-crimping! 🔒");

    const visual = document.getElementById('rj45Visual');
    const tool = document.getElementById("crimpTool");
    const cable = document.getElementById("cableAssembly");

    // 🔥 Ambil posisi RJ45 relatif ke parent
    const rjRect = visual.getBoundingClientRect();
    const parentRect = cable.getBoundingClientRect();

    const rjTopRelative = rjRect.top - parentRect.top;

    // Tampilkan tang
    tool.style.display = "block";

    // Posisi awal tang (di atas RJ45)
    tool.style.top = (rjTopRelative - 120) + "px";

    setTimeout(() => {

        // Turun tepat ke RJ45
        tool.style.top = (rjTopRelative - 20) + "px";

        // Efek tekan
        visual.style.transform = "scale(0.9)";
        visual.style.filter = "brightness(0.7)";
        cable.classList.add("cable-shake");

    }, 50);

    setTimeout(() => {

        // Kembalikan
        tool.style.top = (rjTopRelative - 120) + "px";
        visual.style.transform = "scale(1)";
        visual.style.filter = "none";
        cable.classList.remove("cable-shake");

        s.isCrimped = true;
        showToast("Kabel berhasil di-crimping! ✅", "info");
        saveSession();

    }, 400);

    setTimeout(() => {
        tool.style.display = "none";
    }, 700);
}

        function toggleGloves() { 
            s.gloves = !s.gloves; 
            document.getElementById('gloveStatus').style.background = s.gloves ? '#22c55e' : 'red'; 
            showToast(s.gloves ? "Safety Gloves ON" : "Gloves OFF", 'info');
            saveSession();
        }

        function dragTool(ev, type) { ev.dataTransfer.setData("tool", type); }
        function allowDrop(ev) { ev.preventDefault(); }
        function dropTool(ev) {
            ev.preventDefault();
            const tool = ev.dataTransfer.getData("tool");
            if(tool === 'stripper') useStripper();
            if(tool === 'cutter') useCutter();
            if(tool === 'crimper') useCrimper();
        }

        function useStripper() {
            if(!s.gloves) return showToast("PAKAI GLOVES!");
            if(s.stripped) return showToast("Sudah dikupas!");
            document.getElementById('cableJacket').style.height = '60px';
            setTimeout(() => {
                document.getElementById('wiresZone').style.opacity = '1';
                document.getElementById('wiresZone').style.zIndex = '30';
                document.getElementById('connectorArea').style.display = 'block';
                s.stripped = true;
                saveSession();
            }, 300);
        }

        function useCutter() {
            if(!s.gloves) return showToast("PAKAI GLOVES!");
            s.cableUsed += 5; 
            document.getElementById('cableMetric').innerText = s.cableUsed;
            
            // Animasi & Reset
            const ass = document.getElementById('cableAssembly');
            ass.style.animation = 'cutAnim 0.3s'; 
            s.stripped = false; s.rj45Attached = false; s.isCrimped = false;
            
            // Reset Arrays
            s.wiresInSlots = [null,null,null,null,null,null,null,null];

            document.getElementById('cableJacket').style.height = '100%';
            document.getElementById('wiresZone').style.opacity = '0';
            document.getElementById('connectorArea').style.display = 'none';
            document.getElementById('rj45Visual').style.display = 'none';
            
            generateSlots(); // Bersihkan slot visual
            spawnWires(false); // Spawn ulang kabel acak
            
            setTimeout(() => { ass.style.animation = ''; }, 300);
            showToast("Kabel dipotong (+5cm)", 'info');
            saveSession();
        }

        // --- WIRING & SPAWN ---
        function spawnWires(isRestore) {
            const sourceZone = document.getElementById('wiresZone'); 
            const slotsZone = document.getElementById('pinSlots');
            sourceZone.innerHTML = '';
            
            // Data kabel master
            const allWires = [...WIRES]; 

            if(isRestore && s.wiresInSlots) {
                // Jika sedang restore session, kita harus taruh kabel di tempat yang benar
                // 1. Bersihkan Slot visual
                slotsZone.innerHTML = ''; 
                
                // 2. Loop setiap slot data yang tersimpan
                s.wiresInSlots.forEach((wireId, index) => {
                    let dSlot = document.createElement('div');
                    dSlot.className = 'pin-slot';
                    dSlot.ondrop = dropWire; 
                    dSlot.ondragover = e => e.preventDefault();
                    
                    if(wireId) {
                        // Cari data kabel berdasarkan ID
                        const wData = allWires.find(w => w.id === wireId);
                        if(wData) {
                            let wEl = createWireEl(wData);
                            dSlot.appendChild(wEl);
                            // Hapus dari list allWires agar tidak double spawn di source
                            const idx = allWires.indexOf(wData);
                            if (idx > -1) allWires.splice(idx, 1); 
                        }
                    }
                    slotsZone.appendChild(dSlot);
                });
            } else {
                // Reset slots visual jika bukan restore atau reset cutter
                generateSlots(); 
            }

            // 3. Sisanya (yang belum masuk slot) taruh di source zone
            // Acak sisanya
            allWires.sort(()=>Math.random()-0.5).forEach(w => {
                let wEl = createWireEl(w);
                sourceZone.appendChild(wEl);
            });
        }

        function createWireEl(wData) {
            let d = document.createElement('div'); 
            d.className = `wire ${wData.c}`; 
            d.id = wData.id; 
            d.draggable = true;
            d.ondragstart = e => e.dataTransfer.setData("wid", wData.id);
            return d;
        }

        function dropWire(ev) {
            ev.preventDefault();
            if(s.rj45Attached) return showToast("RJ45 Terpasang!");
            const wid = ev.dataTransfer.getData("wid");
            const wel = document.getElementById(wid);
            if(ev.target.className === 'pin-slot' && !ev.target.hasChildNodes()) {
                ev.target.appendChild(wel);
                saveSession(); // Save tiap kali drop kabel
            }
        }

        function equipRJ45() {
            if(!s.stripped) return showToast("Kupas dulu!");
            if(s.rj45Attached) return showToast("Sudah pasang!");
            s.rj45Attached = true; s.rjCount++;
            document.getElementById('rjMetric').innerText = s.rjCount;
            document.getElementById('rj45Visual').style.display = 'block';
            showToast("RJ45 Terpasang");
            saveSession();
        }

        //function useMultimeter() { alert("Multimeter: Short Circuit Test OK."); }

        // --- TESTER & SCORING ---
        function generateSlots() {
            const el = document.getElementById('pinSlots'); el.innerHTML = '';
            for(let i=0; i<8; i++) {
                let d = document.createElement('div'); d.className = 'pin-slot'; d.ondrop = dropWire; d.ondragover = e => e.preventDefault(); el.appendChild(d);
            }
        }
        function generateLEDs() {
            const el = document.getElementById('leds'); el.innerHTML = '';
            for(let i=1; i<=8; i++) el.innerHTML += `<div class="led" id="led-${i}"></div>`;
        }
        function openTester() {
            if(!s.rj45Attached) return showToast("Pasang RJ45 dulu!");
            if(!s.isCrimped) return showToast("Kabel longgar! Crimp dulu.", "err");
            document.getElementById('testerModal').style.display = 'flex';
        }
        function closeTester() { document.getElementById('testerModal').style.display = 'none'; }
        
        async function runTest() {
            const slots = document.querySelectorAll('.pin-slot');
            let user = [];
            slots.forEach(s => user.push(s.firstChild ? s.firstChild.className.split(' ')[1] : null));
            const isA = JSON.stringify(user) === JSON.stringify(STANDARDS.T568A);
            const isB = JSON.stringify(user) === JSON.stringify(STANDARDS.T568B);
            
            for(let i=1; i<=8; i++) {
                document.getElementById(`led-${i}`).className = 'led active';
                await new Promise(r => setTimeout(r, 100));
                document.getElementById(`led-${i}`).className = 'led';
            }
            const txt = document.getElementById('testerResult');
            if(isA) { txt.innerText = "PASS: T568A"; txt.style.color = "#22c55e"; s.finalResult = 'T568A'; }
            else if(isB) { txt.innerText = "PASS: T568B"; txt.style.color = "#22c55e"; s.finalResult = 'T568B'; }
            else { txt.innerText = "FAIL"; txt.style.color = "#ef4444"; s.finalResult = 'FAIL'; }
            saveSession();
        }

        function finishExam() {
    clearInterval(timerInt);
    closeTester();

    let score = 100;

    if (s.finalResult === 'FAIL') {
        // Jika urutan kabel salah, nilai mutlak 0
        score = 0; 
    } else {
        // Jika berhasil (T568A atau T568B), hitung penalti pemakaian bahan & waktu
        score -= Math.floor(s.cableUsed / 5) * 10;
        if(s.rjCount > 1) score -= (s.rjCount - 1) * 5;
        if(s.elapsedTime > 150) score -= Math.floor((s.elapsedTime - 150)/10);
    }

    if(score < 0) score = 0;

    document.getElementById('scoreModal').classList.remove('hidden');
    document.getElementById('finalScore').innerText = score;
    document.getElementById('resStd').innerText = s.finalResult || "FAIL";
    document.getElementById('resTime').innerText = document.getElementById('timer').innerText;
    document.getElementById("resName").innerText = s.name;
    document.getElementById("resAbsen").innerText = s.absen;
    document.getElementById("resCable").innerText = s.cableUsed;
    document.getElementById("resRJ45").innerText = s.rjCount;

    document.getElementById("resUploadStatus").innerHTML = "⏳ Menyimpan ke database...";

    // Isi Form
    document.getElementById("form_name").value = s.name;
    document.getElementById("form_absen").value = s.absen;
    document.getElementById("form_score").value = score;
    document.getElementById("form_time").value = document.getElementById('timer').innerText;
    document.getElementById("form_cable").value = s.cableUsed;
    document.getElementById("form_rj45").value = s.rjCount;

    // Tentukan status A/B
    document.getElementById("form_t568a").value = s.finalResult === 'T568A' ? 1 : 0;
    document.getElementById("form_t568b").value = s.finalResult === 'T568B' ? 1 : 0;

    // Hapus session
localStorage.removeItem('cabelista_session');

// Kirim data pakai fetch (AJAX)
fetch("{{ route('simulation.save') }}", {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    body: JSON.stringify({
        name: s.name,
        absen: s.absen,
        score: score,
        status_t568a: s.finalResult === 'T568A' ? 1 : 0,
        status_t568b: s.finalResult === 'T568B' ? 1 : 0,
        time_used: document.getElementById('timer').innerText,
        cable_used: s.cableUsed,
        rj45_used: s.rjCount
    })
})
.then(response => response.json())
.then(data => {
    if(data.status === 'success') {
        document.getElementById("resUploadStatus").innerHTML =
            "✅ Berhasil disimpan";
    } else {
        document.getElementById("resUploadStatus").innerHTML =
            "❌ Gagal menyimpan";
    }
})
.catch(error => {
    document.getElementById("resUploadStatus").innerHTML =
        "❌ Gagal koneksi server";
});

}


        function shareWA() {
            const txt = `*HASIL PRAKTIKUM CABELISTA*%0ANama: ${s.name}%0AAbsen: ${s.absen}%0ASkor: ${document.getElementById('finalScore').innerText}%0AStatus: ${s.finalResult}%0ATime: ${document.getElementById('timer').innerText}%0ACable: ${s.cableUsed}%0ARJ45: ${s.rjCount}`;
            window.open(`https://wa.me/?text=${txt}`, '_blank');
        }
    
    // ================= INTRO SYSTEM =================

const introSteps = [
    {
        element: ".tool-box",
        title: "Step 1 - Isi Data Diri",
        text: "Masukkan Nama dan Nomor Absen sebelum memulai praktikum.",
        icon: "<img src='/assets/icons/welcome.png'width='350'>"
    },
    {
        element: ".tool-box",
        title: "Step 2 - Safety First",
        text: "Klik Safety Gloves terlebih dahulu sebelum menggunakan alat apapun.",
        icon: "<img src='/assets/icons/safety-gloves.png'width='150'>"
    },
    {
        element: ".tool-box",
        title: "Step 3 - Kupas Kabel",
        text: "Gunakan Cable Stripper untuk mengupas jaket kabel.",
        icon: "<img src='/assets/icons/stripper.png' width='150'>"
    },
    {
        element: ".tool-box",
        title: "Step 4 - Urutkan Kabel",
        text: "Susun kabel sesuai standar T568A atau T568B.",
        icon: "<img src='/assets/icons/cabel-utp.png' width='350'>"
    },
    {
        element: ".tool-box",
        title: "Step 5 - Pasang RJ45",
        text: "Pasang konektor RJ45 setelah kabel tersusun rapi.",
        icon: "<img src='/assets/icons/rj45-conn.png' width='150'>"
    },
    {
        element: ".tool-box",
        title: "Step 6 - Crimping",
        text: "Gunakan tang crimp untuk mengunci kabel pada RJ45.",
        icon: "<img src='/assets/icons/crimping-tool.png' width='150'>"
    },
    {
        element: ".tool-box",
        title: "Step 7 - Testing",
        text: "Buka tester, tekan RUN TEST lalu Submit & Score.",
        icon: "<img src='/assets/icons/tester.png' width='150'>"
    },
    {
        element: ".tool-box",
        title: "Step 8 - Cable Cutter",
        text: "Gunakan Cable Cutter untuk memotong kabel jika ingin mengulang.",
        icon: "<img src='/assets/icons/cutter.png' width='150'>"
    },
    {
    element: ".tool-box",
    title: "Sistem Penilaian Praktikum",
    text: `
        --------------Nilai Awal: 100 poin--------------

        ❌ Jika hasil tester FAIL, maka nilai otomatis 0.

        ✅ Jika Urutan Kabel Benar (T568A / T568B)
        Nilai akan dikurangi berdasarkan efisiensi kerja:

        ----------------Pemakaian Kabel-----------------
        - Setiap 5 cm kabel terpakai → dikurangi 10 poin

        ----------------Pemakaian RJ45------------------
        - 1 konektor → tidak ada pengurangan 
        - Jika memakai lebih dari 1 konektor, Setiap tambahan RJ45 → dikurangi 5 poin
        
        ----------------Waktu Pengerjaan----------------
        - Batas waktu ideal: 150 detik (2 menit 30 detik)
        - Setiap kelebihan 10 detik → dikurangi 1 poin
        
        `,
    icon: "🏆"
}
];

let currentIntro = 0;

function startIntro() {
    document.getElementById("gameIntro").classList.remove("hidden");
    showIntroStep();
}

function showIntroStep() {
    const step = introSteps[currentIntro];
    const el = document.querySelector(step.element);
    const highlight = document.getElementById("introHighlight");

    if (!el) return;

    const rect = el.getBoundingClientRect();

    highlight.style.top = rect.top - 5 + "px";
    highlight.style.left = rect.left - 5 + "px";
    highlight.style.width = rect.width + 10 + "px";
    highlight.style.height = rect.height + 10 + "px";

    document.getElementById("introTitle").innerText = step.title;
    document.getElementById("introText").innerText = step.text;
    document.getElementById("introIcon").innerHTML = step.icon;

    const backBtn = document.querySelector(".intro-buttons button:nth-child(1)");
    const nextBtn = document.querySelector(".intro-buttons button:nth-child(2)");
    const startBtn = document.getElementById("introStartBtn");
    const buttonsContainer = document.querySelector(".intro-buttons");

    // 🔹 STEP 1 → HIDE BACK
    if (currentIntro === 0) {
    backBtn.style.display = "none";
    buttonsContainer.style.justifyContent = "flex-end"; // 👉 Next ke kanan
} else {
    backBtn.style.display = "inline-block";
    buttonsContainer.style.justifyContent = "space-between";
}

    // 🔹 STEP TERAKHIR → HIDE NEXT & SHOW START
    if (currentIntro === introSteps.length - 1) {
        nextBtn.style.display = "none";
        startBtn.style.display = "inline-block";
    } else {
        nextBtn.style.display = "inline-block";
        startBtn.style.display = "none";
    }
}

function nextIntro() {
    if(currentIntro < introSteps.length - 1){
        currentIntro++;
        showIntroStep();
    }
}

function prevIntro() {
    if(currentIntro > 0){
        currentIntro--;
        showIntroStep();
    }
}

function closeIntro() {
    document.getElementById("gameIntro").classList.add("hidden");

    // Tandai bahwa tutorial sudah pernah dilihat
    localStorage.setItem("cabelista_intro_seen", "true");
}

function downloadResultImage() {

    const scoreCard = document.querySelector("#scoreModal .modal-box");

    html2canvas(scoreCard, {
        scale: 2
    }).then(canvas => {

        const link = document.createElement("a");
        link.download = `Hasil_Cabelista_${s.name}.png`;
        link.href = canvas.toDataURL("image/png");
        link.click();

    });

}
    </script>

    <form id="resultForm" action="{{ route('simulation.save') }}" method="POST">
    @csrf
    <input type="hidden" name="name" id="form_name">
    <input type="hidden" name="absen" id="form_absen">
    <input type="hidden" name="score" id="form_score">
    <input type="hidden" name="status_t568a" id="form_t568a">
    <input type="hidden" name="status_t568b" id="form_t568b">
    <input type="hidden" name="time_used" id="form_time">
    <input type="hidden" name="cable_used" id="form_cable">
    <input type="hidden" name="rj45_used" id="form_rj45">
</form>

</body>
</html>