<x-app-layout>
    @php
        $owner_name = auth()->user()->name;
        $isPremium = auth()->user()->plan === 'premium';
        // Mock data for UI purposes as per instruction to change UI
        $appointmentsNextWeek = 0; // This should ideally come from controller
        $totalServices = auth()->user()->services()->count();
        
        // Fetch appointments for the owner
        $allAppointments = auth()->user()->services()->with('appointments.user')->get()->pluck('appointments')->flatten();
        
        $upcomingAppointments = $allAppointments->filter(fn($a) => in_array($a->status, ['pending', 'confirmed']))->sortByDesc('appointment_date');
        $completedAppointments = $allAppointments->filter(fn($a) => $a->status === 'completed')->sortByDesc('appointment_date');
        $cancelledAppointments = $allAppointments->filter(fn($a) => $a->status === 'cancelled')->sortByDesc('appointment_date');
    @endphp

    <div class="min-h-[calc(100vh-64px)] pb-10">
        <!-- Hero Section -->
        <div class="hero-gradient pt-16 pb-24 border-b border-blue-50/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                
                <!-- Alerts (Laravel style) -->
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2 shadow-sm" role="alert">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                
                <div class="flex flex-col lg:flex-row justify-between items-start gap-12">
                    <!-- Left Hero Content -->
                    <div class="lg:w-1/2">
                        <h1 class="text-4xl sm:text-5xl font-extrabold text-blue-900 tracking-tight mb-4 font-syne">
                            Welcome Back,<br>
                            <span class="text-blue-600">{{ $owner_name }}</span>
                        </h1>
                        <p class="text-lg text-slate-500 mb-8 font-inter">
                            View Your Appointments <span class="text-xs ml-2 px-2 py-1 bg-gray-100 rounded-md text-gray-400 font-mono">Server Time: {{ now()->format('d M Y, h:i A') }}</span>
                        </p>

                        <div class="space-y-4 max-w-md">
                             <div class="relative">
                                <a href="{{ route('owner.services', ['open_add' => 1]) }}" class="w-full pl-4 pr-10 py-4 bg-white border-none shadow-sm rounded-2xl flex items-center justify-between text-blue-600 font-bold cursor-pointer hover:bg-blue-50 transition hover:shadow-md">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-blue-100 rounded-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        </div>
                                        <span>Add New Service</span>
                                    </div>
                                    <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Stats Cards -->
                    <div class="lg:w-1/2 flex flex-col gap-6">
                         <!-- Upcoming Week's Appointments Card -->
                         <div class="bg-white p-8 rounded-[2.5rem] shadow-xl w-full max-w-md border border-slate-100 relative overflow-hidden flex justify-between items-center text-blue-900 group hover:shadow-2xl transition-all duration-300">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                            <div class="relative z-10">
                                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-2">Upcoming Appointments</h3>
                                <div class="text-5xl font-black font-syne">{{ $upcomingAppointments->count() }}</div>
                                <div class="mt-4 inline-flex items-center px-3 py-1 bg-green-50 text-green-600 text-xs font-bold rounded-full border border-green-100">
                                    Next 7 Days
                                </div>
                            </div>
                            <div class="relative z-10 p-4 bg-blue-600 rounded-3xl text-white shadow-lg shadow-blue-200">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                         </div>

                         <!-- Total Services Card -->
                          <div class="bg-white p-8 rounded-[2.5rem] shadow-xl w-full max-w-md border border-slate-100 flex justify-between items-center group hover:shadow-2xl transition-all duration-300">
                                <div>
                                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-2">Total Services</h3>
                                    <div class="text-4xl font-black text-slate-900 font-syne">{{ $totalServices }}</div>
                                     <div class="mt-4 inline-flex items-center px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-full border border-blue-100">
                                        Active Offerings
                                    </div>
                                </div>
                                <div class="p-4 bg-slate-900 rounded-3xl text-white shadow-lg shadow-slate-200 transition-transform group-hover:rotate-12">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointments Sections -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-10 space-y-12">
            
            <!-- 1. Upcoming Appointments -->
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3 font-syne">
                    <span class="w-4 h-4 rounded-full bg-blue-600 shadow-lg shadow-blue-200"></span>
                    Upcoming Appointments
                </h2>
                <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-100">
                            <thead class="bg-blue-50/50">
                                <tr class="text-left text-xs font-black text-slate-400 uppercase tracking-[0.2em]">
                                    <th class="px-8 py-6">Client</th>
                                    <th class="px-8 py-6">Date</th>
                                    <th class="px-8 py-6">Time</th>
                                    <th class="px-8 py-6">Price</th>
                                    <th class="px-8 py-6">Status</th>
                                    <th class="px-8 py-6 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($upcomingAppointments as $appt)
                                    <tr class="hover:bg-blue-50/30 transition-colors group">
                                        <td class="px-8 py-6 whitespace-nowrap text-sm font-bold text-slate-900">{{ $appt->user->name ?? 'Guest' }}</td>
                                        <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-500 font-medium">{{ \Carbon\Carbon::parse($appt->appointment_date)->format('d M Y') }}</td>
                                        <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-500 font-medium">{{ \Carbon\Carbon::parse($appt->appointment_time)->format('h:i A') }}</td>
                                        <td class="px-8 py-6 whitespace-nowrap text-sm font-black text-slate-900">${{ number_format($appt->service->price, 2) }}</td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-blue-100">
                                                {{ $appt->status }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap text-right">
                                            <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <form action="{{ route('appointments.cancel', $appt) }}" method="POST" onsubmit="return confirm('Cancel this appointment?');">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-amber-600 hover:text-amber-700 font-bold text-xs uppercase tracking-widest px-4 py-2 bg-amber-50 rounded-xl transition-colors">
                                                        Cancel
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="px-8 py-16 text-center text-slate-400 font-medium italic">No upcoming appointments.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 2. Completed & Cancelled Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Completed -->
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3 font-syne">
                        <span class="w-4 h-4 rounded-full bg-green-500 shadow-lg shadow-green-200"></span>
                        Completed
                    </h2>
                    <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50/50 border-b border-slate-100">
                                <tr class="text-xs font-black text-slate-400 uppercase tracking-widest">
                                    <th class="px-6 py-4">Client</th>
                                    <th class="px-6 py-4">Date</th>
                                    <th class="px-6 py-4 text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($completedAppointments->take(5) as $appt)
                                    <tr class="hover:bg-green-50/30 transition-colors">
                                        <td class="px-6 py-4 text-sm font-bold text-slate-700">{{ $appt->user->name ?? 'Guest' }}</td>
                                        <td class="px-6 py-4 text-sm text-slate-400 font-medium">{{ \Carbon\Carbon::parse($appt->appointment_date)->format('d M') }}</td>
                                        <td class="px-6 py-4 text-sm font-black text-slate-900 text-right">${{ number_format($appt->service->price, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="px-6 py-10 text-center text-slate-300 italic">No records.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Cancelled -->
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3 font-syne">
                        <span class="w-4 h-4 rounded-full bg-red-500 shadow-lg shadow-red-200"></span>
                        Cancelled
                    </h2>
                    <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden bg-red-50/10">
                        <table class="w-full text-left">
                            <thead class="bg-red-50/30 border-b border-red-50">
                                <tr class="text-xs font-black text-slate-400 uppercase tracking-widest">
                                    <th class="px-6 py-4 text-red-400">Client</th>
                                    <th class="px-6 py-4 text-red-400">Date</th>
                                    <th class="px-6 py-4 text-right text-red-400">Reason</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-red-50/50">
                                @forelse ($cancelledAppointments->take(5) as $appt)
                                    <tr class="hover:bg-red-50/50 transition-colors">
                                        <td class="px-6 py-4 text-sm font-bold text-slate-700">{{ $appt->user->name ?? 'Guest' }}</td>
                                        <td class="px-6 py-4 text-sm text-slate-400 font-medium">{{ \Carbon\Carbon::parse($appt->appointment_date)->format('d M') }}</td>
                                        <td class="px-6 py-4 text-xs font-bold text-red-400 text-right">Cancelled</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="px-6 py-10 text-center text-slate-300 italic">No records.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
