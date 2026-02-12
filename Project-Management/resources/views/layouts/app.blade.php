<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Task Management') - Project Management</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-700 antialiased min-h-screen flex flex-col">
    
    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-40 shadow-sm" x-data="{ open: false }">
        <div class="w-[75%] mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Branding -->
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold shadow-sm">T</div>
                    <span class="font-bold text-lg text-slate-800 tracking-tight">Task<span class="text-blue-500">Manage</span></span>
                </div>

                <!-- Navigation -->
                <div class="hidden md:flex items-center gap-6 ml-10">
                    <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-500' : 'text-slate-600 hover:text-blue-500' }}">Home</a>
                    @auth
                        @can('access-admin')
                            <a href="{{ route('admin.index') }}" class="text-sm font-medium {{ request()->routeIs('admin.index') ? 'text-blue-500' : 'text-slate-600 hover:text-blue-500' }}">Dashboard</a>
                        @endcan
                    @endauth
                </div>

                <!-- Auth Links -->
                <div class="flex items-center gap-4">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-blue-500">Log in</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Register</a>
                        @endif
                    @else
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-gray-100 text-gray-800 shadow-sm hover:bg-gray-200 focus:outline-none">
                                {{ Auth::user()->name }}
                                <svg class="size-4 text-gray-600 transition-transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                            <div x-show="open" x-transition.origin.top.right class="absolute right-0 z-50 mt-2 min-w-[15rem] bg-white shadow-md rounded-lg p-2 border border-gray-100" style="display: none;">
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Log out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
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
    
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.js"></script>
    @stack('scripts')
</body>
</html>
