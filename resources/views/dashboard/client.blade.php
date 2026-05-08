<x-app-layout>
    @php
        $isPremium = auth()->user()->plan === 'premium';
        $client_name = auth()->user()->name;
        // Mocking upcoming booking for UI purposes if needed, 
        // but in a real Laravel app we would pass this from a controller.
        // For now, I'll keep the logic I have or use the provided UI structure.
        $upcomingBooking = auth()->user()->appointments()->whereIn('status', ['pending', 'confirmed'])->where('appointment_date', '>=', now()->toDateString())->orderBy('appointment_date')->orderBy('appointment_time')->first();
    @endphp

    <div class="min-h-[calc(100vh-64px)] pb-10">
        <!-- Hero Section -->
        <div class="hero-gradient pt-16 pb-24 border-b border-blue-50/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="flex flex-col lg:flex-row justify-between items-start gap-12">
                    <!-- Left Hero Content -->
                    <div class="lg:w-1/2">
                        <h1 class="text-4xl sm:text-5xl font-extrabold text-blue-900 tracking-tight mb-4 font-syne">
                            Welcome Back,<br>
                            <span class="text-blue-600">{{ $client_name }}</span>
                        </h1>
                        <p class="text-lg text-slate-500 mb-8 font-inter">
                            Book your next digital services
                        </p>

                        <div class="flex gap-4">
                            <a href="#services" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-500/30 flex items-center gap-2">
                                Explore Services
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Right Hero Card -->
                    <div class="lg:w-1/2 flex justify-end">
                        @if ($upcomingBooking)
                            <!-- Upcoming Booking Widget -->
                            <div class="glass-card p-6 rounded-2xl shadow-xl w-full max-w-md transform rotate-1 border border-white/50 relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 -mr-16 -mt-16"></div>
                                
                                <div class="flex justify-between items-center mb-4 relative z-10">
                                    <h3 class="text-xl font-bold text-gray-900">Upcoming Booking</h3>
                                    @if ($isPremium)
                                        <span class="bg-gradient-to-r from-amber-200 to-yellow-400 text-yellow-900 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider shadow-sm">Premium</span>
                                    @endif
                                </div>
                                
                                <div class="bg-blue-50/50 rounded-xl p-4 mb-4 relative z-10">
                                    <span class="text-xs font-semibold text-blue-500 uppercase tracking-wider">Service</span>
                                    <p class="text-lg font-bold text-blue-900 mt-1">{{ $upcomingBooking->service->service_name }}</p>
                                </div>

                                <div class="space-y-2 relative z-10">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-500">Date:</span>
                                        <span class="font-medium text-gray-800">
                                            {{ \Carbon\Carbon::parse($upcomingBooking->appointment_date)->format('l, M j, Y') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-500">Time:</span>
                                        <div class="flex items-center gap-2">
                                            <span class="font-medium text-gray-800">
                                                {{ \Carbon\Carbon::parse($upcomingBooking->appointment_time)->format('g:i A') }}
                                            </span>
                                            <span class="bg-green-100 text-green-600 text-xs px-2 py-0.5 rounded-full font-bold">
                                                {{ ucfirst($upcomingBooking->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif (!$isPremium)
                            <!-- Freemium: Upgrade CTA -->
                            <div class="glass-card p-8 rounded-2xl shadow-xl w-full max-w-md transform rotate-1 border border-white/50 relative overflow-hidden bg-gradient-to-br from-white to-blue-50">
                                <div class="absolute top-0 right-0 w-40 h-40 bg-purple-100 rounded-full mix-blend-multiply filter blur-2xl opacity-50 -mr-20 -mt-20"></div>
                                
                                <div class="relative z-10 text-center">
                                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-600 mb-4">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Upgrade to Premium</h3>
                                    <p class="text-gray-500 mb-6 text-sm">Unlock priority booking, cancellation flexibility, and exclusive features.</p>
                                    
                                    <ul class="text-left space-y-3 mb-8 px-4">
                                        <li class="flex items-center text-sm text-gray-700">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Priority Booking Slots
                                        </li>
                                        <li class="flex items-center text-sm text-gray-700">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Cancel Anytime
                                        </li>
                                        <li class="flex items-center text-sm text-gray-700">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Booking History Access
                                        </li>
                                    </ul>

                                    <a href="{{ route('upgrade') }}" class="block w-full text-center bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                                        Upgrade to Premium
                                    </a>
                                </div>
                            </div>
                        @else
                            <!-- Premium Member Benefits Card (No Upcoming Booking) -->
                            <div class="glass-card p-8 rounded-2xl shadow-xl w-full max-w-md transform rotate-1 border border-amber-100 relative overflow-hidden bg-gradient-to-br from-amber-50 to-white">
                                <div class="absolute top-0 right-0 w-40 h-40 bg-yellow-100 rounded-full mix-blend-multiply filter blur-2xl opacity-50 -mr-20 -mt-20"></div>
                                
                                <div class="relative z-10">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 shadow-sm">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-900">Premium Member</h3>
                                            <p class="text-xs text-amber-600 font-bold uppercase tracking-wider">Active Subscription</p>
                                        </div>
                                    </div>

                                    <div class="space-y-4 mb-6">
                                        <div class="flex items-center p-3 bg-white rounded-xl shadow-sm border border-amber-50">
                                            <div class="p-2 bg-green-100 rounded-lg text-green-600 mr-3">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-800 text-sm">Priority Booking</p>
                                                <p class="text-xs text-gray-500">First access to new slots</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center p-3 bg-white rounded-xl shadow-sm border border-amber-50">
                                            <div class="p-2 bg-blue-100 rounded-lg text-blue-600 mr-3">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-800 text-sm">Flexible Cancellation</p>
                                                <p class="text-xs text-gray-500">Cancel anytime hassle-free</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center">
                                        <a href="#services" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition">
                                            Book your next premium experience &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div id="services" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 font-syne">Explore Services</h2>
            
            @livewire('service-browser')
        </div>
    </div>
</x-app-layout>
