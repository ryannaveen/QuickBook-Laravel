<x-app-layout>
    <div class="flex min-h-screen bg-slate-50">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-slate-200 hidden md:block">
            <div class="h-full flex flex-col pt-5 pb-4 overflow-y-auto">
                <nav class="mt-5 flex-1 px-4 space-y-2">
                    <a href="#" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg bg-blue-50 text-blue-600 border-r-2 border-blue-500">
                        <svg class="mr-3 h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="#" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                        <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800" style="font-family: 'Syne', sans-serif;">
                        Welcome Back, {{ auth()->user()->name ?? 'Owner' }}
                    </h1>
                    <p class="text-slate-500 mt-1">See your schedule ahead</p>
                </div>
                <button class="border border-blue-500 text-blue-500 hover:bg-blue-50 font-medium px-4 py-2 rounded-lg transition-colors whitespace-nowrap">
                    + Add New Service
                </button>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 mb-8">
                <!-- Search and Filter -->
                <div class="flex-1 flex gap-4">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Search appointments..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-slate-800 bg-white shadow-sm">
                    </div>
                    <div class="w-48">
                        <select class="w-full border border-slate-200 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 text-slate-800 bg-white shadow-sm appearance-none">
                            <option value="">All Categories</option>
                            <option value="consulting">Consulting</option>
                            <option value="design">Design</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Revenue -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-sm font-medium text-slate-500 mb-1">Revenue Overview</h3>
                    <div class="text-3xl font-bold text-slate-800 mb-4">$1,300</div>
                    <div class="h-10 w-full flex items-end gap-1">
                        <!-- Line chart placeholder bars -->
                        <div class="w-1/6 bg-blue-100 rounded-t h-1/3"></div>
                        <div class="w-1/6 bg-blue-200 rounded-t h-1/2"></div>
                        <div class="w-1/6 bg-blue-300 rounded-t h-2/3"></div>
                        <div class="w-1/6 bg-blue-400 rounded-t h-full"></div>
                        <div class="w-1/6 bg-blue-500 rounded-t h-4/5"></div>
                        <div class="w-1/6 bg-blue-600 rounded-t h-full"></div>
                    </div>
                </div>

                <!-- Total Services -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <div class="flex justify-between items-start mb-1">
                        <h3 class="text-sm font-medium text-slate-500">Total Services</h3>
                        <span class="bg-green-100 text-green-700 rounded-full px-2.5 py-0.5 text-xs font-bold">Confirmed</span>
                    </div>
                    <div class="text-3xl font-bold text-slate-800 mb-4">12</div>
                    <p class="text-sm text-slate-500 border-t border-slate-100 pt-3">4 active right now</p>
                </div>

                <!-- Appointments -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-sm font-medium text-slate-500 mb-1">Upcoming Week's Appointments</h3>
                    <div class="text-3xl font-bold text-slate-800 mb-4">24</div>
                    <p class="text-sm text-slate-500 border-t border-slate-100 pt-3 flex items-center gap-1">
                        <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span class="text-green-600 font-medium">+12%</span> vs last week
                    </p>
                </div>
            </div>

            <!-- Recent Appointments Table -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-bold text-slate-800" style="font-family: 'Syne', sans-serif;">Recent Appointments</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-slate-50 text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-3 font-medium">Client</th>
                                <th class="px-6 py-3 font-medium">Date</th>
                                <th class="px-6 py-3 font-medium">Time</th>
                                <th class="px-6 py-3 font-medium">Price</th>
                                <th class="px-6 py-3 font-medium">Status</th>
                                <th class="px-6 py-3 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-800">Sarah Johnson</div>
                                    <div class="text-slate-500 text-xs">SEO Consulting</div>
                                </td>
                                <td class="px-6 py-4 text-slate-600">Oct 24, 2024</td>
                                <td class="px-6 py-4 text-slate-600">10:00 AM</td>
                                <td class="px-6 py-4 font-medium text-slate-800">$75.00</td>
                                <td class="px-6 py-4">
                                    <span class="bg-green-100 text-green-700 rounded-full px-3 py-1 font-medium text-xs">Confirmed</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-blue-500 hover:text-blue-700 font-medium">Edit</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-800">Michael Chen</div>
                                    <div class="text-slate-500 text-xs">Web Design</div>
                                </td>
                                <td class="px-6 py-4 text-slate-600">Oct 25, 2024</td>
                                <td class="px-6 py-4 text-slate-600">2:30 PM</td>
                                <td class="px-6 py-4 font-medium text-slate-800">$120.00</td>
                                <td class="px-6 py-4">
                                    <span class="bg-yellow-100 text-yellow-700 rounded-full px-3 py-1 font-medium text-xs">Pending</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-blue-500 hover:text-blue-700 font-medium">Edit</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-800">Emma Wilson</div>
                                    <div class="text-slate-500 text-xs">Video Editing</div>
                                </td>
                                <td class="px-6 py-4 text-slate-600">Oct 25, 2024</td>
                                <td class="px-6 py-4 text-slate-600">4:00 PM</td>
                                <td class="px-6 py-4 font-medium text-slate-800">$90.00</td>
                                <td class="px-6 py-4">
                                    <span class="bg-red-100 text-red-700 rounded-full px-3 py-1 font-medium text-xs">Cancelled</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-blue-500 hover:text-blue-700 font-medium">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>
