<x-app-layout>
    <x-admin-sidebar />

    <div class="p-4 sm:ml-64">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-black dark:text-white">Daftar Jabatan</h1>
            <a href="{{ route('admin.jabatan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Tambah Jabatan</a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Nama Jabatan</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jabatan as $index => $job)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $job->nama }}</td>
                            <td class="px-6 py-4 flex space-x-4">
                                <a href="{{ route('admin.jabatan.edit', $job->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('admin.jabatan.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jabatan ini?')">
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
            {{ $jabatan->links() }}
        </div>
    </div>
</x-app-layout>
