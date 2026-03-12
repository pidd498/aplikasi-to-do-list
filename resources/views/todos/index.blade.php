<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - My Todo</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        *{font-family:'Outfit',sans-serif;transition:background-color 0.3s,color 0.3s,border-color 0.3s;}
        [data-theme="dark"]{--bg:#0a0f1e;--bg2:#111827;--bg3:#1f2937;--sidebar:#0d1526;--card:#111827;--border:rgba(255,255,255,0.08);--text:#f1f5f9;--text2:#94a3b8;--text3:#64748b;--blue:#2563eb;--blue-light:#60a5fa;--active-bg:rgba(37,99,235,0.15);--active-border:rgba(37,99,235,0.4);--hover:rgba(255,255,255,0.04);--shadow:rgba(0,0,0,0.4);--input-bg:#1f2937;}
        [data-theme="light"]{--bg:#f0f4ff;--bg2:#ffffff;--bg3:#f1f5f9;--sidebar:#ffffff;--card:#ffffff;--border:rgba(0,0,0,0.08);--text:#0f172a;--text2:#475569;--text3:#94a3b8;--blue:#2563eb;--blue-light:#2563eb;--active-bg:rgba(37,99,235,0.1);--active-border:rgba(37,99,235,0.3);--hover:rgba(0,0,0,0.03);--shadow:rgba(0,0,0,0.08);--input-bg:#f8fafc;}
        body{background:var(--bg);color:var(--text);}
        ::-webkit-scrollbar{width:5px;}::-webkit-scrollbar-track{background:transparent;}::-webkit-scrollbar-thumb{background:#2563eb;border-radius:3px;}
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
        .tf-input{background:var(--input-bg);border:1px solid var(--border);color:var(--text);border-radius:12px;padding:10px 14px;font-size:14px;outline:none;transition:all 0.2s;font-family:'Outfit',sans-serif;}
        .tf-input:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(37,99,235,0.15);}
        .tf-input::placeholder{color:var(--text3);}
        .modal-overlay{background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);}
        .modal-box{background:var(--card);border:1px solid var(--border);border-radius:24px;}
        .todo-item{background:var(--card);border:1px solid var(--border);border-radius:16px;transition:all 0.3s;}
        .todo-item:hover{border-color:var(--active-border);box-shadow:0 4px 20px var(--shadow);}
        .todo-item.completed{opacity:0.6;}
        @keyframes fadeUp{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}
        .fade-up{animation:fadeUp 0.4s ease both;}
        .d1{animation-delay:0.05s}.d2{animation-delay:0.1s}.d3{animation-delay:0.15s}
        @keyframes slideIn{from{opacity:0;transform:translateX(-10px)}to{opacity:1;transform:translateX(0)}}
        .slide-in{animation:slideIn 0.3s ease both;}
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
            <a href="{{ route('todos.index') }}" class="nav-item active"><svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>My Todo</a>
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
                    <h1 class="text-xl font-black" style="color:var(--text)">My Todo</h1>
                    <p class="text-sm" style="color:var(--text3)">{{ date('l, d F Y') }}</p>
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

        <div class="flex-1 overflow-y-auto p-6 flex flex-col gap-5">

            <!-- Stats + Add bar -->
            <div class="flex items-center justify-between fade-up d1">
                <div class="flex items-center gap-4">
                    @php $total = count($todos); $done = $todos->where('is_completed', true)->count(); $pct = $total > 0 ? round($done/$total*100) : 0; @endphp
                    <div class="tf-card px-5 py-3 flex items-center gap-3">
                        <div class="w-10 h-10 gbg rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                        </div>
                        <div>
                            <p class="text-lg font-black" style="color:var(--text)">{{ $done }}/{{ $total }}</p>
                            <p class="text-xs" style="color:var(--text3)">Completed · {{ $pct }}%</p>
                        </div>
                    </div>
                    <!-- Mini progress bar -->
                    <div class="hidden md:flex items-center gap-2">
                        <div class="w-32 h-2 rounded-full" style="background:var(--bg3)">
                            <div class="h-full gbg rounded-full transition-all duration-500" style="width:{{ $pct }}%"></div>
                        </div>
                        <span class="text-xs font-bold" style="color:var(--blue-light)">{{ $pct }}%</span>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <form method="GET">
                        <input type="search" name="cari" value="{{ request('cari') }}" placeholder="Search todos..." class="tf-input w-52">
                    </form>
                    <button onclick="openModal()" class="gbg text-white font-bold px-5 py-2.5 rounded-xl flex items-center gap-2 shadow-lg shadow-blue-500/20 hover:opacity-90 transition-opacity">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Add Todo
                    </button>
                </div>
            </div>

            <!-- Todo list -->
            <div class="flex flex-col gap-3 fade-up d2">
                @forelse($todos as $todo)
                <div class="todo-item {{ $todo->is_completed ? 'completed' : '' }} p-5 flex items-center gap-4 slide-in">
                    <!-- Checkbox -->
                    <form method="POST" action="{{ route('todos.update', $todo->id) }}">
                        @csrf @method('PUT')
                        <button type="submit" class="w-6 h-6 rounded-lg border-2 flex items-center justify-center flex-shrink-0 transition-all"
                            style="{{ $todo->is_completed ? 'background:linear-gradient(135deg,#0ea5e9,#2563eb);border-color:#2563eb' : 'border-color:var(--border);background:transparent' }}">
                            @if($todo->is_completed)
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            @endif
                        </button>
                    </form>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold {{ $todo->is_completed ? 'line-through' : '' }}" style="color:{{ $todo->is_completed ? 'var(--text3)' : 'var(--text)' }}">
                            {{ $todo->title }}
                        </p>
                        <p class="text-xs mt-0.5" style="color:var(--text3)">
                            {{ $todo->created_at ? \Carbon\Carbon::parse($todo->created_at)->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>

                    <!-- Badge -->
                    @if($todo->is_completed)
                        <span class="text-xs font-bold px-3 py-1 rounded-full flex-shrink-0" style="background:rgba(16,185,129,0.15);color:#34d399;border:1px solid rgba(16,185,129,0.3)">Done ✓</span>
                    @else
                        <span class="text-xs font-bold px-3 py-1 rounded-full flex-shrink-0" style="background:rgba(37,99,235,0.12);color:var(--blue-light);border:1px solid var(--active-border)">Pending</span>
                    @endif

                    <!-- Delete -->
                    <form method="POST" action="{{ route('todos.destroy', $todo->id) }}" onsubmit="return confirm('Delete this todo?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 transition-all" style="background:rgba(239,68,68,0.1);color:#f87171">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                @empty
                <div class="tf-card p-16 flex flex-col items-center gap-4 fade-up">
                    <div class="w-20 h-20 rounded-3xl flex items-center justify-center" style="background:var(--bg3)">
                        <svg class="w-10 h-10" style="color:var(--text3)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h7"/></svg>
                    </div>
                    <p class="text-lg font-bold" style="color:var(--text3)">No todos yet</p>
                    <p class="text-sm" style="color:var(--text3)">Start building your todo list today!</p>
                    <button onclick="openModal()" class="gbg text-white font-bold px-6 py-2.5 rounded-xl">+ Add Todo</button>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- ADD MODAL -->
<div id="addModal" class="hidden fixed inset-0 z-50 flex items-center justify-center modal-overlay">
    <div class="modal-box w-full max-w-md mx-4 p-8 shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-black" style="color:var(--text)">Add New Todo</h2>
                <p class="text-sm mt-1" style="color:var(--text3)">What do you need to get done?</p>
            </div>
            <button onclick="closeModal()" class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:var(--bg3);color:var(--text2)">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form action="{{ route('todos.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-1.5" style="color:var(--text2)">Todo Title *</label>
                <input type="text" name="title" class="tf-input w-full" placeholder="e.g. Buy groceries, Read a book..." required autofocus>
            </div>
            <button type="submit" class="w-full gbg text-white font-bold py-3 rounded-xl hover:opacity-90 transition-opacity shadow-lg shadow-blue-500/20">
                Add to List →
            </button>
        </form>
    </div>
</div>

<script>
    const html = document.documentElement;
    html.setAttribute('data-theme', localStorage.getItem('tf-theme') || 'dark');
    document.getElementById('themeToggle').addEventListener('click', () => {
        const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', next);
        localStorage.setItem('tf-theme', next);
    });
    function openModal() { document.getElementById('addModal').classList.remove('hidden'); }
    function closeModal() { document.getElementById('addModal').classList.add('hidden'); }
    document.getElementById('addModal').addEventListener('click', function(e) { if(e.target===this) closeModal(); });
</script>
</body>
</html>
