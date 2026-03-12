<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Listify - Your Todo List App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="{{ asset('src/output.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    * {
        scroll-behavior: smooth;
    }

    .animate-typing {
        display: inline-block;
        animation: typing-animation 0.5s linear;
    }

    @keyframes typing-animation {
        from {
            width: 0;
        }
        to {
            width: 1ch;
        }
    }
</style>
<body class="font-[Poppins]">
    <!-- Navbar -->
    <nav class="py-1 px-4 fixed -mt-5 z-40 w-full animate__animated animate__fadeInDown bg-white/90 backdrop-blur-sm">
        <div class="mx-auto flex justify-between lg:justify-evenly items-center">
            <div class="">
                <img class="lg:w-40" src="{{ asset('img/Listify.svg') }}" alt="logo" />
            </div>
            <div class="nav-links md:static absolute md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto w-full flex items-center px-5 font-semibold">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-6">
                    <li><a class="hover:text-purple-400" href="#home">Home</a></li>
                    <li><a class="hover:text-purple-400" href="#about">About</a></li>
                    <li><a class="hover:text-purple-400" href="#program">Program</a></li>
                    <li><a class="hover:text-purple-400" href="#Service">Service</a></li>
                </ul>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('home.index') }}" class="bg-[#5400DE] px-5 py-3 text-sm rounded-md text-white font-semibold shadow-lg hidden md:block lg:block hover:bg-indigo-600 hover:shadow-indigo-500 transition-all">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-[#5400DE] px-5 py-3 text-sm rounded-md text-white font-semibold shadow-lg hidden md:block lg:block hover:bg-indigo-600 hover:shadow-indigo-500 transition-all">
                        Sign Up
                    </a>
                    <a href="{{ route('login') }}" class="bg-[#1BC8FF] px-5 py-3 text-sm rounded-md text-white font-semibold shadow-lg hidden md:block lg:block hover:bg-cyan-400 hover:shadow-cyan-300 transition-all">
                        Login
                    </a>
                @endauth
                <ion-icon onclick="onToggleMenu(this)" name="menu-outline" class="text-3xl cursor-pointer md:hidden lg:hidden xl:hidden"></ion-icon>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Section 1 - Hero -->
    <section id="home">
        <div class="container mx-auto bg px-20 py-8 mt-4">
            <div class="grid grid-cols-12 md:justify-items-center">
                <div class="col-span-12 md:col-span-4 lg:col-span-4 order-1">
                    <div class="mt-4 mb-4 md:mt-40 md:mb-40 h-96 ml-6">
                        <h1 class="text-center font-bold text-3xl md:text-4xl md:text-left lg:text-6xl lg:text-left animate__animated animate__fadeInUp">
                            Atur daftar tugas dari Manapun
                        </h1>
                        <p class="text-sm font-semibold text-gray-700 text-center mt-2 md:text-base md:text-left md:mt-4 lg:text-left lg:mt-4 animate__animated animate__fadeInUp">
                            Temukan solusi untuk mengatur dan menyelesaikan tugas dengan efisien. Bergabunglah sekarang!
                        </p>
                        <div class="flex justify-start items-start md:block lg:block mt-6">
                            @auth
                                <a href="{{ route('home.index') }}" class="w-32 lg:w-40 px-4 py-3 rounded-md font-bold bg-purple-700 text-white mt-4 mx-auto shadow-purple-600 shadow-lg cursor-pointer text-center animate__animated animate__fadeInUp inline-block hover:bg-purple-800 transition-all">
                                    Ke Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="w-32 lg:w-40 px-4 py-3 rounded-md font-bold bg-purple-700 text-white mt-4 mx-auto shadow-purple-600 shadow-lg cursor-pointer text-center animate__animated animate__fadeInUp inline-block hover:bg-purple-800 transition-all">
                                    Ayo mulai
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-8 lg:col-span-8 order-2 hidden md:ml-24 justify-items-center lg:block md:block lg:ml-64">
                    <div class="animate__animated animate__fadeInUp">
                        <img class="w-[664px] h-[664px]" src="{{ asset('img/skyblie.svg') }}" alt="hero" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section 1 -->

    <!-- Quotes Section -->
    <section id="about" class="p-10">
        <div class="mx-auto px-10 py-4">
            <h1 class="text-center font-bold text-2xl text-[#5400DE] mb-3">Tujuan Kami</h1>
            <p class="text-center font-semibold xl:w-3/5 text-base md:w-3/4 mx-auto text-gray-500">
                <span id="animated-text"></span>
            </p>
        </div>
    </section>
    <!-- End Quotes Section -->

    <!-- Section 3 -->
    <section>
        <div class="w-full mx-auto bg px-20 py-8 mt-4">
            <div class="grid grid-cols-12">
                <div class="col-span-12 md:col-span-4 lg:col-span-4 order-1">
                    <div class="md:mt-24 lg:mt-48">
                        <h4 class="font-semibold text-lg text-[#C985FF] uppercase mb-5 text-center md:text-left lg:text-left">
                            Global To-do list
                        </h4>
                        <h1 class="font-bold text-3xl text-center mb-10 md:text-left lg:text-5xl lg:text-left">
                            Kelola agenda milik Anda dari mana saja
                        </h1>
                        <hr class="bg-[#C985FF] p-1 rounded-xl w-56 mx-auto mb-8 lg:ml-0" />
                        <p class="text-sm font-normal text-center text-[#9B9B9B] w-full md:text-left lg:text-left lg:text-base">
                            Akses todo list Anda dari perangkat mana saja. Sinkronisasi otomatis memastikan data Anda selalu up-to-date di semua platform.
                        </p>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-8 lg:col-span-8 order-2 hidden lg:block md:block md:ml-32 lg:ml-64">
                    <div class="-mr-20">
                        <img src="{{ asset('rectangle/purple.svg') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section 3 -->

    <!-- Section 4 -->
    <section>
        <div class="w-full mx-auto bg px-20 py-8 mt-4">
            <div class="grid grid-cols-12">
                <div class="col-span-12 md:col-span-8 lg:col-span-8 order-1 hidden lg:block md:block md:mr-32 lg:mr-64">
                    <div class="-ml-20">
                        <img src="{{ asset('rectangle/blue.svg') }}" alt="" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-4 lg:col-span-4 order-2">
                    <div class="md:mt-24 lg:mt-48">
                        <h4 class="font-semibold text-lg text-[#8BF8FF] uppercase mb-5 text-center md:text-left lg:text-left">
                            Perfect Lists
                        </h4>
                        <h1 class="font-bold text-3xl text-center mb-10 md:text-left lg:text-5xl lg:text-left">
                            Buat daftar sempurna untuk setiap kebutuhan.
                        </h1>
                        <hr class="bg-[#8BF8FF] p-1 rounded-xl w-56 mx-auto mb-8 lg:ml-0" />
                        <p class="text-sm font-normal text-center text-[#9B9B9B] w-full md:text-left lg:text-left lg:text-base">
                            Kategorikan tugas Anda dengan mudah. Buat list terpisah untuk pekerjaan, pribadi, atau proyek khusus.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section 4 -->

    <!-- Section 5 -->
    <section>
        <div class="w-full mx-auto bg px-20 py-8 mt-4">
            <div class="grid grid-cols-12">
                <div class="col-span-12 md:col-span-4 lg:col-span-4 order-1">
                    <div class="md:mt-24 lg:mt-48">
                        <h4 class="font-semibold text-lg text-[#58FF69] uppercase mb-5 text-center md:text-left lg:text-left">
                            Dream Planner
                        </h4>
                        <h1 class="font-bold text-3xl text-center mb-10 md:text-left lg:text-5xl lg:text-left">
                            Buat Rencana, Wujudkan Impian Anda
                        </h1>
                        <hr class="bg-[#58FF69] p-1 rounded-xl w-56 mx-auto mb-8 lg:ml-0" />
                        <p class="text-sm font-normal text-center text-[#9B9B9B] w-full md:text-left lg:text-left lg:text-base">
                            Mulai dari rencana harian hingga goal jangka panjang. Listify membantu Anda tetap fokus dan termotivasi.
                        </p>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-8 lg:col-span-8 order-2 hidden lg:block md:block md:ml-32 lg:ml-64">
                    <div class="-mr-20">
                        <img src="{{ asset('rectangle/green.svg') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section 5 -->

    <!-- Section 6 -->
    <section>
        <div class="w-full mx-auto bg px-20 py-8 mt-4">
            <div class="grid grid-cols-12">
                <div class="col-span-12 md:col-span-8 lg:col-span-8 order-1 hidden lg:block md:block md:mr-32 lg:mr-64">
                    <div class="-ml-20">
                        <img src="{{ asset('rectangle/ungu.svg') }}" alt="" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-4 lg:col-span-4 order-2">
                    <div class="md:mt-24 lg:mt-48">
                        <h4 class="font-semibold text-lg text-[#FF53D9] uppercase mb-5 text-center md:text-left lg:text-left">
                            Full Control
                        </h4>
                        <h1 class="font-bold text-3xl text-center mb-10 lg:text-5xl md:text-left lg:text-left">
                            Dapatkan Kontrol Penuh atas Aktivitas Anda.
                        </h1>
                        <hr class="bg-[#FF53D9] p-1 rounded-xl w-56 mx-auto mb-8 lg:ml-0" />
                        <p class="text-sm font-normal text-center text-[#9B9B9B] w-full md:text-left lg:text-left lg:text-base">
                            Monitor progress, set reminder, dan track produktivitas Anda. Semua dalam satu aplikasi yang powerful.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section 6 -->

    <!-- Section 7 (GRID IMAGE) -->
    <section id="program" class="mb-20 md:mt-8">
        <div class="mb-8">
            <h1 class="font-bold text-2xl text-center lg:text-4xl lg:font-bold lg:text-center">
                Perencanaan yang Mudah
            </h1>
            <p class="text-sm text-center font-normal text-[#6B7280] mt-5 lg:text-lg">
                Selesaikan tugas dengan lebih efisien.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 justify-items-center px-8">
            <div class="">
                <div><img src="{{ asset('grid/1.png') }}" alt="feature" /></div>
                <div class="mt-5 mb-16">
                    <h1 class="font-medium text-xl text-center">Intuitive Design</h1>
                    <p class="text-sm text-center text-[#6B7280] mt-3">
                        Experience a clean, smart interface.
                    </p>
                </div>
            </div>
            <div class="">
                <div><img src="{{ asset('grid/2.png') }}" alt="feature" /></div>
                <div class="mt-5 mb-16">
                    <h1 class="font-medium text-xl text-center">Smart Notifications</h1>
                    <p class="text-sm text-center text-[#6B7280] mt-3">
                        Never miss important deadlines.
                    </p>
                </div>
            </div>
            <div class="">
                <div><img src="{{ asset('grid/3.png') }}" alt="feature" /></div>
                <div class="mt-5 mb-16">
                    <h1 class="font-medium text-xl text-center">Team Collaboration</h1>
                    <p class="text-sm text-center text-[#6B7280] mt-3">
                        Work together seamlessly.
                    </p>
                </div>
            </div>
            <div class="">
                <div><img src="{{ asset('grid/4.png') }}" alt="feature" /></div>
                <div class="mt-5 mb-16">
                    <h1 class="font-medium text-xl text-center">Priority Management</h1>
                    <p class="text-sm text-center text-[#6B7280] mt-3">
                        Focus on what matters most.
                    </p>
                </div>
            </div>
            <div class="">
                <div><img src="{{ asset('grid/5.png') }}" alt="feature" /></div>
                <div class="mt-5 mb-16">
                    <h1 class="font-medium text-xl text-center">Progress Tracking</h1>
                    <p class="text-sm text-center text-[#6B7280] mt-3">
                        Monitor your achievements.
                    </p>
                </div>
            </div>
            <div class="">
                <div><img src="{{ asset('grid/6.png') }}" alt="feature" /></div>
                <div class="mt-5 mb-16">
                    <h1 class="font-medium text-xl text-center">Cloud Sync</h1>
                    <p class="text-sm text-center text-[#6B7280] mt-3">
                        Access anywhere, anytime.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- END Section 7 (GRID IMAGE) -->

    <!-- Section 8 - CTA -->
    <section class="container mx-auto mb-20">
        <div class="flex justify-center items-center">
            <img src="{{ asset('img/card.svg') }}" alt="join us" />
        </div>
    </section>
    <!-- END section 8 -->

    <!-- Footer -->
    <footer id="Service" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8">
                    <h1 class="font-bold text-4xl text-transparent bg-clip-text text-center md:text-center bg-gradient-to-r from-purple-400 to-purple-700 inline-block lg:text-left">
                        Listify
                    </h1>
                    <p class="text-sm leading-6 text-gray-600 w-3/4 text-center mx-auto md:text-center md:mx-auto lg:text-left lg:mx-0">
                        Platform terbaik untuk mengatur dan mengelola to-do list Anda. Tingkatkan produktivitas dengan fitur-fitur canggih kami.
                    </p>
                    <div class="flex space-x-6 justify-center md:justify-center lg:justify-start">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                    <div class="md:grid md:grid-cols-2 md:gap-8 px-12 md:px-12 lg:px-0">
                        <div>
                            <h3 class="text-base uppercase font-semibold leading-6 text-gray-900">Solutions</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Marketing</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Analytics</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Commerce</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Insights</a></li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-base uppercase font-semibold leading-6 text-gray-900">Contact us</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900 mb-4 flex items-center justify-center md:justify-start">
                                        <span class="me-3 [&>svg]:h-5 [&>svg]:w-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        (+62) 8818208207
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900 mb-4 flex items-center justify-center md:justify-start">
                                        <span class="me-3 [&>svg]:h-5 [&>svg]:w-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                                <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                                            </svg>
                                        </span>
                                        Listify@gmail.com
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-16 border-t border-gray-900/10 pt-8 sm:mt-20 lg:mt-24">
                <p class="text-xs leading-5 text-gray-500 text-center md:text-center lg:text-start">
                    &copy; 2024 By ListifyUI. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <script>
        const navLinks = document.querySelector(".nav-links");
        function onToggleMenu(e) {
            e.name = e.name === "menu" ? "close" : "menu";
            navLinks.classList.toggle("top-[9%]");
        }

        // Animasi text typing
        var textToAnimate = "Kami bertujuan untuk menyederhanakan rutinitas harian Anda dengan antarmuka daftar tugas yang intuitif.";
        var animatedTextElement = document.getElementById("animated-text");
        var charIndex = 0;
        var typingSpeed = 100;

        function typeWriter() {
            if (charIndex < textToAnimate.length) {
                animatedTextElement.textContent += textToAnimate.charAt(charIndex);
                charIndex++;
                setTimeout(typeWriter, typingSpeed);
            } else {
                charIndex = 0;
                animatedTextElement.textContent = "";
                setTimeout(typeWriter, typingSpeed);
            }
        }

        typeWriter();
    </script>
</body>
</html>-gray-900">Support</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Pricing</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Documentation</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Guides</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">API Status</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-base uppercase font-semibold leading-6 text-gray-900">Company</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">About</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Blog</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Jobs</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Press</a></li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-base uppercase font-semibold leading-6 text