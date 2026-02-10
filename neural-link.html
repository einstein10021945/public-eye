<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neural Link | Cross-App Data Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0a0a0c;
            color: #fff;
            overflow: hidden;
        }
        .glow-blue { box-shadow: 0 0 20px rgba(59, 130, 246, 0.4); }
        .glow-emerald { box-shadow: 0 0 20px rgba(16, 185, 129, 0.4); }
        .data-line {
            height: 2px;
            background: linear-gradient(90deg, transparent, #3b82f6, transparent);
            position: absolute;
            width: 100%;
            animation: data-flow 3s linear infinite;
        }
        @keyframes data-flow {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        .app-node {
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .app-node:hover {
            transform: scale(1.1);
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="flex flex-col h-screen">

    <!-- Header -->
    <header class="p-8 flex justify-between items-center border-b border-white/5">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tighter flex items-center gap-2">
                <i data-lucide="network" class="text-blue-500"></i> NEURAL LINK
            </h1>
            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Cross-App Telemetry Hub • v0.1</p>
        </div>
        <div class="flex items-center gap-4">
            <div id="status-chip" class="px-4 py-2 bg-blue-500/10 border border-blue-500/20 rounded-full flex items-center gap-2 text-[10px] font-bold text-blue-400 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                Protocol: Active
            </div>
        </div>
    </header>

    <main class="flex-1 relative flex items-center justify-center">
        <!-- Central Hub -->
        <div class="relative z-10">
            <div class="w-48 h-48 rounded-full border-2 border-blue-500/30 flex items-center justify-center glow-blue bg-blue-500/5">
                <div class="w-40 h-40 rounded-full border border-blue-500/50 flex flex-col items-center justify-center text-center p-4">
                    <i data-lucide="cpu" class="w-8 h-8 text-blue-400 mb-2"></i>
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Master Sync</p>
                    <p id="total-signals" class="text-2xl font-black">1,402</p>
                </div>
            </div>
        </div>

        <!-- App Nodes -->
        <div class="absolute inset-0 flex items-center justify-center">
            <!-- Node: panic.btn -->
            <div class="absolute app-node p-6 rounded-3xl bg-white/5 border border-white/10 w-44 text-center" style="transform: translate(-250px, -120px)">
                <i data-lucide="bell-ring" class="w-6 h-6 text-red-500 mx-auto mb-2"></i>
                <h3 class="text-xs font-bold uppercase tracking-widest mb-1">panic.btn</h3>
                <p class="text-[10px] text-gray-500">Last: 2m ago</p>
                <div class="mt-3 h-1 bg-red-500/20 rounded-full overflow-hidden">
                    <div class="h-full bg-red-500 w-[70%] animate-pulse"></div>
                </div>
            </div>

            <!-- Node: iLovable -->
            <div class="absolute app-node p-6 rounded-3xl bg-white/5 border border-white/10 w-44 text-center" style="transform: translate(250px, -120px)">
                <i data-lucide="heart" class="text-pink-500 mx-auto mb-2"></i>
                <h3 class="text-xs font-bold uppercase tracking-widest mb-1">iLovable</h3>
                <p class="text-[10px] text-gray-400">Sync: Regulated</p>
                <div class="mt-3 h-1 bg-emerald-500/20 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 w-[95%]"></div>
                </div>
            </div>

            <!-- Node: The Wall -->
            <div class="absolute app-node p-6 rounded-3xl bg-white/5 border border-white/10 w-44 text-center" style="transform: translate(0, 220px)">
                <i data-lucide="waves" class="text-blue-400 mx-auto mb-2"></i>
                <h3 class="text-xs font-bold uppercase tracking-widest mb-1">The Wall</h3>
                <p class="text-[10px] text-gray-400">Active Breathing</p>
                <div class="mt-3 h-1 bg-blue-400/20 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-400 w-[40%] animate-pulse"></div>
                </div>
            </div>
        </div>

        <!-- Data Flow Canvas (Simulated) -->
        <div class="absolute inset-0 pointer-events-none opacity-20">
            <div class="data-line" style="top: 30%"></div>
            <div class="data-line" style="top: 70%; animation-delay: 1.5s"></div>
        </div>
    </main>

    <!-- Console -->
    <footer class="p-6 bg-white/5 border-t border-white/5">
        <div class="flex gap-6 items-center overflow-hidden">
            <p class="text-[10px] font-bold text-blue-500 whitespace-nowrap uppercase tracking-widest">[LOG 00:15]</p>
            <p id="log-feed" class="text-[10px] font-mono text-gray-400 truncate">SYNCING LOCAL_STORAGE_SCHEMA... UPLOADING TELEMETRY TO CLINICAL_OS...</p>
        </div>
    </footer>

    <script>
        lucide.createIcons();

        // Simulated Live Feed
        const logs = [
            "SYNCING LOCAL_STORAGE_SCHEMA...",
            "UPLOADING TELEMETRY TO CLINICAL_OS...",
            "PARSING VAGAL TONE FROM THE_WALL...",
            "ENCRYPTING HEART_RATE DATA...",
            "NEURAL LINK: ESTABLISHING HANDSHAKE...",
            "REFINING PARTS_MODEL: PROTECTOR_ALPHA..."
        ];
        let logIdx = 0;
        setInterval(() => {
            document.getElementById('log-feed').innerText = logs[logIdx];
            logIdx = (logIdx + 1) % logs.length;
            
            // Randomly update counter
            const counter = document.getElementById('total-signals');
            counter.innerText = (parseInt(counter.innerText) + Math.floor(Math.random() * 5)).toLocaleString();
        }, 3000);
    </script>
</body>
</html>
