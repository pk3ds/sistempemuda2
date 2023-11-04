<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/inertia-vue3";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-blue-200">
            <nav class="bg-white border-b border-gray-100" style="
                                                background-image: url('/assets/images/banner.png');
                                                background-size: cover;
                                            ">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link href="/">
                                <ApplicationLogo class="block h-9 w-auto fill-current text-white" />
                                </Link>
                            </div>

                            <!-- Navigation Links Auth -->
                            <div v-if="$page.props.auth.user && $page.props.auth.can['view navs']"
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                                <NavLink :href="route('users')" :active="route().current('users')">
                                    Users
                                </NavLink>
                                <NavLink :href="route('sessions')" :active="route().current('sessions')">
                                    Sessions
                                </NavLink>
                                <NavLink :href="route('committees')" :active="route().current('committees')">
                                    Committees
                                </NavLink>
                                <NavLink :href="route('winners.index')" :active="route().current('winners.index')">
                                    Winners
                                </NavLink>
                                <NavLink :href="route('products.index')" :active="route().current('products.index')">
                                    Products
                                </NavLink>
                            </div>

                            <!-- Navigation Links User -->
                            <div v-if="$page.props.auth.user && !$page.props.auth.can['view navs']"
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            </div>

                            <!-- Navigation Links Guest -->
                            <div v-if="!$page.props.auth.user" class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            </div>
                        </div>

                        <div v-if="$page.props.auth.user" class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown Auth -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink v-if="!$page.props.auth.can['view navs']" :href="route('dashboard')">
                                            Dashboard
                                        </DropdownLink>
                                        <DropdownLink v-if="!$page.props.auth.can['view navs']"
                                            :href="route('draws.winners')">
                                            Lucky Draw
                                        </DropdownLink>
                                        <DropdownLink :href="route('logout')"
                                            method="post" as="button">
                                            Logout
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <div v-if="!$page.props.auth.user" class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown Guest -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                Guest

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('login')">
                                            Login
                                        </DropdownLink>
                                        <DropdownLink :href="route('register')">
                                            Register
                                        </DropdownLink>
                                        <DropdownLink :href="route('draws.winners')">
                                            Lucky Draw
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="
                                showingNavigationDropdown =
                                !showingNavigationDropdown
                            "
                                class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu Auth -->
                <div v-if="$page.props.auth.user" :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1" v-if="$page.props.auth.can['view navs']">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('users')" :active="route().current('users')">
                            Users
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('sessions')" :active="route().current('sessions')">
                            Sessions
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('committees')" :active="route().current('committees')">
                            Committees
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('winners.index')" :active="route().current('winners.index')">
                            Winners
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('products.index')" :active="route().current('products.index')">
                            Products
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-white">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-300">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                           <ResponsiveNavLink v-if="!$page.props.auth.can['view navs']" :href="route('dashboard')">
                                Dashboard
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('draws.winners')">
                                Lucky Draw
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Logout
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu Guest -->
                <div v-if="!$page.props.auth.user" :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }" class="sm:hidden">
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="pt-4 pb-1 border-t border-gray-200">
                            <div class="space-y-1">
                                <ResponsiveNavLink :href="route('login')">
                                    Login
                                </ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('register')">
                                    Register
                                </ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('draws.winners')">
                                    Lucky Draw
                                </ResponsiveNavLink>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Flash Messages -->
            <div v-if="$page.props.flash.success"
                class="bg-green-100 rounded-b-lg py-5 px-6 mb-3 text-base text-green-700 inline-flex items-center w-full"
                role="alert">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle"
                    class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor"
                        d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z">
                    </path>
                </svg>
                {{ $page.props.flash.success }}
            </div>
            <div v-if="$page.props.flash.error"
                class="bg-red-100 rounded-b-lg py-5 px-6 mb-3 text-base text-red-700 inline-flex items-center w-full"
                role="alert">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle"
                    class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor"
                        d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z">
                    </path>
                </svg>
                {{ $page.props.flash.error }}
            </div>
            <div v-if="$page.props.flash.warn"
                class="bg-yellow-100 rounded-b-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full"
                role="alert">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle"
                    class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path fill="currentColor"
                        d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z">
                    </path>
                </svg>
                {{ $page.props.flash.warn }}
            </div>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
