<x-app-layout>
    <x-admin-sidebar />
    
    <div class="transition-all duration-300 pt-16"
     :class="{ 'ml-64': !collapsed, 'ml-16': collapsed }">
    <!-- Your main content here -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" x-show="show">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Halo, selamat datang ! :name", ['name' => Auth::user()->name]) }}
                </div>
            </div>
        </div>

        <!-- Informasi -->

    </div>
</div>
</x-app-layout>


