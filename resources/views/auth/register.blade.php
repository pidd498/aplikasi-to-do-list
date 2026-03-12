<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TaskFlow</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family: 'Poppins', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #0ea5e9, #2563eb); }
        .gradient-text { background: linear-gradient(135deg, #0ea5e9, #2563eb); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden flex min-h-[600px]">

        <!-- Left: Branding -->
        <div class="hidden md:flex w-1/2 gradient-bg p-10 flex-col justify-between text-white">
            <div>
                <div class="flex items-center gap-2 mb-8">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <span class="text-xl font-bold">TaskFlow</span>
                </div>
                <h2 class="text-3xl font-bold leading-snug mb-4">Start your productivity journey today 🚀</h2>
                <p class="text-blue-100 text-sm leading-relaxed">Create your free account and take control of your tasks, goals, and time.</p>
            </div>

            <div class="space-y-3">
                <div class="flex items-center gap-3 bg-white/10 rounded-xl p-4">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Unlimited Tasks</p>
                        <p class="text-xs text-blue-100">Create as many tasks as you need</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 bg-white/10 rounded-xl p-4">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Smart Notifications</p>
                        <p class="text-xs text-blue-100">Never miss a deadline again</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 bg-white/10 rounded-xl p-4">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Progress Reports</p>
                        <p class="text-xs text-blue-100">Track your productivity over time</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Form -->
        <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
            <div class="flex items-center gap-2 mb-6 md:hidden">
                <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <span class="text-xl font-bold gradient-text">TaskFlow</span>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-1">Let's get started! 🎉</h1>
            <p class="text-gray-400 text-sm mb-8">Create your free TaskFlow account</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Full Name <span class="text-red-400">*</span></label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        placeholder="Your full name"
                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all placeholder:text-gray-300 @error('name') border-red-400 @enderror">
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email <span class="text-red-400">*</span></label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        placeholder="your@email.com"
                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all placeholder:text-gray-300 @error('email') border-red-400 @enderror">
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password <span class="text-red-400">*</span></label>
                    <input id="password" type="password" name="password" required
                        placeholder="Create a password"
                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all placeholder:text-gray-300 @error('password') border-red-400 @enderror">
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">Confirm Password <span class="text-red-400">*</span></label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        placeholder="Repeat your password"
                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all placeholder:text-gray-300">
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full gradient-bg text-white font-semibold py-3 rounded-xl hover:opacity-90 transition-opacity shadow-lg shadow-blue-100 mt-2">
                    Create Account →
                </button>

                <p class="text-center text-sm text-gray-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-blue-500 font-semibold hover:underline ml-1">Sign in</a>
                </p>
            </form>
        </div>

    </div>

</body>
</html>
