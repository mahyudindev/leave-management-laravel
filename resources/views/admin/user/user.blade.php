<x-app-layout>
    <x-admin-sidebar />

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
            document.addEventListener('DOMContentLoaded', function() {
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
        <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <div class="relative flex space-x-2">
                <input type="text" id="table-search-users" onkeyup="filterTable()"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari Data Karyawan">
                <a href="{{ route('admin.users.export') }}" class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600">
                    Export Excel
                </a>
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="user-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">#</th>
                        <th scope="col" class="px-6 py-3 sortable" data-column="name" data-order="asc">
                            <div class="flex items-center space-x-2 cursor-pointer">
                                <span>Nama</span>
                                <svg class="w-4 h-4 text-gray-500 sort-icon" aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12 4l6 6H6z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3 sortable" data-column="departemen_nama" data-order="asc">
                            <div class="flex items-center space-x-2 cursor-pointer">
                                <span>Departemen</span>
                                <svg class="w-4 h-4 text-gray-500 sort-icon" aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12 4l6 6H6z" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">Jabatan</th>
                        <th scope="col" class="px-6 py-3 text-center">Jumlah Cuti</th>
                        <th scope="col" class="px-6 py-3 text-center">Role</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="p-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->departemen_nama ?? 'Tidak Ada' }}</td>
                            <td class="px-6 py-4">{{ $user->jabatan_nama ?? 'Tidak Ada' }}</td>
                            <td class="px-6 py-4">{{ $user->jumlah_cuti }}</td>
                            <td class="px-6 py-4">{{ ucfirst($user->role) }}</td>
                            <td class="px-6 py-4 flex items-center">
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="flex items-center space-x-2">
                                    <svg class="w-6 h-6 text-blue-500 dark:text-blue-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M5 8a4 4 0 1 1 7.796 1.263l-2.533 2.534A4 4 0 0 1 5 8Zm4.06 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h2.172a2.999 2.999 0 0 1-.114-1.588l.674-3.372a3 3 0 0 1 .82-1.533L9.06 13Zm9.032-5a2.907 2.907 0 0 0-2.056.852L9.967 14.92a1 1 0 0 0-.273.51l-.675 3.373a1 1 0 0 0 1.177 1.177l3.372-.675a1 1 0 0 0 .511-.273l6.07-6.07a2.91 2.91 0 0 0-.944-4.742A2.907 2.907 0 0 0 18.092 8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-blue-500">Edit</span>
                                </a>
                                <button class="flex items-center space-x-2 ms-3 delete-user-btn" data-id="{{ $user->id }}">
                                    <svg class="w-6 h-6 text-red-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                    <span class="text-red-500">Hapus</span>
                                </button>
                                <form id="delete-user-form-{{ $user->id }}" action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            @include('vendor.pagination.default', ['paginator' => $users])
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Search bar filter function
        function filterTable() {
            const input = document.getElementById('table-search-users').value.toLowerCase();
            const rows = document.querySelectorAll('#user-table tbody tr');
            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                row.style.display = name.includes(input) ? '' : 'none';
            });
        }

        // Sorting functionality for sortable headers
        document.querySelectorAll('.sortable').forEach(header => {
            header.addEventListener('click', function() {
                const column = this.dataset.column;
                const order = this.dataset.order;
                const rows = Array.from(document.querySelectorAll('#user-table tbody tr'));
                const sortIcon = this.querySelector('.sort-icon');

                // Sort rows
                rows.sort((a, b) => {
                    const valA = a.querySelector(`td:nth-child(${this.cellIndex + 1})`).textContent.trim().toLowerCase();
                    const valB = b.querySelector(`td:nth-child(${this.cellIndex + 1})`).textContent.trim().toLowerCase();
                    return (valA < valB ? -1 : 1) * (order === 'asc' ? 1 : -1);
                });

                // Toggle sorting order
                this.dataset.order = order === 'asc' ? 'desc' : 'asc';

                // Update sort icon
                if (order === 'asc') {
                    sortIcon.setAttribute('d', 'M12 20l-6-6h12z'); // Arrow down
                } else {
                    sortIcon.setAttribute('d', 'M12 4l6 6H6z'); // Arrow up
                }

                // Reorder table rows and update numbering
                const tbody = document.querySelector('#user-table tbody');
                rows.forEach((row, index) => {
                    row.querySelector('td:first-child').textContent = index + 1; // Update nomor urut
                    tbody.appendChild(row);
                });
            });
        });
    </script>
    <script>
        // SweetAlert delete confirmation
        document.querySelectorAll('.delete-user-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.dataset.id;
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data pengguna ini akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-user-form-${userId}`).submit();
                    }
                });
            });
        });
    </script>
    
</x-app-layout>
