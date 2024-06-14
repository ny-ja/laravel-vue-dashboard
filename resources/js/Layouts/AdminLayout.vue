<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { useDark, useToggle } from "@vueuse/core";

defineProps({
    title: String,
});

const logout = () => {
    router.post(route("logout"));
};

const isDark = useDark();
const toggleDark = useToggle(isDark);

const isSidebarOpen = ref(true);
const isSettingsPanelOpen = ref(false);
const isSearchBoxOpen = ref(false);
const isUserMenuOpen = ref(false);
const isOptionMenuOpen = ref(false);
const isServiceMenuOpen = ref(false);
const isNotificationMenuOpen = ref(false);

const menus = [
    isSettingsPanelOpen,
    isUserMenuOpen,
    isOptionMenuOpen,
    isServiceMenuOpen,
    isNotificationMenuOpen,
];

const onClickAway = () => {
    menus.forEach((menu) => {
        if (menu.value) {
            menu.value = false;
        }
    });
};
</script>

<template>

    <Head :title="title" />
    <div class="flex h-screen overflow-y-hidden bg-white dark:bg-gray-900">
        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 z-10 flex flex-col ease-in-out duration-1000 flex-shrink-0 w-64 max-h-screen transition-all transform verflow-hidden  bg-white border-r shadow-lg lg:z-auto lg:static lg:shadow-none dark:bg-gray-900 dark:border-gray-600"
            :class="{
        '-translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen,
    }">
            <!-- sidebar header -->
            <div class="flex items-center justify-between flex-shrink-0 p-2" :class="{
        'lg:justify-center': !isSidebarOpen,
    }">
                <span
                    class="p-2 text-xl font-semibold leading-8 tracking-wider uppercase whitespace-nowrap dark:text-gray-100">
                    L<span :class="{ 'lg:hidden': !isSidebarOpen }">-VDT</span>
                </span>
                <button @click="isSidebarOpen = !isSidebarOpen" class="p-2 rounded-md lg:hidden">
                    <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Sidebar links -->
            <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
                <ul class="p-2 overflow-hidden">
                    <li>
                        <Link :href="route('admin.index')"
                            class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-200 dark:text-gray-100 dark:hover:bg-gray-700"
                            :class="{
        'justify-center': !isSidebarOpen,
        'bg-gray-100 dark:bg-gray-600':
            $page.component === 'Admin/Index',
    }">
                        <span>
                            <svg class="w-6 h-6 text-gray-400 dark:text-gray-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </span>
                        <span :class="{ 'lg:hidden': !isSidebarOpen }">Dashboard</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('chat.show')"
                            class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-200 dark:text-gray-100 dark:hover:bg-gray-700"
                            :class="{
        'justify-center': !isSidebarOpen,
        'bg-gray-100 dark:bg-gray-600':
            $page.component === 'Chat/ChatIndex',
    }">
                        <span>
                            <svg class="w-6 h-6 text-gray-400 dark:text-gray-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>

                        </span>
                        <span :class="{ 'lg:hidden': !isSidebarOpen }">Chatbot</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('pages.playground')"
                            class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-200 dark:text-gray-100 dark:hover:bg-gray-700"
                            :class="{
        'justify-center': !isSidebarOpen,
        'bg-gray-100 dark:bg-gray-600':
            $page.component === 'Playground',
    }">
                        <span>
                            <svg class="w-6 h-6 text-gray-400 dark:text-gray-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>

                        </span>
                        <span :class="{ 'lg:hidden': !isSidebarOpen }">Playground</span>
                        </Link>
                    </li>
                </ul>
            </nav>
            <!-- Sidebar footer -->
            <div class="flex-shrink-0 p-2 border-t max-h-14 dark:border-gray-600">
                <form @submit.prevent="logout">
                    <button
                        class="flex items-center justify-center w-full px-4 py-2 space-x-1 font-medium tracking-wider uppercase bg-gray-100 border rounded-md focus:outline-none focus:ring dark:bg-gray-900 dark:border-gray-600 dark:text-gray-100">
                        <span>
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </span>
                        <span :class="{ 'lg:hidden': !isSidebarOpen }">
                            Logout
                        </span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex flex-col flex-1 h-full overflow-hidden">
            <header class="flex-shrink-0 border-b dark:border-gray-600">
                <div class="flex items-center justify-between p-2">
                    <!-- Navbar left -->
                    <div class="flex items-center space-x-3">
                        <span
                            class="p-2 text-xl font-semibold tracking-wider uppercase lg:hidden dark:text-gray-100">L-VDT</span>
                        <!-- Toggle sidebar button -->
                        <button @click="isSidebarOpen = !isSidebarOpen"
                            class="p-2 rounded-md focus:outline-none focus:ring">
                            <svg class="w-4 h-4 text-gray-600" :class="{
        'transform transition-transform -rotate-180':
            isSidebarOpen,
    }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    <!-- Mobile search box -->
                    <div v-if="isSearchBoxOpen" class="fixed inset-0 z-10 bg-black bg-opacity-20" style="
                            backdrop-filter: blur(14px);
                            -webkit-backdrop-filter: blur(14px);
                        ">
                        <div
                            class="absolute inset-x-0 flex items-center justify-between p-2 bg-white shadow-md dark:bg-gray-950">
                            <div class="flex items-center flex-1 px-2 space-x-2">
                                <!-- search icon -->
                                <span><svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </span>
                                <input type="text" placeholder="Search"
                                    class="w-full px-4 py-3 text-gray-600 rounded-md focus:bg-gray-100 focus:outline-none dark:text-white dark:bg-gray-950" />
                            </div>
                            <!-- close button -->
                            <button @click="isSearchBoxOpen = false" class="flex-shrink-0 p-4 rounded-md">
                                <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Desktop search box -->
                    <div class="items-center hidden px-2 space-x-2 md:flex-1 md:flex md:mr-auto md:ml-5">
                        <!-- search icon --><svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>

                        <input type="text" placeholder="Search"
                            class="px-4 py-3 rounded-md hover:bg-gray-100 lg:max-w-sm md:py-2 md:flex-1 focus:outline-none md:focus:bg-transparent md:focus:shadow md:focus:border dark:bg-gray-900 dark:text-white" />
                    </div>

                    <!-- Navbar right -->
                    <div class="relative flex items-center space-x-3">
                        <!-- Search button -->
                        <button @click="isSearchBoxOpen = true"
                            class="p-2 bg-gray-100 rounded-full md:hidden focus:outline-none focus:ring hover:bg-gray-200">
                            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>

                        <div class="items-center hidden space-x-3 md:flex">
                            <!-- Notification Menu -->
                            <div class="relative">
                                <!-- red dot -->
                                <div class="absolute right-0 p-1 bg-red-400 rounded-full animate-ping"></div>
                                <div class="absolute right-0 p-1 bg-red-400 border rounded-full"></div>
                                <button @click="isNotificationMenuOpen = !isNotificationMenuOpen"
                                    class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none focus:ring">
                                    <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </button>

                                <div v-if="isNotificationMenuOpen" v-click-away="onClickAway"
                                    class="absolute z-50 w-48 max-w-md mt-3 transform bg-white rounded-md shadow-lg -translate-x-3/4 min-w-max">
                                    <div class="p-4 font-medium border-b">
                                        <span class="text-gray-800">Notification</span>
                                    </div>
                                    <ul class="flex flex-col p-2 my-2 space-y-1">
                                        <li>
                                            <a href="#"
                                                class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Link</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Another
                                                Link</a>
                                        </li>
                                    </ul>
                                    <div class="flex items-center justify-center p-4 text-blue-700 underline border-t">
                                        <a href="#">See All</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Services Menu -->
                            <div class="relative">
                                <button @click="isServiceMenuOpen = !isServiceMenuOpen"
                                    class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none focus:ring">
                                    <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                </button>

                                <div v-if="isServiceMenuOpen" v-click-away="onClickAway"
                                    class="absolute z-50 w-48 max-w-md mt-3 transform bg-white rounded-md shadow-lg -translate-x-3/4 min-w-max">
                                    <div class="p-4 text-lg font-medium border-b">
                                        Web apps & services
                                    </div>
                                    <ul class="flex flex-col p-2 my-3 space-y-3">
                                        <li>
                                            <a href="#"
                                                class="flex items-start px-2 py-1 space-x-2 rounded-md hover:bg-gray-100">
                                                <span class="block mt-1">
                                                    <svg class="w-6 h-6 text-gray-500"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                                                        <path fill="#fff"
                                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                                    </svg>
                                                </span>
                                                <span class="flex flex-col">
                                                    <span class="text-lg">Atlassian</span>
                                                    <span class="text-sm text-gray-400">Lorem ipsum dolor
                                                        sit.</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-start px-2 py-1 space-x-2 rounded-md hover:bg-gray-100">
                                                <span class="block mt-1">
                                                    <svg class="w-6 h-6 text-gray-500"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                                    </svg>
                                                </span>
                                                <span class="flex flex-col">
                                                    <span class="text-lg">Slack</span>
                                                    <span class="text-sm text-gray-400">Lorem ipsum, dolor sit
                                                        amet consectetur
                                                        adipisicing elit.</span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="flex items-center justify-center p-4 text-blue-700 underline border-t">
                                        <a href="#">Show all apps</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Options Menu -->
                            <div class="relative">
                                <button @click="isOptionMenuOpen = !isOptionMenuOpen"
                                    class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none focus:ring">
                                    <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                    </svg>
                                </button>

                                <div v-if="isOptionMenuOpen" v-click-away="onClickAway"
                                    class="absolute z-50 w-48 max-w-md mt-3 transform bg-white rounded-md shadow-lg -translate-x-3/4 min-w-max">
                                    <div class="p-4 font-medium border-b">
                                        <span class="text-gray-800">Options</span>
                                    </div>
                                    <ul class="flex flex-col p-2 my-2 space-y-1">
                                        <li>
                                            <a href="#"
                                                class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Link</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Another
                                                Link</a>
                                        </li>
                                    </ul>
                                    <div class="flex items-center justify-center p-4 text-blue-700 underline border-t">
                                        <a href="#">See All</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Menu -->
                        <div class="relative">
                            <button @click="isUserMenuOpen = !isUserMenuOpen"
                                class="p-1 bg-gray-200 rounded-full focus:outline-none focus:ring">
                                <img class="object-cover w-8 h-8 rounded-full"
                                    src="https://avatars0.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                    alt="Profile Photo" />
                            </button>
                            <!-- green dot -->
                            <div class="absolute right-0 p-1 bg-green-400 rounded-full bottom-3 animate-ping"></div>
                            <div class="absolute right-0 p-1 bg-green-400 border border-white rounded-full bottom-3">
                            </div>

                            <div v-if="isUserMenuOpen" v-click-away="onClickAway"
                                class="absolute z-50 w-48 max-w-md mt-3 transform bg-white rounded-md shadow-lg -translate-x-3/4 min-w-max">
                                <div class="flex flex-col p-4 space-y-1 font-medium border-b">
                                    <span class="text-gray-800">{{
        $page.props.auth.user.name
    }}</span>
                                    <span class="text-sm text-gray-400">{{
            $page.props.auth.user.email
        }}</span>
                                </div>
                                <ul class="flex flex-col p-2 my-2 space-y-1">
                                    <li>
                                        <a href="#"
                                            class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Link</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Another
                                            Link</a>
                                    </li>
                                </ul>
                                <div class="flex items-center justify-center p-4 text-blue-700 underline border-t">
                                    <form @submit.prevent="logout">
                                        <button>Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
                <slot />
            </main>
            <!-- Main footer -->
            <footer
                class="flex items-center justify-between flex-shrink-0 p-4 border-t max-h-14 dark:text-gray-100 dark:border-gray-600">
                <div>L-VDT &copy; 2024</div>
                <div class="text-sm">
                    Made by
                    <a class="text-blue-400 underline" href="#" rel="noopener noreferrer">Johnny Ermio</a>
                </div>
                <div>
                    <!-- Github svg -->
                    <a href="#" class="flex items-center space-x-1">
                        <svg class="w-6 h-6 text-gray-400" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z">
                            </path>
                        </svg>
                        <span class="hidden text-sm md:block">View on Github</span>
                    </a>
                </div>
            </footer>
        </div>
        <!-- Setting panel button -->
        <div>
            <button @click="isSettingsPanelOpen = true"
                class="fixed right-0 px-4 py-2 text-sm font-medium text-white uppercase transform rotate-90 translate-x-8 bg-gray-600 top-1/2 rounded-b-md">
                Settings
            </button>
        </div>

        <!-- Settings panel -->
        <Transition name="settings-panel">
            <div v-if="isSettingsPanelOpen" v-click-away="onClickAway"
                class="fixed inset-y-0 right-0 flex flex-col bg-white shadow-lg bg-opacity-20 w-80" style="
                backdrop-filter: blur(14px);
                -webkit-backdrop-filter: blur(14px);
            ">
                <div class="flex items-center justify-between flex-shrink-0 p-2">
                    <h6 class="p-2 text-lg">Settings</h6>
                    <button @click="isSettingsPanelOpen = false" class="p-2 rounded-md focus:outline-none focus:ring">
                        <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 max-h-full p-4 overflow-hidden">
                    <button @click="toggleDark()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="w-10 h-10 fill-black stroke-black dark:fill-white dark:stroke-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </Transition>
    </div>
</template>

<style scoped>
.settings-panel-enter-active {
    transition: all 0.3s ease-out;
}

.settings-panel-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.settings-panel-enter-from,
.settings-panel-leave-to {
    transform: translateX(100%);
    opacity: 0;
}
</style>
