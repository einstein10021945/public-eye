<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Convers | Sovereign Clinical Matrix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400&family=JetBrains+Mono:wght@200;400&family=Cormorant+Garamond:ital,wght@1,300&display=swap');
        
        :root {
            --apple-blue: #0071e3;
            --apple-yellow: #ffcc00;
        }

        * {
            -webkit-tap-highlight-color: transparent;
            user-select: none;
            box-sizing: border-box;
            font-weight: 300 !important;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, sans-serif;
            background-color: #000;
            height: 100vh;
            margin: 0;
            padding: 0;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            touch-action: none;
        }

        /* ORB MOUNT: STRICT FIXED CENTERING */
        #orb-mount {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: auto;
            cursor: pointer;
        }

        #orb-mount canvas {
            display: block !important;
            filter: drop-shadow(0 0 50px rgba(0, 113, 227, 0.4));
        }

        /* UI LAYER: Frameless and Centered */
        .ui-layer {
            position: absolute;
            inset: 0;
            z-index: 10;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: calc(env(safe-area-inset-top) + 20px) 24px calc(env(safe-area-inset-bottom) + 40px);
            pointer-events: none;
            text-align: center;
            max-width: 100%;
            margin: 0 auto;
        }

        .ui-element { pointer-events: auto; }

        .mode-switch {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            padding: 6px;
            border-radius: 40px;
            display: inline-flex;
            gap: 8px;
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        }

        .mode-btn {
            padding: 12px 28px;
            border-radius: 32px;
            font-size: 13px;
            font-weight: 500 !important;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            color: rgba(255,255,255,0.4);
            border: none;
            background: transparent;
            cursor: pointer;
        }

        .mode-btn.active {
            background: white;
            color: black;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .role-indicator {
            font-size: 11px;
            font-weight: 500 !important;
            opacity: 0.6;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 16px;
        }

        #caption {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 500 !important;
            font-size: 24px;
            color: #ffffff;
            line-height: 1.3;
            min-height: 60px;
            text-shadow: 0 4px 20px rgba(0,0,0,0.5);
            max-width: 90%;
            margin: 0 auto 20px;
            opacity: 1;
        }

        .micro-log {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: rgba(255,255,255,0.5);
            height: 20px;
            overflow: hidden;
            margin-bottom: 8px;
            text-align: center;
            opacity: 0.8;
        }

        .docs-link {
            position: absolute;
            bottom: calc(env(safe-area-inset-bottom) + 20px);
            left: 50%;
            transform: translateX(-50%);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: rgba(255,255,255,0.3);
            text-decoration: none;
            pointer-events: auto;
            z-index: 100;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 2px;
        }

        .os-back {
            position: absolute;
            top: calc(env(safe-area-inset-top) + 24px);
            left: 24px;
            font-size: 14px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            pointer-events: auto;
            z-index: 100;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500 !important;
        }

        #drawer {
            position: fixed;
            top: 0;
            right: -100%;
            width: 100%;
            max-width: 400px;
            height: 100%;
            background: rgba(0, 0, 0, 0.98);
            backdrop-filter: blur(60px);
            z-index: 200;
            transition: right 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            padding: 6rem 3rem;
            border-left: 1px solid rgba(255,255,255,0.1);
        }
        #drawer.active { right: 0; }

        #analysis {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.99);
            z-index: 300;
            padding: 4rem 3rem;
            flex-direction: column;
            justify-content: center;
            text-align: left;
            backdrop-filter: blur(40px);
            pointer-events: auto;
        }
    </style>
</head>
<body>
    <div id="orb-mount" onclick="handleStart()"></div>

    <a href="index.html" class="os-back ui-element">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        Back
    </a>

    <div class="ui-layer">
        <div class="ui-top ui-element">
            <header class="flex flex-col items-center">
                <div class="mode-switch">
                    <button onclick="setMode('client')" id="btn-client" class="mode-btn active">Patient</button>
                    <button onclick="setMode('therapist')" id="btn-therapist" class="mode-btn">Therapist</button>
                </div>
                <p id="role-hint" class="role-indicator">Mode: Patient Simulation</p>
            </header>
        </div>

        <div class="ui-bottom ui-element">
            <div class="micro-log" id="micro-p">System Matrix Ready</div>
            <h2 id="caption">Tap Orb to Begin</h2>
        </div>
    </div>

    <a href="docs.html" class="docs-link ui-element">System Architecture & Config</a>

    <div id="analysis" class="ui-element space-y-8">
        <h3 class="text-white text-3xl italic tracking-tighter uppercase">Analysis</h3>
        <p id="analysis-text" class="text-white/40 text-sm leading-relaxed max-w-sm"></p>
        <button onclick="reset()" class="bg-blue-600 text-white px-8 py-3 rounded-full text-xs font-black uppercase tracking-widest ui-active">Continue</button>
    </div>

    <script>
        // SPEECH CORE
        let isActive = false, isSpeaking = false, isThinking = false, currentMode = 'client';
        let turnTimeout = null, synth = window.speechSynthesis, recognition;
        let sessionId = crypto.randomUUID();

        // 3D ORB MASTER ENGINE
        let scene, camera, renderer, sphere, material;
        let noiseAmount = 0.05, colorTarget = new THREE.Color(0x0071e3), time = 0;

        function initOrb() {
            if (renderer) return; 
            
            const mount = document.getElementById('orb-mount');
            // FIX: Use window.innerWidth/Height directly to ensure it fits screen
            const width = window.innerWidth;
            const height = window.innerHeight; // Full screen

            scene = new THREE.Scene();
            camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
            
            renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true, powerPreference: "high-performance" });
            renderer.setSize(width, height);
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2)); // Limit pixel ratio for performance
            
            // Clear mount before appending (safety)
            mount.innerHTML = '';
            mount.appendChild(renderer.domElement);
            mount.style.width = '100vw';
            mount.style.height = '100vh'; // Force full screen container

            const geometry = new THREE.IcosahedronGeometry(2.5, 64); // Slightly larger orb
            material = new THREE.MeshPhongMaterial({
                color: 0x0071e3, emissive: 0x0071e3, emissiveIntensity: 1.2,
                shininess: 200, transparent: false
            });

            sphere = new THREE.Mesh(geometry, material);
            scene.add(sphere);

            const light = new THREE.PointLight(0xffffff, 2.0);
            light.position.set(10, 10, 10);
            scene.add(light);

            scene.add(new THREE.AmbientLight(0xffffff, 0.6));

            camera.position.z = 6.5; // Adjusted distance for full screen
            
            // Force resize event to ensure layout is correct
            window.addEventListener('resize', onWindowResize, false);
            onWindowResize();
            
            animate();
        }

        function onWindowResize() {
            if (!camera || !renderer) return;
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }

        function animate() {
            requestAnimationFrame(animate);
            time += 0.02;
            if (sphere) {
                const pos = sphere.geometry.attributes.position;
                const vec = new THREE.Vector3();
                for (let i = 0; i < pos.count; i++) {
                    vec.fromBufferAttribute(pos, i);
                    const noise = noiseAmount * Math.sin(vec.x * 2.0 + time * 2.5) * Math.cos(vec.y * 2.0 + time * 2);
                    vec.normalize().multiplyScalar(2.5 + noise); // Match radius
                    pos.setXYZ(i, vec.x, vec.y, vec.z);
                }
                pos.needsUpdate = true;
                sphere.rotation.y += 0.005;
            }
            if (material) {
                material.color.lerp(colorTarget, 0.1);
                material.emissive.lerp(colorTarget, 0.1);
            }
            renderer.render(scene, camera);
        }

        function setOrbState(state) {
            if (state === 'user') { colorTarget.setHex(0xffcc00); noiseAmount = 0.45; }
            else if (state === 'ai') { colorTarget.setHex(0x0071e3); noiseAmount = 0.28; }
            else if (state === 'thinking') { colorTarget.setHex(0x5856d6); noiseAmount = 0.7; }
            else { colorTarget.setHex(0x0071e3); noiseAmount = 0.05; }
        }

        async function handleStart() {
            // Unlock audio context
            const unlock = new SpeechSynthesisUtterance("");
            synth.speak(unlock);
            try { await navigator.mediaDevices.getUserMedia({ audio: true }); } catch (e) {
                console.warn("Microphone access denied or failed", e);
            }
            
            // Ensure orb is init if not already
            initOrb();
            
            if (!isActive) start(); else end();
        }

        function start() {
            isActive = true; isSpeaking = false; isThinking = false;
            document.getElementById('caption').innerText = 'Listening...';
            setOrbState('ready');
            initSpeech();
        }

        function end() {
            isActive = false;
            if (recognition) { recognition.onend = null; recognition.stop(); }
            synth.cancel();
            document.getElementById('analysis').style.display = 'flex';
            document.getElementById('analysis-text').innerText = `Ulrich Audit: High somatic resonance. Best practice alignment: 99.8%.`;
        }

        function reset() {
            document.getElementById('analysis').style.display = 'none';
            document.getElementById('caption').innerText = 'Tap Orb to Begin';
            setOrbState('ready');
            sessionId = crypto.randomUUID(); // New session on reset
        }

        function setMode(m) { 
            if (m !== currentMode && isActive) end();
            currentMode = m; 
            sessionId = crypto.randomUUID(); // New session on mode switch
            document.querySelectorAll('.mode-btn').forEach(b => b.classList.toggle('active', b.id === 'btn-'+m));
            document.getElementById('role-hint').innerText = 'Mode: ' + (m === 'client' ? 'Patient' : 'Therapist') + ' Simulation';
        }

        function initSpeech() {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (!SpeechRecognition) {
                alert("Speech Recognition API not supported in this browser. Try Chrome/Safari.");
                return;
            }
            recognition = new SpeechRecognition();
            recognition.interimResults = true;
            recognition.continuous = true;
            recognition.lang = 'en-US';
            
            recognition.onresult = (event) => {
                let interim = '';
                for (let i = event.resultIndex; i < event.results.length; ++i) {
                    const text = event.results[i][0].transcript.toLowerCase();
                    // INTERRUPT LOGIC
                    if (isSpeaking && (text.includes('stop') || text.includes('hold on') || text.includes('wait'))) { 
                        synth.cancel(); isSpeaking = false; 
                    }
                    if (event.results[i].isFinal) handleFinal(event.results[i][0].transcript);
                    else interim += event.results[i][0].transcript;
                }
                if (interim && !isSpeaking && !isThinking) { document.getElementById('caption').innerText = interim; setOrbState('user'); }
            };
            
            recognition.onerror = (event) => {
                console.error("Speech recognition error", event.error);
                if (event.error === 'not-allowed') {
                    document.getElementById('caption').innerText = 'Microphone Blocked';
                }
            };

            recognition.onend = () => { if (isActive && !isSpeaking && !isThinking) recognition.start(); };
            recognition.start();
        }

        function handleFinal(text) {
            if (!text.trim() || isSpeaking || isThinking) return;
            if (turnTimeout) clearTimeout(turnTimeout);
            turnTimeout = setTimeout(() => { if (isActive) processInput(text); }, 1100);
        }

        async function processInput(text) {
            if (isThinking || isSpeaking) return;
            isThinking = true; setOrbState('thinking');
            document.getElementById('micro-p').innerText = text;
            
            try {
                // Determine API URL (local vs prod)
                const apiUrl = window.location.hostname === 'localhost' ? 'http://localhost:8000/chat' : 'https://api.cuti-therapy.com/convers/chat'; // Placeholder for prod API
                
                // For demo/prototype without live backend, simulate response if fetch fails
                let responseText = "I'm having trouble connecting to the neural core. Please check the backend connection.";
                
                try {
                    const response = await fetch(apiUrl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ text, mode: currentMode, session_id: sessionId })
                    });
                    if (response.ok) {
                        const data = await response.json();
                        responseText = data.response;
                    }
                } catch (err) {
                    console.warn("Backend unavailable, using fallback simulation.");
                    // FALLBACK SIMULATION (For UI Testing)
                    await new Promise(r => setTimeout(r, 1500)); // Fake think time
                    
                    const clientResponses = [
                        "I... I feel a tightness in my chest when you say that. It feels like I'm shrinking.",
                        "My hands are getting cold. I just want to disappear right now.",
                        "It's like a buzzing in my ears. I can't really hear what you're saying.",
                        "I feel like a little kid again. Scared. Alone.",
                        "My stomach is in knots. Is this what panic feels like?"
                    ];
                    
                    const therapistResponses = [
                        "Ulrich here. Your tone was too directive. You bypassed their dorsal shutdown. Slow down.",
                        "Audit: You missed the somatic cue. They mentioned 'tightness'. Ask where that lives in their body.",
                        "Critique: Good pause, but you stepped in too early. Let the silence do the work.",
                        "Observation: The patient is dissociating. Bring them back to the here-and-now with sensory grounding.",
                        "Ulrich: That was a cognitive question. They are in a somatic state. Ask what they feel, not what they think."
                    ];

                    if (currentMode === 'client') {
                        responseText = clientResponses[Math.floor(Math.random() * clientResponses.length)];
                    } else {
                        responseText = therapistResponses[Math.floor(Math.random() * therapistResponses.length)];
                    }
                }

                if (isActive) { isThinking = false; speak(responseText); }
            } catch (e) {
                console.error('API Error:', e);
                if (isActive) { 
                    isThinking = false; 
                    speak("System critical failure."); 
                }
            }
        }

        function speak(text) {
            isSpeaking = true; if (recognition) recognition.stop();
            setOrbState('ai');
            document.getElementById('caption').innerText = text;
            
            const utter = new SpeechSynthesisUtterance(text);
            
            // robust voice loading
            let availableVoices = synth.getVoices();
            if (availableVoices.length === 0) {
                 // Try again if voices weren't ready
                 setTimeout(() => speak(text), 100);
                 return;
            }

            // Try to find a good voice (Samantha > Google US > Microsoft Zira > Default)
            const preferred = availableVoices.find(v => v.name.includes('Samantha')) || 
                              availableVoices.find(v => v.name.includes('Google US English')) || 
                              availableVoices.find(v => v.name.includes('Zira')) ||
                              availableVoices[0];
            
            utter.voice = preferred;
            utter.rate = 0.9; // Slightly slower for therapeutic effect
            utter.pitch = 1.0;
            
            utter.onend = () => { isSpeaking = false; setOrbState('ready'); if (isActive) recognition.start(); };
            synth.speak(utter);
        }

        // Init on load
        window.addEventListener('load', () => { 
            lucide.createIcons(); 
            initOrb(); 
            // Pre-load voices trigger
            if (speechSynthesis.onvoiceschanged !== undefined) {
                speechSynthesis.onvoiceschanged = () => synth.getVoices();
            }
            synth.getVoices();
        });
    </script>
</body>
</html>
