<nav x-data="{ open: false, darkMode: false }" class="sticky top-0 z-50 bg-white/30 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700 backdrop-blur-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-20 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <div :class="{'text-black dark:text-white font-bold': true}">
                    Hello {{ Auth::user()->name }}
                </div>
                <button @click="darkMode = !darkMode; toggleTheme()"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <!-- Gambar Matahari dari CDN -->
                    <img x-show="!darkMode" src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/2600.svg"
                        alt="Sun Icon" class="w-5 h-5">
                    <!-- Gambar Bulan dari CDN -->
                    <img x-show="darkMode" src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f319.svg"
                        alt="Moon Icon" class="w-5 h-5">
                </button>



                <script>
                    function toggleTheme() {
                        const html = document.documentElement;
                        if (html.classList.contains('dark')) {
                            html.classList.remove('dark');
                            localStorage.setItem('theme', 'light');
                        } else {
                            html.classList.add('dark');
                            localStorage.setItem('theme', 'dark');
                        }
                    }

                    // Apply saved theme on load
                    document.addEventListener('DOMContentLoaded', () => {
                        const savedTheme = localStorage.getItem('theme');
                        if (savedTheme === 'dark') {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }
                    });
                </script>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden space-x-4">
                <!-- Teks Hello -->
                <div :class="{'text-black': !darkMode, 'text-white': darkMode}">
                    Hello!! {{ Auth::user()->name }}
                </div>
                <!-- Tombol Dark/Light Mode -->
                <button @click="darkMode = !darkMode; toggleTheme()"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <!-- Gambar Matahari dari CDN -->
                    <img x-show="!darkMode" src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/2600.svg"
                        alt="Sun Icon" class="w-5 h-5">
                    <!-- Gambar Bulan dari CDN -->
                    <img x-show="darkMode" src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f319.svg"
                        alt="Moon Icon" class="w-5 h-5">
                </button>
            </div>

        </div>
</nav>
@auth
    @if(Auth::user()->role == 'user')
        <div class="fixed bottom-0 left-0 right-0 bg-white/50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700 backdrop-blur-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-around h-16 items-center">
                    <!-- Dashboard -->
                    <a class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                        href="{{ route('dashboard') }}">
                        <i class="fas fa-home text-xl"></i>
                        <span class="text-xs">Dashboard</span>
                    </a>
                    <!-- Pengajuan Cuti -->
                    <a class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                        href="#">
                        <i class="fas fa-calendar-alt text-xl"></i>
                        <span class="text-xs">Pengajuan Cuti</span>
                    </a>

                    <!-- History -->
                    <a class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                        href="{{ route('history') }}">
                        <i class="fas fa-history text-xl"></i>
                        <span class="text-xs">History</span>
                    </a>

                    <!-- Profile -->
                    <div class="relative flex flex-col items-center justify-center">
                        <button onclick="toggleProfileMenu()"
                            class="flex flex-col items-center text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                            <i class="fas fa-user text-xl"></i>
                            <span class="text-xs">Profile</span>
                        </button>
                        <!-- Dropdown Menu -->
                        <div id="profileMenu"
                            class="hidden absolute bottom-16 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg">
                            <a class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                                href="{{ route('profile.edit') }}">Profile</a>
                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
@endauth


<script>
    function toggleProfileMenu() {
        const menu = document.getElementById('profileMenu');
        menu.classList.toggle('hidden');
    }
</script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
