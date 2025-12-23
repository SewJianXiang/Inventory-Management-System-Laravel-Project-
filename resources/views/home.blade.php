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
        <a href="#" class="hover:text-white">Panel</a>
        <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-full font-medium">
            Get Started
        </a>
    </div>
</nav>

<!-- ================= HERO ================= -->
<section class="w-full min-h-screen flex flex-col justify-center items-center text-center px-6 bg-gradient-to-b from-[#0b1020] via-[#050816] to-black">

    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
        Providing the brand new  <br>
        Stock Management
    </h1>

    <p class="text-slate-400 max-w-2xl mx-auto mb-10 text-lg">
        Trouble with Stock Management? <br>
        Our System will help you manage your stock easily and effectively.
    </p>

    <div class="flex justify-center gap-4">
        <a href="#" class="bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-full font-medium">
            Get started
        </a>
        <a href="#" class="bg-white/10 hover:bg-white/20 px-6 py-3 rounded-full font-medium">
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

<!-- ================= LOGOS ================= -->
<section class="max-w-6xl mx-auto px-6 pb-20">
    <div class="flex flex-wrap justify-center items-center gap-10 opacity-60">

        <span class="text-lg font-semibold">Microsoft</span>
        <span class="text-lg font-semibold">airbnb</span>
        <span class="text-lg font-semibold">Google</span>
        <span class="text-lg font-semibold">GE</span>
        <span class="text-lg font-semibold">NETFLIX</span>
        <span class="text-lg font-semibold">Google Cloud</span>

    </div>
</section>

</body>
</html>
