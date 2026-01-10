<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Management</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Manrope', 'sans-serif'] },
                    colors: { brand: { yellow: '#fcd34d' } }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-700 antialiased min-h-screen flex flex-col">
    
    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-40 shadow-sm">
        <div class="w-[75%] mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Branding -->
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center text-slate-900 font-bold shadow-sm">T</div>
                    <span class="font-bold text-lg text-slate-800 tracking-tight">Task<span class="text-yellow-500">Manage</span></span>
                </div>
                <!-- Profile -->
                <div class="flex items-center gap-4">
                    <div class="h-9 w-9 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">TM</div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <div class="flex-grow w-[75%] mx-auto px-6 lg:px-8 py-10">
        @yield('content')
    </div>
    
    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white py-8">
        <div class="w-[75%] mx-auto px-6 lg:px-8 text-center">
            <p class="text-sm text-slate-400">&copy; {{ date('Y') }} Project Management. All rights reserved (v2.0 Fixed).</p>
        </div>
    </footer>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('scripts')
</body>
</html>
