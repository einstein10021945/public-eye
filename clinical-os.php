<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinical OS | Alpha v0.1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        
        :root {
            --apple-blue: #0071e3;
            --apple-bg: #ffffff;
            --apple-card: rgba(245, 245, 247, 0.8);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--apple-bg);
            color: #1d1d1f;
            -webkit-font-smoothing: antialiased;
        }

        .glass {
            background: var(--apple-card);
            backdrop-filter: saturate(180%) blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 24px;
        }

        .sidebar-item-active {
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            color: var(--apple-blue);
        }

        .stat-card {
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.04);
        }

        @keyframes pulse-ring {
            0% { transform: scale(0.33); }
            80%, 100% { opacity: 0; }
        }

        .pulse-emerald {
            position: relative;
        }

        .pulse-emerald::before {
            content: '';
            position: absolute;
            left: -8px;
            top: -8px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #10b981;
            animation: pulse-ring 1.25s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
        }
    </style>
</head>
<body class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 border-r border-black/5 p-6 flex flex-col gap-8">
        <div class="flex items-center gap-3 px-2">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                <i data-lucide="shield-plus" class="text-white w-6 h-6"></i>
            </div>
            <h1 class="text-xl font-bold tracking-tight text-black">Clinical <span class="text-blue-600">OS</span></h1>
        </div>

        <nav class="flex flex-col gap-1">
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold sidebar-item-active">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-500 hover:bg-gray-100/50 hover:text-black transition-all">
                <i data-lucide="users" class="w-4 h-4"></i> Patients
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-500 hover:bg-gray-100/50 hover:text-black transition-all">
                <i data-lucide="activity" class="w-4 h-4"></i> Telemetry
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-500 hover:bg-gray-100/50 hover:text-black transition-all">
                <i data-lucide="flask-conical" class="w-4 h-4"></i> Lab Tools
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-500 hover:bg-gray-100/50 hover:text-black transition-all">
                <i data-lucide="settings" class="w-4 h-4"></i> Settings
            </a>
        </nav>

        <div class="mt-auto p-4 glass flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">System Health</p>
                <div class="w-2 h-2 rounded-full bg-emerald-500 pulse-emerald"></div>
            </div>
            <p class="text-xs font-medium text-gray-600">Agentic Engine: Optimal</p>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-[#fbfbfd] p-10 overflow-y-auto">
        <!-- Top Bar -->
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold tracking-tight text-black">Morning, Franz.</h2>
            <div class="flex items-center gap-4">
                <div class="px-4 py-2 glass flex items-center gap-2 text-xs font-bold border-emerald-500/10">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    NEURAL LINK: SYNCED
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-200 border border-black/5"></div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="glass p-8 stat-card">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Total Active Patients</p>
                <div class="flex items-baseline gap-2">
                    <p class="text-5xl font-bold tracking-tighter">42</p>
                    <p class="text-xs font-bold text-emerald-500">+12%</p>
                </div>
            </div>
            <div class="glass p-8 stat-card">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Mean Regulation Score</p>
                <div class="flex items-baseline gap-2">
                    <p class="text-5xl font-bold tracking-tighter text-blue-600">8.4</p>
                    <p class="text-xs font-bold text-emerald-500">Stable</p>
                </div>
            </div>
            <div class="glass p-8 stat-card">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Labs App Engagement</p>
                <div class="flex items-baseline gap-2">
                    <p class="text-5xl font-bold tracking-tighter">94%</p>
                    <p class="text-xs font-bold text-blue-500">High</p>
                </div>
            </div>
        </div>

        <!-- Telemetry Feed -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="glass p-8 space-y-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-black">Real-time Patient Telemetry</h3>
                    <button class="text-blue-600 text-xs font-bold uppercase hover:underline">View All</button>
                </div>
                <div class="space-y-4">
                    <!-- Patient 1 -->
                    <div class="flex items-center justify-between p-4 bg-white/50 rounded-2xl border border-black/5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center text-orange-600 font-bold">JD</div>
                            <div>
                                <p class="text-sm font-bold">John Doe</p>
                                <p class="text-[10px] text-gray-400 uppercase font-mono">panic.btn • 2m ago</p>
                            </div>
                        </div>
                        <span class="text-[10px] bg-red-100 text-red-600 px-3 py-1 rounded-full font-bold">HIGH AROUSAL</span>
                    </div>
                    <!-- Patient 2 -->
                    <div class="flex items-center justify-between p-4 bg-white/50 rounded-2xl border border-black/5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center text-pink-600 font-bold">JS</div>
                            <div>
                                <p class="text-sm font-bold">Jane Smith</p>
                                <p class="text-[10px] text-gray-400 uppercase font-mono">iLovable • 15m ago</p>
                            </div>
                        </div>
                        <span class="text-[10px] bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full font-bold">REGULATED</span>
                    </div>
                </div>
            </div>

            <!-- Parts Mapping -->
            <div class="glass p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-lg font-bold text-black">Mutterly Intelligence: Parts Mapping</h3>
                    <i data-lucide="brain-circuit" class="text-blue-600 w-5 h-5"></i>
                </div>
                <div class="flex items-center justify-center h-48 bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                    <p class="text-sm text-gray-400 italic">Synthetic Parts Visualization [Alpha]</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
