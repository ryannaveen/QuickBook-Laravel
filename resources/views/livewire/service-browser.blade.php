<div>
    <!-- SECTION A — Search bar -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search services..." class="w-full bg-zinc-900 border border-zinc-800 text-zinc-100 rounded-xl pl-10 pr-10 py-2 focus:ring-amber-400 focus:border-amber-400">
            <div wire:loading wire:target="search" class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <div class="animate-spin rounded-full h-4 w-4 border-2 border-zinc-600 border-t-amber-400"></div>
            </div>
        </div>
        <div class="w-full sm:w-48">
            <select wire:model.live="sortBy" class="w-full bg-zinc-900 border border-zinc-800 text-zinc-100 rounded-xl py-2 pl-3 pr-10 focus:ring-amber-400 focus:border-amber-400">
                <option value="service_name">Sort: A–Z</option>
                <option value="price">Sort: Price ↑</option>
            </select>
        </div>
    </div>

    <!-- SECTION B — Skeleton loader -->
    <div wire:loading wire:target="search, sortBy" class="w-full">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @for ($i = 0; $i < 6; $i++)
                <div class="animate-pulse bg-zinc-900 border border-zinc-800 rounded-2xl p-5 flex flex-col justify-between h-40">
                    <div>
                        <div class="h-4 bg-zinc-800 rounded w-3/4 mb-3"></div>
                        <div class="h-3 bg-zinc-800 rounded w-full mb-2"></div>
                        <div class="h-3 bg-zinc-800 rounded w-5/6 mb-4"></div>
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-zinc-800"></div>
                            <div class="h-3 bg-zinc-800 rounded w-1/3"></div>
                        </div>
                    </div>
                    <div class="flex justify-between items-end mt-4">
                        <div class="h-5 bg-zinc-800 rounded w-16"></div>
                        <div class="h-8 bg-zinc-800 rounded w-24"></div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- SECTION C — Service cards -->
    <div wire:loading.remove wire:target="search, sortBy">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($services as $service)
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-5 flex flex-col justify-between h-full">
                    <div>
                        <h3 class="font-bold text-zinc-100 text-lg mb-1">{{ $service->service_name }}</h3>
                        <p class="text-zinc-500 text-xs line-clamp-2 mb-4">{{ $service->description }}</p>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-6 h-6 rounded-full bg-amber-400/20 text-amber-400 flex items-center justify-center text-xs font-bold uppercase">
                                {{ substr($service->user->name ?? '?', 0, 1) }}
                            </div>
                            <span class="text-zinc-500 text-xs">{{ $service->user->name ?? 'Unknown Provider' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-auto pt-4">
                        <div class="text-amber-400 font-bold">${{ number_format($service->price, 2) }}</div>
                        <button wire:click="openBooking({{ $service->id }})" class="bg-zinc-800 text-zinc-100 px-4 py-2 rounded-lg text-sm font-medium hover:bg-amber-400 hover:text-zinc-950 transition-colors">
                            Book Now
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 flex flex-col items-center justify-center text-center">
                    <svg class="h-12 w-12 text-zinc-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <h3 class="text-lg font-medium text-zinc-300">No services found</h3>
                    <p class="mt-1 text-sm text-zinc-500">Try adjusting your search terms.</p>
                </div>
            @endforelse
        </div>

        <!-- SECTION D — Pagination -->
        <div class="mt-6">
            {{ $services->links('livewire.pagination') }}
        </div>
    </div>

    <!-- SECTION E — Booking Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0" x-data x-on:keydown.escape.window="$wire.closeModal()">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-zinc-950/80 backdrop-blur-sm" wire:click="closeModal"></div>
            
            <!-- Panel -->
            <div class="relative bg-zinc-900 border border-zinc-800 rounded-2xl max-w-md w-full shadow-2xl animate-[fadeSlideUp_0.2s_ease-out] overflow-hidden flex flex-col max-h-full">
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-800">
                    <div>
                        <h2 class="text-lg font-bold text-zinc-100 font-heading">Book Appointment</h2>
                        <p class="text-sm text-zinc-400">{{ $serviceName }}</p>
                    </div>
                    <button wire:click="closeModal" class="text-zinc-500 hover:text-zinc-300 p-1 rounded-md hover:bg-zinc-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 overflow-y-auto">
                    <!-- Price summary row -->
                    <div class="bg-zinc-800/50 rounded-xl px-4 py-3 mb-6 flex justify-between items-center border border-zinc-800">
                        <span class="text-zinc-400 text-sm">Service Price</span>
                        <span class="text-amber-400 font-bold">${{ number_format($servicePrice, 2) }}</span>
                    </div>

                    @if($bookingSuccess)
                        <!-- SUCCESS STATE -->
                        <div class="text-center py-6">
                            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-500/10 mb-4">
                                <svg class="h-8 w-8 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-zinc-100 font-heading mb-2">Booking Confirmed!</h3>
                            <p class="text-zinc-400 text-sm mb-6">
                                Your appointment is set for<br>
                                <strong class="text-zinc-200">{{ \Carbon\Carbon::parse($appointmentDate)->format('M d, Y') }}</strong> at <strong class="text-zinc-200">{{ \Carbon\Carbon::parse($appointmentTime)->format('h:i A') }}</strong>.
                            </p>
                            <div class="flex flex-col gap-3">
                                <a href="/appointments" class="w-full text-center px-4 py-2.5 bg-amber-400 text-zinc-950 rounded-xl font-medium hover:bg-amber-300 transition-colors">
                                    View Bookings
                                </a>
                                <button wire:click="closeModal" class="w-full text-center px-4 py-2.5 bg-zinc-800 text-zinc-300 rounded-xl font-medium hover:bg-zinc-700 hover:text-zinc-100 transition-colors">
                                    Done
                                </button>
                            </div>
                        </div>
                    @else
                        <!-- FORM STATE -->
                        @if($bookingError)
                            <div class="mb-5 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl flex items-start gap-3">
                                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span class="text-sm">{{ $bookingError }}</span>
                            </div>
                        @endif

                        <div class="space-y-4">
                            <!-- Date field -->
                            <div>
                                <label class="block uppercase tracking-wider text-xs font-medium text-zinc-400 mb-1.5">DATE</label>
                                <input type="date" wire:model.live="appointmentDate" min="{{ now()->format('Y-m-d') }}"
                                    class="w-full bg-zinc-900 border @error('appointmentDate') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-zinc-700 focus:border-amber-400 focus:ring-amber-400 @enderror text-zinc-100 rounded-xl py-2 px-3 [color-scheme:dark]">
                                @error('appointmentDate') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Time field -->
                            <div>
                                <label class="block uppercase tracking-wider text-xs font-medium text-zinc-400 mb-1.5">TIME</label>
                                <input type="time" wire:model.live="appointmentTime"
                                    class="w-full bg-zinc-900 border @error('appointmentTime') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-zinc-700 focus:border-amber-400 focus:ring-amber-400 @enderror text-zinc-100 rounded-xl py-2 px-3 [color-scheme:dark]">
                                @error('appointmentTime') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Info line -->
                            <div class="flex items-center gap-2 pt-2">
                                <svg class="w-4 h-4 text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-zinc-600 text-xs">Must book at least 1 hour in advance</span>
                            </div>

                            <!-- Submit button -->
                            <button wire:click="book" wire:loading.attr="disabled" wire:loading.class="opacity-70 cursor-not-allowed"
                                class="w-full mt-6 bg-amber-400 text-zinc-950 px-4 py-3 rounded-xl font-medium hover:bg-amber-300 transition-colors flex items-center justify-center gap-2">
                                <span wire:loading.remove wire:target="book">Confirm Booking</span>
                                <span wire:loading wire:target="book" class="flex items-center gap-2">
                                    <div class="animate-spin rounded-full h-4 w-4 border-2 border-zinc-950 border-t-transparent"></div>
                                    Processing...
                                </span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <style>
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(12px) scale(0.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
    </style>
</div>
