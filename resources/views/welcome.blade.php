<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QuickBook - Professional Scheduling for Micro-Businesses</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|syne:600,700,800" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --accent: #f59e0b;
        }

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .font-syne {
            font-family: 'Syne', sans-serif;
        }

        /* Animated Background Blobs */
        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.2) 0%, rgba(147, 197, 253, 0.2) 100%);
            filter: blur(80px);
            border-radius: 50%;
            z-index: -1;
            animation: move 25s infinite alternate;
        }

        .blob-1 { top: -100px; left: -100px; animation-delay: 0s; }
        .blob-2 { top: 40%; right: -100px; animation-delay: -5s; background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(253, 230, 138, 0.1) 100%); }
        .blob-3 { bottom: -100px; left: 20%; animation-delay: -10s; }

        @keyframes move {
            from { transform: translate(0, 0) scale(1); }
            to { transform: translate(100px, 100px) scale(1.1); }
        }

        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .glass-dark {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Animations */
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Floating Animation */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-[#fafbff] text-slate-900 antialiased selection:bg-blue-500 selection:text-white">

    <!-- Background Blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 glass border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="font-extrabold text-2xl text-slate-900 tracking-tight font-syne">QuickBook</span>
                </div>

                <!-- Nav Links (Desktop) -->
                <div class="hidden md:flex items-center space-x-10">
                    <a href="#features" class="text-slate-600 hover:text-blue-600 font-medium transition-colors relative group">
                        Features
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#how-it-works" class="text-slate-600 hover:text-blue-600 font-medium transition-colors relative group">
                        How it Works
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#pricing" class="text-slate-600 hover:text-blue-600 font-medium transition-colors relative group">
                        Pricing
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-slate-900 text-white rounded-full font-semibold hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/20">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-700 hover:text-blue-600 font-semibold transition-colors px-4">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-7 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full font-bold transition-all shadow-xl shadow-blue-600/25 hover:scale-105 active:scale-95">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-12 pb-24 lg:pt-20 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="max-w-2xl fade-in-up">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-sm font-bold mb-8 animate-bounce">
                        <span class="flex h-2 w-2 rounded-full bg-blue-600"></span>
                        New: Automated SMS Reminders
                    </div>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-slate-900 leading-[1.1] mb-8 font-syne tracking-tight">
                        Professional <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Scheduling</span> for Micro-Businesses
                    </h1>
                    <p class="text-xl text-slate-600 mb-10 leading-relaxed font-light">
                        Automate your digital service bookings in under 5 minutes. Say goodbye to manual emails and embarrassing double-bookings.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-5">
                        <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold text-lg transition-all shadow-2xl shadow-blue-600/30 hover:-translate-y-1 group">
                            Start Your Free Trial
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#how-it-works" class="inline-flex justify-center items-center px-10 py-4 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-2xl font-bold text-lg transition-all">
                            Watch Demo
                        </a>
                    </div>
                    
                    <!-- Social Proof -->
                    <div class="mt-12 flex items-center gap-4">
                        <div class="flex -space-x-3">
                            <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?u=1" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?u=2" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?u=3" alt="User">
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-blue-100 flex items-center justify-center text-xs font-bold text-blue-600">500+</div>
                        </div>
                        <p class="text-sm text-slate-500 font-medium">Trusted by 500+ small business owners</p>
                    </div>
                </div>
                
                <div class="relative mt-12 lg:mt-0 fade-in-up" style="animation-delay: 0.2s">
                    <div class="absolute -inset-4 bg-gradient-to-tr from-blue-100 to-indigo-100 rounded-[2.5rem] transform rotate-3 blur-2xl opacity-50"></div>
                    <div class="relative rounded-[2rem] shadow-2xl overflow-hidden border border-white/50 floating">
                        <img src="{{ asset('quickbook_dashboard_mockup_1778214347594.png') }}" alt="QuickBook Dashboard Mockup" class="w-full h-auto object-cover">
                    </div>
                    
                    <!-- Floating Cards -->
                    <div class="absolute -bottom-6 -left-6 glass p-5 rounded-2xl shadow-xl border border-white/40 max-w-[200px] hidden md:block">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">New Booking</span>
                        </div>
                        <p class="text-sm font-semibold text-slate-800">John Doe booked Consultation</p>
                        <p class="text-[10px] text-slate-400 mt-1">2 minutes ago</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3-Step Process -->
    <section id="how-it-works" class="py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-sm font-bold text-blue-600 uppercase tracking-[0.2em] mb-4">The Process</h2>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 font-syne">Three Simple Steps to Success</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                <!-- Connector Line (Desktop) -->
                <div class="absolute top-1/2 left-0 w-full h-0.5 bg-slate-200 -translate-y-1/2 hidden md:block z-0"></div>
                
                <!-- Step 1 -->
                <div class="relative z-10 group">
                    <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 text-center hover-lift transition-all">
                        <div class="w-20 h-20 bg-blue-50 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:bg-blue-600 group-hover:scale-110 transition-all duration-500">
                            <svg class="w-10 h-10 text-blue-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4 font-syne">1. Create</h3>
                        <p class="text-slate-500 leading-relaxed">Sign up in seconds and list your digital services with custom pricing and duration.</p>
                    </div>
                    <div class="absolute -top-4 -right-4 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-black text-xl border-4 border-white shadow-lg">1</div>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 group">
                    <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 text-center hover-lift transition-all">
                        <div class="w-20 h-20 bg-indigo-50 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:bg-indigo-600 group-hover:scale-110 transition-all duration-500">
                            <svg class="w-10 h-10 text-indigo-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4 font-syne">2. Share</h3>
                        <p class="text-slate-500 leading-relaxed">Share your personalized booking link on Instagram, WhatsApp, or your website.</p>
                    </div>
                    <div class="absolute -top-4 -right-4 w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-black text-xl border-4 border-white shadow-lg">2</div>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 group">
                    <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 text-center hover-lift transition-all">
                        <div class="w-20 h-20 bg-amber-50 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:bg-amber-500 group-hover:scale-110 transition-all duration-500">
                            <svg class="w-10 h-10 text-amber-500 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4 font-syne">3. Relax</h3>
                        <p class="text-slate-500 leading-relaxed">Let QuickBook handle the scheduling, reminders, and confirmations while you work.</p>
                    </div>
                    <div class="absolute -top-4 -right-4 w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center text-amber-500 font-black text-xl border-4 border-white shadow-lg">3</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-24 bg-slate-900 text-white rounded-[3rem] mx-4 sm:mx-8 lg:mx-16 relative overflow-hidden">
        <div class="blob blob-2 opacity-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20">
                <h2 class="text-blue-400 font-bold uppercase tracking-widest mb-4">Pricing</h2>
                <h2 class="text-4xl md:text-5xl font-extrabold font-syne mb-6">Simple Plans for Growth</h2>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">Scale your business with confidence. No hidden fees, cancel anytime.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto">
                <!-- Free Tier -->
                <div class="glass-dark rounded-[2.5rem] p-10 border border-white/5 hover:border-white/20 transition-all flex flex-col group">
                    <h3 class="text-2xl font-bold mb-2 font-syne">Free Tier</h3>
                    <p class="text-slate-400 mb-8">Perfect for getting started</p>
                    <div class="flex items-baseline gap-2 mb-10">
                        <span class="text-6xl font-black font-syne">$0</span>
                        <span class="text-slate-400">/ month</span>
                    </div>
                    
                    <ul class="space-y-5 mb-12 flex-grow">
                        <li class="flex items-center gap-4 text-slate-300">
                            <div class="w-6 h-6 rounded-full bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            Up to 5 Services
                        </li>
                        <li class="flex items-center gap-4 text-slate-300">
                            <div class="w-6 h-6 rounded-full bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            Email Notifications
                        </li>
                        <li class="flex items-center gap-4 text-slate-300">
                            <div class="w-6 h-6 rounded-full bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            Standard Dashboard
                        </li>
                    </ul>
                    
                    <a href="{{ route('register') }}" class="block w-full py-5 px-6 border-2 border-white/10 text-white text-center font-bold rounded-2xl hover:bg-white hover:text-slate-900 transition-all">
                        Get Started Free
                    </a>
                </div>

                <!-- Pro Tier -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-[2.6rem] blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative glass-dark rounded-[2.5rem] p-10 border border-blue-500/30 flex flex-col h-full bg-slate-900/40">
                        <div class="absolute top-0 right-10 transform -translate-y-1/2">
                            <span class="bg-blue-600 text-white text-xs font-black uppercase tracking-widest py-2 px-5 rounded-full shadow-lg shadow-blue-600/50">Most Popular</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-2 font-syne">Pro Tier</h3>
                        <p class="text-slate-400 mb-8">For serious professionals</p>
                        <div class="flex items-baseline gap-2 mb-10">
                            <span class="text-6xl font-black font-syne">$15</span>
                            <span class="text-slate-400">/ month</span>
                        </div>
                        
                        <ul class="space-y-5 mb-12 flex-grow">
                            <li class="flex items-center gap-4 text-white">
                                <div class="w-6 h-6 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <strong>Unlimited</strong> Services
                            </li>
                            <li class="flex items-center gap-4 text-white">
                                <div class="w-6 h-6 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                SMS Notifications & Reminders
                            </li>
                            <li class="flex items-center gap-4 text-white">
                                <div class="w-6 h-6 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                Priority 24/7 Support
                            </li>
                            <li class="flex items-center gap-4 text-white">
                                <div class="w-6 h-6 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                Advanced Analytics
                            </li>
                        </ul>
                        
                        <a href="{{ route('register') }}" class="block w-full py-5 px-6 bg-blue-600 hover:bg-blue-700 text-white text-center font-bold rounded-2xl transition-all shadow-xl shadow-blue-600/30 hover:scale-[1.02] active:scale-[0.98]">
                            Upgrade to Pro
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1">
                    <h2 class="text-4xl font-extrabold font-syne mb-6 text-slate-900">Loved by Entrepreneurs</h2>
                    <p class="text-slate-600 text-lg mb-8 leading-relaxed">Join thousands of service providers who have reclaimed their time with QuickBook.</p>
                    <div class="flex items-center gap-2 mb-12">
                        <div class="flex text-amber-400">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <span class="font-bold text-slate-800">4.9/5 from 2,000+ reviews</span>
                    </div>
                </div>
                
                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                        <p class="text-slate-600 mb-6 italic">"QuickBook changed my life. I used to spend 2 hours a day just responding to booking DMs. Now it happens automatically."</p>
                        <div class="flex items-center gap-4">
                            <img class="w-12 h-12 rounded-full" src="https://i.pravatar.cc/100?u=4" alt="User">
                            <div>
                                <h4 class="font-bold text-slate-900">Sarah Jenkins</h4>
                                <p class="text-xs text-slate-400">Yoga Instructor</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm md:mt-8">
                        <p class="text-slate-600 mb-6 italic">"The simplest scheduling tool I've ever used. My clients love the ease of booking, and I love the SMS reminders."</p>
                        <div class="flex items-center gap-4">
                            <img class="w-12 h-12 rounded-full" src="https://i.pravatar.cc/100?u=5" alt="User">
                            <div>
                                <h4 class="font-bold text-slate-900">Marcus Thorne</h4>
                                <p class="text-xs text-slate-400">Tech Consultant</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-50 border-t border-slate-200 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="font-extrabold text-xl text-slate-900 font-syne">QuickBook</span>
                    </div>
                    <p class="text-slate-500 max-w-sm mb-8">Professional scheduling software designed specifically for solo entrepreneurs and micro-businesses.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.336 3.608 1.31.974.974 1.248 2.242 1.31 3.608.058 1.266.07 1.646.07 4.849 0 3.203-.012 3.583-.07 4.849-.062 1.366-.336 2.633-1.31 3.608-.974.974-2.242 1.248-3.608 1.31-1.266.058-1.646.07-4.849.07-3.203 0-3.583-.012-4.849-.07-1.366-.062-2.633-.336-3.608-1.31-.974-.974-1.248-2.242-1.31-3.608-.058-1.266-.07-1.646-.07-4.849 0-3.203.012-3.583.07-4.849.062-1.366.336-2.633 1.31-3.608.974-.974 1.248-2.242 1.31-3.608.058-1.266.07-1.646.07-4.849 0-3.203.012-3.583.07-4.849z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 mb-6">Product</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 hover:text-blue-600 transition-colors">Features</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-blue-600 transition-colors">Pricing</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-blue-600 transition-colors">Roadmap</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 mb-6">Company</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 hover:text-blue-600 transition-colors">About Us</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-blue-600 transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-blue-600 transition-colors">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-200 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-400 text-sm">© 2024 QuickBook SAAS. All rights reserved.</p>
                <p class="text-slate-400 text-sm">Made with ❤️ for entrepreneurs.</p>
            </div>
        </div>
    </footer>

</body>
</html>
