<div>
    <!-- FEEDBACK -->
    @if($successMessage)
        <div x-data x-init="setTimeout(() => $el.remove(), 4000)" class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ $successMessage }}</span>
        </div>
    @endif

    @if($errorMessage)
        <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span class="text-sm font-medium">{{ $errorMessage }}</span>
        </div>
    @endif

    <!-- FILTER TABS -->
    <div class="flex gap-1 p-1 bg-zinc-900 border border-zinc-800 rounded-xl w-fit mb-6 overflow-x-auto max-w-full">
        <button wire:click="$set('filterStatus', 'all')" class="px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap transition-colors {{ $filterStatus === 'all' ? 'bg-zinc-700 text-zinc-100' : 'text-zinc-500 hover:text-zinc-300' }}">All</button>
        <button wire:click="$set('filterStatus', 'pending')" class="px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap transition-colors {{ $filterStatus === 'pending' ? 'bg-zinc-700 text-zinc-100' : 'text-zinc-500 hover:text-zinc-300' }}">Pending</button>
        <button wire:click="$set('filterStatus', 'confirmed')" class="px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap transition-colors {{ $filterStatus === 'confirmed' ? 'bg-zinc-700 text-zinc-100' : 'text-zinc-500 hover:text-zinc-300' }}">Confirmed</button>
        <button wire:click="$set('filterStatus', 'cancelled')" class="px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap transition-colors {{ $filterStatus === 'cancelled' ? 'bg-zinc-700 text-zinc-100' : 'text-zinc-500 hover:text-zinc-300' }}">Cancelled</button>
    </div>

    <!-- SKELETON LOADER -->
    <div wire:loading wire:target="filterStatus, cancel" class="w-full">
        <div class="space-y-4">
            @for ($i = 0; $i < 4; $i++)
                <div class="animate-pulse bg-zinc-900 border border-zinc-800 rounded-xl px-5 py-4 flex flex-col sm:flex-row justify-between gap-4">
                    <div class="space-y-2">
                        <div class="h-5 bg-zinc-800 rounded w-48"></div>
                        <div class="h-3 bg-zinc-800 rounded w-32"></div>
                        <div class="flex gap-4 pt-2">
                            <div class="h-4 bg-zinc-800 rounded w-24"></div>
                            <div class="h-4 bg-zinc-800 rounded w-24"></div>
                        </div>
                    </div>
                    <div class="flex flex-col sm:items-end justify-between gap-2">
                        <div class="h-6 bg-zinc-800 rounded-full w-20"></div>
                        <div class="h-8 bg-zinc-800 rounded-lg w-24"></div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- APPOINTMENTS LIST -->
    <div wire:loading.remove wire:target="filterStatus, cancel">
        <div class="space-y-4">
            @forelse($appointments as $apt)
                @php
                    $dt = \Carbon\Carbon::parse($apt->appointment_date.' '.$apt->appointment_time);
                    $isPast = $dt->isPast();
                    $canCancel = $apt->status !== 'cancelled' && !$isPast && \Carbon\Carbon::now()->diffInMinutes($dt, false) >= 60;
                @endphp
                
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl px-5 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 {{ $apt->status === 'cancelled' ? 'opacity-60' : '' }}">
                    <!-- Left side -->
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <h4 class="font-bold text-zinc-100 text-lg">{{ $apt->service->service_name ?? 'Unknown Service' }}</h4>
                        </div>
                        <p class="text-zinc-500 text-xs mb-3">
                            with {{ auth()->user()->role === 'owner' ? ($apt->user->name ?? 'Client') : ($apt->service->user->name ?? 'Provider') }}
                        </p>
                        <div class="flex items-center gap-4 text-sm text-zinc-400">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($apt->appointment_date)->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($apt->appointment_time)->format('h:i A') }}</span>
                            </div>
                            @if($isPast && $apt->status !== 'cancelled')
                                <span class="text-zinc-500 italic flex items-center gap-1">
                                    <span class="w-1 h-1 rounded-full bg-zinc-500"></span> Completed
                               </span>
                            @endif
                        </div>
                    </div>

                    <!-- Right side -->
                    <div class="flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-3">
                        @if($apt->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-400/10 text-amber-400 border border-amber-400/20">
                                Pending
                            </span>
                        @elseif($apt->status === 'confirmed')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                Confirmed
                            </span>
                        @elseif($apt->status === 'cancelled')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider bg-zinc-800 text-zinc-500 border border-zinc-700">
                                Cancelled
                            </span>
                        @endif

                        @if($canCancel)
                            <button wire:click="cancel({{ $apt->id }})" wire:confirm="Cancel this appointment?" class="text-sm font-medium text-zinc-400 px-3 py-1.5 rounded-lg border border-transparent hover:text-red-400 hover:border-red-400/30 hover:bg-red-400/10 transition-colors">
                                Cancel
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="border-2 border-dashed border-zinc-800 rounded-2xl py-12 flex flex-col items-center justify-center text-center">
                    <svg class="h-12 w-12 text-zinc-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    @if($filterStatus === 'all')
                        <h3 class="text-lg font-medium text-zinc-300 mb-1">No appointments yet</h3>
                        <p class="text-sm text-zinc-500 mb-6">You haven't booked any services yet.</p>
                        <a href="/services" class="bg-amber-400 text-zinc-950 px-4 py-2 rounded-xl font-medium hover:bg-amber-300 transition-colors">
                            Explore Services
                        </a>
                    @else
                        <h3 class="text-lg font-medium text-zinc-300 mb-1">No {{ $filterStatus }} appointments</h3>
                        <p class="text-sm text-zinc-500">You don't have any appointments with this status.</p>
                    @endif
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $appointments->links('livewire.pagination') }}
        </div>
    </div>
</div>
