<x-app-layout>
    <x-admin-sidebar />

    <div class="p-4 sm:ml-64">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-black dark:text-white">Daftar Jenis Cuti</h1>
            <a href="{{ route('admin.jenis_cuti.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Tambah Jenis Cuti</a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Nama Cuti</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenisCuti as $index => $cuti)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $cuti->nama_cuti }}</td>
                            <td class="px-6 py-4 flex space-x-4">
                                <a href="{{ route('admin.jenis_cuti.edit', $cuti->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('admin.jenis_cuti.destroy', $cuti->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jenis cuti ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $jenisCuti->links() }}
        </div>
    </div>
</x-app-layout>
