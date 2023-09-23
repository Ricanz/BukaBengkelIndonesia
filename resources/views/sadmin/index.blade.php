<x-app-layout>
    @if (Auth::user()->role === 'employee')
        @include('sadmin.employee-dashboard')
    @elseif(Auth::user()->role === 'client')  
        @include('sadmin.client-dashboard')
    @elseif(Auth::user()->role === 'admin')  
        @include('sadmin.admin-dashboard')
    @endif
</x-app-layout>