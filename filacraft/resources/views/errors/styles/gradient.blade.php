<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $code }} - {{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kumbh Sans', sans-serif; }
        .glass {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.15);
        }
        .float-1 { animation: f1 8s ease-in-out infinite; }
        .float-2 { animation: f2 10s ease-in-out infinite; }
        .float-3 { animation: f3 12s ease-in-out infinite; }
        @keyframes f1 { 0%,100% { transform: translate(0,0) rotate(0deg); } 50% { transform: translate(30px,-40px) rotate(10deg); } }
        @keyframes f2 { 0%,100% { transform: translate(0,0) rotate(0deg); } 50% { transform: translate(-20px,30px) rotate(-8deg); } }
        @keyframes f3 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(15px,20px); } }
    </style>
</head>
<body class="h-full flex items-center justify-center px-6 overflow-hidden relative"
    style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 25%, #4338ca 50%, #6366f1 75%, #818cf8 100%);">

    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="float-1 absolute top-[10%] left-[15%] w-40 h-40 rounded-full bg-white/5"></div>
        <div class="float-2 absolute top-[60%] right-[10%] w-64 h-64 rounded-full bg-white/5"></div>
        <div class="float-3 absolute bottom-[20%] left-[30%] w-32 h-32 rounded-full bg-white/5"></div>
        <div class="float-1 absolute top-[30%] right-[25%] w-20 h-20 rounded-full bg-white/10" style="animation-delay:2s"></div>
    </div>

    <div class="glass rounded-3xl p-12 max-w-md w-full text-center relative z-10">
        <h1 class="text-8xl font-bold text-white/90 mb-2">{{ $code }}</h1>
        <div class="w-16 h-1 bg-white/30 rounded-full mx-auto mb-4"></div>
        <h2 class="text-xl font-semibold text-white mb-3">{{ $title }}</h2>
        <p class="text-white/60 mb-8 text-sm">{{ $message }}</p>
        <a href="/admin" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white text-indigo-700 font-medium text-sm hover:bg-white/90 hover:-translate-y-0.5 transition-all duration-200 shadow-lg">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
            Ana Sayfaya Don
        </a>
    </div>
</body>
</html>
