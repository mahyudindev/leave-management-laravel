@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900" x-data="{ collapsed: false }">
        <x-admin-sidebar/>

        <!-- Main Content -->
        <div class="transition-all duration-300" :class="collapsed ? 'ml-16' : 'ml-64'">
            <div class="p-8">
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <p class="mt-4">Welcome to your dashboard</p>

                <!-- Dashboard Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Total Karyawan</h2>
                        <p class="text-3xl font-bold">150</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Pending Cuti</h2>
                        <p class="text-3xl font-bold">12</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Total Departemen</h2>
                        <p class="text-3xl font-bold">8</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Active Users</h2>
                        <p class="text-3xl font-bold">145</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
