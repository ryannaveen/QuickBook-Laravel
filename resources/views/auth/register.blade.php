<x-guest-layout>
    <div class="w-full sm:max-w-md px-10 py-12 bg-white shadow-2xl rounded-[2.5rem] border border-white/50 relative overflow-hidden">
        <!-- Logo -->
        <div class="flex justify-center mb-10">
            <a href="/" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="font-bold text-2xl tracking-tight text-slate-900" style="font-family: 'Syne', sans-serif;">QuickBook</span>
            </a>
        </div>

        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-slate-900 font-syne mb-2">Create Your Account</h1>
            <p class="text-slate-500 font-medium px-4">Start your free trial today. No credit card required.</p>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div class="space-y-4">
                <div class="relative group">
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Full Name"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 transition-all placeholder:text-slate-400 font-medium">
                </div>

                <div class="relative group">
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Work Email"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 transition-all placeholder:text-slate-400 font-medium">
                </div>

                <div class="relative group">
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Password"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 transition-all placeholder:text-slate-400 font-medium tracking-widest">
                </div>

                <div class="relative group" x-data="{ show: false }">
                    <input :type="show ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 transition-all placeholder:text-slate-400 font-medium tracking-widest">
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-6 flex items-center">
                        <div class="w-10 h-6 bg-slate-200 rounded-full relative transition-colors" :class="show ? 'bg-blue-500' : 'bg-slate-200'">
                            <div class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-transform" :class="show ? 'translate-x-4' : ''"></div>
                        </div>
                    </button>
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="flex items-center">
                    <x-checkbox name="terms" id="terms" required />
                    <div class="ml-2 text-sm text-slate-600">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-blue-600 hover:text-blue-700 font-bold transition-colors">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-blue-600 hover:text-blue-700 font-bold transition-colors">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </div>
                </div>
            @endif

            <div class="relative py-4 flex items-center justify-center">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-100"></div>
                </div>
                <span class="relative px-4 bg-white text-xs font-bold text-slate-300 uppercase tracking-widest">OR</span>
            </div>

            <!-- Google Signup Placeholder -->
            <button type="button" class="w-full flex items-center justify-center gap-3 px-6 py-4 bg-white border border-slate-200 rounded-2xl hover:bg-slate-50 transition-all shadow-sm group">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 12-4.53z" fill="#EA4335"/>
                </svg>
                <span class="text-slate-700 font-bold">Sign up with Google</span>
            </button>

            <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl transition-all shadow-lg shadow-blue-100 transform active:scale-95">
                Sign Up
            </button>

            <div class="text-center mt-8">
                <p class="text-slate-500 font-medium">
                    Already have your account? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-bold transition-colors">Log In</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
