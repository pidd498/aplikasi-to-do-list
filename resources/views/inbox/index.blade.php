<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Inbox</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        *{font-family:'Outfit',sans-serif;transition:background-color 0.3s,color 0.3s,border-color 0.3s;}
        [data-theme="dark"]{--bg:#0a0f1e;--bg2:#111827;--bg3:#1f2937;--sidebar:#0d1526;--card:#111827;--border:rgba(255,255,255,0.08);--text:#f1f5f9;--text2:#94a3b8;--text3:#64748b;--blue:#2563eb;--blue-light:#60a5fa;--active-bg:rgba(37,99,235,0.15);--active-border:rgba(37,99,235,0.4);--hover:rgba(255,255,255,0.04);--shadow:rgba(0,0,0,0.4);}
        [data-theme="light"]{--bg:#f0f4ff;--bg2:#ffffff;--bg3:#f1f5f9;--sidebar:#ffffff;--card:#ffffff;--border:rgba(0,0,0,0.08);--text:#0f172a;--text2:#475569;--text3:#94a3b8;--blue:#2563eb;--blue-light:#2563eb;--active-bg:rgba(37,99,235,0.1);--active-border:rgba(37,99,235,0.3);--hover:rgba(0,0,0,0.03);--shadow:rgba(0,0,0,0.08);}
        body{background:var(--bg);color:var(--text);}
        ::-webkit-scrollbar{width:5px;}::-webkit-scrollbar-thumb{background:#2563eb;border-radius:3px;}
        .sidebar{background:var(--sidebar);border-right:1px solid var(--border);}
        .nav-item{display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:12px;color:var(--text2);font-weight:600;font-size:14px;text-decoration:none;transition:all 0.2s;border:1px solid transparent;}
        .nav-item:hover{background:var(--hover);color:var(--text);}
        .nav-item.active{background:var(--active-bg);border-color:var(--active-border);color:var(--blue-light);}
        .tf-card{background:var(--card);border:1px solid var(--border);border-radius:16px;}
        .topbar{background:var(--card);border:1px solid var(--border);border-radius:16px;}
        .gbg{background:linear-gradient(135deg,#0ea5e9,#2563eb);}
        .theme-toggle{width:44px;height:24px;background:var(--bg3);border:1px solid var(--border);border-radius:999px;position:relative;cursor:pointer;}
        .theme-toggle-thumb{width:18px;height:18px;background:var(--blue);border-radius:50%;position:absolute;top:2px;left:2px;transition:all 0.3s;}
        [data-theme="light"] .theme-toggle-thumb{left:22px;background:#f59e0b;}
        @keyframes fadeUp{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}
        .fade-up{animation:fadeUp 0.4s ease both;}
        .d1{animation-delay:0.05s}.d2{animation-delay:0.1s}.d3{animation-delay:0.15s}.d4{animation-delay:0.2s}
    </style>
</head>
<body>
<section class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <div class="sidebar w-64 flex flex-col gap-6 p-6 h-screen shrink-0 overflow-y-auto">
        <div class="flex items-center gap-2.5 py-2">
            <div class="w-9 h-9 gbg rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
            <span class="text-lg font-black" style="color:var(--text)">Task<span style="background:linear-gradient(135deg,#0ea5e9,#2563eb);-webkit-background-clip:text;-webkit-text-fill-color:transparent">Flow</span></span>
        </div>
        <div class="flex flex-col gap-1">
            <p class="text-xs font-bold uppercase tracking-widest mb-2" style="color:var(--text3)">Main Menu</p>
            <a href="{{ route('home.index') }}" class="nav-item"><svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Home</a>
            <a href="{{ route('tasks.index') }}" class="nav-item"><svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>My Task</a>
            <a href="{{ route('todos.index') }}" class="nav-item"><svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>My Todo</a>
            </svg>
<a href="{{ route('inbox.index') }}" class="nav-item">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
    </svg>
    Inbox
    @if($notificationCount > 0)
        <span class="ml-auto gbg text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $notificationCount }}</span>
    @endif
</a>
</a>
            <a href="{{ route('history.index') }}" class="nav-item"><svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>History</a>
        </div>
        <div class="flex-1"></div>
        <div class="tf-card p-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 gbg rounded-xl flex items-center justify-center text-white font-bold text-lg flex-shrink-0">{{ strtoupper(substr($userName, 0, 1)) }}</div>
                <div class="min-w-0"><p class="font-bold text-sm truncate" style="color:var(--text)">{{ $userName }}</p><p class="text-xs truncate" style="color:var(--text3)">{{ $userEmail }}</p></div>
            </div>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 rounded-xl text-sm font-semibold" style="background:var(--bg3);color:var(--text2)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Logout
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col overflow-hidden" style="background:var(--bg)">
        <div class="p-6 pb-0">
            <div class="topbar flex justify-between items-center px-6 py-4 fade-up">
                <div>
                    <h1 class="text-xl font-black" style="color:var(--text)">Inbox</h1>
                    <p class="text-sm" style="color:var(--text3)">{{ date('l, d F Y') }} · {{ $notificationCount }} notification{{ $notificationCount != 1 ? 's' : '' }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        <span class="text-sm" style="color:var(--text3)">☀️</span>
                        <div class="theme-toggle" id="themeToggle"><div class="theme-toggle-thumb"></div></div>
                        <span class="text-sm" style="color:var(--text3)">🌙</span>
                    </div>
                    <div class="flex items-center gap-3 pl-3" style="border-left:1px solid var(--border)">
                        <div class="w-9 h-9 gbg rounded-xl flex items-center justify-center text-white font-bold flex-shrink-0">{{ strtoupper(substr($userName, 0, 1)) }}</div>
                        <p class="text-sm font-bold hidden md:block" style="color:var(--text)">{{ $userName }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto p-6 flex flex-col gap-4">

            @if($notificationCount == 0)
            <!-- Empty state -->
            <div class="tf-card p-20 flex flex-col items-center gap-4 fade-up">
                <div class="w-20 h-20 rounded-3xl flex items-center justify-center" style="background:var(--bg3)">
                    <svg class="w-10 h-10" style="color:var(--text3)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                </div>
                <p class="text-xl font-bold" style="color:var(--text3)">All caught up!</p>
                <p class="text-sm" style="color:var(--text3)">No new notifications. Great job staying on top of things 🎉</p>
            </div>
            @else

            @forelse($notifications as $notif)
                @if($notif['type'] === 'task_manager')
                    @php $interval = $notif['interval']; $taskName = $notif['message']; @endphp

                    @if($interval < 0)
                    <!-- Overdue -->
                    <div class="tf-card p-5 flex items-start gap-4 fade-up" style="border-left:4px solid #ef4444;">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(239,68,68,0.15);">
                            <svg class="w-6 h-6" style="color:#f87171" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full" style="background:rgba(239,68,68,0.15);color:#f87171;border:1px solid rgba(239,68,68,0.3)">Overdue</span>
                            </div>
                            <p class="font-semibold" style="color:var(--text)">Hai {{ $userName }}, task <span style="color:#f87171">{{ $taskName }}</span> telah melewati batas waktu!</p>
                            <p class="text-sm mt-1" style="color:var(--text3)">Segera selesaikan atau update statusnya 💪</p>
                        </div>
                    </div>

                    @elseif($interval == 0)
                    <!-- Due today -->
                    <div class="tf-card p-5 flex items-start gap-4 fade-up" style="border-left:4px solid #f59e0b;">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(245,158,11,0.15);">
                            <svg class="w-6 h-6" style="color:#fbbf24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full" style="background:rgba(245,158,11,0.15);color:#fbbf24;border:1px solid rgba(245,158,11,0.3)">Due Today</span>
                            </div>
                            <p class="font-semibold" style="color:var(--text)">Hai {{ $userName }}, task <span style="color:#fbbf24">{{ $taskName }}</span> jatuh tempo hari ini!</p>
                            <p class="text-sm mt-1" style="color:var(--text3)">Hari ini adalah batas terakhir — ayo kerjakan! 💪</p>
                        </div>
                    </div>

                    @elseif($interval >= 1 && $interval <= 3)
                    <!-- Due soon -->
                    <div class="tf-card p-5 flex items-start gap-4 fade-up" style="border-left:4px solid #2563eb;">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(37,99,235,0.15);">
                            <svg class="w-6 h-6" style="color:#60a5fa" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full" style="background:rgba(37,99,235,0.15);color:#60a5fa;border:1px solid rgba(37,99,235,0.3)">{{ $interval }} day{{ $interval > 1 ? 's' : '' }} left</span>
                            </div>
                            <p class="font-semibold" style="color:var(--text)">Hai {{ $userName }}, task <span style="color:#60a5fa">{{ $taskName }}</span> akan berakhir {{ $interval }} hari lagi.</p>
                            <p class="text-sm mt-1" style="color:var(--text3)">Masih ada waktu — tapi jangan ditunda ya! 💪</p>
                        </div>
                    </div>
                    @endif

                @elseif($notif['type'] === 'task')
                <!-- Activity today -->
                <div class="tf-card p-5 flex items-start gap-4 fade-up" style="border-left:4px solid #10b981;">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(16,185,129,0.15);">
                        <svg class="w-6 h-6" style="color:#34d399" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-bold px-2 py-0.5 rounded-full" style="background:rgba(16,185,129,0.15);color:#34d399;border:1px solid rgba(16,185,129,0.3)">Today's Activity</span>
                        </div>
                        <p class="font-semibold" style="color:var(--text)">Hai {{ $userName }}, hari ini ada aktivitas <span style="color:#34d399">{{ $notif['message'] }}</span>!</p>
                        <p class="text-sm mt-1" style="color:var(--text3)">Jangan lupa ya — semangat! 💪</p>
                    </div>
                </div>
                @endif
            @empty
            @endforelse
            @endif

        </div>
    </div>
</section>

<script>
    const html = document.documentElement;
    html.setAttribute('data-theme', localStorage.getItem('tf-theme') || 'dark');
    document.getElementById('themeToggle').addEventListener('click', () => {
        const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', next);
        localStorage.setItem('tf-theme', next);
    });
</script>
</body>
</html>
