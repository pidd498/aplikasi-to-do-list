<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TaskFlow</title>
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
        .input-field {
            transition: all 0.2s ease;
        }
        .input-field:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl flex overflow-hidden animate__animated animate__fadeIn">
        <!-- Left Panel - Brand -->
        <div class="hidden md:flex w-1/2 hero-bg flex-col justify-between p-10">
            <div class="flex items-center gap-3">
                <img src="../public/img/taskflow-logo.png" alt="TaskFlow" class="w-10 h-10 rounded-xl bg-white p-1">
                <span class="text-white font-bold text-xl">TaskFlow</span>
            </div>
            <div>
                <h2 class="text-white text-3xl font-bold mb-4 leading-tight">Kelola Tugas<br />Lebih Cerdas</h2>
                <p class="text-blue-100 text-sm leading-relaxed mb-8">Bergabung dengan ribuan pengguna yang produktif. Atur semua tugasmu dari satu tempat.</p>
                <!-- Task preview card -->
                <div class="bg-white bg-opacity-10 backdrop-blur rounded-xl p-4 border border-white border-opacity-20">
                    <div class="text-white text-xs font-semibold mb-3 opacity-80">Tugas Hari Ini</div>
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded-full bg-green-400 flex items-center justify-center">
                                <svg class="w-2.5 h-2.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-white text-xs opacity-70 line-through">Review UI Design</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded-full border-2 border-white border-opacity-60"></div>
                            <span class="text-white text-xs">Team standup meeting</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded-full border-2 border-white border-opacity-60"></div>
                            <span class="text-white text-xs">Deploy to production</span>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-blue-200 text-xs">&copy; 2024 TaskFlow. All rights reserved.</p>
        </div>

        <!-- Right Panel - Form -->
        <div class="w-full md:w-1/2 p-8 md:p-10 flex flex-col justify-center">
            <div class="mb-8">
                <div class="flex items-center gap-2 mb-6 md:hidden">
                    <img src="../public/img/taskflow-logo.png" alt="TaskFlow" class="w-8 h-8 rounded-lg">
                    <span class="font-bold gradient-text">TaskFlow</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-1">Selamat Datang 👋</h1>
                <p class="text-gray-400 text-sm">Masuk ke akun TaskFlow kamu</p>
            </div>

            <form action="aksi_login.php" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email <span class="text-red-400">*</span></label>
                    <input type="email" name="email" placeholder="nama@email.com"
                        class="input-field w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none placeholder:text-gray-300">
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Password <span class="text-red-400">*</span></label>
                        <a href="#" class="text-xs text-blue-500 hover:text-blue-700">Lupa password?</a>
                    </div>
                    <input type="password" name="password" placeholder="Masukkan password"
                        class="input-field w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none placeholder:text-gray-300">
                </div>
                <button type="submit" class="btn-primary w-full text-white font-semibold py-3 rounded-xl text-sm">
                    Masuk ke Akun →
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Belum punya akun? 
                <a href="register.php" class="text-blue-600 font-semibold hover:underline">Daftar sekarang</a>
            </p>
        </div>
    </div>
</body>
</html>
