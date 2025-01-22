<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" x-show="show">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Halo, selamat datang ! :name", ['name' => Auth::user()->name]) }}
                </div>
            </div>
        </div>

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
