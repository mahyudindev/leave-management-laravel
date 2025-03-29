<x-app-layout>
    @if(auth()->user()->role === 'manager')
    <x-admin-sidebar />
    @endif

    <div class="@if(auth()->user()->role === 'manager') p-4 sm:ml-64 @else max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5 @endif">
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
                                <!-- Catatan -->
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-500 uppercase dark:text-gray-400">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            @forelse($riwayatCuti as $cuti)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($cuti->tanggal_awal)->format('d-m-Y') }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($cuti->tanggal_akhir)->format('d-m-Y') }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-gray-100">{{ $cuti->jenisCuti->nama_cuti }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-gray-100">{{ $cuti->jumlah }} Hari</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusClass = match(strtolower($cuti->status)) {
                                                'approved', 'approve' => 'bg-green-500 text-green-100',
                                                'rejected', 'reject' => 'bg-red-700 text-red-100',
                                                'pending' => 'bg-yellow-500 text-yellow-100',
                                                default => 'bg-gray-500 text-gray-100'
                                            };
                                            
                                            $statusText = match(strtolower($cuti->status)) {
                                                'pending' => $cuti->status_manager === 'Pending' ? 'Pending Manager' : 'Pending HRD',
                                                'approved', 'approve' => 'Approved',
                                                'rejected', 'reject' => 'Rejected',
                                                default => $cuti->status
                                            };
                                        @endphp
                                        <div class="px-3 py-1 rounded-full text-xs font-bold text-center {{ $statusClass }}">
                                            {{ $statusText }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-gray-100">
                                        @if($cuti->notes_manager)
                                            <p class="mb-1"><span class="text-blue-600 dark:text-blue-400">Manager:</span> {{ $cuti->notes_manager }}</p>
                                        @endif
                                        @if($cuti->notes_hrd)
                                            <p><span class="text-green-600 dark:text-green-400">HRD:</span> {{ $cuti->notes_hrd }}</p>
                                        @endif
                                        @if(!$cuti->notes_manager && !$cuti->notes_hrd)
                                            <p class="text-gray-500 dark:text-gray-400">-</p>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Belum ada riwayat cuti.</td>
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
