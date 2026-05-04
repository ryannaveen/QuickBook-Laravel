<x-app-layout>
    @php
        if (auth()->user()->role === 'owner') {
            redirect('/owner/dashboard')->send();
        } else {
            redirect('/client/dashboard')->send();
        }
    @endphp
</x-app-layout>