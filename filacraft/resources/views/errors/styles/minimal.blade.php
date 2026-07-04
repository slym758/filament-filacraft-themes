<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $code }} - {{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Kumbh Sans', sans-serif; }</style>
</head>
<body class="h-full bg-white dark:bg-gray-950 flex items-center justify-center px-6">
    <div class="text-center max-w-md">
        <h1 class="text-[10rem] font-bold leading-none tracking-tighter text-gray-100 dark:text-gray-800">{{ $code }}</h1>
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white -mt-6 mb-3">{{ $title }}</h2>
        <p class="text-gray-400 dark:text-gray-500 mb-8">{{ $message }}</p>
        <a href="/admin" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-sm font-medium hover:opacity-90 transition-opacity">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
            Ana Sayfaya Don
        </a>
    </div>
</body>
</html>
