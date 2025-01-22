<x-app-layout>
    {{-- Main Dashboard Content --}}
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
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input id="name" name="name" type="text" value="{{ auth()->user()->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                            </div>

                            {{-- Email --}}
                            <div class="mt-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input id="email" name="email" type="email" value="{{ auth()->user()->email }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                            </div>

                            {{-- Tanggal Masuk (readonly) --}}
                            <div class="mt-4">
                                <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                                <input id="tanggal_masuk" name="tanggal_masuk" type="text" value="{{ auth()->user()->tanggal_masuk }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 bg-gray-100" readonly>
                            </div>

                            {{-- Jumlah Cuti (readonly) --}}
                            <div class="mt-4">
                                <label for="jumlah_cuti" class="block text-sm font-medium text-gray-700">Jumlah Cuti</label>
                                <input id="jumlah_cuti" name="jumlah_cuti" type="text" value="{{ auth()->user()->jumlah_cuti }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 bg-gray-100" readonly>
                            </div>

                            {{-- Departemen (readonly) --}}
                            <div class="mt-4">
                                <label for="departemen" class="block text-sm font-medium text-gray-700">Departemen</label>
                                <input id="departemen" name="departemen" type="text" value="{{ auth()->user()->departemen['nama'] ?? 'Tidak Ada Departemen' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 bg-gray-100" readonly>
                            </div>

                            {{-- Jabatan (readonly) --}}
                            <div class="mt-4">
                                <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                                <input id="jabatan" name="jabatan" type="text" value="{{ auth()->user()->jabatan['nama'] ?? 'Tidak Ada Jabatan' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 bg-gray-100" readonly>
                            </div>
                            

                            {{-- Submit Button --}}
                            <div class="mt-6">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
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
    </script>
</x-app-layout>
