<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" x-show="show">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Halo, selamat datang ! :name", ['name' => Auth::user()->name]) }}
                </div>
            </div>
        </div>

        @if($notification)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
            <div class="bg-yellow-50 dark:bg-yellow-900 border-l-4 border-yellow-400 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700 dark:text-yellow-200">
                            {{ $notification['message'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Informasi -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5" :class="{ 'mt-5': show, 'mt-0': !show }" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Sisa Cuti -->
                <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-300">Sisa Cuti</h3>
                    <p class="text-2xl font-bold text-blue-900 dark:text-blue-200">{{ $jumlahCuti }} Hari</p>
                </div>

                <!-- Total Terpakai -->
                <div class="bg-red-100 dark:bg-red-900 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-red-800 dark:text-red-300">Total Terpakai</h3>
                    <p class="text-2xl font-bold text-red-900 dark:text-red-200">{{ $totalTerpakai ?? '0' }} Hari</p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
