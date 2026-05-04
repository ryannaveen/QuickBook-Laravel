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
                    <a href="{{ route('owner.services') ?? '#' }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                        <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Manage Services
                    </a>
                    <a href="#" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg bg-blue-50 text-blue-600 border-r-2 border-blue-500">
                        <svg class="mr-3 h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        View Bookings
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8 max-w-full overflow-hidden">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <h1 class="text-3xl font-bold text-slate-800" style="font-family: 'Syne', sans-serif;">
                    View Bookings - <span class="text-blue-600">October 2024</span>
                </h1>
                
                <div class="flex items-center gap-4 bg-white border border-slate-200 rounded-lg p-1 shadow-sm">
                    <button class="px-4 py-1.5 text-sm font-medium rounded-md bg-blue-50 text-blue-600 shadow-sm">Month</button>
                    <button class="px-4 py-1.5 text-sm font-medium rounded-md text-slate-600 hover:bg-slate-50 transition-colors">Day</button>
                </div>
            </div>

            <!-- Calendar Container -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden flex flex-col h-[700px]">
                
                <!-- Calendar Header -->
                <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
                    <h2 class="text-lg font-bold text-slate-800" style="font-family: 'Syne', sans-serif;">October 2024</h2>
                    <div class="flex items-center gap-2">
                        <button class="p-2 border border-slate-200 rounded-lg hover:bg-white text-slate-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button class="px-4 py-2 border border-slate-200 rounded-lg hover:bg-white text-slate-600 font-medium text-sm transition-colors">
                            Today
                        </button>
                        <button class="p-2 border border-slate-200 rounded-lg hover:bg-white text-slate-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Calendar Grid -->
                <div class="flex-1 flex flex-col">
                    <!-- Days of week -->
                    <div class="grid grid-cols-7 border-b border-slate-200 text-center text-sm font-medium text-slate-500 bg-white">
                        <div class="py-3">Sun</div>
                        <div class="py-3">Mon</div>
                        <div class="py-3">Tue</div>
                        <div class="py-3">Wed</div>
                        <div class="py-3">Thu</div>
                        <div class="py-3">Fri</div>
                        <div class="py-3">Sat</div>
                    </div>

                    <!-- Days Grid -->
                    <!-- Simulating a 5-week month grid -->
                    <div class="grid grid-cols-7 grid-rows-5 flex-1 bg-slate-200 gap-px">
                        
                        <!-- Row 1 -->
                        <div class="bg-white p-2 min-h-[100px] flex flex-col text-slate-400">
                            <span class="text-sm font-medium mb-1">29</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col text-slate-400">
                            <span class="text-sm font-medium mb-1">30</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">1</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">2</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">3</span>
                            <div class="bg-green-100 border border-green-200 text-green-700 text-xs rounded px-2 py-1 truncate mb-1 flex items-center gap-1.5 cursor-pointer hover:bg-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 flex-shrink-0"></span>
                                SEO Cons...
                            </div>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">4</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">5</span>
                        </div>

                        <!-- Row 2 -->
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">6</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">7</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">8</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">9</span>
                            <div class="bg-yellow-100 border border-yellow-200 text-yellow-700 text-xs rounded px-2 py-1 truncate mb-1 flex items-center gap-1.5 cursor-pointer hover:bg-yellow-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 flex-shrink-0"></span>
                                Web Design
                            </div>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">10</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">11</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">12</span>
                        </div>

                        <!-- Row 3 -->
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">13</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">14</span>
                            <div class="bg-green-100 border border-green-200 text-green-700 text-xs rounded px-2 py-1 truncate mb-1 flex items-center gap-1.5 cursor-pointer hover:bg-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 flex-shrink-0"></span>
                                Content W...
                            </div>
                            <div class="bg-red-100 border border-red-200 text-red-700 text-xs rounded px-2 py-1 truncate mb-1 flex items-center gap-1.5 cursor-pointer hover:bg-red-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 flex-shrink-0"></span>
                                Web Design
                            </div>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">15</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">16</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">17</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col relative">
                            <!-- Today indicator -->
                            <div class="w-7 h-7 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-bold mb-1 shadow-sm mx-auto sm:mx-0">18</div>
                            <div class="bg-green-100 border border-green-200 text-green-700 text-xs rounded px-2 py-1 truncate mb-1 flex items-center gap-1.5 cursor-pointer hover:bg-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 flex-shrink-0"></span>
                                Video Edit...
                            </div>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">19</span>
                        </div>

                        <!-- Row 4 -->
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">20</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">21</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">22</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col">
                            <span class="text-sm font-medium text-slate-800 mb-1">23</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col text-slate-400">
                            <span class="text-sm font-medium text-slate-800 mb-1">24</span>
                            <div class="bg-green-100 border border-green-200 text-green-700 text-xs rounded px-2 py-1 truncate mb-1 flex items-center gap-1.5 cursor-pointer hover:bg-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 flex-shrink-0"></span>
                                SEO Cons...
                            </div>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col text-slate-400">
                            <span class="text-sm font-medium text-slate-800 mb-1">25</span>
                            <div class="bg-yellow-100 border border-yellow-200 text-yellow-700 text-xs rounded px-2 py-1 truncate mb-1 flex items-center gap-1.5 cursor-pointer hover:bg-yellow-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 flex-shrink-0"></span>
                                Web Design
                            </div>
                            <div class="bg-red-100 border border-red-200 text-red-700 text-xs rounded px-2 py-1 truncate mb-1 flex items-center gap-1.5 cursor-pointer hover:bg-red-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 flex-shrink-0"></span>
                                Video Edit...
                            </div>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col text-slate-400">
                            <span class="text-sm font-medium text-slate-800 mb-1">26</span>
                        </div>

                        <!-- Row 5 -->
                        <div class="bg-white p-2 min-h-[100px] flex flex-col text-slate-400">
                            <span class="text-sm font-medium text-slate-800 mb-1">27</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col text-slate-400">
                            <span class="text-sm font-medium text-slate-800 mb-1">28</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col text-slate-400">
                            <span class="text-sm font-medium text-slate-800 mb-1">29</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col text-slate-400">
                            <span class="text-sm font-medium text-slate-800 mb-1">30</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col text-slate-400">
                            <span class="text-sm font-medium text-slate-800 mb-1">31</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col text-slate-400">
                            <span class="text-sm font-medium mb-1">1</span>
                        </div>
                        <div class="bg-white p-2 min-h-[100px] flex flex-col text-slate-400">
                            <span class="text-sm font-medium mb-1">2</span>
                        </div>

                    </div>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>
