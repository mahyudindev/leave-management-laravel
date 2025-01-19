@vite(['resources/css/app.css', 'resources/js/app.js'])
<div x-data="{ collapsed: false, openKaryawan: false, openDepartemen: false, openJabatan: false, openVariabelCuti: false, openCuti: false }">
    <!-- Sidebar -->
    <aside :class="collapsed ? 'w-16' : 'w-64'" class="fixed top-16 left-0 z-40 h-screen bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 transition-all duration-300">
        <div class="flex flex-col h-full">
            <!-- Sidebar Content -->
            <div class="flex-grow px-3 pb-4 overflow-y-auto">
                <!-- Toggle Button -->
                <button @click="collapsed = !collapsed" class="p-2 mb-4 bg-gray-100 dark:bg-gray-700 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Sidebar Menu -->
                <ul class="space-y-2">
                    <!-- Dashboard -->
                    <li>
                        <a href="#" class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-6 h-6 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ml-3" x-show="!collapsed">Dashboard</span>
                        </a>
                    </li>

                    <!-- Karyawan Menu -->
                    <li>
                        <button @click="openKaryawan = !openKaryawan" class="flex items-center w-full p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Z" />
                            </svg>
                            <span class="ml-3" x-show="!collapsed">Karyawan</span>
                            <svg class="w-3 h-3 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul x-show="openKaryawan && !collapsed" x-collapse class="pl-8 space-y-2">
                            <li><a href="#" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">All Karyawan</a></li>
                            <li><a href="#" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Add Karyawan</a></li>
                        </ul>
                    </li>

                    <!-- Departemen Menu -->
                <li>
                    <button @click="openDepartemen = !openDepartemen" class="flex items-center w-full p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 0 0-2 2v4m5-6h8M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m0 0h3a2 2 0 0 1 2 2v4m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6m18 0s-4 2-9 2-9-2-9-2m9-2h.01"/>
                          </svg>

                        <span class="ml-3" x-show="!collapsed">Departemen</span>
                        <svg class="w-3 h-3 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul x-show="openDepartemen && !collapsed" x-collapse class="pl-8 space-y-2">
                        <li><a href="#" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">All Departemen</a></li>
                        <li><a href="#" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Add Departemen</a></li>
                    </ul>
                </li>

                <!-- Jabatan Menu -->
                <li>
                    <button @click="openJabatan = !openJabatan" class="flex items-center w-full p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M5 3a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5Zm0 12a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H5Zm12 0a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2h-2Zm0-12a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-2Z"/>
                            <path fill-rule="evenodd" d="M10 6.5a1 1 0 0 1 1-1h2a1 1 0 1 1 0 2h-2a1 1 0 0 1-1-1ZM10 18a1 1 0 0 1 1-1h2a1 1 0 1 1 0 2h-2a1 1 0 0 1-1-1Zm-4-4a1 1 0 0 1-1-1v-2a1 1 0 1 1 2 0v2a1 1 0 0 1-1 1Zm12 0a1 1 0 0 1-1-1v-2a1 1 0 1 1 2 0v2a1 1 0 0 1-1 1Z" clip-rule="evenodd"/>
                          </svg>

                        <span class="ml-3" x-show="!collapsed">Jabatan</span>
                        <svg class="w-3 h-3 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul x-show="openJabatan && !collapsed" x-collapse class="pl-8 space-y-2">
                        <li><a href="#" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">All Jabatan</a></li>
                        <li><a href="#" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Add Jabatan</a></li>
                    </ul>
                </li>

                <!-- Variabel Cuti Menu -->
                <li>
                    <button @click="openVariabelCuti = !openVariabelCuti" class="flex items-center w-full p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M5 13.17a3.001 3.001 0 0 0 0 5.66V20a1 1 0 1 0 2 0v-1.17a3.001 3.001 0 0 0 0-5.66V4a1 1 0 0 0-2 0v9.17ZM11 20v-9.17a3.001 3.001 0 0 1 0-5.66V4a1 1 0 1 1 2 0v1.17a3.001 3.001 0 0 1 0 5.66V20a1 1 0 1 1-2 0Zm6-1.17V20a1 1 0 1 0 2 0v-1.17a3.001 3.001 0 0 0 0-5.66V4a1 1 0 1 0-2 0v9.17a3.001 3.001 0 0 0 0 5.66Z"/>
                          </svg>

                        <span class="ml-3" x-show="!collapsed">Variabel Cuti</span>
                        <svg class="w-3 h-3 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul x-show="openVariabelCuti && !collapsed" x-collapse class="pl-8 space-y-2">
                        <li><a href="#" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">All Variabel Cuti</a></li>
                        <li><a href="#" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Add Variabel Cuti</a></li>
                    </ul>
                </li>

                <!-- Cuti Menu -->
                <li>
                    <button @click="openCuti = !openCuti" class="flex items-center w-full p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12.512 8.72a2.46 2.46 0 0 1 3.479 0 2.461 2.461 0 0 1 0 3.479l-.004.005-1.094 1.08a.998.998 0 0 0-.194-.272l-3-3a1 1 0 0 0-.272-.193l1.085-1.1Zm-2.415 2.445L7.28 14.017a1 1 0 0 0-.289.702v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .703-.288l2.851-2.816a.995.995 0 0 1-.26-.189l-3-3a.998.998 0 0 1-.19-.26Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M7 3a1 1 0 0 1 1 1v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h1V4a1 1 0 0 1 1-1Zm10.67 8H19v8H5v-8h3.855l.53-.537a1 1 0 0 1 .87-.285c.097.015.233.13.277.087.045-.043-.073-.18-.09-.276a1 1 0 0 1 .274-.873l1.09-1.104a3.46 3.46 0 0 1 4.892 0l.001.002A3.461 3.461 0 0 1 17.67 11Z" clip-rule="evenodd"/>
                          </svg>

                        <span class="ml-3" x-show="!collapsed">Cuti</span>
                        <svg class="w-3 h-3 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul x-show="openCuti && !collapsed" x-collapse class="pl-8 space-y-2">
                        <li><a href="#" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Pending Cuti</a></li>
                        <li><a href="#" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Approve Cuti</a></li>
                        <li><a href="#" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Reject Cuti</a></li>

                    </ul>
                </li>
                </ul>
            </div>

            <!-- Profile Section -->
            <div class="sticky bottom-0 border-t border-gray-100 dark:border-gray-700 p-4 bg-white dark:bg-gray-800">
                <div x-data="{ profileOpen: false }" class="relative">
                    <!-- Profile Button -->
                    <button @click="profileOpen = !profileOpen"
                            class="flex items-center w-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            :class="{ 'justify-center': collapsed }">
                        <img class="w-8 h-8 rounded-full"
                             src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random"
                             alt="user photo">
                        <template x-if="!collapsed">
                            <div class="flex items-center justify-between ml-3 flex-grow">
                                <span class="text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </template>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="profileOpen" @click.away="profileOpen = false"
                         class="absolute bottom-full mb-2 w-56 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                         :class="{ 'left-0': !collapsed, 'left-full ml-2': collapsed }">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                            <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                        </div>
                        <ul class="py-2">
                            <li><a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                        Sign out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </aside>

</div>
