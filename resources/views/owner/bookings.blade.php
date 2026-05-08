<x-app-layout>
    @php
        $owner_id = auth()->id();
        $isPremium = auth()->user()->plan === 'premium';
        
        $year = request('year', date('Y'));
        $month = request('month', date('m'));

        $date = \Carbon\Carbon::createFromDate($year, $month, 1);
        $monthName = $date->format('F');
        
        $prevMonthDate = $date->copy()->subMonth();
        $nextMonthDate = $date->copy()->addMonth();
        
        $daysInMonth = $date->daysInMonth;
        $firstDayOfWeek = $date->dayOfWeek; // 0 (Sun) to 6 (Sat)
        
        // Fetch appointments for this month
        $appointments = auth()->user()->services()
            ->with(['appointments' => function($q) use ($year, $month) {
                $q->whereYear('appointment_date', $year)
                  ->whereMonth('appointment_date', $month)
                  ->with('user');
            }])
            ->get()
            ->pluck('appointments')
            ->flatten();

        $calendarEvents = $appointments->groupBy(function($appt) {
            return (int) \Carbon\Carbon::parse($appt->appointment_date)->format('j');
        });
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- Calendar Container -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
            
            <!-- Calendar Header -->
            <div class="px-10 py-8 flex flex-col md:flex-row justify-between items-center gap-6 border-b border-slate-50">
                
                <!-- Title & Nav -->
                <div class="flex items-center gap-6">
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight font-syne">
                        {{ $monthName }} {{ $year }}
                    </h2>
                    <div class="flex items-center gap-2">
                         <a href="?month={{ $prevMonthDate->month }}&year={{ $prevMonthDate->year }}" class="p-3 bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-2xl transition-all shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </a>
                        <a href="?month={{ now()->month }}&year={{ now()->year }}" class="px-6 py-3 bg-white border border-slate-100 text-slate-600 font-bold text-sm rounded-2xl hover:bg-slate-50 transition-all shadow-sm">
                            Today
                        </a>
                        <a href="?month={{ $nextMonthDate->month }}&year={{ $nextMonthDate->year }}" class="p-3 bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-2xl transition-all shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @if ($isPremium)
                        <button onclick="document.getElementById('blockModal').classList.remove('hidden')" class="bg-red-50 text-red-600 px-6 py-3 rounded-2xl font-black uppercase tracking-widest border border-red-100 hover:bg-red-100 transition-all flex items-center gap-2 text-xs shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                            Block Date
                        </button>
                    @endif

                    <div class="hidden sm:flex bg-slate-50 p-1.5 rounded-2xl border border-slate-100 shadow-inner">
                        <button class="px-6 py-2 bg-white shadow-md text-slate-900 text-xs font-black uppercase tracking-widest rounded-xl">Month</button>
                        <button class="px-6 py-2 text-slate-400 text-xs font-black uppercase tracking-widest hover:text-slate-900 transition-colors">Day</button>
                    </div>
                </div>
            </div>

            <!-- Calendar Grid Header -->
            <div class="grid grid-cols-7 border-b border-slate-50 bg-slate-50/30">
                @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                    <div class="py-4 text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                        {{ $day }}
                    </div>
                @endforeach
            </div>

            <!-- Calendar Grid Body -->
            <div class="grid grid-cols-7 bg-white">
                @php
                    // Empty cells at start
                    for ($i = 0; $i < $firstDayOfWeek; $i++) {
                        echo '<div class="h-40 border-b border-r border-slate-50 bg-slate-50/10"></div>';
                    }

                    // Days
                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        $isToday = ($day == date('j') && $month == date('m') && $year == date('Y'));
                        $cellClass = "h-40 border-b border-r border-slate-50 p-3 relative group hover:bg-blue-50/20 transition-all flex flex-col gap-2";
                        
                        echo "<div class='$cellClass'>";
                        
                        // Day Number
                        $numClass = "text-sm font-black w-8 h-8 flex items-center justify-center rounded-full transition-all " . ($isToday ? "bg-blue-600 text-white shadow-lg shadow-blue-200 scale-110" : "text-slate-400 group-hover:text-blue-600");
                        echo "<span class='$numClass'>$day</span>";

                        // Events
                        if (isset($calendarEvents[$day])) {
                            echo '<div class="flex flex-col gap-1.5 overflow-y-auto mt-1 pr-1 custom-scrollbar">';
                            foreach ($calendarEvents[$day] as $event) {
                                $colorClass = "bg-blue-50 text-blue-700 border-blue-100"; 
                                if ($event->status === 'pending') $colorClass = "bg-amber-50 text-amber-700 border-amber-100";
                                if ($event->status === 'cancelled') $colorClass = "bg-red-50 text-red-700 border-red-100";
                                if ($event->status === 'completed') $colorClass = "bg-green-50 text-green-700 border-green-100";
                                
                                $clientName = $event->user->name ?? 'Guest';
                                $serviceName = $event->service->service_name ?? 'Service';

                                echo "<div class='text-[10px] px-2.5 py-1.5 rounded-xl border font-bold truncate $colorClass shadow-sm cursor-pointer hover:scale-[1.02] transition-transform' title='$clientName - $serviceName'>";
                                echo strtoupper($clientName);
                                echo "</div>";
                            }
                            echo '</div>';
                        }

                        echo "</div>";
                    }

                    // Fill remaining cells
                    $totalCells = $firstDayOfWeek + $daysInMonth;
                    $remainingCells = 7 - ($totalCells % 7);
                    if ($remainingCells < 7) {
                         for ($i = 0; $i < $remainingCells; $i++) {
                            echo '<div class="h-40 border-b border-r border-slate-50 bg-slate-50/10"></div>';
                        }
                    }
                @endphp
            </div>

        </div>

    </div>

    <!-- Block Date Modal -->
    <div id="blockModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-md w-full p-10 m-4 transform transition-all">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-black text-slate-900 font-syne">Block Schedule</h3>
                <button type="button" onclick="document.getElementById('blockModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form action="#" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Select Date</label>
                    <input type="date" name="block_date" required class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:bg-white transition-all text-slate-800 font-bold">
                </div>

                <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <input type="checkbox" id="is_full_day" name="is_full_day" value="1" checked onchange="toggleTimeInputs(this)" class="rounded-lg text-blue-600 focus:ring-blue-500 w-5 h-5 border-slate-300">
                    <label for="is_full_day" class="text-sm font-bold text-slate-600">Block Full Day</label>
                </div>

                <div id="timeInputs" class="grid grid-cols-2 gap-4 hidden">
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Start Time</label>
                        <input type="time" name="start_time" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-blue-500/10 text-slate-800 font-bold">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">End Time</label>
                        <input type="time" name="end_time" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-blue-500/10 text-slate-800 font-bold">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Reason (Optional)</label>
                    <input type="text" name="reason" placeholder="e.g. Personal Leave, Holiday" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-blue-500/10 text-slate-800 font-bold">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-red-600 text-white font-black uppercase tracking-widest py-5 rounded-2xl hover:bg-red-700 transition-all shadow-xl shadow-red-200 transform hover:-translate-y-1">
                        Confirm Block
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleTimeInputs(checkbox) {
            const timeInputs = document.getElementById('timeInputs');
            if (checkbox.checked) {
                timeInputs.classList.add('hidden');
            } else {
                timeInputs.classList.remove('hidden');
            }
        }
    </script>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
    </style>
</x-app-layout>
