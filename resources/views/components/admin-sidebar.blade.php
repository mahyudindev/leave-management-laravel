<div x-data="{
    collapsed: localStorage.getItem('sidebarCollapsed') === 'true',
    activeMenu: localStorage.getItem('activeMenu') || '',
    toggleCollapse() {
        this.collapsed = !this.collapsed;
        localStorage.setItem('sidebarCollapsed', this.collapsed);
    },
    setActiveMenu(menu) {
        this.activeMenu = this.activeMenu === menu ? '' : menu;
        localStorage.setItem('activeMenu', this.activeMenu);
    }
}"
    class="fixed top-16 left-0 h-[calc(100vh-4rem)] transition-all duration-300 z-40"
    :class="collapsed ? 'w-16' : 'w-64'">

    <!-- Sidebar content -->
    <div class="flex flex-col h-full bg-white/30 dark:bg-gray-800/50 backdrop-blur-lg border-r border-gray-100 dark:border-gray-700">
        <!-- Toggle Button -->
        <div class="absolute -right-3 top-10">
            <button @click="toggleCollapse()"
                    class="bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 p-1 rounded-full shadow-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform"
                     :class="{ 'rotate-180': collapsed }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-grow py-4">
            <ul class="space-y-2">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center px-4 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                       :class="{ 'justify-center': collapsed }">
                        <i class="fas fa-home text-xl"></i>
                        <span class="ml-3" x-show="!collapsed">Dashboard</span>
                    </a>
                </li>

                <!-- Data User Menu -->
                <li>
                    <button @click="setActiveMenu('users')"
                            class="flex items-center w-full px-4 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                            :class="{
                                'justify-center': collapsed,
                                'bg-gray-100 dark:bg-gray-700': activeMenu === 'users'
                            }">
                        <i class="fas fa-users text-xl"></i>
                        <template x-if="!collapsed">
                            <div class="flex items-center justify-between ml-3 flex-grow">
                                <span>Data User</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-4 w-4 transform transition-transform"
                                     :class="{ 'rotate-180': activeMenu === 'users' }"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </template>
                    </button>
                    <ul x-show="!collapsed && activeMenu === 'users'"
                        x-collapse
                        class="mt-2 space-y-1">
                        <li>
                            <a href="/users" class="block pl-12 pr-4 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">All Users</a>
                        </li>
                        <li>
                            <a href="/users/create" class="block pl-12 pr-4 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">Create User</a>
                        </li>
                    </ul>
                </li>

                <!-- Cuti Menu -->
                <li>
                    <button @click="setActiveMenu('cuti')"
                            class="flex items-center w-full px-4 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                            :class="{
                                'justify-center': collapsed,
                                'bg-gray-100 dark:bg-gray-700': activeMenu === 'cuti'
                            }">
                        <i class="fas fa-calendar-alt text-xl"></i>
                        <template x-if="!collapsed">
                            <div class="flex items-center justify-between ml-3 flex-grow">
                                <span>Cuti</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-4 w-4 transform transition-transform"
                                     :class="{ 'rotate-180': activeMenu === 'cuti' }"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </template>
                    </button>
                    <ul x-show="!collapsed && activeMenu === 'cuti'"
                        x-collapse
                        class="mt-2 space-y-1">
                        <li>
                            <a href="/cuti" class="block pl-12 pr-4 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">All Cuti</a>
                        </li>
                        <li>
                            <a href="/cuti/create" class="block pl-12 pr-4 py-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">Create Cuti</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Profile Section dalam Sidebar -->
        <div class="border-t border-gray-100 dark:border-gray-700 p-4">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </template>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="profileOpen"
                     @click.away="profileOpen = false"
                     class="absolute bottom-full mb-2 w-56 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                     :class="{ 'left-0': !collapsed, 'left-full ml-2': collapsed }">
                    <!-- User Info -->
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                    </div>

                    <!-- Menu Items -->
                    <ul class="py-2">

                        <li>
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Profile
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    Sign out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<!-- Main Content Container - Adjusted for both navbar and sidebar -->
<div class="transition-all duration-300 pt-16"
     :class="{ 'ml-64': !collapsed, 'ml-16': collapsed }">
    <!-- Your main content here -->
</div>
