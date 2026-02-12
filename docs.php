<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Convers | System Architecture</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=JetBrains+Mono:wght@400&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #050505;
            color: #e5e5e5;
            line-height: 1.6;
        }

        h1, h2, h3 { font-weight: 500; letter-spacing: -0.02em; color: white; }
        code { font-family: 'JetBrains Mono', monospace; font-size: 0.85em; background: rgba(255,255,255,0.1); padding: 2px 4px; border-radius: 4px; }
        pre { background: #111; padding: 1rem; border-radius: 8px; overflow-x: auto; font-size: 0.85rem; border: 1px solid rgba(255,255,255,0.1); }
        
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body class="p-6 md:p-12 max-w-4xl mx-auto">
    
    <a href="convers.html" class="inline-flex items-center text-sm text-gray-400 hover:text-white mb-8 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="m15 18-6-6 6-6"/></svg>
        Back to Simulation
    </a>

    <header class="mb-12">
        <h1 class="text-4xl md:text-5xl mb-4">System Architecture</h1>
        <p class="text-xl text-gray-400 font-light">Under the hood of the Sovereign Clinical Matrix.</p>
    </header>

    <section class="glass-panel">
        <h2 class="text-2xl mb-6 flex items-center gap-3">
            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
            Overview
        </h2>
        <p class="mb-4">
            Convers is a **Sovereign AI Application**. Unlike typical SaaS tools, it runs entirely on your own infrastructure (or a secure private cloud). It does not send patient data to third-party aggregators.
        </p>
        <div class="grid md:grid-cols-2 gap-8 mt-8">
            <div>
                <h3 class="text-lg text-white mb-2">Frontend</h3>
                <ul class="list-disc list-inside text-gray-400 space-y-1">
                    <li>Pure HTML5/JS (No Framework Bloat)</li>
                    <li>Three.js Somatic Orb Engine</li>
                    <li>WebSpeech API for Voice I/O</li>
                    <li>Tailwind CSS for Styling</li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg text-white mb-2">Backend</h3>
                <ul class="list-disc list-inside text-gray-400 space-y-1">
                    <li>Python FastAPI Server</li>
                    <li>Stateful Session Memory</li>
                    <li>Stealth LLM Driver (Headless Browser)</li>
                    <li>Modular Prompt System</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="glass-panel">
        <h2 class="text-2xl mb-6 flex items-center gap-3">
            <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
            Configuration (BYO Keys)
        </h2>
        <p class="mb-4">
            By default, Convers uses a **Stealth Driver** to access AI models without API keys. For production reliability or HIPAA compliance, you can configure it to use your own secure API endpoints.
        </p>
        
        <h3 class="text-lg text-white mt-6 mb-3">1. Environment Setup</h3>
        <p class="mb-2 text-gray-400">Create a `.env` file in the `api/` directory:</p>
        <pre><code class="language-bash"># api/.env

# Optional: Use OpenAI/Anthropic instead of Stealth Mode
OPENAI_API_KEY=sk-...
ANTHROPIC_API_KEY=sk-ant-...

# System Settings
LOG_LEVEL=INFO
SESSION_TIMEOUT=3600</code></pre>

        <h3 class="text-lg text-white mt-8 mb-3">2. Prompt Engineering</h3>
        <p class="mb-2 text-gray-400">Edit the clinical personas in `api/prompts/` to tune the simulation:</p>
        <ul class="space-y-2 mt-2">
            <li class="flex items-center gap-2">
                <code class="text-blue-400">api/prompts/client_alex.txt</code>
                <span class="text-sm text-gray-500">- The Anxious Patient Persona</span>
            </li>
            <li class="flex items-center gap-2">
                <code class="text-yellow-400">api/prompts/supervisor_ulrich.txt</code>
                <span class="text-sm text-gray-500">- The Clinical Auditor Persona</span>
            </li>
        </ul>
    </section>

    <section class="glass-panel">
        <h2 class="text-2xl mb-6 flex items-center gap-3">
            <span class="w-2 h-2 rounded-full bg-green-500"></span>
            Developer Notes
        </h2>
        <p class="text-gray-400 mb-4">
            The 3D Orb is procedurally generated using Perlin noise mapped to an Icosahedron geometry. It reacts to "State" (Listening, Thinking, Speaking) by interpolating between color targets (`lerp`).
        </p>
        <p class="text-gray-400">
            Voice synthesis prioritizes local high-quality voices ("Samantha", "Nadia") to minimize latency.
        </p>
    </section>

    <footer class="text-center text-gray-600 text-sm mt-12 mb-8">
        &copy; 2026 Columbia United Therapy Institute. Built by Ulrich.
    </footer>

</body>
</html>
