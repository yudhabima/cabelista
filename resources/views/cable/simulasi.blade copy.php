<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabelista - Cable Stripping Simulator</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #e8f5e8;
            min-height: 100vh;
            color: #333;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: #e8f5e8;
            border-bottom: 1px solid #ddd;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        
        .logo::before {
            content: "🔌";
            margin-right: 10px;
        }
        
        .nav-menu {
            display: flex;
            gap: 20px;
        }
        
        .nav-item {
            padding: 8px 16px;
            background: transparent;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s ease;
        }
        
        .nav-item:hover {
            background: rgba(0,0,0,0.1);
        }
        
        .status-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
            padding: 10px 30px;
            background: #f0f0f0;
            font-size: 14px;
        }
        
        .reset-btn {
            padding: 8px 16px;
            background: #ffa726;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s ease;
        }
        
        .reset-btn:hover {
            background: #ff9800;
        }
        
        .main-container {
            display: flex;
            height: calc(100vh - 120px);
            padding: 20px;
            gap: 20px;
        }
        
        .tools-panel, .equipment-panel {
            width: 300px;
            background: #f9d71c;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .work-area {
            flex: 1;
            background: #b8d4b8;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .panel-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        
        .panel-subtitle {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
            color: #666;
        }
        
        .tool-item, .equipment-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px 0;
            cursor: pointer;
            transition: transform 0.2s ease;
            user-select: none;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .tool-item:hover, .equipment-item:hover {
            transform: scale(1.05);
            background: rgba(255,255,255,0.2);
        }
        
        .tool-icon, .equipment-icon {
            font-size: 48px;
            margin-bottom: 8px;
        }
        
        .tool-name, .equipment-name {
            font-size: 12px;
            text-align: center;
            color: #333;
            font-weight: 600;
        }
        
        .cable-container {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }
        
        .cable-outer {
            width: 400px;
            height: 80px;
            background: #f0f0f0;
            border: 3px solid #ddd;
            border-radius: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .cable-outer:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2), inset 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .cable-outer.being-cut {
            animation: shake 0.3s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-2px); }
            75% { transform: translateX(2px); }
        }
        
        .cable-label {
            color: #666;
            font-size: 14px;
            font-weight: bold;
            user-select: none;
        }
        
        .cut-indicator {
            position: absolute;
            top: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 90px;
            background: #ff4444;
            border-radius: 2px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .cut-indicator.visible {
            opacity: 1;
            animation: cut-line 0.5s ease-in-out;
        }
        
        @keyframes cut-line {
            0% { height: 0; }
            100% { height: 90px; }
        }
        
        .inner-wires {
            display: flex;
            gap: 8px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s ease;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .inner-wires.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        
        .wire {
            width: 30px;
            height: 120px;
            border-radius: 4px;
            border: 2px solid #333;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .wire:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }
        
        .wire::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, 
                rgba(255,255,255,0.3) 0%, 
                transparent 30%, 
                transparent 70%, 
                rgba(0,0,0,0.2) 100%);
        }
        
        .wire-label {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            color: #333;
            width: 40px;
        }
        
        .tool-active {
            background: rgba(255,255,255,0.4);
            box-shadow: 0 0 15px rgba(255,255,255,0.6);
        }
        
        .equipment-active {
            background: rgba(255,255,255,0.4);
            box-shadow: 0 0 15px rgba(255,255,255,0.6);
        }
        
        .instructions {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(255,255,255,0.95);
            padding: 15px 25px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .instructions.pulsing {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: translateX(-50%) scale(1); }
            50% { transform: translateX(-50%) scale(1.05); }
        }
        
        .step-counter {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(33, 150, 243, 0.9);
            color: white;
            padding: 10px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }
        
        .footer {
            text-align: center;
            padding: 15px;
            color: #666;
            font-size: 12px;
        }
        
        .cutting-animation {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 48px;
            opacity: 0;
            z-index: 10;
        }
        
        .cutting-animation.active {
            animation: cutting 1s ease-in-out;
        }
        
        @keyframes cutting {
            0% { opacity: 0; transform: translate(-50%, -50%) rotate(-45deg) scale(0.5); }
            50% { opacity: 1; transform: translate(-50%, -50%) rotate(0deg) scale(1.2); }
            100% { opacity: 0; transform: translate(-50%, -50%) rotate(45deg) scale(0.5); }
        }
        
        @media (max-width: 1024px) {
            .main-container {
                flex-direction: column;
                height: auto;
            }
            
            .tools-panel, .equipment-panel {
                width: 100%;
                height: auto;
            }
            
            .cable-outer {
                width: 300px;
                height: 60px;
            }
            
            .inner-wires {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .wire {
                width: 25px;
                height: 80px;
                margin: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">CABELISTA</div>
        <div class="nav-menu">
            <button class="nav-item">Setting</button>
        </div>
    </div>
    
    <div class="status-bar">
        <span id="timer">Elapsed 00:00:00</span>
        <span id="cable-info">Cable 3 c.m.</span>
        <button class="reset-btn" onclick="resetSimulation()">Reset</button>
    </div>
    
    <div class="main-container">
        <div class="tools-panel">
            <div class="panel-title">Tools</div>
            <div class="panel-subtitle">(Drag To Use)</div>
            
            <div class="tool-item" data-tool="gloves" onclick="selectTool('gloves')">
                <div class="tool-icon"></div>
                <div class="tool-name">Safety Gloves</div>
            </div>
            
            <div class="tool-item" data-tool="cutter" onclick="selectTool('cutter')">
                <div class="tool-icon"></div>
                <div class="tool-name">Cable Cutter</div>
            </div>
            
            <div class="tool-item" data-tool="stripper" onclick="selectTool('stripper')">
                <div class="tool-icon"></div>
                <div class="tool-name">Wire Stripper</div>
            </div>
        </div>
        
        <div class="work-area">
            <div class="step-counter">Step 1: Strip Cable</div>
            <div class="instructions" id="instructions">Put on safety gloves first</div>
            
            <div class="cable-container">
                <div class="cable-outer" id="cableOuter" onclick="cutCable()">
                    <div class="cable-label">UTP Cable - Click to Cut</div>
                    <div class="cut-indicator" id="cutIndicator"></div>
                </div>
                
                <div class="cutting-animation" id="cuttingAnimation">✂️</div>
                
                <div class="inner-wires" id="innerWires">
                    <!-- Wires akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
        
        <div class="equipment-panel">
            <div class="panel-title">Equipment</div>
            <div class="panel-subtitle">(Tap To Use)</div>
            
            <div class="equipment-item" data-equipment="connector" onclick="selectEquipment('connector')">
                <div class="equipment-icon">🔌</div>
                <div class="equipment-name">RJ45 Connector</div>
            </div>
            
            <div class="equipment-item" data-equipment="tester" onclick="selectEquipment('tester')">
                <div class="equipment-icon">📱</div>
                <div class="equipment-name">Cable Tester</div>
            </div>
            
            <div class="equipment-item" data-equipment="multimeter" onclick="selectEquipment('multimeter')">
                <div class="equipment-icon">⚡</div>
                <div class="equipment-name">Multimeter</div>
            </div>
        </div>
    </div>
    
    <div class="footer">
        ©crosslink - 2025
    </div>

    <script>
        // Wire colors based on T568B standard
        const wireColors = [
            { name: 'White-Orange', color: '#FFE4B5', code: '1' },
            { name: 'Orange', color: '#FFA500', code: '2' },
            { name: 'White-Green', color: '#90EE90', code: '3' },
            { name: 'Blue', color: '#0000FF', code: '4' },
            { name: 'White-Blue', color: '#ADD8E6', code: '5' },
            { name: 'Green', color: '#008000', code: '6' },
            { name: 'White-Brown', color: '#DEB887', code: '7' },
            { name: 'Brown', color: '#8B4513', code: '8' }
        ];
        
        let currentStep = 0; // 0: gloves, 1: cutter, 2: cut cable
        let selectedTool = null;
        let selectedEquipment = null;
        let startTime = Date.now();
        let timerInterval;
        let cableIsCut = false;
        
        // Initialize
        function init() {
            createInnerWires();
            startTimer();
            updateInstructions();
        }
        
        // Create inner wire elements
        function createInnerWires() {
            const innerWires = document.getElementById('innerWires');
            innerWires.innerHTML = '';
            
            wireColors.forEach((wire, index) => {
                const wireElement = document.createElement('div');
                wireElement.className = 'wire';
                wireElement.style.backgroundColor = wire.color;
                wireElement.dataset.wireIndex = index;
                
                const wireLabel = document.createElement('div');
                wireLabel.className = 'wire-label';
                wireLabel.textContent = wire.code;
                
                wireElement.appendChild(wireLabel);
                innerWires.appendChild(wireElement);
                
                // Add click handler for individual wires
                wireElement.addEventListener('click', () => {
                    if (cableIsCut) {
                        selectWire(index);
                    }
                });
            });
        }
        
        // Timer functions
        function startTimer() {
            timerInterval = setInterval(updateTimer, 1000);
        }
        
        function updateTimer() {
            const elapsed = Math.floor((Date.now() - startTime) / 1000);
            const hours = Math.floor(elapsed / 3600).toString().padStart(2, '0');
            const minutes = Math.floor((elapsed % 3600) / 60).toString().padStart(2, '0');
            const seconds = (elapsed % 60).toString().padStart(2, '0');
            
            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById('timer').textContent = `Elapsed ${timeString}`;
        }
        
        // Tool selection
        function selectTool(tool) {
            // Remove previous tool selection
            const allTools = document.querySelectorAll('.tool-item');
            allTools.forEach(item => item.classList.remove('tool-active'));
            
            // Select new tool
            const toolElement = document.querySelector(`[data-tool="${tool}"]`);
            toolElement.classList.add('tool-active');
            selectedTool = tool;
            
            updateStep(tool);
            updateInstructions();
        }
        
        // Equipment selection
        function selectEquipment(equipment) {
            // Remove previous equipment selection
            const allEquipment = document.querySelectorAll('.equipment-item');
            allEquipment.forEach(item => item.classList.remove('equipment-active'));
            
            // Select new equipment
            const equipmentElement = document.querySelector(`[data-equipment="${equipment}"]`);
            equipmentElement.classList.add('equipment-active');
            selectedEquipment = equipment;
            
            updateInstructions();
        }
        
        // Update step based on tool selection
        function updateStep(tool) {
            if (tool === 'gloves' && currentStep === 0) {
                currentStep = 1;
            } else if (tool === 'cutter' && currentStep === 1) {
                currentStep = 2;
            }
        }
        
        // Update instructions
        function updateInstructions() {
            const instructions = document.getElementById('instructions');
            instructions.classList.remove('pulsing');
            
            switch (currentStep) {
                case 0:
                    instructions.textContent = 'Put on safety gloves first';
                    instructions.className = 'instructions pulsing';
                    break;
                case 1:
                    instructions.textContent = 'Select cable cutter tool';
                    instructions.className = 'instructions pulsing';
                    break;
                case 2:
                    if (!cableIsCut) {
                        instructions.textContent = 'Click on the cable to cut it';
                        instructions.className = 'instructions pulsing';
                    } else {
                        instructions.textContent = 'Great! Inner wires are now exposed';
                        instructions.className = 'instructions';
                        instructions.style.background = 'rgba(76, 175, 80, 0.9)';
                        instructions.style.color = 'white';
                    }
                    break;
                default:
                    instructions.textContent = 'Follow the steps to complete the cable preparation';
                    instructions.className = 'instructions';
            }
        }
        
        // Cut cable function
        function cutCable() {
            if (currentStep < 2 || cableIsCut) return;
            
            const cableOuter = document.getElementById('cableOuter');
            const cutIndicator = document.getElementById('cutIndicator');
            const innerWires = document.getElementById('innerWires');
            const cuttingAnimation = document.getElementById('cuttingAnimation');
            
            // Show cutting animation
            cableOuter.classList.add('being-cut');
            cutIndicator.classList.add('visible');
            cuttingAnimation.classList.add('active');
            
            // Play cutting sound effect (if available)
            // const audio = new Audio('cut-sound.mp3');
            // audio.play().catch(() => {}); // Ignore audio errors
            
            setTimeout(() => {
                cableOuter.style.display = 'none';
                innerWires.classList.add('revealed');
                cableIsCut = true;
                updateInstructions();
                
                // Remove animations
                cuttingAnimation.classList.remove('active');
            }, 1000);
        }
        
        // Select individual wire
        function selectWire(index) {
            const wire = wireColors[index];
            const instructions = document.getElementById('instructions');
            
            // Remove selection from other wires
            const allWires = document.querySelectorAll('.wire');
            allWires.forEach(w => w.style.border = '2px solid #333');
            
            // Highlight selected wire
            const selectedWireElement = document.querySelector(`[data-wire-index="${index}"]`);
            selectedWireElement.style.border = '3px solid #ff4444';
            selectedWireElement.style.boxShadow = '0 0 15px rgba(255, 68, 68, 0.6)';
            
            instructions.textContent = `Selected: ${wire.name} (Pin ${index + 1})`;
            instructions.style.background = 'rgba(33, 150, 243, 0.9)';
            instructions.style.color = 'white';
        }
        
        // Reset simulation
        function resetSimulation() {
            currentStep = 0;
            selectedTool = null;
            selectedEquipment = null;
            cableIsCut = false;
            startTime = Date.now();
            
            // Reset UI elements
            document.querySelectorAll('.tool-active').forEach(item => 
                item.classList.remove('tool-active'));
            document.querySelectorAll('.equipment-active').forEach(item => 
                item.classList.remove('equipment-active'));
            
            const cableOuter = document.getElementById('cableOuter');
            const innerWires = document.getElementById('innerWires');
            const instructions = document.getElementById('instructions');
            
            cableOuter.style.display = 'flex';
            cableOuter.classList.remove('being-cut');
            innerWires.classList.remove('revealed');
            
            document.getElementById('cutIndicator').classList.remove('visible');
            
            instructions.style.background = 'rgba(255,255,255,0.95)';
            instructions.style.color = '#333';
            
            // Reset wire selections
            const allWires = document.querySelectorAll('.wire');
            allWires.forEach(w => {
                w.style.border = '2px solid #333';
                w.style.boxShadow = '';
            });
            
            updateInstructions();
        }
        
        // Initialize when page loads
        window.addEventListener('load', init);
        
        // Add keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            switch(e.key.toLowerCase()) {
                case 'g':
                    selectTool('gloves');
                    break;
                case 'c':
                    selectTool('cutter');
                    break;
                case 's':
                    selectTool('stripper');
                    break;
                case 'r':
                    resetSimulation();
                    break;
                case ' ':
                    e.preventDefault();
                    if (currentStep === 2) cutCable();
                    break;
            }
        });
    </script>
</body>
</html>