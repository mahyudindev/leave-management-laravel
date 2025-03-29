<x-app-layout>
    <x-admin-sidebar />

    <div class="p-4 sm:ml-64">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-black dark:text-white">Ajukan Cuti</h1>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Kembali</a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white dark:bg-gray-800 p-6">
            @if(session('success'))
                <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 dark:bg-green-900 dark:border-green-700 dark:text-green-300" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.934 2.935a1 1 0 01-1.414-1.415l2.935-2.934-2.935-2.934a1 1 0 011.415-1.415L10 8.586l2.934-2.935a1 1 0 011.415 1.415L11.414 10l2.935 2.934a1 1 0 010 1.415z"/>
                        </svg>
                    </span>
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('success-alert').style.display = 'none';
                    }, 3000);
                </script>
            @endif
            @if(session('error'))
                <div id="error-alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 dark:bg-red-900 dark:border-red-700 dark:text-red-300" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.934 2.935a1 1 0 01-1.414-1.415l2.935-2.934-2.935-2.934a1 1 0 011.415-1.415L10 8.586l2.934-2.935a1 1 0 011.415 1.415L11.414 10l2.935 2.934a1 1 0 010 1.415z"/>
                        </svg>
                    </span>
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('error-alert').style.display = 'none';
                    }, 3000);
                </script>
            @endif
            <form method="POST" action="{{ route('cuti.ajukan') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="jenis_cuti" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Cuti</label>
                    <select id="jenis_cuti" name="jenis_cuti" required 
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-300">
                        <option value="">Pilih Jenis Cuti</option>
                        @foreach($jenisCuti as $cuti)
                            <option value="{{ $cuti->id }}">{{ $cuti->nama_cuti }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tanggal_awal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Mulai</label>
                    <input type="date" id="tanggal_awal" name="tanggal_awal" required
                           class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-300"
                           onclick="this.showPicker()">
                </div>

                <div>
                    <label for="tanggal_akhir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Selesai</label>
                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" required
                           class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-300"
                           onclick="this.showPicker()">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700">
                        Ajukan Cuti
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
