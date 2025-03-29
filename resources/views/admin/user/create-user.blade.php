<x-app-layout>
    <x-admin-sidebar />

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
                <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <!-- NIK -->
                    <div class="mb-4">
                        <label for="nik" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">NIK:</label>
                        <input type="text" name="nik" id="nik" value="{{ old('nik') }}" maxlength="10" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('nik')
                            <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Nama:</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" maxlength="30" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('name')
                            <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" maxlength="30" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('email')
                            <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Password:</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" maxlength="70" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility('password', this)">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="password-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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
                            <input type="password" name="password_confirmation" id="password_confirmation" maxlength="70" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility('password_confirmation', this)">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="password-confirmation-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Tanggal Masuk Kerja -->
                    <div class="mb-4">
                        <label for="tanggal_masuk_kerja" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Tanggal Masuk Kerja:</label>
                        <input type="date" name="tanggal_masuk_kerja" id="tanggal_masuk_kerja" value="{{ old('tanggal_masuk_kerja') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" onclick="this.showPicker()">
                        @error('tanggal_masuk_kerja')
                            <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tanggal Akhir Kerja -->
                    <div class="mb-4">
                        <label for="tanggal_akhir_kerja" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Tanggal Akhir Kerja:</label>
                        <input type="date" name="tanggal_akhir_kerja" id="tanggal_akhir_kerja" value="{{ old('tanggal_akhir_kerja') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" onclick="this.showPicker()">
                        @error('tanggal_akhir_kerja')
                            <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jumlah Cuti -->
                    <div class="mb-4">
                        <label for="jumlah_cuti" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Jumlah Cuti:</label>
                        <input type="text" name="jumlah_cuti" id="jumlah_cuti" value="{{ old('jumlah_cuti') }}" maxlength="2" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('jumlah_cuti')
                            <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="mb-4">
                        <label for="role" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Role:</label>
                        <select name="role" id="role" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Role</option>
                            <option value="hrd" {{ old('role') == 'hrd' ? 'selected' : '' }}>HRD</option>
                            <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="pegawai" {{ old('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                        </select>
                        @error('role')
                            <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Departemen -->
                    <div class="mb-4">
                        <label for="departemen_id" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Departemen:</label>
                        <select name="departemen_id" id="departemen_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Departemen</option>
                            @foreach($departemens as $departemen)
                                <option value="{{ $departemen->id }}" {{ old('departemen_id') == $departemen->id ? 'selected' : '' }}>
                                    {{ $departemen->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('departemen_id')
                            <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-4">
                        <label for="jabatan_id" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Jabatan:</label>
                        <select name="jabatan_id" id="jabatan_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Jabatan</option>
                            @foreach($jabatans as $jabatan)
                                <option value="{{ $jabatan->id }}" {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }}>
                                    {{ $jabatan->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('jabatan_id')
                            <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                        <a href="{{ route('admin.user.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, icon) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Update icon
            const svg = icon.querySelector('svg');
            if (type === 'text') {
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</x-app-layout>
