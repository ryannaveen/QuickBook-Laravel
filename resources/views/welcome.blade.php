<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QuickBook - Professional Scheduling</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|syne:500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-800 antialiased font-sans selection:bg-blue-500 selection:text-white">

    <!-- Navbar -->
    <nav class="border-b border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl text-slate-800 tracking-tight" style="font-family: 'Syne', sans-serif;">QuickBook</span>
                </div>

                <!-- Nav Links (Desktop) -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-slate-600 hover:text-blue-500 font-medium transition-colors">Features</a>
                    <a href="#" class="text-slate-600 hover:text-blue-500 font-medium transition-colors">How it Works</a>
                    <a href="#" class="text-slate-600 hover:text-blue-500 font-medium transition-colors">Pricing</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-slate-600 hover:text-blue-500 font-medium transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 border border-blue-500 text-blue-500 hover:bg-blue-50 rounded-lg font-medium transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium transition-colors shadow-sm">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-20 pb-24 lg:pt-32 lg:pb-40 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-2xl">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-800 leading-tight mb-6" style="font-family: 'Syne', sans-serif;">
                        Professional Scheduling for Micro-Businesses
                    </h1>
                    <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                        Automate your digital service bookings in under 5 minutes. No more manual emails or double-bookings.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium text-lg transition-colors shadow-md">
                            Start Your Free Trial
                        </a>
                    </div>
                </div>
                <div class="relative mt-12 lg:mt-0">
                    <div class="absolute inset-0 bg-blue-100 rounded-3xl transform translate-x-4 translate-y-4"></div>
                    <div class="relative bg-white border border-slate-200 rounded-3xl shadow-xl overflow-hidden aspect-[4/3] flex items-center justify-center">
                        <!-- Placeholder for screenshot/mockup -->
                        <div class="text-center p-8">
                            <svg class="w-20 h-20 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-slate-400 font-medium">Dashboard Mockup Placeholder</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3-Step Process -->
    <section class="py-20 bg-slate-50 border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800" style="font-family: 'Syne', sans-serif;">How It Works</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Step 1 -->
                <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200 text-center relative">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-7 h-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Step 1: Create</h3>
                    <p class="text-slate-600">Create your account and list services</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200 text-center relative">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-7 h-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Step 2: Share</h3>
                    <p class="text-slate-600">Send your unique booking link to clients</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200 text-center relative">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-7 h-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Step 3: Relax</h3>
                    <p class="text-slate-600">Manage schedule automatically on dashboard</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4" style="font-family: 'Syne', sans-serif;">Simple, Transparent Pricing</h2>
                <p class="text-lg text-slate-600">Choose the plan that best fits your business needs.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Free Tier -->
                <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-2xl font-bold text-slate-800 mb-2">Free Tier</h3>
                    <div class="text-4xl font-bold text-slate-800 mb-6">$0 <span class="text-lg text-slate-500 font-normal">/ month</span></div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 text-slate-600">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Up to 5 Services
                        </li>
                        <li class="flex items-center gap-3 text-slate-600">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Email Notifications
                        </li>
                        <li class="flex items-center gap-3 text-slate-600">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Basic Dashboard
                        </li>
                    </ul>
                    
                    <a href="{{ route('register') }}" class="block w-full py-3 px-4 border border-blue-500 text-blue-500 text-center font-medium rounded-lg hover:bg-blue-50 transition-colors">
                        Get Started
                    </a>
                </div>

                <!-- Pro Tier -->
                <div class="bg-blue-500 border border-blue-600 rounded-2xl p-8 shadow-lg text-white relative transform md:-translate-y-4">
                    <div class="absolute top-0 right-8 transform -translate-y-1/2">
                        <span class="bg-blue-200 text-blue-800 text-xs font-bold uppercase tracking-wider py-1 px-3 rounded-full">Most Popular</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Pro Tier</h3>
                    <div class="text-4xl font-bold mb-6">$15 <span class="text-lg text-blue-100 font-normal">/ month</span></div>
                    
                    <ul class="space-y-4 mb-8 text-blue-50">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-white flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Unlimited Services
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-white flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            SMS & Priority Support
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-white flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Advanced Analytics & CRUD
                        </li>
                    </ul>
                    
                    <a href="{{ route('register') }}" class="block w-full py-3 px-4 bg-white text-blue-600 text-center font-medium rounded-lg hover:bg-blue-50 transition-colors shadow-sm">
                        Upgrade to Pro
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-50 border-t border-slate-200 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-slate-500">Copyright &copy; 2024 QuickBook SAAS</p>
            <div class="flex gap-6">
                <a href="#" class="text-slate-500 hover:text-slate-800 transition-colors">Terms of Service</a>
                <a href="#" class="text-slate-500 hover:text-slate-800 transition-colors">Privacy Policy</a>
            </div>
        </div>
    </footer>

</body>
</html>
