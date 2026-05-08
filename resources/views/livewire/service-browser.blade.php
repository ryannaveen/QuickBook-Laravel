<div>
    @php
        $isPremium = auth()->user()->plan === 'premium';
    @endphp

    <!-- FEEDBACK (if any) -->
    @if(session('success'))
        <div x-data x-init="setTimeout(() => $el.remove(), 4000)" class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Search & Filter bar (Matching Owner/Client Dashboard Style) -->
    <div class="flex flex-col md:flex-row gap-4 mb-8">
        <div class="relative flex-1 group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search services..." 
                class="w-full pl-12 pr-6 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 shadow-sm transition-all text-lg font-medium">
        </div>
        
        <div class="w-full md:w-48">
            <select wire:model.live="sortBy" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl text-slate-600 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 shadow-sm transition-all font-medium text-lg appearance-none">
                <option value="service_name">Sort: A–Z</option>
                <option value="price">Sort: Price ↑</option>
            </select>
        </div>
    </div>

    <!-- Service cards grid (Matching User's Provided UI) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($services as $service)
            <div class="relative bg-white rounded-[2.5rem] p-6 shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center group overflow-hidden">
                <!-- Avatar -->
                <div class="w-24 h-24 rounded-full bg-blue-50 mb-6 overflow-hidden border-4 border-white shadow-md group-hover:scale-105 transition-transform duration-300 flex items-center justify-center">
                    @if($service->owner && $service->owner->profile_photo_path)
                         <img src="{{ asset('storage/'.$service->owner->profile_photo_path) }}" alt="{{ $service->owner->name }}" class="w-full h-full object-cover">
                    @elseif($service->owner)
                         <img src="https://ui-avatars.com/api/?name={{ urlencode($service->owner->name ?? 'P') }}&background=6366f1&color=fff&size=128" alt="Owner" class="w-full h-full object-cover">
                    @else
                         <img src="https://ui-avatars.com/api/?name=P&background=6366f1&color=fff&size=128" alt="Owner" class="w-full h-full object-cover">
                    @endif
                </div>
                
                <!-- Badge/Icon overlay -->
                <div class="absolute top-6 left-6 flex gap-2">
                    <div class="p-2 bg-blue-50 rounded-2xl text-blue-500 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    
                    @if ($isPremium)
                        @php $isFav = auth()->user()->favourites()->where('service_id', $service->id)->exists(); @endphp
                        <button wire:click="toggleFavourite({{ $service->id }})" class="p-2 bg-white rounded-2xl shadow-sm border border-slate-100 transition-all hover:scale-110 {{ $isFav ? 'text-red-500 fill-current' : 'text-slate-300 hover:text-red-500' }}">
                            <svg class="w-5 h-5" fill="{{ $isFav ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </button>
                    @endif
                </div>

                @if ($service->owner && $service->owner->plan === 'premium')
                    <div class="absolute top-6 right-6">
                        <span class="bg-amber-100 text-amber-700 text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm">Priority</span>
                    </div>
                @endif

                <h3 class="text-xl font-extrabold text-slate-900 mb-2 font-syne line-clamp-1 px-2">{{ $service->service_name }}</h3>
                <p class="text-blue-600 font-black mb-6 font-inter">${{ number_format($service->price, 2) }}<span class="text-sm text-slate-400 font-medium">/session</span></p>

                <button 
                    wire:click="openBooking({{ $service->id }})"
                    class="w-full mt-auto bg-blue-600 text-white rounded-2xl py-4 font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-500/20 transform group-hover:-translate-y-1">
                    Book Now
                </button>
            </div>
        @empty
            <div class="col-span-full text-center py-20 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm">
                <div class="mx-auto w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-300">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 font-syne">No services available</h3>
                <p class="text-slate-500 font-inter">Try adjusting your search or check back later.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $services->links('livewire.pagination') }}
    </div>

    <!-- Booking Modal (Polished) -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center px-4" x-data x-on:keydown.escape.window="$wire.closeModal()">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" wire:click="closeModal"></div>
            
            <div class="relative bg-white rounded-[2.5rem] w-full max-w-md shadow-2xl overflow-hidden animate-[fadeSlideUp_0.3s_ease-out]">
                <button wire:click="closeModal" class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 bg-slate-50 rounded-full p-2 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <div class="bg-blue-50/50 px-10 pt-10 pb-8 border-b border-blue-50">
                    <h3 class="text-2xl font-extrabold text-slate-900 font-syne">Book Service</h3>
                    <p class="text-blue-600 font-bold mt-1 font-inter">{{ $serviceName }}</p>
                </div>

                <div class="px-10 py-8 space-y-6">
                    @if($bookingSuccess)
                        <div class="text-center py-6">
                            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-emerald-100 text-emerald-600 mb-6 shadow-sm">
                                <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <h3 class="text-2xl font-extrabold text-slate-900 font-syne mb-2">Booking Confirmed!</h3>
                            <p class="text-slate-500 font-inter mb-8">
                                Your appointment is set for<br>
                                <strong class="text-slate-900">{{ \Carbon\Carbon::parse($appointmentDate)->format('M d, Y') }}</strong> at <strong class="text-slate-900">{{ \Carbon\Carbon::parse($appointmentTime)->format('h:i A') }}</strong>.
                            </p>
                            <div class="flex flex-col gap-4">
                                <a href="/appointments" class="w-full bg-blue-600 text-white rounded-2xl py-4 font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-500/20">
                                    View My Bookings
                                </a>
                                <button wire:click="closeModal" class="w-full bg-slate-50 text-slate-600 rounded-2xl py-4 font-bold hover:bg-slate-100 transition">
                                    Close
                                </button>
                            </div>
                        </div>
                    @else
                        @if($bookingError)
                            <div class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-2xl text-sm font-medium flex items-start gap-2">
                                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span>{{ $bookingError }}</span>
                            </div>
                        @endif

                        <div class="space-y-6">
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                <p class="text-slate-600 text-sm font-medium leading-relaxed">{{ $serviceDescription ?: 'Professional digital service tailored to your needs.' }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4 font-inter">
                                <div>
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">DATE</label>
                                    <input type="date" wire:model.live="appointmentDate" min="{{ now()->format('Y-m-d') }}"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 font-bold transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">TIME</label>
                                    <input type="time" wire:model.live="appointmentTime"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 font-bold transition-all">
                                </div>
                            </div>

                            <div class="flex items-center justify-between py-4 border-t border-slate-100">
                                <span class="text-slate-500 font-bold">Total Price</span>
                                <span class="text-2xl font-black text-blue-600 font-syne">${{ number_format($servicePrice, 2) }}</span>
                            </div>

                            <button wire:click="book" wire:loading.attr="disabled"
                                class="w-full bg-blue-600 text-white rounded-2xl py-4 font-bold text-lg hover:bg-blue-700 hover:shadow-xl transition-all transform active:scale-95 disabled:opacity-50 flex items-center justify-center gap-2">
                                <span wire:loading.remove wire:target="book">Confirm Booking</span>
                                <span wire:loading wire:target="book" class="flex items-center gap-2">
                                    <div class="animate-spin rounded-full h-5 w-5 border-3 border-white border-t-transparent"></div>
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
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
    </style>
</div>
