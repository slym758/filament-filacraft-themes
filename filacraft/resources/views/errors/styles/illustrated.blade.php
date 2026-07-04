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
        .floating { animation: float 6s ease-in-out infinite; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .pulse-slow { animation: pulse-slow 3s ease-in-out infinite; }
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.15; }
            50% { opacity: 0.3; }
        }
    </style>
</head>
<body class="h-full bg-gradient-to-br from-orange-50 via-white to-amber-50 dark:from-gray-900 dark:via-gray-950 dark:to-gray-900 flex items-center justify-center px-6 overflow-hidden">
    <div class="absolute top-20 left-20 w-72 h-72 rounded-full bg-orange-200 dark:bg-orange-900 pulse-slow blur-3xl"></div>
    <div class="absolute bottom-20 right-20 w-96 h-96 rounded-full bg-amber-200 dark:bg-amber-900 pulse-slow blur-3xl" style="animation-delay: 1.5s"></div>

    <div class="text-center max-w-lg relative z-10">
        <div class="floating mb-8">
            @if($code === 404)
                <svg class="mx-auto h-36 w-36 text-orange-400/70" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0012.016 15a4.486 4.486 0 00-3.198 1.318M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                </svg>
            @elseif($code === 403)
                <svg class="mx-auto h-36 w-36 text-red-400/70" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            @else
                <svg class="mx-auto h-36 w-36 text-amber-400/70" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            @endif
        </div>
        <h1 class="text-8xl font-bold text-orange-500 dark:text-orange-400 mb-4">{{ $code }}</h1>
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-3">{{ $title }}</h2>
        <p class="text-gray-500 dark:text-gray-400 mb-8">{{ $message }}</p>
        <a href="/admin" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-orange-500 text-white font-medium shadow-lg shadow-orange-500/30 hover:shadow-xl hover:shadow-orange-500/40 hover:-translate-y-0.5 transition-all duration-200">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
            Ana Sayfaya Don
        </a>
    </div>
</body>
</html>
