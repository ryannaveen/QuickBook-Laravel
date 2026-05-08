<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-2 font-syne">Upgrade to Premium</h1>
                <p class="text-lg text-gray-600 font-inter">Unlock exclusive features for better booking experience.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                <!-- Benefits Column -->
                <div class="md:col-span-1 bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 font-syne">Premium Benefits</h3>
                    <ul class="space-y-4 font-inter">
                        <li class="flex items-start text-sm text-gray-600">
                            <svg class="w-5 h-5 text-green-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Priority Booking Slots
                        </li>
                        <li class="flex items-start text-sm text-gray-600">
                            <svg class="w-5 h-5 text-green-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Flexible Cancellations
                        </li>
                        <li class="flex items-start text-sm text-gray-600">
                            <svg class="w-5 h-5 text-green-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Full Booking History
                        </li>
                        <li class="flex items-start text-sm text-gray-600">
                            <svg class="w-5 h-5 text-green-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            No Ads
                        </li>
                    </ul>
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <div class="text-3xl font-bold text-gray-900 font-syne">$15<span class="text-sm font-normal text-gray-500">/mo</span></div>
                    </div>
                </div>

                <!-- Payment Form Column -->
                <div class="md:col-span-2 bg-white rounded-2xl shadow-xl p-8 border border-gray-200 relative overflow-hidden">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-900 font-syne">Payment Details</h2>
                        <p class="text-sm text-gray-500 font-inter">Secure AES-256 Encrypted Connection</p>
                    </div>

                    <form action="#" method="POST" class="space-y-5 font-inter">
                        @csrf
                        <!-- Cardholder Name -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Cardholder Name</label>
                            <input type="text" name="card_name" placeholder="John Doe" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none uppercase transition font-medium">
                        </div>

                        <!-- Card Number -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Card Number</label>
                            <div class="relative">
                                <input type="text" name="card_number" placeholder="0000 0000 0000 0000" maxlength="16" required
                                    class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none font-mono transition">
                                <div class="absolute left-4 top-3.5 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <!-- Expiry -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Expiry Date</label>
                                <input type="text" name="card_expiry" placeholder="MM/YY" maxlength="5" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-center font-mono transition">
                            </div>
                            <!-- CVC -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">CVC / CVV</label>
                                <div class="relative">
                                    <input type="text" name="card_cvc" placeholder="123" maxlength="3" required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none font-mono transition">
                                    <div class="absolute left-3 top-3.5 text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="button" class="w-full bg-blue-600 text-white font-bold text-lg py-4 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-1">
                                Confirm Pay $15.00
                            </button>
                            <div class="text-center mt-4">
                                <a href="{{ route('client.dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">Cancel and Return</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
