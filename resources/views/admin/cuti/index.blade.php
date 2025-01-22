<x-app-layout>
    <x-admin-sidebar />

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

    <div class="p-4 sm:ml-64">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-black dark:text-white">Daftar Cuti - {{ ucfirst($status) }}</h1>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Nama Karyawan</th>
                        <th scope="col" class="px-6 py-3">Jenis Cuti</th>
                        <th scope="col" class="px-6 py-3">Tanggal Awal</th>
                        <th scope="col" class="px-6 py-3">Tanggal Akhir</th>
                        <th scope="col" class="px-6 py-3">Durasi</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarCuti as $index => $cuti)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $cuti->user->name }}</td>
                            <td class="px-6 py-4">{{ $cuti->jenisCuti->nama_cuti }}</td>
                            <td class="px-6 py-4">{{ $cuti->tanggal_awal }}</td>
                            <td class="px-6 py-4">{{ $cuti->tanggal_akhir }}</td>
                            <td class="px-6 py-4">{{ $cuti->jumlah }} Hari</td>
                            <td class="px-6 py-4">
                                @if ($status === 'Pending')
                                    <form action="{{ route('admin.cuti.update', $cuti->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="action" value="approve" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">Approve</button>
                                        <button type="submit" name="action" value="reject" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700 ml-2">Reject</button>
                                    </form>
                                @else
                                    <span class="px-3 py-1 text-white rounded-full {{ $status == 'Approved' ? 'bg-green-500' : 'bg-red-500' }}">{{ $status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Tidak ada data cuti {{ $status }}.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $daftarCuti->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>
