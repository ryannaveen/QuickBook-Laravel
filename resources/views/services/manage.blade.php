<x-app-layout>
    @php
        $owner_name = auth()->user()->name;
        $isPremium = auth()->user()->plan === 'premium';
        $services = auth()->user()->services;
    @endphp

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Flash Messages -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="fixed top-24 right-4 bg-green-50 text-green-700 px-6 py-4 rounded-xl shadow-lg border border-green-100 flex items-center gap-3 z-50 animate-fade-in-down">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        
        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="fixed top-24 right-4 bg-red-50 text-red-700 px-6 py-4 rounded-xl shadow-lg border border-red-100 flex items-center gap-3 z-50 animate-fade-in-down">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-end md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight font-syne">Manage Services</h1>
                <p class="text-slate-500 mt-2 font-inter font-medium">Manage your offerings and pricing</p>
            </div>
             <button onclick="openModal('add')" class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-300 bg-blue-600 rounded-2xl hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 shadow-lg shadow-blue-500/30 transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-3 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add New Service
            </button>
        </div>

        <!-- Services List Card -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
            <div class="px-10 py-8 border-b border-slate-50 flex flex-col md:flex-row justify-between items-center gap-4 bg-white/50 backdrop-blur-sm sticky top-0 z-10">
                <h3 class="text-xl font-bold text-slate-900 font-syne">Your Services</h3>
                <div class="flex items-center gap-2">
                    <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-xs font-black uppercase tracking-widest border border-blue-100">
                        {{ $services->count() }} Total
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50/30 text-left">
                            <th class="px-10 py-5 text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Service Name</th>
                            <th class="px-10 py-5 text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Price</th>
                            <th class="px-10 py-5 text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Description</th>
                            <th class="px-10 py-5 text-right text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($services as $svc)
                        <tr class="group hover:bg-blue-50/20 transition-colors duration-150">
                            <td class="px-10 py-6">
                                <div class="flex items-center">
                                    <span class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors text-lg">{{ $svc->service_name }}</span>
                                </div>
                            </td>
                            <td class="px-10 py-6">
                                <span class="text-slate-900 font-black whitespace-nowrap text-lg">
                                    ${{ number_format($svc->price, 2) }}<span class="text-xs text-slate-400 font-bold ml-1 uppercase tracking-tighter">/session</span>
                                </span>
                            </td>
                            <td class="px-10 py-6">
                                <p class="text-sm text-slate-500 font-medium line-clamp-1 max-w-xs">{{ $svc->description ?? 'No description provided.' }}</p>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0">
                                    <button onclick="openModal('edit', {{ $svc->toJson() }})" class="p-3 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-2xl transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <!-- Use Laravel delete route if available, or keep it generic for now -->
                                    <form action="#" method="POST" class="inline-block" onsubmit="return confirm('Delete this service?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-3 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-2xl transition-all" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-10 py-24 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-200">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    </div>
                                    <p class="text-slate-500 font-bold text-xl font-syne">No services added yet</p>
                                    <button onclick="openModal('add')" class="mt-4 text-blue-600 hover:text-blue-700 text-sm font-black uppercase tracking-widest hover:underline">Add your first service</button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="serviceModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-sm" aria-hidden="true" onclick="closeModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block align-bottom bg-white rounded-[2.5rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full p-2">
                <div class="bg-white px-8 pt-10 pb-6">
                    <h3 class="text-2xl font-black text-slate-900 font-syne" id="modal-title">Add New Service</h3>
                    <p class="text-slate-500 mt-2 font-medium">Fill in the details for your new service listing.</p>
                </div>
                <!-- Update this form action to point to your controller store/update methods -->
                <form id="serviceForm" action="{{ route('owner.services') }}" method="POST" class="px-8 pb-10">
                    @csrf
                    <input type="hidden" id="method_field" name="_method" value="POST">
                    <input type="hidden" id="service_id" name="service_id" value="">

                    <div class="space-y-6">
                        <div>
                            <label for="service_name" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Service Name</label>
                            <input type="text" name="service_name" id="service_name" required placeholder="e.g. 1-on-1 Math Tutoring" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:bg-white transition-all text-slate-800 font-bold text-lg">
                        </div>
                        <div>
                            <label for="price" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Price ($)</label>
                            <input type="number" step="0.01" name="price" id="price" required placeholder="0.00" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:bg-white transition-all text-slate-800 font-bold text-lg">
                        </div>
                        <div>
                            <label for="description" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Description</label>
                            <textarea name="description" id="description" rows="3" placeholder="Briefly describe what this service entails..." class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:bg-white transition-all text-slate-800 font-medium"></textarea>
                        </div>
                    </div>

                    <div class="mt-10 flex gap-4">
                         <button type="button" onclick="closeModal()" class="flex-1 px-6 py-4 bg-slate-100 text-slate-600 font-black uppercase tracking-widest rounded-2xl hover:bg-slate-200 transition-all">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 px-6 py-4 bg-blue-600 text-white font-black uppercase tracking-widest rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/30">
                            Save Service
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        const modal = document.getElementById('serviceModal');
        const title = document.getElementById('modal-title');
        const form = document.getElementById('serviceForm');
        const methodField = document.getElementById('method_field');
        const idInput = document.getElementById('service_id');
        const nameInput = document.getElementById('service_name');
        const priceInput = document.getElementById('price');
        const descInput = document.getElementById('description');

        function openModal(mode, service = null) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            if (mode === 'edit' && service) {
                title.textContent = 'Edit Service';
                // Assuming you have an update route like /owner/services/{id}
                form.action = `/owner/services/${service.id}`;
                methodField.value = 'PUT';
                idInput.value = service.id;
                nameInput.value = service.service_name;
                priceInput.value = service.price;
                descInput.value = service.description || '';
            } else {
                title.textContent = 'Add New Service';
                form.action = "{{ route('owner.services') }}";
                methodField.value = 'POST';
                idInput.value = '';
                nameInput.value = '';
                priceInput.value = '';
                descInput.value = '';
            }
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Auto-open if query param exists
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('open_add')) {
            openModal('add');
        }
    </script>
</x-app-layout>
