<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stocky Management</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

        <style>
            @keyframes float1 {
                0% { transform: translate(0, 0); }
                50% { transform: translate(50px, 100px); }
                100% { transform: translate(0, 0); }
            }
            @keyframes float2 {
                0% { transform: translate(0, 0); }
                50% { transform: translate(-80px, 150px); }
                100% { transform: translate(0, 0); }
            }
            @keyframes float3 {
                0% { transform: translate(0, 0); }
                50% { transform: translate(60px, -120px); }
                100% { transform: translate(0, 0); }
            }
            @keyframes float4 {
                0% { transform: translate(0, 0); }
                50% { transform: translate(80px, -140px); }
                100% { transform: translate(0, 0); }
            }

            .animate-ball1 {
                animation: float1 12s ease-in-out infinite alternate;
                top: 20%;
                left: 10%;
            }
            .animate-ball2 {
                animation: float2 15s ease-in-out infinite alternate;
                top: 40%;
                left: 70%;
            }
            .animate-ball3 {
                animation: float3 18s ease-in-out infinite alternate;
                top: 60%;
                left: 30%;
            }
            .animate-ball4 {
                animation: float3 200s ease-in-out infinite alternate;
                top: 70%;
                left: 20%;
            }
</style>
</head>
<body class="bg-gradient-to-b from-[#0b1020] via-[#050816] to-black text-white font-sans">

<!-- ================= NAVBAR ================= -->
<nav class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
    <div class="flex items-center gap-2 text-xl font-bold">
        <span class="w-3 h-3 bg-indigo-500 rounded-full"></span>
        Stocky Management
    </div>

    <div class="hidden md:flex items-center gap-8 text-sm text-slate-300">
        <a href="#" class="hover:text-white">About</a>
        <a href="#" class="hover:text-white">Pricing</a>
        <a href="#" class="hover:text-white">Features</a>
        <a href="{{ route('stocks.index') }}" class="hover:text-white">Panel</a>
        <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-full font-medium">
            Get Started
        </a>
    </div>  
</nav>

<!-- ================= HERO ================= -->
<section class="relative w-full min-h-screen flex flex-col justify-center items-center text-center px-6 overflow-hidden">

    <!-- Floating Balls Background -->
    <div class="absolute inset-0 -z-10">
        <!-- Ball 1 -->
        <div class="absolute w-40 h-40 bg-purple-500 rounded-full opacity-30 blur-2xl animate-ball1"></div>
        <!-- Ball 2 -->
        <div class="absolute w-60 h-60 bg-pink-500 rounded-full opacity-20 blur-3xl animate-ball2"></div>
        <!-- Ball 3 -->
        <div class="absolute w-32 h-32 bg-indigo-400 rounded-full opacity-25 blur-2xl animate-ball3"></div>
        <!-- Ball 4 -->
        <div class="absolute w-50 h-50 bg-cyan-400 rounded-full opacity-35 blur-2xl animate-ball3"></div>
    </div>

    <!-- Hero Content -->
    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6 drop-shadow-lg text-white">
        Providing the brand new <br>
        Stock Management
    </h1>

    <p class="text-slate-200 max-w-2xl mx-auto mb-10 text-lg drop-shadow-md">
        Trouble with Stock Management? <br>
        Our System will help you manage your stock easily and effectively.
    </p>

    <div class="flex justify-center gap-4">
        <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-full font-medium shadow-lg transition">
            Get started
        </a>
        <a href="#" class="bg-white/10 hover:bg-white/20 px-6 py-3 rounded-full font-medium shadow-lg transition">
            Learn more
        </a>
    </div>
</section>

<!-- ================= FEATURES ================= -->
<section class="max-w-6xl mx-auto px-6 pb-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center border-t border-white/10 pt-12">

        <div>
            <h3 class="font-semibold text-lg mb-2">The lowest price</h3>
            <p class="text-slate-400 text-sm">Some text here</p>
        </div>

        <div>
            <h3 class="font-semibold text-lg mb-2">The fastest on the market</h3>
            <p class="text-slate-400 text-sm">Some text here</p>
        </div>

        <div>
            <h3 class="font-semibold text-lg mb-2">The most loved</h3>
            <p class="text-slate-400 text-sm">Some text here</p>
        </div>

    </div>
</section>
</body>
</html>
