<div>
    <!-- SUCCESS FLASH -->
    @if($successMessage)
        <div x-data x-init="setTimeout(() => $el.remove(), 3000)" class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ $successMessage }}</span>
        </div>
    @endif

    <!-- TOOLBAR -->
    @if(!$showForm)
        <div class="flex justify-end mb-6">
            <button wire:click="openCreate" class="bg-amber-400 text-zinc-950 px-4 py-2 rounded-xl font-medium hover:bg-amber-300 transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Service
            </button>
        </div>
    @endif

    <!-- CREATE/EDIT FORM -->
    @if($showForm)
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 mb-8 animate-[fadeSlideUp_0.2s_ease-out]">
            <h3 class="text-xl font-bold text-zinc-100 font-heading mb-6">
                {{ $isEditing ? 'Edit Service' : 'New Service' }}
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                <!-- Service Name -->
                <div class="sm:col-span-2">
                    <label class="block uppercase tracking-wider text-xs font-medium text-zinc-400 mb-1.5">Service Name</label>
                    <input type="text" wire:model.live="service_name" placeholder="e.g. Premium Haircut"
                        class="w-full bg-zinc-800 border @error('service_name') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-zinc-700 focus:border-amber-400 focus:ring-amber-400 @enderror text-zinc-100 rounded-xl py-2 px-3">
                    @error('service_name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Price -->
                <div>
                    <label class="block uppercase tracking-wider text-xs font-medium text-zinc-400 mb-1.5">Price ($)</label>
                    <input type="number" step="0.01" wire:model.live="price" placeholder="0.00"
                        class="w-full bg-zinc-800 border @error('price') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-zinc-700 focus:border-amber-400 focus:ring-amber-400 @enderror text-zinc-100 rounded-xl py-2 px-3">
                    @error('price') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label class="block uppercase tracking-wider text-xs font-medium text-zinc-400 mb-1.5">Duration</label>
                    <select wire:model.live="duration"
                        class="w-full bg-zinc-800 border @error('duration') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-zinc-700 focus:border-amber-400 focus:ring-amber-400 @enderror text-zinc-100 rounded-xl py-2 px-3">
                        <option value="">Select duration...</option>
                        <option value="30">30 min</option>
                        <option value="45">45 min</option>
                        <option value="60">1 hour</option>
                        <option value="90">1.5 hours</option>
                        <option value="120">2 hours</option>
                    </select>
                    @error('duration') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div class="sm:col-span-2">
                    <label class="block uppercase tracking-wider text-xs font-medium text-zinc-400 mb-1.5">Description</label>
                    <textarea wire:model.live="description" rows="3" placeholder="Describe the service..."
                        class="w-full bg-zinc-800 border @error('description') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-zinc-700 focus:border-amber-400 focus:ring-amber-400 @enderror text-zinc-100 rounded-xl py-2 px-3"></textarea>
                    @error('description') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end gap-3">
                <button wire:click="cancelForm" class="px-4 py-2 text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800 rounded-xl font-medium transition-colors">
                    Cancel
                </button>
                <button wire:click="save" wire:loading.attr="disabled" wire:loading.class="opacity-70 cursor-not-allowed"
                    class="bg-amber-400 text-zinc-950 px-6 py-2 rounded-xl font-medium hover:bg-amber-300 transition-colors flex items-center gap-2">
                    <span wire:loading.remove wire:target="save">Save</span>
                    <span wire:loading wire:target="save" class="flex items-center gap-2">
                        <div class="animate-spin rounded-full h-4 w-4 border-2 border-zinc-950 border-t-transparent"></div>
                        Saving...
                    </span>
                </button>
            </div>
        </div>
    @endif

    <!-- EMPTY STATE -->
    @if($services->isEmpty() && !$showForm)
        <div class="border-2 border-dashed border-zinc-800 rounded-2xl py-12 flex flex-col items-center justify-center text-center">
            <svg class="h-12 w-12 text-zinc-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <h3 class="text-lg font-medium text-zinc-300 mb-1">No services yet</h3>
            <p class="text-sm text-zinc-500 mb-6">Create your first service to start taking bookings.</p>
            <button wire:click="openCreate" class="bg-amber-400 text-zinc-950 px-4 py-2 rounded-xl font-medium hover:bg-amber-300 transition-colors">
                Add your first service
            </button>
        </div>
    @endif

    <!-- SERVICES LIST -->
    @if($services->isNotEmpty())
        <div class="space-y-4">
            @foreach($services as $service)
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl px-5 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <!-- Left -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1">
                            <h4 class="font-bold text-zinc-100 text-lg">{{ $service->service_name }}</h4>
                            <span class="text-xs font-medium text-zinc-400 bg-zinc-800 px-2 py-0.5 rounded-full">
                                {{ $service->duration }} min
                            </span>
                        </div>
                        <p class="text-zinc-500 text-sm line-clamp-1 mb-2">{{ $service->description }}</p>
                        <div class="text-xs text-zinc-600">
                            {{ $service->appointments()->count() ?? 0 }} bookings
                        </div>
                    </div>

                    <!-- Right -->
                    <div class="flex items-center justify-between sm:justify-end gap-6 sm:w-48">
                        <div class="text-amber-400 font-bold text-lg">${{ number_format($service->price, 2) }}</div>
                        <div class="flex items-center gap-2">
                            <!-- Edit -->
                            <button wire:click="openEdit({{ $service->id }})" class="text-zinc-400 hover:text-amber-400 p-2 rounded-lg hover:bg-zinc-800 transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <!-- Delete -->
                            <button wire:click="delete({{ $service->id }})" wire:confirm="Delete '{{ $service->service_name }}'? Cannot be undone." class="text-zinc-400 hover:text-red-400 p-2 rounded-lg hover:bg-zinc-800 transition-colors" title="Delete">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $services->links('livewire.pagination') }}
        </div>
    @endif

    <style>
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(12px) scale(0.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
    </style>
</div>
