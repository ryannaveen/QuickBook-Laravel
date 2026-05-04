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
    <!-- Blue Navbar -->
    <nav class="sticky top-0 z-40 w-full bg-blue-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight" style="font-family: 'Syne', sans-serif;">QuickBook</span>
                    </a>
                </div>

                <!-- Nav Links (Desktop) -->
                <div class="hidden md:flex items-center space-x-8">
                    @auth
                        @if(auth()->user()->role === 'owner')
                            <a href="{{ route('dashboard') }}" class="hover:text-blue-200 font-medium transition-colors">Dashboard</a>
                            <a href="{{ route('owner.services') }}" class="hover:text-blue-200 font-medium transition-colors">Manage Services</a>
                            <a href="#" class="hover:text-blue-200 font-medium transition-colors">View Bookings</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="hover:text-blue-200 font-medium transition-colors">Features</a>
                            <a href="{{ route('appointments.index') }}" class="hover:text-blue-200 font-medium transition-colors">My Bookings</a>
                            <a href="#" class="hover:text-blue-200 font-medium transition-colors">Profile</a>
                        @endif
                    @else
                        <a href="#" class="hover:text-blue-200 font-medium transition-colors">Features</a>
                        <a href="#" class="hover:text-blue-200 font-medium transition-colors">How it Works</a>
                        <a href="#" class="hover:text-blue-200 font-medium transition-colors">Pricing</a>
                    @endauth
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    @auth
                        <div class="flex items-center gap-3">
                            <div class="hidden sm:flex flex-col items-end">
                                <span class="text-sm font-medium">Hi, {{ auth()->user()->name }}</span>
                                <span class="text-[10px] font-bold uppercase tracking-wider bg-white/20 px-2 py-0.5 rounded">{{ auth()->user()->role }}</span>
                            </div>
                            
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="hover:bg-blue-700 p-2 rounded-full transition-colors flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                            
                            <!-- Profile Avatar -->
                            <div class="w-8 h-8 rounded-full bg-blue-400 flex items-center justify-center text-white font-bold cursor-pointer hover:bg-blue-300 transition-colors border border-white/30">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-white hover:text-blue-200 font-medium transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-colors shadow-sm">
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

    @livewireScripts
</body>
</html>
