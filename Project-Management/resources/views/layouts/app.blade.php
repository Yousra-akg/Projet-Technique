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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

                <!-- Navigation -->
                <div class="hidden md:flex items-center gap-6 ml-10">
                    <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-yellow-500' : 'text-slate-600 hover:text-yellow-500' }}">Home</a>
                    @auth
                        <a href="{{ route('admin.index') }}" class="text-sm font-medium {{ request()->routeIs('admin.index') ? 'text-yellow-500' : 'text-slate-600 hover:text-yellow-500' }}">Admin</a>
                    @endauth
                </div>

                <!-- Auth Links -->
                <div class="flex items-center gap-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-yellow-500 transition">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-slate-900 font-semibold rounded-lg transition shadow-sm text-sm">Register</a>
                        @endif
                    @else
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-yellow-500 transition">
                                <div class="h-9 w-9 rounded-full bg-yellow-100 border border-yellow-200 flex items-center justify-center text-xs font-bold text-yellow-700">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                            
                            <!-- Dropdown -->
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="{{ route('home.dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 rounded-t-lg">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-b-lg">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="flex-grow">
        @yield('content')
    </div>
    
    <footer class="border-t border-slate-200 bg-white py-8">
        <div class="max-w-[85rem] mx-auto px-6 lg:px-8 text-center">
            <p class="text-sm text-slate-400">&copy; {{ date('Y') }} Project Management. All rights reserved.</p>
        </div>
    </footer>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.js"></script>
    @stack('scripts')
</body>
</html>
