<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TaskFlow - Smart Task Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Syne:wght@700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { --blue: #2563eb; --sky: #0ea5e9; --dark: #0a0f1e; }
        * { font-family: 'Outfit', sans-serif; scroll-behavior: smooth; box-sizing: border-box; }
                h1, h2, h3, .display { 
                font-family: 'Syne', 'Outfit', sans-serif;
                    line-height: 1.2;
                letter-spacing: -0.01em;
                    font-weight: 700;
}
        body { background: var(--dark); color: #e2e8f0; overflow-x: hidden; }

        .gt { background: linear-gradient(135deg, #60c0ff, #2563eb, #818cf8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .gbg { background: linear-gradient(135deg, #0ea5e9, #2563eb); }

        /* Noise overlay */
        body::before { content: ''; position: fixed; inset: 0; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E"); pointer-events: none; z-index: 0; opacity: 0.5; }

        /* Animated orbs */
        .orb { position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.12; animation: drift 8s ease-in-out infinite; }
        .orb-1 { width: 500px; height: 500px; background: #2563eb; top: -100px; right: -100px; }
        .orb-2 { width: 400px; height: 400px; background: #0ea5e9; bottom: 0; left: -100px; animation-delay: 3s; }
        .orb-3 { width: 300px; height: 300px; background: #818cf8; top: 40%; left: 40%; animation-delay: 6s; }

        @keyframes drift { 0%,100% { transform: translate(0,0) scale(1); } 33% { transform: translate(30px,-30px) scale(1.05); } 66% { transform: translate(-20px,20px) scale(0.95); } }
        @keyframes float { 0%,100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-18px) rotate(2deg); } }
        @keyframes float2 { 0%,100% { transform: translateY(0px); } 50% { transform: translateY(-12px) rotate(-2deg); } }
        @keyframes float3 { 0%,100% { transform: translateY(0px); } 50% { transform: translateY(-8px); } }
        @keyframes spin-slow { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes spin-rev { from { transform: rotate(360deg); } to { transform: rotate(0deg); } }
        @keyframes pulse-glow { 0%,100% { box-shadow: 0 0 20px rgba(37,99,235,0.3); } 50% { box-shadow: 0 0 50px rgba(37,99,235,0.6); } }
        @keyframes progress { from { width: 0; } to { width: var(--w); } }
        @keyframes slideIn { from { opacity:0; transform: translateX(20px); } to { opacity:1; transform: translateX(0); } }
        @keyframes fadeUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }

        .float-1 { animation: float 4s ease-in-out infinite; }
        .float-2 { animation: float2 5s ease-in-out infinite; animation-delay: 1s; }
        .float-3 { animation: float3 6s ease-in-out infinite; animation-delay: 2s; }
        .spin-slow { animation: spin-slow 14s linear infinite; }
        .spin-rev { animation: spin-rev 9s linear infinite; }

        /* Scroll reveal */
        .reveal { opacity: 0; transform: translateY(50px); transition: all 0.9s cubic-bezier(0.16,1,0.3,1); }
        .reveal.from-left { transform: translateX(-60px); }
        .reveal.from-right { transform: translateX(60px); }
        .reveal.scale-up { transform: scale(0.8); }
        .reveal.visible { opacity: 1; transform: translate(0) scale(1); }
        .d1 { transition-delay: 0.1s; } .d2 { transition-delay: 0.2s; } .d3 { transition-delay: 0.3s; }
        .d4 { transition-delay: 0.4s; } .d5 { transition-delay: 0.5s; } .d6 { transition-delay: 0.6s; }

        /* Cards */
        .glass-card { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(20px); transition: all 0.4s ease; }
        .glass-card:hover { background: rgba(255,255,255,0.07); border-color: rgba(37,99,235,0.4); transform: translateY(-6px); box-shadow: 0 20px 60px rgba(37,99,235,0.15); }
        .task-card { background: rgba(15,20,40,0.95); border: 1px solid rgba(255,255,255,0.08); }

        /* Nav */
        nav { background: rgba(10,15,30,0.85); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.06); }

        /* Badge */
        .badge { background: rgba(37,99,235,0.15); border: 1px solid rgba(37,99,235,0.3); color: #60a5fa; }
        .badge-green { background: rgba(16,185,129,0.15); border: 1px solid rgba(16,185,129,0.3); color: #34d399; }
        .badge-yellow { background: rgba(245,158,11,0.15); border: 1px solid rgba(245,158,11,0.3); color: #fbbf24; }

        .divider { width: 60px; height: 4px; background: linear-gradient(90deg, #2563eb, #0ea5e9); border-radius: 2px; }
        .progress-bar { animation: progress 2s ease-out 0.5s both; }
        .hover-glow { transition: all 0.3s ease; }
        .hover-glow:hover { box-shadow: 0 0 40px rgba(37,99,235,0.5); transform: translateY(-2px); }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--dark); }
        ::-webkit-scrollbar-thumb { background: #2563eb; border-radius: 3px; }
    </style>
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="fixed w-full z-50 py-4 px-6">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
        <div class="flex items-center gap-2.5">
            <div class="w-9 h-9 gbg rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30" style="animation: pulse-glow 3s ease-in-out infinite;">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
            <span class="text-xl font-bold text-white">Task<span class="gt">Flow</span></span>
        </div>
        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-400">
            <a href="#features" class="hover:text-white transition-colors">Features</a>
            <a href="#howto" class="hover:text-white transition-colors">How it Works</a>
            <a href="#creator" class="hover:text-white transition-colors">About</a>
        </div>
        <div class="flex items-center gap-3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="gbg text-white text-sm font-bold px-5 py-2.5 rounded-xl hover:opacity-90 transition-opacity shadow-lg shadow-blue-500/30 hover-glow">Dashboard →</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-400 hover:text-white transition-colors">Sign In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="gbg text-white text-sm font-bold px-5 py-2.5 rounded-xl hover:opacity-90 transition-opacity shadow-lg shadow-blue-500/30 hover-glow">Get Started</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>

<!-- ===== HERO ===== -->
<section class="relative min-h-screen flex items-center overflow-hidden pt-20">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Grid bg -->
    <div class="absolute inset-0 opacity-[0.04]" style="background-image: linear-gradient(rgba(255,255,255,0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.3) 1px, transparent 1px); background-size: 60px 60px;"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-6 py-28 grid lg:grid-cols-2 gap-20 items-center w-full">
        <!-- Text side -->
        <div style="animation: fadeUp 0.8s ease-out both;">
            <div class="badge inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-bold mb-8">
                <span class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse"></span>
                Smart Priority Engine — Now Live
            </div>
            <h1 class="text-6xl lg:text-7xl font-black leading-none mb-6 text-white tracking-tight">
                Do More.<br/>
                Stress <span class="gt">Less.</span>
            </h1>
            <p class="text-gray-400 text-xl leading-relaxed mb-10 max-w-md">
                Your intelligent companion for managing tasks, tracking goals, and building productive habits — beautifully designed for real humans.
            </p>
            <div class="flex items-center gap-4 flex-wrap">
                @auth
                    <a href="{{ url('/home') }}" class="gbg text-white font-bold px-8 py-4 rounded-2xl shadow-2xl shadow-blue-500/40 hover-glow text-lg">Open Dashboard →</a>
                @else
                    <a href="{{ route('register') }}" class="gbg text-white font-bold px-8 py-4 rounded-2xl shadow-2xl shadow-blue-500/40 hover-glow text-lg">Start Free →</a>
                    <a href="{{ route('login') }}" class="text-gray-300 font-semibold hover:text-white transition-colors flex items-center gap-2">
                        Sign In <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @endauth
            </div>

            <!-- Stats -->
            <div class="flex items-center gap-8 mt-14 pt-8 border-t border-white/5">
                <div>
                    <p class="text-3xl font-black text-white count-up" data-target="10" data-suffix="K+">0</p>
                    <p class="text-xs text-gray-500 font-medium mt-0.5">Active Users</p>
                </div>
                <div class="w-px h-10 bg-gray-800"></div>
                <div>
                    <p class="text-3xl font-black text-white count-up" data-target="500" data-suffix="K+">0</p>
                    <p class="text-xs text-gray-500 font-medium mt-0.5">Tasks Completed</p>
                </div>
                <div class="w-px h-10 bg-gray-800"></div>
                <div>
                    <p class="text-3xl font-black text-white">4.9<span class="text-yellow-400">★</span></p>
                    <p class="text-xs text-gray-500 font-medium mt-0.5">User Rating</p>
                </div>
            </div>
        </div>

        <!-- Mockup side -->
        <div class="relative float-1 hidden lg:block" style="animation: fadeUp 1s ease-out 0.2s both;">
            <!-- Spinning rings -->
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="w-[420px] h-[420px] rounded-full border border-blue-500/10 spin-slow absolute"></div>
                <div class="w-[340px] h-[340px] rounded-full border border-indigo-500/15 spin-rev absolute"></div>
                <div class="w-[260px] h-[260px] rounded-full border border-blue-400/10 spin-slow absolute" style="animation-duration: 20s;"></div>
            </div>

            <!-- Main task card -->
            <div class="task-card rounded-3xl p-6 shadow-2xl shadow-blue-900/40 max-w-sm mx-auto relative z-10">
                <!-- Header -->
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <p class="text-xs text-gray-600 font-medium">Good morning 👋</p>
                        <h3 class="text-white font-bold text-lg">My Tasks Today</h3>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                        <div class="w-9 h-9 gbg rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Task list -->
                <div class="space-y-2.5">
                    <div class="flex items-center gap-3 p-3 rounded-xl" style="background: rgba(37,99,235,0.1); border: 1px solid rgba(37,99,235,0.2);">
                        <div class="w-5 h-5 gbg rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-sm text-gray-500 line-through flex-1">Review project proposal</span>
                        <span class="badge-green text-xs px-2 py-0.5 rounded-full font-semibold border">Done</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 rounded-xl" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07);">
                        <div class="w-5 h-5 border-2 border-blue-400 rounded-full flex-shrink-0"></div>
                        <span class="text-sm text-white font-medium flex-1">Team standup meeting</span>
                        <span class="text-xs rounded-full font-semibold px-2 py-0.5 border" style="background: rgba(239,68,68,0.15); border-color: rgba(239,68,68,0.3); color: #f87171;">High</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 rounded-xl" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07);">
                        <div class="w-5 h-5 border-2 border-gray-600 rounded-full flex-shrink-0"></div>
                        <span class="text-sm text-white font-medium flex-1">Update design mockups</span>
                        <span class="badge-yellow text-xs px-2 py-0.5 rounded-full font-semibold border">Med</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 rounded-xl" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07);">
                        <div class="w-5 h-5 border-2 border-gray-700 rounded-full flex-shrink-0"></div>
                        <span class="text-sm text-gray-500 flex-1">Send weekly report</span>
                        <span class="text-xs rounded-full font-semibold px-2 py-0.5 border" style="background: rgba(107,114,128,0.15); border-color: rgba(107,114,128,0.3); color: #9ca3af;">Low</span>
                    </div>
                </div>

                <!-- Progress -->
                <div class="mt-5 pt-4 border-t border-white/5">
                    <div class="flex justify-between text-xs mb-2">
                        <span class="text-gray-500">Today's progress</span>
                        <span class="text-blue-400 font-bold">1 / 4 tasks</span>
                    </div>
                    <div class="h-1.5 bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full gbg rounded-full progress-bar" style="--w: 25%;"></div>
                    </div>
                </div>
            </div>

            <!-- Floating badges -->
            <div class="float-2 absolute -top-8 -right-6 glass-card rounded-2xl px-4 py-3 flex items-center gap-3 shadow-xl z-20">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: rgba(16,185,129,0.2);">
                    <span class="text-lg">🔥</span>
                </div>
                <div>
                    <p class="text-xs font-bold text-white">7-Day Streak!</p>
                    <p class="text-xs text-gray-500">Keep it up!</p>
                </div>
            </div>

            <div class="float-3 absolute -bottom-6 -left-8 glass-card rounded-2xl px-4 py-3 flex items-center gap-3 shadow-xl z-20">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: rgba(37,99,235,0.2);">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-white">+42% productive</p>
                    <p class="text-xs text-gray-500">vs last week</p>
                </div>
            </div>

            <!-- Small notification popup -->
            <div class="absolute top-1/2 -right-12 glass-card rounded-2xl px-3 py-2.5 flex items-center gap-2 shadow-xl z-20" style="animation: slideIn 0.6s ease-out 1s both;">
                <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                <p class="text-xs text-gray-300 font-medium">New task added!</p>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-gray-700">
        <span class="text-xs font-medium tracking-widest uppercase">Scroll</span>
        <div class="w-5 h-9 border-2 border-gray-700 rounded-full flex justify-center pt-1.5">
            <div class="w-1 h-2 bg-blue-400 rounded-full float-3"></div>
        </div>
    </div>
</section>

<!-- ===== FEATURES ===== -->
<section id="features" class="py-32 relative overflow-hidden">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-20 reveal">
            <div class="divider mx-auto mb-6"></div>
            <h2 class="text-5xl font-black text-white mb-4">Everything You Need to <span class="gt">Stay Ahead</span></h2>
            <p class="text-gray-400 max-w-xl mx-auto text-lg">Powerful features engineered to remove friction and help you do your best work.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="glass-card rounded-3xl p-8 reveal d1">
                <div class="w-14 h-14 gbg rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <h3 class="text-white font-bold text-xl mb-3">Smart Checklist</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Intelligent task creation with subtasks, labels, and automatic priority suggestions based on your work habits.</p>
            </div>

            <div class="glass-card rounded-3xl p-8 reveal d2">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #7c3aed, #a855f7); box-shadow: 0 10px 30px rgba(124,58,237,0.3);">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-white font-bold text-xl mb-3">Calendar View</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Visualize your entire schedule at a glance. Plan your week with a drag-and-drop calendar interface.</p>
            </div>

            <div class="glass-card rounded-3xl p-8 reveal d3">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #059669, #10b981); box-shadow: 0 10px 30px rgba(16,185,129,0.3);">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-white font-bold text-xl mb-3">Analytics</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Deep insights into your productivity patterns with beautiful charts that motivate you to push further.</p>
            </div>

            <div class="glass-card rounded-3xl p-8 reveal d1">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #ea580c, #f97316); box-shadow: 0 10px 30px rgba(249,115,22,0.3);">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                </div>
                <h3 class="text-white font-bold text-xl mb-3">Smart Alerts</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Timely notifications that adapt to your schedule so you never miss an important deadline again.</p>
            </div>

            <div class="glass-card rounded-3xl p-8 reveal d2">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #db2777, #ec4899); box-shadow: 0 10px 30px rgba(236,72,153,0.3);">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <h3 class="text-white font-bold text-xl mb-3">Labels & Tags</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Organize everything with custom labels, color tags, and smart filters for instant task lookup.</p>
            </div>

            <div class="glass-card rounded-3xl p-8 reveal d3">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #0891b2, #06b6d4); box-shadow: 0 10px 30px rgba(6,182,212,0.3);">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <h3 class="text-white font-bold text-xl mb-3">Privacy First</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Your data is encrypted and private by default. We believe your tasks are completely yours.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== HOW IT WORKS ===== -->
<section id="howto" class="py-32 relative" style="background: linear-gradient(180deg, transparent, rgba(37,99,235,0.04), transparent);">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-20 reveal">
            <div class="divider mx-auto mb-6"></div>
            <h2 class="text-5xl font-black text-white mb-4">How It <span class="gt">Works</span></h2>
            <p class="text-gray-400 max-w-lg mx-auto">Three simple steps to transform how you manage your day.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 relative">
            <div class="hidden md:block absolute top-10 left-[20%] right-[20%] h-px" style="background: linear-gradient(90deg, transparent, rgba(37,99,235,0.4), rgba(37,99,235,0.4), transparent);"></div>

            <div class="text-center reveal d1">
                <div class="relative inline-flex flex-col items-center mb-8">
                    <div class="w-20 h-20 gbg rounded-3xl flex items-center justify-center shadow-2xl shadow-blue-500/40 float-1">
                        <span class="text-2xl font-black text-white">01</span>
                    </div>
                    <div class="absolute -inset-3 gbg rounded-3xl opacity-10 -z-10" style="animation: float 3s ease-in-out infinite;"></div>
                </div>
                <h3 class="text-white font-bold text-xl mb-3">Create Tasks</h3>
                <p class="text-gray-500 text-sm leading-relaxed px-4">Add tasks in seconds. Set deadlines, priorities, and labels all from one simple interface.</p>
            </div>

            <div class="text-center reveal d3">
                <div class="relative inline-flex flex-col items-center mb-8">
                    <div class="w-20 h-20 rounded-3xl flex items-center justify-center shadow-2xl float-2" style="background: linear-gradient(135deg, #7c3aed, #a855f7); box-shadow: 0 20px 40px rgba(124,58,237,0.4);">
                        <span class="text-2xl font-black text-white">02</span>
                    </div>
                </div>
                <h3 class="text-white font-bold text-xl mb-3">Stay Focused</h3>
                <p class="text-gray-500 text-sm leading-relaxed px-4">Smart notifications and focus mode help you work on what truly matters right now.</p>
            </div>

            <div class="text-center reveal d5">
                <div class="relative inline-flex flex-col items-center mb-8">
                    <div class="w-20 h-20 rounded-3xl flex items-center justify-center shadow-2xl float-3" style="background: linear-gradient(135deg, #059669, #10b981); box-shadow: 0 20px 40px rgba(16,185,129,0.4);">
                        <span class="text-2xl font-black text-white">03</span>
                    </div>
                </div>
                <h3 class="text-white font-bold text-xl mb-3">Track & Celebrate</h3>
                <p class="text-gray-500 text-sm leading-relaxed px-4">Review your wins, build streaks, and watch your productivity grow week over week.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA ===== -->
<section class="py-32 relative overflow-hidden">
    <div class="absolute inset-0 gbg opacity-90"></div>
    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="absolute top-0 left-0 w-72 h-72 rounded-full bg-white/5 -translate-x-1/2 -translate-y-1/2 float-1"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-white/5 translate-x-1/3 translate-y-1/3 float-2"></div>

    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center text-white reveal scale-up">
        <div class="inline-flex items-center gap-2 bg-white/20 rounded-full px-4 py-2 text-sm font-bold mb-8">
            🚀 Join 10,000+ productive people today
        </div>
        <h2 class="text-5xl font-black mb-6 leading-tight">Ready to Transform<br/>Your Productivity?</h2>
        <p class="text-blue-100 text-lg mb-10 leading-relaxed">Start free today. No credit card required.<br/>Cancel anytime, no questions asked.</p>
        @auth
            <a href="{{ url('/home') }}" class="inline-block bg-white text-blue-600 font-black px-12 py-5 rounded-2xl hover:bg-blue-50 transition-all shadow-2xl text-lg hover-glow">Open Dashboard →</a>
        @else
            <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 font-black px-12 py-5 rounded-2xl hover:bg-blue-50 transition-all shadow-2xl text-lg hover-glow">Create Free Account →</a>
        @endauth
    </div>
</section>

<!-- ===== CREATOR ===== -->
<section id="creator" class="py-32 relative overflow-hidden">
    <div class="orb orb-1" style="opacity:0.06;"></div>
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <div class="divider mx-auto mb-6"></div>
            <h2 class="text-5xl font-black text-white mb-4">Meet the <span class="gt">Creator</span></h2>
            <p class="text-gray-500">The person behind TaskFlow</p>
        </div>

        <div class="glass-card rounded-3xl p-10 md:p-14 reveal scale-up">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <!-- Avatar with rings -->
                <div class="flex-shrink-0 relative">
                    <div class="absolute -inset-6 pointer-events-none">
                        <div class="w-full h-full rounded-3xl border border-blue-500/15 spin-slow"></div>
                    </div>
                    <div class="absolute -inset-10 pointer-events-none">
                        <div class="w-full h-full rounded-3xl border border-blue-500/08 spin-rev"></div>
                    </div>
                    <div class="w-40 h-50 rounded-3xl overflow-hidden shadow-2xl shadow-blue-500/50 float-1 relative z-10">
                        <img src="{{ asset('img/foto hafid.jpeg') }}" alt="Ahmad Hafidh An Ni'am" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Info -->
                <div class="text-center md:text-left flex-1">
                    <div class="badge-green inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold mb-5 border">
                        <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                        Open to collaboration
                    </div>
                    <h3 class="text-4xl font-black text-white mb-2">Ahmad Hafidh An Ni'am</h3>
                    <p class="text-blue-400 font-semibold text-lg mb-5">Full Stack Developer · UI/UX Enthusiast</p>
                    <p class="text-gray-400 leading-relaxed max-w-lg mb-7 text-sm">
                        A 10th-grade student at PPLG 1 SMK 7 Samarinda who loves technology and wants a to-do list app that's simple, uncomplicated, and still visually appealing. TaskFlow is here to help you manage your school, office, and even daily tasks without getting overwhelmed or messy.
                    </p>
                    <!-- Tech stack -->
                    <div class="flex flex-wrap gap-2 justify-center md:justify-start mb-7">
                        <p class="text-blue-400 font-semibold text-lg mb-5">Teach Stack yang digunakan</p>
                        <p>
                        <span class="badge px-3 py-1.5 rounded-xl text-xs font-semibold border"> Laravel</span>
                        <span class="badge px-3 py-1.5 rounded-xl text-xs font-semibold border"> Tailwind CSS</span>
                        <span class="badge px-3 py-1.5 rounded-xl text-xs font-semibold border"> MySQL</span>
                        <span class="badge px-3 py-1.5 rounded-xl text-xs font-semibold border"> PHP</span>
                        <span class="badge px-3 py-1.5 rounded-xl text-xs font-semibold border"> JavaScript</span>
                        </p>
                    </div>


                    <!-- Contact links -->
                    <div class="flex items-center gap-3 flex-wrap justify-center md:justify-start">
                        <a href="mailto:ahmadhafidniam@gmail.com" class="flex items-center gap-2 glass-card rounded-xl px-4 py-3 text-sm text-gray-300 hover:text-white hover:border-blue-500/40 transition-all">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            ahmadhafidniam@gmail.com
                        </a>
                        <a href="tel:+6281348985927" class="flex items-center gap-2 glass-card rounded-xl px-4 py-3 text-sm text-gray-300 hover:text-white hover:border-blue-500/40 transition-all">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            (+62) 81348985927
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="border-t border-white/5 py-12">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 gbg rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <span class="text-white font-bold">Task<span class="gt">Flow</span></span>
            </div>
            <p class="text-gray-600 text-sm">© 2026 TaskFlow by <span class="text-gray-400">Ahmad Haafidh A.</span></p>
            <div class="flex items-center gap-6 text-sm text-gray-600">
                <a href="#features" class="hover:text-gray-300 transition-colors">Features</a>
                <a href="#creator" class="hover:text-gray-300 transition-colors">About</a>
                <a href="mailto:taskflow@gmail.com" class="hover:text-gray-300 transition-colors">Contact</a>
            </div>
        </div>
    </div>
</footer>

<script>
// ===== SCROLL REVEAL =====
const revealObs = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

// ===== COUNT UP =====
const countObs = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting && !e.target.dataset.done) {
            e.target.dataset.done = '1';
            const target = parseInt(e.target.dataset.target);
            const suffix = e.target.dataset.suffix || '';
            let cur = 0;
            const step = target / 60;
            const t = setInterval(() => {
                cur = Math.min(cur + step, target);
                e.target.textContent = Math.floor(cur) + suffix;
                if (cur >= target) clearInterval(t);
            }, 16);
        }
    });
}, { threshold: 0.5 });
document.querySelectorAll('.count-up').forEach(el => countObs.observe(el));

// ===== PARALLAX ORBS =====
let ticking = false;
window.addEventListener('scroll', () => {
    if (!ticking) {
        requestAnimationFrame(() => {
            const sy = window.scrollY;
            document.querySelectorAll('.orb').forEach((o, i) => {
                o.style.transform = `translateY(${sy * (i + 1) * 0.04}px)`;
            });
            ticking = false;
        });
        ticking = true;
    }
});

// ===== NAVBAR SCROLL =====
window.addEventListener('scroll', () => {
    const nav = document.querySelector('nav');
    nav.style.background = window.scrollY > 60
        ? 'rgba(10,15,30,0.95)'
        : 'rgba(10,15,30,0.85)';
});
</script>
</body>
</html>
