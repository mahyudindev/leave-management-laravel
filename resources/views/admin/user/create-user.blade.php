<x-app-layout>
    <x-admin-sidebar />
    <div class="p-4 sm:ml-64 mt-16">
        <div class="bg-blue-500 shadow-md rounded px-8 pt-6 pb-8 mb-4" style="height: 70px;">
            <h1 class="text-2xl font-bold mb-4 text-center text-white">Add New User</h1>
        </div>
        <div class="p-4">
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <x-input-label for="role" :value="__('Role')" />
                    <select id="role" name="role" class="block mt-1 w-full">
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end mt-4 space-x-3">
                    <x-secondary-button type="button" onclick="history.back()">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <!-- Change this to type="submit" -->
                    <x-primary-button type="submit">
                        {{ __('Create User') }}
                    </x-primary-button>
                </div>
            </form>

            <script>
                function togglePasswordVisibility(id) {
                    const input = document.getElementById(id);
                    const icon = document.getElementById(id + '-toggle-icon');
                    const inputConf = document.getElementById('password_confirmation');
                    if (input.type === 'password') {
                        input.type = 'text';
                        inputConf.type = 'text';
                        icon.classList.toggle('text-blue-500');
                    } else {
                        input.type = 'password';
                        inputConf.type = 'password';
                        icon.classList.toggle('text-blue-500');
                    }
                }
            </script>
        </div>
    </div>
</x-app-layout>