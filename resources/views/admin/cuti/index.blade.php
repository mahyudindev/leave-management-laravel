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
                                    <form action="{{ route('admin.cuti.update', $cuti->id) }}" method="POST" id="cutiForm">
                                        @csrf
                                        @method('PATCH')
                            
                                        <div class="flex space-x-2">
                                            <!-- Approve Button -->
                                            <button type="button" onclick="handleApprove()" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">Approve</button>
                            
                                            <!-- Reject Button -->
                                            <div x-data="{ open: false }">
                                                <button type="button" @click="open = true" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700">Reject</button>
                            
                                                <!-- Modal -->
                                                <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-50">
                                                    <div class="bg-white rounded-lg shadow-xl w-1/3 p-6">
                                                        <h3 class="text-lg font-medium text-gray-900">Catatan Penolakan</h3>
                                                        <textarea name="notes" id="notes" class="form-input mt-4 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-opacity-50 text-sm" placeholder="Masukkan catatan penolakan"></textarea>
                                                        <div class="flex justify-end mt-4 space-x-2">
                                                            <button type="button" @click="open = false" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">Cancel</button>
                                                            <button type="button" onclick="submitReject()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <!-- Hidden Input -->
                                        <input type="hidden" name="action" id="action">
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
    <script>
        function handleApprove() {
            document.getElementById('action').value = 'approve';
            document.getElementById('cutiForm').submit();
        }

        // function submitReject() {
        //     const notes = document.getElementById('notes').value.trim();
        //     if (!notes) {
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Oops...',
        //             text: 'Catatan harus diisi untuk menolak pengajuan!',
        //         });
        //         return;
        //     }

        //     document.getElementById('action').value = 'reject';
        //     document.getElementById('cutiForm').submit();
        // }
        function submitReject() {
    // Pilih modal yang sedang aktif berdasarkan atribut x-show
    const modal = document.querySelector('div[x-show="open"]');
    // Pastikan modal ditemukan
    if (!modal) {
        console.error("Modal tidak ditemukan");
        return;
    }

    // Ambil textarea dari modal tersebut
    const notesElement = modal.querySelector('#notes');
    if (!notesElement) {
        console.error("Textarea tidak ditemukan di dalam modal");
        return;
    }

    const notes = notesElement.value.trim();

    if (!notes) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Catatan harus diisi untuk menolak pengajuan!',
        });
        return;
    }

    document.getElementById('action').value = 'reject';
    document.getElementById('cutiForm').submit();
}

    </script>
</x-app-layout>
