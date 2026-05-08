<div>
    @php
        $upcomingBookings = $appointments->filter(fn($apt) => in_array($apt->status, ['pending', 'confirmed']));
        $completedBookings = $appointments->filter(fn($apt) => $apt->status === 'completed' || ($apt->status !== 'cancelled' && \Carbon\Carbon::parse($apt->appointment_date.' '.$apt->appointment_time)->isPast()));
        $cancelledBookings = $appointments->filter(fn($apt) => $apt->status === 'cancelled');
    @endphp

    <!-- FEEDBACK -->
    @if($successMessage)
        <div x-data x-init="setTimeout(() => $el.remove(), 4000)" class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="block sm:inline">{{ $successMessage }}</span>
        </div>
    @endif

    @if($errorMessage)
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="block sm:inline">{{ $errorMessage }}</span>
        </div>
    @endif

    <div class="space-y-12">
        <!-- 1. Upcoming Bookings -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2 font-syne">
                <span class="w-3 h-3 rounded-full bg-blue-600"></span>
                Upcoming Bookings
            </h2>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                @if ($upcomingBookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-blue-50/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Service</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Business Owner</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date & Time</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($upcomingBookings as $apt)
                                <tr class="hover:bg-blue-50/30 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-bold text-gray-900">{{ $apt->service->service_name ?? 'Unknown' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600 font-medium">{{ $apt->service->user->name ?? 'Owner' }}</div>
                                        <div class="text-xs text-gray-400">{{ $apt->service->user->email ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                                        {{ \Carbon\Carbon::parse($apt->appointment_date)->format('Y-m-d') }}
                                        <span class="text-gray-400 mx-1">at</span>
                                        {{ \Carbon\Carbon::parse($apt->appointment_time)->format('h:i A') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-black rounded-full bg-blue-100 text-blue-700 uppercase tracking-tighter">
                                            {{ ucfirst($apt->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-gray-900">
                                        ${{ number_format($apt->service->price ?? 0, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($apt->status !== 'cancelled' && \Carbon\Carbon::parse($apt->appointment_date.' '.$apt->appointment_time)->isFuture())
                                            <button wire:click="cancel({{ $apt->id }})" wire:confirm="Are you sure you want to cancel this appointment?" class="text-red-500 hover:text-red-700 font-bold text-xs border border-red-200 hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors">
                                                Cancel
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-gray-500 font-medium">
                        No upcoming bookings. <a href="/dashboard" class="text-blue-600 font-bold hover:underline">Book now</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- 2. Completed Bookings -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2 font-syne">
                <span class="w-3 h-3 rounded-full bg-green-500"></span>
                Completed Bookings
            </h2>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden opacity-90">
                @if ($completedBookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Service</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Business Owner</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date & Time</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($completedBookings as $apt)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-bold text-gray-900">{{ $apt->service->service_name ?? 'Unknown' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600 font-medium">{{ $apt->service->user->name ?? 'Owner' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                                        {{ \Carbon\Carbon::parse($apt->appointment_date)->format('Y-m-d') }}
                                        <span class="text-gray-400 mx-1">at</span>
                                        {{ \Carbon\Carbon::parse($apt->appointment_time)->format('h:i A') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-black rounded-full bg-green-100 text-green-700 uppercase tracking-tighter">
                                            Completed
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-gray-900">
                                        ${{ number_format($apt->service->price ?? 0, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <span class="text-green-600 text-xs font-bold flex items-center justify-end gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Done
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-gray-500 font-medium">No completed bookings yet.</div>
                @endif
            </div>
        </div>

        <!-- 3. Cancelled Bookings -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2 font-syne">
                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                Cancelled Bookings
            </h2>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden bg-red-50/10">
                @if ($cancelledBookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-red-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Service</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Business Owner</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Date & Time</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($cancelledBookings as $apt)
                                <tr class="hover:bg-red-50/20 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-bold text-gray-900">{{ $apt->service->service_name ?? 'Unknown' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600 font-medium">{{ $apt->service->user->name ?? 'Owner' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                                        {{ \Carbon\Carbon::parse($apt->appointment_date)->format('Y-m-d') }}
                                        <span class="text-gray-400 mx-1">at</span>
                                        {{ \Carbon\Carbon::parse($apt->appointment_time)->format('h:i A') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-black rounded-full bg-red-100 text-red-700 uppercase tracking-tighter">
                                            Cancelled
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-gray-900">
                                        ${{ number_format($apt->service->price ?? 0, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <span class="text-gray-400 text-xs italic font-bold">Cancelled</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-gray-500 font-medium">No cancelled bookings.</div>
                @endif
            </div>
        </div>
    </div>
</div>
