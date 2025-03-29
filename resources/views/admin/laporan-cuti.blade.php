<x-app-layout>
    <x-admin-sidebar />

    {{-- Notifikasi Sukses atau Error --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: "{{ session('success') }}",
                    icon: "success",
                    timer: 2500,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: "{{ session('error') }}",
                    icon: "error",
                    timer: 2500,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif

    {{-- Konten Utama --}}
    <div class="p-4 sm:ml-64">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-black dark:text-white">Laporan Cuti</h1>
        </div>

        {{-- Filter Bulan dan Tombol Export --}}
        <form method="GET" class="flex items-center space-x-4 mb-4">
            <div>
                <label for="bulan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filter Bulan</label>
                <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div class="flex items-center space-x-4 mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-sm">Filter</button>
                <a href="{{ route('admin.laporan.cuti.export', ['bulan' => $bulan]) }}" 
                   class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 shadow-sm">Export ke Excel</a>
            </div>
        </form>

        {{-- Tabel Laporan Cuti --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Karyawan</th>
                        <th scope="col" class="px-6 py-3">Departemen</th>
                        <th scope="col" class="px-6 py-3">Jabatan</th>
                        <th scope="col" class="px-6 py-3">Jumlah Cuti</th>
                        <th scope="col" class="px-6 py-3">Tanggal Mulai</th>
                        <th scope="col" class="px-6 py-3">Tanggal Berakhir</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @forelse ($laporan as $cuti)
                        <tr>
                            <td class="px-6 py-4">{{ $cuti->user->name }}</td>
                            <td class="px-6 py-4">{{ $cuti->user->departemen->nama ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $cuti->user->jabatan->nama ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $cuti->jumlah }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($cuti->tanggal_awal)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($cuti->tanggal_akhir)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Tidak ada data cuti untuk bulan ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- SweetAlert Script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>
