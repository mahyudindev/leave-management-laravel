<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-semibold mb-4">Riwayat Cuti</h3>
                <!-- Membuat tabel responsif -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Jenis Cuti</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Durasi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">01 Jan 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Tahunan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">3 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400">Disetujui</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">15 Feb 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Sakit</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">2 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600 dark:text-yellow-400">Menunggu</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">10 Mar 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Khusus</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">5 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400">Ditolak</td>
                            </tr>
                        </tbody>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">01 Jan 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Tahunan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">3 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400">Disetujui</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">15 Feb 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Sakit</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">2 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600 dark:text-yellow-400">Menunggu</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">10 Mar 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Khusus</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">5 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400">Ditolak</td>
                            </tr>
                        </tbody>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">01 Jan 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Tahunan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">3 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400">Disetujui</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">15 Feb 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Sakit</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">2 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600 dark:text-yellow-400">Menunggu</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">10 Mar 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Khusus</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">5 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400">Ditolak</td>
                            </tr>
                        </tbody>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">01 Jan 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Tahunan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">3 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400">Disetujui</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">15 Feb 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Sakit</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">2 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600 dark:text-yellow-400">Menunggu</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">10 Mar 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Khusus</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">5 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400">Ditolak</td>
                            </tr>
                        </tbody>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">01 Jan 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Tahunan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">3 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400">Disetujui</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">15 Feb 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Sakit</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">2 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600 dark:text-yellow-400">Menunggu</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">10 Mar 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Khusus</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">5 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400">Ditolak</td>
                            </tr>
                        </tbody>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">01 Jan 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Tahunan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">3 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400">Disetujui</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">15 Feb 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Sakit</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">2 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600 dark:text-yellow-400">Menunggu</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">10 Mar 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Cuti Khusus</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">5 Hari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400">Ditolak</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
