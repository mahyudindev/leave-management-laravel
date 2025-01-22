<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-bold mb-4">Riwayat Cuti</h3>
                <!-- Membuat tabel responsif -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <!-- Sorting Tanggal Awal -->
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-500 uppercase dark:text-gray-400">
                                    <a href="?sort=tanggal_awal" class="hover:underline">Tanggal Awal</a>
                                </th>
                                <!-- Sorting Tanggal Akhir -->
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-500 uppercase dark:text-gray-400">
                                    <a href="?sort=tanggal_akhir" class="hover:underline">Tanggal Akhir</a>
                                </th>
                                <!-- Jenis Cuti -->
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-500 uppercase dark:text-gray-400">Jenis Cuti</th>
                                <!-- Durasi -->
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-500 uppercase dark:text-gray-400">Durasi</th>
                                <!-- Status -->
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-500 uppercase dark:text-gray-400">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            @forelse($riwayatCuti as $cuti)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-gray-100">{{ $cuti->tanggal_awal }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-gray-100">{{ $cuti->tanggal_akhir }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-gray-100">{{ $cuti->jenisCuti->nama_cuti }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-gray-100">{{ $cuti->jumlah }} Hari</td>
                                    <td class="px-6 py-4">
                                        <div class="px-3 py-1 rounded-full text-xs font-bold text-center
                                            {{ $cuti->status == 'Approved' ? 'bg-green-500 text-green-100' : ($cuti->status == 'Rejected' ? 'bg-red-700 text-red-100' : 'bg-yellow-500 text-yellow-800') }}">
                                            {{ $cuti->status }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Belum ada riwayat cuti.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $riwayatCuti->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
