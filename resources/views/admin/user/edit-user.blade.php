<x-app-layout>
    <x-admin-sidebar />

    <div class="p-4 sm:ml-64">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="text-2xl font-bold text-center text-black dark:text-white mb-6">Edit Data Karyawan</h1>

            <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- NIK -->
                <div class="mb-4">
                    <label for="nik" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">NIK:</label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik', $user->nik) }}" maxlength="10"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('nik') border-red-500 @enderror">
                    @error('nik')
                        <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nama -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Nama:</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" maxlength="30"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" maxlength="30"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Password:</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" maxlength="70"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                               placeholder="Leave blank to keep current password">
                        <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility('password', this)">
                            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="password-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825a10.05 10.05 0 01-1.875.175c-4.67 0-8.43-3.358-10-8.005 1.57-4.647 5.33-8.005 10-8.005 1.14 0 2.241.198 3.283.555M15 12a3 3 0 11-6 0 3 3 0 016 0zm3.238 3.238a8.977 8.977 0 002.205-3.23 10.042 10.042 0 00-1.403-2.137m-2.244-1.607a8.943 8.943 0 00-2.962-2.648" />
                            </svg>
                        </span>
                    </div>
                    @error('password')
                        <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Konfirmasi Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Konfirmasi Password:</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility('password_confirmation', this)">
                            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="password-confirmation-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825a10.05 10.05 0 01-1.875.175c-4.67 0-8.43-3.358-10-8.005 1.57-4.647 5.33-8.005 10-8.005 1.14 0 2.241.198 3.283.555M15 12a3 3 0 11-6 0 3 3 0 016 0zm3.238 3.238a8.977 8.977 0 002.205-3.23 10.042 10.042 0 00-1.403-2.137m-2.244-1.607a8.943 8.943 0 00-2.962-2.648" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Tanggal Masuk -->
                <div class="mb-4">
                    <label for="tanggal_masuk_kerja" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Tanggal Masuk:</label>
                    <input type="date" name="tanggal_masuk_kerja" id="tanggal_masuk_kerja" value="{{ old('tanggal_masuk_kerja', $user->tanggal_masuk_kerja) }}"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('tanggal_masuk_kerja') border-red-500 @enderror">
                    @error('tanggal_masuk_kerja')
                        <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tanggal Akhir -->
                <div class="mb-4">
                    <label for="tanggal_akhir_kerja" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Tanggal Akhir:</label>
                    <input type="date" name="tanggal_akhir_kerja" id="tanggal_akhir_kerja" value="{{ old('tanggal_akhir_kerja', $user->tanggal_akhir_kerja) }}"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('tanggal_akhir_kerja') border-red-500 @enderror">
                    @error('tanggal_akhir_kerja')
                        <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Jumlah Cuti -->
                <div class="mb-4">
                    <label for="jumlah_cuti" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Jumlah Cuti:</label>
                    <input type="text" name="jumlah_cuti" id="jumlah_cuti" value="{{ old('jumlah_cuti', $user->jumlah_cuti) }}" maxlength="2"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('jumlah_cuti') border-red-500 @enderror">
                    @error('jumlah_cuti')
                        <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Dropdown Departemen -->
                <div class="mb-4">
                    <label for="departemen_id" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Departemen:</label>
                    <select name="departemen_id" id="departemen_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('departemen_id') border-red-500 @enderror">
                        <option value="">Pilih Departemen</option>
                        @foreach ($departemen as $dept)
                            <option value="{{ $dept->id }}" {{ old('departemen_id', $user->departemen_id) == $dept->id ? 'selected' : '' }}>
                                {{ $dept->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('departemen_id')
                        <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Dropdown Jabatan -->
                <div class="mb-4">
                    <label for="jabatan_id" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Jabatan:</label>
                    <select name="jabatan_id" id="jabatan_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('jabatan_id') border-red-500 @enderror">
                        <option value="">Pilih Jabatan</option>
                        @foreach ($jabatan as $job)
                            <option value="{{ $job->id }}" {{ old('jabatan_id', $user->jabatan_id) == $job->id ? 'selected' : '' }}>
                                {{ $job->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('jabatan_id')
                        <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Role:</label>
                    <select name="role" id="role"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('role') border-red-500 @enderror">
                        <option value="pegawai" {{ old('role', $user->role) === 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                        <option value="manager" {{ old('role', $user->role) === 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="hrd" {{ old('role', $user->role) === 'hrd' ? 'selected' : '' }}>HRD</option>
                    </select>
                    @error('role')
                        <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="flex items-center justify-between">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan
                    </button>
                    <a href="{{ route('admin.user.index') }}" class="text-blue-500 dark:text-blue-400 hover:underline">Batal</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePasswordVisibility(inputId, iconElement) {
            const input = document.getElementById(inputId);
            const icon = iconElement.querySelector('svg');
    
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm1.707-6.707A10.034 10.034 0 0113.875 4.175 10.05 10.05 0 0112 4c-4.67 0-8.43 3.358-10 8.005 1.57 4.647 5.33 8.005 10 8.005a9.989 9.989 0 007.32-3.072l.157-.157M17 12h.01" />';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825a10.05 10.05 0 01-1.875.175c-4.67 0-8.43-3.358-10-8.005 1.57-4.647 5.33-8.005 10-8.005 1.14 0 2.241.198 3.283.555M15 12a3 3 0 11-6 0 3 3 0 016 0zm3.238 3.238a8.977 8.977 0 002.205-3.23 10.042 10.042 0 00-1.403-2.137m-2.244-1.607a8.943 8.943 0 00-2.962-2.648" />';
            }
        }
    </script>
</x-app-layout>
