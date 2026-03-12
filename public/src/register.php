<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - TaskFlow</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../public/img/taskflow-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        * { font-family: 'Poppins', sans-serif; }
        .gradient-text {
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            transition: all 0.3s ease;
        }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); }
        .hero-bg {
            background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 50%, #1d4ed8 100%);
        }
        .input-field { transition: all 0.2s ease; }
        .input-field:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl flex overflow-hidden animate__animated animate__fadeIn">
        <!-- Left Panel - Form -->
        <div class="w-full md:w-1/2 p-8 md:p-10 flex flex-col justify-center">
            <div class="mb-7">
                <div class="flex items-center gap-2 mb-6 md:hidden">
                    <img src="../public/img/taskflow-logo.png" alt="TaskFlow" class="w-8 h-8 rounded-lg">
                    <span class="font-bold gradient-text">TaskFlow</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-1">Buat Akun Baru 🚀</h1>
                <p class="text-gray-400 text-sm">Mulai perjalanan produktifmu bersama TaskFlow</p>
            </div>

            <form action="aksi_register.php" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-400">*</span></label>
                    <input type="text" name="fullname" placeholder="Masukkan nama lengkap"
                        class="input-field w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none placeholder:text-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email <span class="text-red-400">*</span></label>
                    <input type="email" name="email" placeholder="nama@email.com"
                        class="input-field w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none placeholder:text-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password <span class="text-red-400">*</span></label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter"
                        class="input-field w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none placeholder:text-gray-300">
                </div>
                <button type="submit" class="btn-primary w-full text-white font-semibold py-3 rounded-xl text-sm mt-2">
                    Buat Akun →
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-5">
                Sudah punya akun? 
                <a href="login.php" class="text-blue-600 font-semibold hover:underline">Masuk di sini</a>
            </p>
        </div>

        <!-- Right Panel - Brand -->
        <div class="hidden md:flex w-1/2 hero-bg flex-col justify-between p-10">
            <div class="flex items-center gap-3">
                <img src="../public/img/taskflow-logo.png" alt="TaskFlow" class="w-10 h-10 rounded-xl bg-white p-1">
                <span class="text-white font-bold text-xl">TaskFlow</span>
            </div>
            <div>
                <h2 class="text-white text-3xl font-bold mb-4 leading-tight">Gratis &<br />Langsung Mulai</h2>
                <p class="text-blue-100 text-sm leading-relaxed mb-8">Tidak perlu kartu kredit. Daftar dalam 30 detik dan mulai kelola tugasmu hari ini.</p>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-white text-sm">
                        <div class="w-6 h-6 rounded-full bg-white bg-opacity-20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        Kelola tugas tanpa batas
                    </div>
                    <div class="flex items-center gap-3 text-white text-sm">
                        <div class="w-6 h-6 rounded-full bg-white bg-opacity-20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        Sinkronisasi di semua perangkat
                    </div>
                    <div class="flex items-center gap-3 text-white text-sm">
                        <div class="w-6 h-6 rounded-full bg-white bg-opacity-20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        Notifikasi & pengingat otomatis
                    </div>
                    <div class="flex items-center gap-3 text-white text-sm">
                        <div class="w-6 h-6 rounded-full bg-white bg-opacity-20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        Laporan produktivitas visual
                    </div>
                </div>
            </div>
            <p class="text-blue-200 text-xs">&copy; 2024 TaskFlow. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
