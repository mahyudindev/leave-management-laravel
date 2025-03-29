<x-app-layout>
    <x-admin-sidebar />

    {{-- Main Dashboard Content --}}
    <div x-data="{ openDropdown: null }" 
         :class="openDropdown ? 'sm:ml-16' : 'sm:ml-64'"
         class="p-4 transition-all duration-300"> 
        <div class="p-4 mt-14">
            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ auth()->user()->role === 'hrd' ? '4' : '3' }} gap-4">
                {{-- Total Karyawan (Only for HRD) --}}
                @if(auth()->user()->role === 'hrd')
                <div onclick="location.href='{{ route('admin.user.index') }}'" 
                     class="cursor-pointer p-6 bg-blue-100 dark:bg-blue-900 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-blue-600 dark:text-blue-200">Total Karyawan</p>
                            <p class="text-3xl font-bold text-blue-700 dark:text-blue-100">{{ $totalKaryawan }}</p>
                        </div>
                        <div class="text-blue-500 dark:text-blue-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Pending Requests --}}
                <div onclick="location.href='{{ route('admin.cuti.status', 'pending') }}'" 
                     class="cursor-pointer p-6 bg-yellow-100 dark:bg-yellow-900 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-yellow-600 dark:text-yellow-200">Pending</p>
                            <p class="text-3xl font-bold text-yellow-700 dark:text-yellow-100">{{ $pending }}</p>
                            <p class="text-xs text-yellow-500 dark:text-yellow-300 mt-1">
                                {{ auth()->user()->role === 'hrd' ? 'Awaiting HRD Approval' : 'Awaiting Manager Approval' }}
                            </p>
                        </div>
                        <div class="text-yellow-500 dark:text-yellow-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Approved Requests --}}
                <div onclick="location.href='{{ route('admin.cuti.status', 'approved') }}'" 
                     class="cursor-pointer p-6 bg-green-100 dark:bg-green-900 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-green-600 dark:text-green-200">Approved</p>
                            <p class="text-3xl font-bold text-green-700 dark:text-green-100">{{ $approved }}</p>
                            <p class="text-xs text-green-500 dark:text-green-300 mt-1">
                                {{ auth()->user()->role === 'hrd' ? 'HRD Approved' : 'Manager Approved' }}
                            </p>
                        </div>
                        <div class="text-green-500 dark:text-green-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Rejected Requests --}}
                <div onclick="location.href='{{ route('admin.cuti.status', 'rejected') }}'" 
                     class="cursor-pointer p-6 bg-red-100 dark:bg-red-900 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-red-600 dark:text-red-200">Rejected</p>
                            <p class="text-3xl font-bold text-red-700 dark:text-red-100">{{ $rejected }}</p>
                            <p class="text-xs text-red-500 dark:text-red-300 mt-1">
                                {{ auth()->user()->role === 'hrd' ? 'HRD Rejected' : 'Manager Rejected' }}
                            </p>
                        </div>
                        <div class="text-red-500 dark:text-red-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if(auth()->user()->role === 'manager')
            {{-- Divider --}}
            <div class="my-6 border-t border-gray-200 dark:border-gray-700"></div>
            
            {{-- Manager's Leave Balance --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Available Leave --}}
                <div class="p-6 bg-indigo-100 dark:bg-indigo-900 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-200">Sisa Cuti</p>
                            <p class="text-3xl font-bold text-indigo-700 dark:text-indigo-100">{{ auth()->user()->jumlah_cuti }} Hari</p>
                            <p class="text-xs text-indigo-500 dark:text-indigo-300 mt-1">
                                Cuti yang masih tersedia
                            </p>
                        </div>
                        <div class="text-indigo-500 dark:text-indigo-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Used Leave --}}
                <div class="p-6 bg-purple-100 dark:bg-purple-900 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-purple-600 dark:text-purple-200">Cuti Terpakai</p>
                            <p class="text-3xl font-bold text-purple-700 dark:text-purple-100">{{ 12 - auth()->user()->jumlah_cuti }} Hari</p>
                            <p class="text-xs text-purple-500 dark:text-purple-300 mt-1">
                                Cuti yang sudah digunakan
                            </p>
                        </div>
                        <div class="text-purple-500 dark:text-purple-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Bottom Divider --}}
            <div class="my-6 border-t border-gray-200 dark:border-gray-700"></div>
            @endif
        </div>
    </div>
</x-app-layout>
