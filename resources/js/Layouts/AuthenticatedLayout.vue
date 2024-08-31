<script setup lang="ts">
import {ref} from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import AppLink from "@/Components/Links/AppLink.vue";
import HeadingTiny from "@/Components/Texts/HeadingTiny.vue";
import {PhCaretRight, PhSignOut} from "@phosphor-icons/vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";

const showingNavigationDropdown = ref(false);

const props = defineProps<{
    withGreeting?: boolean
}>()

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-900">
            <nav class="flex m-2 p-4 justify-between bg-gray-800 ring-1 ring-inset ring-gray-600" v-motion-slide-top :delay="200">
                <div class="flex items-center gap-2">
                    <AppLink :href="route('dashboard')">
                        <ApplicationLogo class="block h-8 fill-primary-400"/>
                    </AppLink>
                    <div

                        class="h-6 border-l border-gray-500 mx-2"/>
                    <HeadingTiny v-if="withGreeting" v-motion-slide-left :delay="700" class="hidden sm:inline-flex">
                        Welcome back, {{ $page.props.auth.user.name }}.
                    </HeadingTiny>

                    <div v-motion-slide-left :delay="500">
                        <slot name="breadcrumbs"/>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center gap-2 sm:ms-6">

                    <AppLink :href="route('profile.edit')">
                        <PrimaryButton direction="right" title="Προφίλ">
                            <template #icon>
                                <PhCaretRight weight="bold"/>
                            </template>
                            Profile
                        </PrimaryButton>
                    </AppLink>

                    <AppLink :href="route('logout')" method="post">
                        <IconSecondaryButton title="Αποσύνδεση">
                            <PhSignOut weight="bold" size="16" />
                        </IconSecondaryButton>
                    </AppLink>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile</ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="m-2" v-motion-fade-visible :delay="200">
                <slot/>
            </main>
        </div>
    </div>
</template>
