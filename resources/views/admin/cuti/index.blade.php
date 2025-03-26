<x-app-layout>
    <x-admin-sidebar />

    <div class="p-4 sm:ml-64">
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

        <div class="p-4 bg-white rounded-lg shadow-xs">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-700">Daftar Pengajuan Cuti - Status: {{ ucfirst($status) }}</h2>
                <div class="flex space-x-2">
                    @if(auth()->user()->role === 'manager')
                        <a href="{{ route('admin.cuti.status', 'pending') }}" class="px-4 py-2 text-sm font-medium rounded-md {{ $status === 'pending' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                            Menunggu Persetujuan
                        </a>
                        
                        <a href="{{ route('admin.cuti.status', 'approved_manager') }}" class="px-4 py-2 text-sm font-medium rounded-md {{ $status === 'approved_manager' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                            Disetujui
                        </a>
                        <a href="{{ route('admin.cuti.status', 'rejected_manager') }}" class="px-4 py-2 text-sm font-medium rounded-md {{ $status === 'rejected_manager' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                            Ditolak
                        </a>
                    @elseif(auth()->user()->role === 'hrd')
                        <a href="{{ route('admin.cuti.status', 'approved_manager') }}" class="px-4 py-2 text-sm font-medium rounded-md {{ $status === 'approved_manager' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                            Perlu Review
                        </a>
                        <a href="{{ route('admin.cuti.status', 'approved_hrd') }}" class="px-4 py-2 text-sm font-medium rounded-md {{ $status === 'approved_hrd' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                            Disetujui
                        </a>
                        <a href="{{ route('admin.cuti.status', 'rejected_hrd') }}" class="px-4 py-2 text-sm font-medium rounded-md {{ $status === 'rejected_hrd' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                            Ditolak
                        </a>
                    @endif
                </div>
            </div>

            <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
                <div class="overflow-x-auto w-full">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                                <th class="px-4 py-3">NIK</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Departemen</th>
                                <th class="px-4 py-3">Jenis Cuti</th>
                                <th class="px-4 py-3">Tanggal Mulai</th>
                                <th class="px-4 py-3">Tanggal Selesai</th>
                                <th class="px-4 py-3">Durasi</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            @forelse($daftarCuti as $cuti)
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3 text-sm">{{ $cuti->user->nik }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $cuti->user->name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $cuti->user->departemen->nama }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $cuti->jenisCuti->nama }}</td>
                                    <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($cuti->tanggal_awal)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($cuti->tanggal_akhir)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $cuti->jumlah }} Hari</td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="px-2 py-1 text-sm rounded-full
                                            @if($cuti->status === 'pending')
                                                bg-yellow-100 text-yellow-800
                                            @elseif($cuti->status === 'approved_manager')
                                                bg-blue-100 text-blue-800
                                            @elseif($cuti->status === 'approved_hrd')
                                                bg-green-100 text-green-800
                                            @elseif($cuti->status === 'rejected_manager')
                                                bg-red-100 text-red-800
                                            @elseif($cuti->status === 'rejected_hrd')
                                                bg-purple-100 text-purple-800
                                            @endif">
                                            @if($cuti->status === 'pending')
                                                Menunggu Persetujuan
                                            @elseif($cuti->status === 'approved_manager')
                                                Disetujui Manager
                                            @elseif($cuti->status === 'approved_hrd')
                                                Disetujui HRD
                                            @elseif($cuti->status === 'rejected_manager')
                                                Ditolak Manager
                                            @elseif($cuti->status === 'rejected_hrd')
                                                Ditolak HRD
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if(auth()->user()->role === 'manager' && $cuti->status === 'pending')
                                            <div class="flex space-x-2">
                                                <form action="{{ route('admin.cuti.update-status', $cuti->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="action" value="approve">
                                                    <button type="submit" class="px-3 py-1 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                                                        Setuju
                                                    </button>
                                                </form>
                                                <button onclick="showRejectModal('{{ $cuti->id }}')" class="px-3 py-1 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                                                    Tolak
                                                </button>
                                            </div>
                                        @elseif(auth()->user()->role === 'hrd' && $cuti->status === 'approved_manager')    
                                            <div class="flex space-x-2">
                                                <form action="{{ route('admin.cuti.update-status', $cuti->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="action" value="approve">
                                                    <button type="submit" class="px-3 py-1 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                                                        Setuju
                                                    </button>
                                                </form>
                                                <button onclick="showRejectModal('{{ $cuti->id }}')" class="px-3 py-1 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                                                    Tolak
                                                </button>
                                            </div>
                                        @elseif(auth()->user()->role === 'hrd' && in_array($cuti->status, ['approved_hrd', 'rejected_hrd']))
                                            @if($cuti->notes_hrd)
                                                <span class="text-sm text-gray-600">Catatan HRD: {{ $cuti->notes_hrd }}</span>
                                            @endif
                                        @else
                                            @if($cuti->notes_manager)
                                                <span class="text-sm text-gray-600">Catatan Manager: {{ $cuti->notes_manager }}</span>
                                            @endif
                                            @if($cuti->notes_hrd)
                                                <span class="text-sm text-gray-600">Catatan HRD: {{ $cuti->notes_hrd }}</span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-3 text-sm text-center text-gray-500">
                                        @if(auth()->user()->role === 'manager')
                                            @if($status === 'pending')
                                                Tidak ada pengajuan cuti yang perlu disetujui dari departemen Anda.
                                            @else
                                                Tidak ada data cuti {{ $status }} dari departemen Anda.
                                            @endif
                                        @elseif(auth()->user()->role === 'hrd')
                                            @if($status === 'approved_manager')
                                                Tidak ada pengajuan cuti yang sudah disetujui manager.
                                            @else
                                                Tidak ada data cuti {{ $status }}.
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                {{ $daftarCuti->links('pagination::tailwind') }}
            </div>
        </div>

        <!-- Reject Modals -->
        @foreach($daftarCuti as $cuti)
            <div id="reject-modal-{{ $cuti->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Alasan Penolakan</h3>
                        <form action="{{ route('admin.cuti.update-status', $cuti->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="action" value="reject">
                            <textarea name="notes" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" required
                                placeholder="Masukkan alasan penolakan..."></textarea>
                            <div class="flex justify-end mt-4 space-x-2">
                                <button type="button" onclick="document.getElementById('reject-modal-{{ $cuti->id }}').classList.add('hidden')"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                                    Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showRejectModal(id) {
            const modal = document.querySelector(`#reject-modal-${id}`);
            modal.classList.remove('hidden');
        }
    </script>
</x-app-layout>
