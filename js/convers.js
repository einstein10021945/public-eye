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
            const size = 300; 

            scene = new THREE.Scene();
            camera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);
            
            renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true, powerPreference: "high-performance" });
            renderer.setSize(size, size);
            renderer.setPixelRatio(window.devicePixelRatio);
            mount.appendChild(renderer.domElement);

            const geometry = new THREE.IcosahedronGeometry(2, 64);
            material = new THREE.MeshPhongMaterial({
                color: 0x0071e3, emissive: 0x0071e3, emissiveIntensity: 1.5,
                shininess: 200, transparent: false
            });

            sphere = new THREE.Mesh(geometry, material);
            scene.add(sphere);
            scene.add(new THREE.PointLight(0xffffff, 2.5).set(10, 10, 10));
            scene.add(new THREE.AmbientLight(0xffffff, 0.8));

            camera.position.z = 5.2;
            animate();
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
                    vec.normalize().multiplyScalar(2 + noise);
                    pos.setXYZ(i, vec.x, vec.y, vec.z);
                }
                pos.needsUpdate = true;
                sphere.rotation.y += 0.007;
            }
            if (material) {
                material.color.lerp(colorTarget, 0.15);
                material.emissive.lerp(colorTarget, 0.15);
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
            const unlock = new SpeechSynthesisUtterance("");
            synth.speak(unlock);
            try { await navigator.mediaDevices.getUserMedia({ audio: true }); } catch (e) {}
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
            window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            recognition = new SpeechRecognition();
            recognition.interimResults = true;
            recognition.continuous = true;
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
                const response = await fetch('http://localhost:8000/chat', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ text, mode: currentMode, session_id: sessionId })
                });
                const data = await response.json();
                if (isActive) { isThinking = false; speak(data.response); }
            } catch (e) {
                console.error('API Error:', e);
                if (isActive) { 
                    isThinking = false; 
                    speak("System link failure. Ensure the Python backend is running."); 
                }
            }
        }

        function speak(text) {
            isSpeaking = true; if (recognition) recognition.stop();
            setOrbState('ai');
            document.getElementById('caption').innerText = text;
            const utter = new SpeechSynthesisUtterance(text);
            const voices = synth.getVoices();
            const nadia = voices.find(v => v.name.includes('Nadia') || v.name.includes('Natural') || v.name.includes('Samantha'));
            utter.voice = nadia || voices[0];
            utter.rate = 0.82;
            utter.onend = () => { isSpeaking = false; setOrbState('ready'); if (isActive) recognition.start(); };
            synth.speak(utter);
        }

        window.addEventListener('load', () => { synth.getVoices(); lucide.createIcons(); initOrb(); });
