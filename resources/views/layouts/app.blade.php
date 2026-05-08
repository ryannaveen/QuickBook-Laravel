<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'QuickBook') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600|syne:500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans selection:bg-blue-500 selection:text-white min-h-screen flex flex-col">
    <!-- White Navbar -->
    <nav class="sticky top-0 z-40 w-full bg-white border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-bold text-2xl tracking-tight text-slate-900" style="font-family: 'Syne', sans-serif;">QuickBook</span>
                    </a>
                </div>

                <!-- Nav Links (Desktop) -->
                <div class="hidden md:flex items-center space-x-10">
                    @auth
                        @if(auth()->user()->role === 'owner')
                            <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Dashboard</a>
                            <a href="{{ route('owner.services') }}" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Manage Services</a>
                            <a href="#" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">View Bookings</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Features</a>
                            <a href="{{ route('appointments.index') }}" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">My Bookings</a>
                            <a href="#" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Profile</a>
                        @endif
                    @else
                        <a href="#" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Features</a>
                        <a href="#" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">How it Works</a>
                        <a href="#" class="text-slate-600 hover:text-blue-600 font-semibold transition-colors">Pricing</a>
                    @endauth
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    @auth
                        <div class="flex items-center gap-4">
                            <div class="hidden sm:flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-full border border-slate-100">
                                <span class="text-sm font-semibold text-slate-700">Hi, {{ auth()->user()->name }}</span>
                                <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-white shadow-sm">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3b82f6&color=fff" alt="Profile">
                                </div>
                            </div>
                            
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2 text-slate-700 hover:text-blue-600 font-bold transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-600 text-white hover:bg-blue-700 rounded-xl font-bold transition-all shadow-lg shadow-blue-200">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 w-full">
        @if (session()->has('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if (session()->has('error'))
            <div x-data="{ show: true }" x-show="show" class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center justify-between gap-3 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-red-400 hover:text-red-600">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        @endif
    </div>

    <!-- Page Content -->
    <main class="flex-1 flex flex-col">
        {{ $slot }}
    </main>

    <footer class="bg-white border-t border-slate-100 py-10 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-slate-500 text-sm">Copyright &copy; 2024 QuickBook SAAS</p>
            <div class="mt-4 flex justify-center gap-6 text-sm">
                <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors">Terms of Service</a>
                <span class="text-slate-200">|</span>
                <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors">Privacy Policy</a>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
