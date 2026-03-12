<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TaskFlow - My Task</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family: 'Outfit', sans-serif; transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease; }
        [data-theme="dark"] { --bg:#0a0f1e; --bg2:#111827; --bg3:#1f2937; --sidebar:#0d1526; --card:#111827; --border:rgba(255,255,255,0.08); --text:#f1f5f9; --text2:#94a3b8; --text3:#64748b; --blue:#2563eb; --blue-light:#60a5fa; --active-bg:rgba(37,99,235,0.15); --active-border:rgba(37,99,235,0.4); --hover:rgba(255,255,255,0.04); --shadow:rgba(0,0,0,0.4); --input-bg:#1f2937; }
        [data-theme="light"] { --bg:#f0f4ff; --bg2:#ffffff; --bg3:#f1f5f9; --sidebar:#ffffff; --card:#ffffff; --border:rgba(0,0,0,0.08); --text:#0f172a; --text2:#475569; --text3:#94a3b8; --blue:#2563eb; --blue-light:#2563eb; --active-bg:rgba(37,99,235,0.1); --active-border:rgba(37,99,235,0.3); --hover:rgba(0,0,0,0.03); --shadow:rgba(0,0,0,0.08); --input-bg:#f8fafc; }
        body { background:var(--bg); color:var(--text); }
        ::-webkit-scrollbar { width:5px; } ::-webkit-scrollbar-track { background:transparent; } ::-webkit-scrollbar-thumb { background:#2563eb; border-radius:3px; }
        .sidebar { background:var(--sidebar); border-right:1px solid var(--border); }
        .nav-item { display:flex; align-items:center; gap:12px; padding:12px 16px; border-radius:12px; color:var(--text2); font-weight:600; font-size:14px; text-decoration:none; transition:all 0.2s ease; border:1px solid transparent; }
        .nav-item:hover { background:var(--hover); color:var(--text); }
        .nav-item.active { background:var(--active-bg); border-color:var(--active-border); color:var(--blue-light); }
        .tf-card { background:var(--card); border:1px solid var(--border); border-radius:16px; }
        .topbar { background:var(--card); border:1px solid var(--border); border-radius:16px; }
        .gbg { background:linear-gradient(135deg,#0ea5e9,#2563eb); }
        .theme-toggle { width:44px; height:24px; background:var(--bg3); border:1px solid var(--border); border-radius:999px; position:relative; cursor:pointer; }
        .theme-toggle-thumb { width:18px; height:18px; background:var(--blue); border-radius:50%; position:absolute; top:2px; left:2px; transition:all 0.3s ease; }
        [data-theme="light"] .theme-toggle-thumb { left:22px; background:#f59e0b; }
        .tf-input { background:var(--input-bg); border:1px solid var(--border); color:var(--text); border-radius:12px; padding:10px 14px; font-size:14px; outline:none; transition:all 0.2s; font-family:'Outfit',sans-serif; }
        .tf-input:focus { border-color:var(--blue); box-shadow:0 0 0 3px rgba(37,99,235,0.15); }
        .tf-input::placeholder { color:var(--text3); }
        .tf-select { background:var(--input-bg); border:1px solid var(--border); color:var(--text); border-radius:10px; padding:6px 10px; font-size:13px; outline:none; font-family:'Outfit',sans-serif; }
        .tf-table { width:100%; border-collapse:collapse; }
        .tf-table thead th { padding:12px 16px; text-align:left; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:var(--text3); background:var(--bg3); border-bottom:1px solid var(--border); }
        .tf-table thead th:first-child { border-radius:12px 0 0 0; } .tf-table thead th:last-child { border-radius:0 12px 0 0; }
        .tf-table tbody td { padding:14px 16px; border-bottom:1px solid var(--border); font-size:14px; color:var(--text); }
        .tf-table tbody tr:hover { background:var(--hover); }
        .tf-table tbody tr:last-child td { border-bottom:none; }
        .modal-overlay { background:rgba(0,0,0,0.7); backdrop-filter:blur(8px); }
        .modal-box { background:var(--card); border:1px solid var(--border); border-radius:24px; }
        @keyframes fadeUp { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }
        .fade-up { animation:fadeUp 0.4s ease both; }
        .d1{animation-delay:0.05s} .d2{animation-delay:0.1s} .d3{animation-delay:0.15s}
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
            <span class="text-lg font-black" style="color:var(--text)">Task<span style="background:linear-gradient(135deg,#0ea5e9,#2563eb);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">Flow</span></span>
        </div>
        <div class="flex flex-col gap-1">
            <p class="text-xs font-bold uppercase tracking-widest mb-2" style="color:var(--text3)">Main Menu</p>
            <a href="{{ route('home.index') }}" class="nav-item">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Home
            </a>
            <a href="{{ route('tasks.index') }}" class="nav-item active">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                My Task
            </a>
            <a href="{{ route('todos.index') }}" class="nav-item">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                My Todo
            </a>
            <a href="{{ route('inbox.index') }}" class="nav-item">
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
        <div class="flex-1"></div>
        <div class="tf-card p-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 gbg rounded-xl flex items-center justify-center text-white font-bold text-lg flex-shrink-0">{{ strtoupper(substr($userName, 0, 1)) }}</div>
                <div class="min-w-0">
                    <p class="font-bold text-sm truncate" style="color:var(--text)">{{ $userName }}</p>
                    <p class="text-xs truncate" style="color:var(--text3)">{{ $userEmail }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 rounded-xl text-sm font-semibold" style="background:var(--bg3);color:var(--text2)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col overflow-hidden" style="background:var(--bg)">
        <!-- Topbar -->
        <div class="p-6 pb-0">
            <div class="topbar flex justify-between items-center px-6 py-4 fade-up">
                <div>
                    <h1 class="text-xl font-black" style="color:var(--text)">My Task</h1>
                    <p class="text-sm" style="color:var(--text3)">{{ date('l, d F Y') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <button id="notifBtn" class="relative w-10 h-10 rounded-xl flex items-center justify-center" style="background:var(--bg3);color:var(--text2)">
                            @if($notificationCount > 0)
                                <span class="absolute -top-1 -right-1 w-5 h-5 gbg text-white rounded-full text-xs flex items-center justify-center font-bold">{{ $notificationCount }}</span>
                            @endif
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </button>
                        <div id="notifDrop" class="hidden absolute right-0 mt-2 w-64 tf-card p-4 z-50 shadow-xl">
                            <p class="text-sm font-bold mb-2" style="color:var(--text)">Notifications</p>
                            <p class="text-sm" style="color:var(--text3)">No new notifications</p>
                        </div>
                    </div>
                    <button id="fsBtn" class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:var(--bg3);color:var(--text2)">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z"/></svg>
                    </button>
                    <div class="flex items-center gap-2">
                        <span class="text-sm" style="color:var(--text3)">☀️</span>
                        <div class="theme-toggle" id="themeToggle"><div class="theme-toggle-thumb"></div></div>
                        <span class="text-sm" style="color:var(--text3)">🌙</span>
                    </div>
                    <div class="flex items-center gap-3 pl-3" style="border-left:1px solid var(--border)">
                        <div class="w-9 h-9 gbg rounded-xl flex items-center justify-center text-white font-bold flex-shrink-0">{{ strtoupper(substr($userName, 0, 1)) }}</div>
                        <div class="hidden md:block">
                            <p class="text-sm font-bold" style="color:var(--text)">{{ $userName }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-6 flex flex-col gap-5">
            <!-- Actions bar -->
            <div class="flex items-center justify-between fade-up d1">
                <button onclick="openModal()" class="gbg text-white font-bold px-5 py-2.5 rounded-xl flex items-center gap-2 shadow-lg shadow-blue-500/20 hover:opacity-90 transition-opacity">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    Add Task
                </button>
                <form method="GET">
                    <input type="search" name="cari" value="{{ request('cari') }}" placeholder="Search tasks..." class="tf-input w-64">
                </form>
            </div>

            <!-- Table -->
            <div class="tf-card overflow-hidden fade-up d2">
                <div class="px-6 py-4" style="border-bottom:1px solid var(--border)">
                    <h2 class="font-bold" style="color:var(--text)">All Tasks <span class="text-sm font-normal" style="color:var(--text3)">({{ count($tasks) }} total)</span></h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="tf-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Task Name</th>
                                <th>Start Date</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tasks as $index => $task)
                            <tr>
                                <td class="font-bold" style="color:var(--text3)">{{ $index + 1 }}</td>
                                <td>
                                    <p class="font-semibold" style="color:var(--text)">{{ $task->task_name }}</p>
                                    @if($task->description)
                                        <p class="text-xs mt-0.5" style="color:var(--text3)">{{ Str::limit($task->description, 40) }}</p>
                                    @endif
                                </td>
                                <td style="color:var(--text2)">{{ \Carbon\Carbon::parse($task->start_time)->format('d M Y') }}</td>
                                <td>
                                    @php $due = \Carbon\Carbon::parse($task->end_time); $isOverdue = $due->isPast() && $task->status != 'Done'; @endphp
                                    <span class="{{ $isOverdue ? 'text-red-400 font-semibold' : '' }}" style="{{ !$isOverdue ? 'color:var(--text2)' : '' }}">
                                        {{ $due->format('d M Y') }}
                                    </span>
                                    @if($isOverdue)<span class="ml-1 text-xs text-red-400">Overdue</span>@endif
                                </td>
                                <td>
                                    <select class="tf-select" onchange="updateStatus({{ $task->id }}, this.value)">
                                        <option value="Not started" {{ $task->status == 'Not started' ? 'selected' : '' }}>Not Started</option>
                                        <option value="On Progres" {{ $task->status == 'On Progres' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <button onclick="openEditModal({{ $task->id }}, '{{ addslashes($task->task_name) }}', '{{ $task->start_time->format('Y-m-d') }}', '{{ $task->end_time->format('Y-m-d') }}', '{{ $task->status }}', '{{ addslashes($task->description ?? '') }}')"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center transition-all" style="background:rgba(37,99,235,0.1);color:#60a5fa" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return confirm('Delete this task?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center transition-all" style="background:rgba(239,68,68,0.1);color:#f87171" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-16">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center" style="background:var(--bg3)">
                                            <svg class="w-8 h-8" style="color:var(--text3)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                        </div>
                                        <p class="font-semibold" style="color:var(--text3)">No tasks yet</p>
                                        <button onclick="openModal()" class="gbg text-white text-sm font-bold px-4 py-2 rounded-xl">+ Add your first task</button>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ADD MODAL -->
<div id="addModal" class="hidden fixed inset-0 z-50 flex items-center justify-center modal-overlay">
    <div class="modal-box w-full max-w-2xl mx-4 p-8 shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-black" style="color:var(--text)">Add New Task</h2>
                <p class="text-sm mt-1" style="color:var(--text3)">Fill in the details for your new task</p>
            </div>
            <button onclick="closeModal()" class="w-9 h-9 rounded-xl flex items-center justify-center transition-all" style="background:var(--bg3);color:var(--text2)">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1.5" style="color:var(--text2)">Task Name *</label>
                    <input type="text" name="task_name" class="tf-input w-full" placeholder="Enter task name" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5" style="color:var(--text2)">Status *</label>
                    <select name="status" class="tf-input w-full" required>
                        <option value="" disabled selected>Select status</option>
                        <option value="Not started">Not Started</option>
                        <option value="On Progres">In Progress</option>
                        <option value="Done">Done</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5" style="color:var(--text2)">Start Date *</label>
                    <input type="date" name="start_time" class="tf-input w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5" style="color:var(--text2)">Due Date *</label>
                    <input type="date" name="end_time" class="tf-input w-full" required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5" style="color:var(--text2)">Description</label>
                <textarea name="description" class="tf-input w-full h-24 resize-none" placeholder="Add task description (optional)"></textarea>
            </div>
            <button type="submit" class="w-full gbg text-white font-bold py-3 rounded-xl hover:opacity-90 transition-opacity shadow-lg shadow-blue-500/20">
                Save Task →
            </button>
        </form>
    </div>
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="hidden fixed inset-0 z-50 flex items-center justify-center modal-overlay">
    <div class="modal-box w-full max-w-2xl mx-4 p-8 shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-black" style="color:var(--text)">Edit Task</h2>
                <p class="text-sm mt-1" style="color:var(--text3)">Update your task details</p>
            </div>
            <button onclick="closeEditModal()" class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:var(--bg3);color:var(--text2)">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1.5" style="color:var(--text2)">Task Name *</label>
                    <input type="text" id="editTaskName" name="task_name" class="tf-input w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5" style="color:var(--text2)">Status *</label>
                    <select id="editStatus" name="status" class="tf-input w-full">
                        <option value="Not started">Not Started</option>
                        <option value="On Progres">In Progress</option>
                        <option value="Done">Done</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5" style="color:var(--text2)">Start Date *</label>
                    <input type="date" id="editStartTime" name="start_time" class="tf-input w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5" style="color:var(--text2)">Due Date *</label>
                    <input type="date" id="editEndTime" name="end_time" class="tf-input w-full" required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5" style="color:var(--text2)">Description</label>
                <textarea id="editDescription" name="description" class="tf-input w-full h-24 resize-none" placeholder="Add task description (optional)"></textarea>
            </div>
            <button type="submit" class="w-full gbg text-white font-bold py-3 rounded-xl hover:opacity-90 transition-opacity shadow-lg shadow-blue-500/20">
                Update Task →
            </button>
        </form>
    </div>
</div>

<script>
    // Theme
    const html = document.documentElement;
    const saved = localStorage.getItem('tf-theme') || 'dark';
    html.setAttribute('data-theme', saved);
    document.getElementById('themeToggle').addEventListener('click', () => {
        const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', next);
        localStorage.setItem('tf-theme', next);
    });

    // Modals
    function openModal() { document.getElementById('addModal').classList.remove('hidden'); }
    function closeModal() { document.getElementById('addModal').classList.add('hidden'); }
    function closeEditModal() { document.getElementById('editModal').classList.add('hidden'); }
    function openEditModal(id, name, start, end, status, desc) {
        document.getElementById('editForm').action = `/tasks/${id}`;
        document.getElementById('editTaskName').value = name;
        document.getElementById('editStartTime').value = start;
        document.getElementById('editEndTime').value = end;
        document.getElementById('editStatus').value = status;
        document.getElementById('editDescription').value = desc;
        document.getElementById('editModal').classList.remove('hidden');
    }
    // Close modal on overlay click
    ['addModal','editModal'].forEach(id => {
        document.getElementById(id).addEventListener('click', function(e) {
            if (e.target === this) this.classList.add('hidden');
        });
    });

    // Update status via AJAX
   function updateStatus(taskId, newStatus) {
    fetch(`/tasks/${taskId}/update-status`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        body: JSON.stringify({ status: newStatus })
    }).then(r => r.json()).then(d => { 
        if(d.success) location.reload();
    });
}

    // Notification
    document.getElementById('notifBtn').addEventListener('click', e => {
        e.stopPropagation();
        document.getElementById('notifDrop').classList.toggle('hidden');
    });
    window.addEventListener('click', () => document.getElementById('notifDrop').classList.add('hidden'));

    // Fullscreen
    document.getElementById('fsBtn').addEventListener('click', () => {
        if (!document.fullscreenElement) document.documentElement.requestFullscreen();
        else document.exitFullscreen();
    });
</script>
</body>
</html>
