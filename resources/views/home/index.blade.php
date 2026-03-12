<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family: 'Outfit', sans-serif; transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease; }

        /* ===== DARK THEME ===== */
        [data-theme="dark"] {
            --bg: #0a0f1e;
            --bg2: #111827;
            --bg3: #1f2937;
            --sidebar: #0d1526;
            --card: #111827;
            --border: rgba(255,255,255,0.08);
            --text: #f1f5f9;
            --text2: #94a3b8;
            --text3: #64748b;
            --blue: #2563eb;
            --blue-light: #60a5fa;
            --active-bg: rgba(37,99,235,0.15);
            --active-border: rgba(37,99,235,0.4);
            --hover: rgba(255,255,255,0.04);
            --shadow: rgba(0,0,0,0.4);
        }

        /* ===== LIGHT THEME ===== */
        [data-theme="light"] {
            --bg: #f0f4ff;
            --bg2: #ffffff;
            --bg3: #f1f5f9;
            --sidebar: #ffffff;
            --card: #ffffff;
            --border: rgba(0,0,0,0.08);
            --text: #0f172a;
            --text2: #475569;
            --text3: #94a3b8;
            --blue: #2563eb;
            --blue-light: #2563eb;
            --active-bg: rgba(37,99,235,0.1);
            --active-border: rgba(37,99,235,0.3);
            --hover: rgba(0,0,0,0.03);
            --shadow: rgba(0,0,0,0.08);
        }

        body { background: var(--bg); color: var(--text); }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--blue); border-radius: 3px; }

        /* Sidebar */
        .sidebar {
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            box-shadow: 4px 0 20px var(--shadow);
        }

        /* Nav item */
        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 16px; border-radius: 12px;
            color: var(--text2); font-weight: 600; font-size: 14px;
            text-decoration: none; transition: all 0.2s ease;
            border: 1px solid transparent;
        }
        .nav-item:hover { background: var(--hover); color: var(--text); }
        .nav-item.active {
            background: var(--active-bg);
            border-color: var(--active-border);
            color: var(--blue-light);
        }

        /* Card */
        .tf-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            transition: all 0.3s ease;
        }
        .tf-card:hover { box-shadow: 0 8px 30px var(--shadow); transform: translateY(-2px); }

        /* Topbar */
        .topbar {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        /* Badge */
        .gbg { background: linear-gradient(135deg, #0ea5e9, #2563eb); }

        /* Progress bar */
        .progress-track { background: var(--bg3); border-radius: 999px; overflow: hidden; }
        .progress-fill { background: linear-gradient(90deg, #0ea5e9, #2563eb); border-radius: 999px; height: 100%; }

        /* Theme toggle */
        .theme-toggle {
            width: 44px; height: 24px;
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 999px;
            position: relative; cursor: pointer;
            transition: all 0.3s ease;
        }
        .theme-toggle-thumb {
            width: 18px; height: 18px;
            background: var(--blue);
            border-radius: 50%;
            position: absolute; top: 2px; left: 2px;
            transition: all 0.3s ease;
        }
        [data-theme="light"] .theme-toggle-thumb { left: 22px; background: #f59e0b; }

        /* Stat card */
        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 28px;
            transition: all 0.3s ease;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px var(--shadow); }

        /* Table */
        .tf-table { width: 100%; border-collapse: collapse; }
        .tf-table thead th {
            padding: 12px 16px;
            text-align: left;
            font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.05em;
            color: var(--text3);
            background: var(--bg3);
            border-bottom: 1px solid var(--border);
        }
        .tf-table thead th:first-child { border-radius: 12px 0 0 0; }
        .tf-table thead th:last-child { border-radius: 0 12px 0 0; }
        .tf-table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            font-size: 14px; color: var(--text);
        }
        .tf-table tbody tr:hover { background: var(--hover); }
        .tf-table tbody tr:last-child td { border-bottom: none; }

        /* Notification dropdown */
        .notif-dropdown {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 20px 60px var(--shadow);
        }

        @keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
        .fade-up { animation: fadeUp 0.4s ease both; }
        .fade-up-1 { animation-delay: 0.05s; }
        .fade-up-2 { animation-delay: 0.1s; }
        .fade-up-3 { animation-delay: 0.15s; }
        .fade-up-4 { animation-delay: 0.2s; }
        .fade-up-5 { animation-delay: 0.25s; }
    </style>
</head>
<body>
<section class="flex h-screen overflow-hidden">

    <!-- ===== SIDEBAR ===== -->
    <div class="sidebar w-64 flex flex-col gap-6 p-6 h-screen shrink-0 overflow-y-auto">
        <!-- Logo -->
        <div class="flex items-center gap-2.5 py-2">
            <div class="w-9 h-9 gbg rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
            <span class="text-lg font-black" style="color: var(--text);">Task<span style="background: linear-gradient(135deg, #0ea5e9, #2563eb); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Flow</span></span>
        </div>

        <!-- Nav -->
        <div class="flex flex-col gap-1">
            <p class="text-xs font-bold uppercase tracking-widest mb-2" style="color: var(--text3);">Main Menu</p>

            <a href="{{ route('home.index') }}" class="nav-item active">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Home
            </a>

            <a href="{{ route('tasks.index') }}" class="nav-item">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                My Task
            </a>

            <a href="{{ route('todos.index') }}" class="nav-item">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                My Todo
            </a>

            <a href="{{ route('inbox.index') }}" class="nav-item relative">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                Inbox
                @if($notificationCount > 0)
                    <span class="ml-auto gbg text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $notificationCount }}</span>
                @endif
            </a>

            <a href="{{ route('history.index') }}" class="nav-item">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                History
            </a>
        </div>

        <!-- Spacer -->
        <div class="flex-1"></div>

        <!-- Profile mini -->
        <div class="tf-card p-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 gbg rounded-xl flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                    {{ strtoupper(substr($userName, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="font-bold text-sm truncate" style="color: var(--text);">{{ $userName }}</p>
                    <p class="text-xs truncate" style="color: var(--text3);">{{ $userEmail }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 rounded-xl text-sm font-semibold transition-all" style="background: var(--bg3); color: var(--text2);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="flex-1 flex flex-col overflow-hidden" style="background: var(--bg);">

        <!-- Topbar -->
        <div class="p-6 pb-0">
            <div class="topbar flex justify-between items-center px-6 py-4 fade-up">
                <div>
                    <h1 class="text-xl font-black" style="color: var(--text);">Home</h1>
                    <p class="text-sm" style="color: var(--text3);">Today, <span id="date"></span></p>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Notification -->
                    <div class="relative">
                        <button id="notificationButton" class="relative w-10 h-10 rounded-xl flex items-center justify-center transition-all" style="background: var(--bg3); color: var(--text2);">
                            @if($notificationCount > 0)
                                <span class="absolute -top-1 -right-1 w-5 h-5 gbg text-white rounded-full text-xs flex items-center justify-center font-bold">{{ $notificationCount }}</span>
                            @endif
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </button>
                        <div id="notificationDropdown" class="notif-dropdown absolute right-0 mt-2 w-72 p-4 z-[999] hidden">
                            <p class="text-sm font-bold mb-2" style="color: var(--text);">Notifications</p>
                            <p class="text-sm" style="color: var(--text3);">No new notifications</p>
                        </div>
                    </div>

                    <!-- Fullscreen -->
                    <button id="fullscreen-button" class="w-10 h-10 rounded-xl flex items-center justify-center transition-all" style="background: var(--bg3); color: var(--text2);">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z"/></svg>
                    </button>

                    <!-- Theme toggle -->
                    <div class="flex items-center gap-2">
                        <span class="text-sm" style="color: var(--text3);">☀️</span>
                        <div class="theme-toggle" id="themeToggle" title="Toggle dark/light mode">
                            <div class="theme-toggle-thumb" id="themeThumb"></div>
                        </div>
                        <span class="text-sm" style="color: var(--text3);">🌙</span>
                    </div>

                    <!-- Profile -->
                    <div class="flex items-center gap-3 pl-4" style="border-left: 1px solid var(--border);">
                        <div class="w-9 h-9 gbg rounded-xl flex items-center justify-center text-white font-bold flex-shrink-0">
                            {{ strtoupper(substr($userName, 0, 1)) }}
                        </div>
                        <div class="hidden md:block">
                            <p class="text-sm font-bold" style="color: var(--text);">{{ $userName }}</p>
                            <p class="text-xs" style="color: var(--text3);">{{ $userEmail }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scrollable content -->
        <div class="flex-1 overflow-y-auto p-6 flex flex-col gap-6">

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-4">
                <!-- Total Tasks -->
                <div class="stat-card fade-up fade-up-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 gbg rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-black mb-1" style="color: var(--text);">{{ $totalTasks }}</p>
                    <p class="text-sm font-semibold" style="color: var(--text3);">Total Tasks</p>
                    <a href="{{ route('tasks.index') }}" class="inline-flex items-center gap-1 text-xs font-bold mt-3" style="color: var(--blue-light);">
                        View all <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <!-- Total Todos -->
                <div class="stat-card fade-up fade-up-2">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-lg" style="background: linear-gradient(135deg, #7c3aed, #a855f7); box-shadow: 0 8px 20px rgba(124,58,237,0.3);">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-black mb-1" style="color: var(--text);">{{ $totalTodos }}</p>
                    <p class="text-sm font-semibold" style="color: var(--text3);">Total Todos</p>
                    <a href="{{ route('todos.index') }}" class="inline-flex items-center gap-1 text-xs font-bold mt-3" style="color: #a78bfa;">
                        View all <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <!-- Inbox -->
                <div class="stat-card fade-up fade-up-3">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-lg" style="background: linear-gradient(135deg, #059669, #10b981); box-shadow: 0 8px 20px rgba(16,185,129,0.3);">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-black mb-1" style="color: var(--text);">{{ $notificationCount }}</p>
                    <p class="text-sm font-semibold" style="color: var(--text3);">Inbox Messages</p>
                    <a href="{{ route('inbox.index') }}" class="inline-flex items-center gap-1 text-xs font-bold mt-3" style="color: #34d399;">
                        View all <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Table + Calendar -->
            <div class="grid grid-cols-5 gap-4 fade-up fade-up-4">

                <!-- Task Table -->
                <div class="col-span-3 tf-card overflow-hidden">
                    <div class="px-6 py-4 flex items-center justify-between" style="border-bottom: 1px solid var(--border);">
                        <h2 class="font-bold text-base" style="color: var(--text);">Project Progress</h2>
                        <a href="{{ route('tasks.index') }}" class="text-xs font-bold" style="color: var(--blue-light);">View All →</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="tf-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Task Name</th>
                                    <th>Progress</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $index => $task)
                                <tr>
                                    <td class="font-bold" style="color: var(--text3);">{{ $index + 1 }}</td>
                                    <td>
                                        <p class="font-semibold text-sm" style="color: var(--text);">{{ $task->task_name }}</p>
                                        <p class="text-xs mt-0.5" style="color: var(--text3);">Due {{ $task->end_time->format('d M Y') }}</p>
                                    </td>
                                    <td>
                                        <div class="progress-track h-2 w-36">
                                            <div class="progress-fill" style="width: {{ $task->status == 'Done' ? '100' : ($task->status == 'On Progres' ? '50' : '0') }}%"></div>
                                        </div>
                                        <p class="text-xs mt-1" style="color: var(--text3);">{{ $task->status == 'Done' ? '100' : ($task->status == 'On Progres' ? '50' : '0') }}%</p>
                                    </td>
                                    <td>
                                        @if($task->status == 'Done')
                                            <span class="text-xs font-bold px-3 py-1 rounded-full" style="background: rgba(16,185,129,0.15); color: #34d399; border: 1px solid rgba(16,185,129,0.3);">Done</span>
                                        @elseif($task->status == 'On Progres')
                                            <span class="text-xs font-bold px-3 py-1 rounded-full" style="background: rgba(245,158,11,0.15); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3);">In Progress</span>
                                        @else
                                            <span class="text-xs font-bold px-3 py-1 rounded-full" style="background: rgba(107,114,128,0.15); color: #9ca3af; border: 1px solid rgba(107,114,128,0.3);">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-12">
                                        <div class="flex flex-col items-center gap-2">
                                            <svg class="w-10 h-10" style="color: var(--text3);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                            <p class="font-semibold" style="color: var(--text3);">No tasks yet</p>
                                            <a href="{{ route('tasks.create') }}" class="text-xs font-bold" style="color: var(--blue-light);">+ Add Task</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Calendar -->
                <div class="col-span-2 tf-card fade-up fade-up-5">
                    <div class="px-6 py-4 flex items-center justify-between" style="border-bottom: 1px solid var(--border);">
                        <h2 class="font-bold text-base" style="color: var(--text);">Calendar</h2>
                        <span class="text-xs font-bold" style="color: var(--text3);">{{ date('F Y') }}</span>
                    </div>
                    <div class="p-5">
                        <table class="w-full text-center text-sm">
                            <thead>
                                <tr>
                                    @foreach(['Su','Mo','Tu','We','Th','Fr','Sa'] as $d)
                                        <th class="pb-3 font-bold text-xs" style="color: var(--text3);">{{ $d }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $currentMonth = date('m');
                                    $currentYear = date('Y');
                                    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
                                    $firstDayOffset = date('w', strtotime("1-$currentMonth-$currentYear"));
                                    $today = date('j');
                                @endphp
                                @for($week = 0; $week < 6; $week++)
                                    <tr>
                                        @for($day = 0; $day < 7; $day++)
                                            @php $dayNumber = $week * 7 + $day + 1 - $firstDayOffset; @endphp
                                            @if($dayNumber >= 1 && $dayNumber <= $daysInMonth)
                                                <td class="py-1.5">
                                                    @if($dayNumber == $today)
                                                        <span class="gbg text-white font-bold w-8 h-8 rounded-full flex items-center justify-center mx-auto text-sm shadow-lg shadow-blue-500/30">{{ $dayNumber }}</span>
                                                    @else
                                                        <span class="w-8 h-8 flex items-center justify-center mx-auto text-sm rounded-full hover:bg-blue-500/10 cursor-default transition-colors" style="color: var(--text2);">{{ $dayNumber }}</span>
                                                    @endif
                                                </td>
                                            @else
                                                <td class="py-1.5"><span class="text-sm" style="color: var(--border);"></span></td>
                                            @endif
                                        @endfor
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    // ===== DATE =====
    function updateDate() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('date').textContent = now.toLocaleDateString('en-US', options);
    }
    updateDate();

    // ===== THEME TOGGLE =====
    const html = document.documentElement;
    const toggle = document.getElementById('themeToggle');

    // Load saved theme
    const savedTheme = localStorage.getItem('tf-theme') || 'dark';
    html.setAttribute('data-theme', savedTheme);

    toggle.addEventListener('click', () => {
        const current = html.getAttribute('data-theme');
        const next = current === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', next);
        localStorage.setItem('tf-theme', next);
    });

    // ===== NOTIFICATION =====
    document.getElementById('notificationButton').addEventListener('click', function(e) {
        e.stopPropagation();
        const dd = document.getElementById('notificationDropdown');
        dd.classList.toggle('hidden');
    });
    window.addEventListener('click', () => {
        document.getElementById('notificationDropdown').classList.add('hidden');
    });

    // ===== FULLSCREEN =====
    document.getElementById('fullscreen-button').addEventListener('click', () => {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            document.exitFullscreen();
        }
    });
</script>
</body>
</html>
