<x-app-layout>
    <div class="flex min-h-screen bg-slate-50">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-slate-200 hidden md:block">
            <div class="h-full flex flex-col pt-5 pb-4 overflow-y-auto">
                <nav class="mt-5 flex-1 px-4 space-y-2">
                    <a href="{{ route('dashboard') ?? '#' }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                        <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('owner.services') ?? '#' }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg bg-blue-50 text-blue-600 border-r-2 border-blue-500">
                        <svg class="mr-3 h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Manage Services
                    </a>
                    <a href="#" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                        <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        View Bookings
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-slate-800 mb-8" style="font-family: 'Syne', sans-serif;">
                Welcome Back, {{ auth()->user()->name ?? 'Owner' }}
            </h1>

            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-8">
                <!-- Search -->
                <div class="relative w-full lg:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Search appointments or services..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-slate-800 bg-white shadow-sm">
                </div>

                <div class="flex items-center gap-4 w-full lg:w-auto">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-lg transition-colors whitespace-nowrap shadow-sm">
                        + Add New Service
                    </button>
                    <div class="bg-white border border-slate-200 text-slate-700 font-medium px-4 py-2 rounded-lg shadow-sm whitespace-nowrap">
                        Pending Appointments: <span class="text-blue-600 font-bold">12</span>
                    </div>
                </div>
            </div>

            <!-- Filters Row -->
            <div class="flex items-center gap-4 mb-6">
                <select class="w-48 border border-slate-200 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 text-slate-800 bg-white shadow-sm appearance-none">
                    <option value="">Filter by Service</option>
                    <option value="seo">SEO Consulting</option>
                    <option value="web">Web Design</option>
                </select>
                <button class="bg-slate-800 hover:bg-slate-900 text-white font-medium px-4 py-2 rounded-lg transition-colors shadow-sm">
                    Confirm
                </button>
            </div>

            <!-- All Appointments Table -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-bold text-slate-800" style="font-family: 'Syne', sans-serif;">All Appointments</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-slate-50 text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-3 font-medium">Service Name</th>
                                <th class="px-6 py-3 font-medium">Client Name</th>
                                <th class="px-6 py-3 font-medium">Date</th>
                                <th class="px-6 py-3 font-medium">Time</th>
                                <th class="px-6 py-3 font-medium">Status</th>
                                <th class="px-6 py-3 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-800">SEO Consulting</td>
                                <td class="px-6 py-4 text-slate-600">Sarah Johnson</td>
                                <td class="px-6 py-4 text-slate-600">Oct 24, 2024</td>
                                <td class="px-6 py-4 text-slate-600">10:00 AM</td>
                                <td class="px-6 py-4">
                                    <span class="bg-green-100 text-green-700 rounded-full px-3 py-1 font-medium text-xs">Confirmed</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="text-blue-500 hover:text-blue-700 font-medium px-3 py-1 rounded hover:bg-blue-50 transition-colors">Edit</button>
                                        <button class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition-colors" title="Delete">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-800">Web Design</td>
                                <td class="px-6 py-4 text-slate-600">Michael Chen</td>
                                <td class="px-6 py-4 text-slate-600">Oct 25, 2024</td>
                                <td class="px-6 py-4 text-slate-600">2:30 PM</td>
                                <td class="px-6 py-4">
                                    <span class="bg-yellow-100 text-yellow-700 rounded-full px-3 py-1 font-medium text-xs">Pending</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="text-blue-500 hover:text-blue-700 font-medium px-3 py-1 rounded hover:bg-blue-50 transition-colors">Edit</button>
                                        <button class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition-colors" title="Delete">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-800">Video Editing</td>
                                <td class="px-6 py-4 text-slate-600">Emma Wilson</td>
                                <td class="px-6 py-4 text-slate-600">Oct 25, 2024</td>
                                <td class="px-6 py-4 text-slate-600">4:00 PM</td>
                                <td class="px-6 py-4">
                                    <span class="bg-red-100 text-red-700 rounded-full px-3 py-1 font-medium text-xs">Cancelled</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="text-blue-500 hover:text-blue-700 font-medium px-3 py-1 rounded hover:bg-blue-50 transition-colors">Edit</button>
                                        <button class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition-colors" title="Delete">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>
