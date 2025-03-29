<x-app-layout>
    {{-- Main Dashboard Content --}}
    @if (in_array(auth()->user()->role, ['hrd', 'manager']))
        <x-admin-sidebar />
        
        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4" onsubmit="return handleFormSubmit(event)">
                        @csrf
                        @method('PATCH')
                        
                        {{-- Nama --}}
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Nama</label>
                            <input id="name" name="name" type="text" value="{{ auth()->user()->name }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('name')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Email</label>
                            <input id="email" name="email" type="email" value="{{ auth()->user()->email }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('email')
                                <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Tanggal Masuk (readonly) --}}

                            <div class="mb-4">
                            <label for="tanggal_masuk" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Tanggal Masuk</label>
                            <input id="tanggal_masuk" name="tanggal_masuk" type="text" 
                                value="{{ \Carbon\Carbon::parse(auth()->user()->tanggal_masuk_kerja)->format('d-m-Y') }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-600 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                                readonly>
                        </div>

                        {{-- Tanggal Berakhir Kontrak (readonly) --}}
                        <div class="mb-4">
                            <label for="tanggal_akhir_kerja" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Tanggal Berakhir Kontrak</label>
                            <input id="tanggal_akhir_kerja" name="tanggal_akhir_kerja" type="text" 
                                value="{{ auth()->user()->tanggal_akhir_kerja ? \Carbon\Carbon::parse(auth()->user()->tanggal_akhir_kerja)->format('d-m-Y') : 'Kontrak Tetap' }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-600 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                                readonly>
                        </div>

                        {{-- Jumlah Cuti (readonly) --}}
                        <div class="mb-4">
                            <label for="jumlah_cuti" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Jumlah Cuti</label>
                            <input id="jumlah_cuti" name="jumlah_cuti" type="text" value="{{ auth()->user()->jumlah_cuti }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-600 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" readonly>
                        </div>

                        {{-- Departemen (readonly) --}}
                        <div class="mb-4">
                            <label for="departemen" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Departemen</label>
                            <input id="departemen" name="departemen" type="text" value="{{ auth()->user()->departemen->nama ?? 'Tidak Ada Departemen' }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-600 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" readonly>
                        </div>

                        {{-- Jabatan (readonly) --}}
                        <div class="mb-4">
                            <label for="jabatan" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Jabatan</label>
                            <input id="jabatan" name="jabatan" type="text" value="{{ auth()->user()->jabatan->nama ?? 'Tidak Ada Jabatan' }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-600 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500" readonly>
                        </div>

                        {{-- Password --}}
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Password: (Kosongkan jika tidak ingin mengubah)</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" maxlength="70"
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

                        {{-- Konfirmasi Password --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Konfirmasi Password:</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation" maxlength="70"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility('password_confirmation', this)">
                                    <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="password-confirmation-icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Simpan Perubahan
                            </button>
                        @if (Auth::check() && (Auth::user()->role == 'manager' || Auth::user()->role == 'hrd'))
                            <a href="{{ route('admin.dashboard') }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Kembali
                            </a>
                            @else
                            <a href="{{ route('dashboard') }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Kembali
                            </a>
                        @endif

                            

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="p-4 transition-all duration-300">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <form method="POST" action="{{ route('profile.update') }}" onsubmit="return handleFormSubmit(event)">
                                @csrf
                                @method('PATCH')

                                {{-- Nama --}}
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                                    <input id="name" name="name" type="text" value="{{ auth()->user()->name }}" 
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-300">
                                </div>

                                {{-- Email --}}
                                <div class="mt-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                    <input id="email" name="email" type="email" value="{{ auth()->user()->email }}" 
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-300">
                                </div>

                                {{-- Tanggal Masuk (readonly) --}}
                                <div class="mt-4">
                                <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Masuk</label>
                                <input id="tanggal_masuk" name="tanggal_masuk" type="text" 
                                    value="{{ \Carbon\Carbon::parse(auth()->user()->tanggal_masuk_kerja)->format('d-m-Y') }}" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-opacity-50 bg-gray-100 dark:bg-gray-600 dark:text-gray-300" 
                                    readonly>
                                </div>

                                    {{-- Tanggal Berakhir Kontrak (readonly) --}}
                                    <div class="mt-4">
                                        <label for="tanggal_akhir_kerja" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Berakhir Kontrak</label>
                                        <input id="tanggal_akhir_kerja" name="tanggal_akhir_kerja" type="text" 
                                            value="{{ auth()->user()->tanggal_akhir_kerja ? \Carbon\Carbon::parse(auth()->user()->tanggal_akhir_kerja)->format('d-m-Y') : 'Kontrak Tetap' }}" 
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-opacity-50 bg-gray-100 dark:bg-gray-600 dark:text-gray-300" 
                                            readonly>
                                    </div>


                                {{-- Jumlah Cuti (readonly) --}}
                                <div class="mt-4">
                                    <label for="jumlah_cuti" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Cuti</label>
                                    <input id="jumlah_cuti" name="jumlah_cuti" type="text" value="{{ auth()->user()->jumlah_cuti }}" 
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-opacity-50 bg-gray-100 dark:bg-gray-600 dark:text-gray-300" readonly>
                                </div>

                                {{-- Departemen (readonly) --}}
                                <div class="mt-4">
                                    <label for="departemen" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Departemen</label>
                                    <input id="departemen" name="departemen" type="text" value="{{ auth()->user()->departemen->nama ?? 'Tidak Ada Departemen' }}" 
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-opacity-50 bg-gray-100 dark:bg-gray-600 dark:text-gray-300" readonly>
                                </div>

                                {{-- Jabatan (readonly) --}}
                                <div class="mt-4">
                                    <label for="jabatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jabatan</label>
                                    <input id="jabatan" name="jabatan" type="text" value="{{ auth()->user()->jabatan->nama ?? 'Tidak Ada Jabatan' }}" 
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-opacity-50 bg-gray-100 dark:bg-gray-600 dark:text-gray-300" readonly>
                                </div>
                                 
                                {{-- Submit Button --}}
                                <div class="mt-6">
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function handleFormSubmit(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Perubahan akan disimpan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();

                    Swal.fire(
                        'Berhasil!',
                        'Perubahan telah disimpan.',
                        'success'
                    );
                }
            });
        }

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
