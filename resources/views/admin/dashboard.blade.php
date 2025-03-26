<x-app-layout>
    <x-admin-sidebar />

    {{-- Main Dashboard Content --}}
    <div x-data="{ openDropdown: null }" 
         :class="openDropdown ? 'sm:ml-16' : 'sm:ml-64'"
         class="p-4 transition-all duration-300"> 
        <div class="p-4 mt-14">
            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Total Karyawan --}}
                @if(auth()->user()->role === 'hrd')
                <div onclick="location.href='{{ route('admin.user.index') }}'" class="cursor-pointer p-4 bg-blue-100 dark:bg-blue-900 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-600 dark:text-blue-200">Total Karyawan</p>
                            <p class="text-2xl font-bold text-blue-700 dark:text-blue-100">{{ $totalKaryawan }}</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Pending --}}
                <div onclick="location.href='{{ route('admin.cuti.status', 'pending') }}'" class="cursor-pointer p-4 bg-yellow-100 dark:bg-yellow-900 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-yellow-600 dark:text-yellow-200">Pending</p>
                            <p class="text-2xl font-bold text-yellow-700 dark:text-yellow-100">{{ $pending }}</p>
                        </div>
                    </div>
                </div>

                {{-- Approved --}}
                @if(auth()->user()->role === 'manager')
                <div onclick="location.href='{{ route('admin.cuti.status', 'approved') }}'" class="cursor-pointer p-4 bg-green-100 dark:bg-green-900 rounded-lg shadow-sm">
                @elseif(auth()->user()->role === 'hrd')
                <div onclick="location.href='{{ route('admin.cuti.status', 'approved') }}'" class="cursor-pointer p-4 bg-green-100 dark:bg-green-900 rounded-lg shadow-sm">
                @else
                <div onclick="location.href='{{ route('admin.cuti.index') }}'" class="cursor-pointer p-4 bg-green-100 dark:bg-green-900 rounded-lg shadow-sm">
                @endif
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-600 dark:text-green-200">Approved</p>
                            <p class="text-2xl font-bold text-green-700 dark:text-green-100">{{ $approved }}</p>
                        </div>
                    </div>
                </div>

                {{-- Rejected --}}
                @if(auth()->user()->role === 'manager')
                <div onclick="location.href='{{ route('admin.cuti.status', 'rejected') }}'" class="cursor-pointer p-4 bg-red-100 dark:bg-red-900 rounded-lg shadow-sm">
                @elseif(auth()->user()->role === 'hrd')
                <div onclick="location.href='{{ route('admin.cuti.status', 'rejected') }}'" class="cursor-pointer p-4 bg-red-100 dark:bg-red-900 rounded-lg shadow-sm">
                @else
                <div onclick="location.href='{{ route('admin.cuti.index') }}'" class="cursor-pointer p-4 bg-red-100 dark:bg-red-900 rounded-lg shadow-sm">
                @endif
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-red-600 dark:text-red-200">Rejected</p>
                            <p class="text-2xl font-bold text-red-700 dark:text-red-100">{{ $rejected }}</p>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</x-app-layout>
