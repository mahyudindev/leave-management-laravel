<x-app-layout>
    <x-admin-sidebar />
    
    {{-- Main Dashboard Content --}}
    <div x-data="{ collapsed: false }" 
         :class="collapsed ? 'sm:ml-16' : 'sm:ml-64'"
         class="p-4 transition-all duration-300"> 
        <div class="p-4 mt-14">
            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Karyawan Card --}}
                <div class="p-4 bg-blue-100 dark:bg-blue-900 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-600 dark:text-blue-200">Total Karyawan</p>
                            <p class="text-2xl font-bold text-blue-700 dark:text-blue-100">{{ $totalKaryawan }}</p>
                        </div>
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>

                {{-- Waiting Approval Card --}}
                <div class="p-4 bg-yellow-100 dark:bg-yellow-900 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-yellow-600 dark:text-yellow-200">Waiting Approval</p>
                            <p class="text-2xl font-bold text-yellow-700 dark:text-yellow-100">8</p>
                        </div>
                        <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                {{-- Approved Card --}}
                <div class="p-4 bg-green-100 dark:bg-green-900 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-600 dark:text-green-200">Approved</p>
                            <p class="text-2xl font-bold text-green-700 dark:text-green-100">42</p>
                        </div>
                        <svg class="w-8 h-8 text-green-600 dark:text-green-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                {{-- Rejected Card --}}
                <div class="p-4 bg-red-100 dark:bg-red-900 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-red-600 dark:text-red-200">Rejected</p>
                            <p class="text-2xl font-bold text-red-700 dark:text-red-100">3</p>
                        </div>
                        <svg class="w-8 h-8 text-red-600 dark:text-red-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
