<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import CardContainer from "@/Components/Cards/CardContainer.vue";
import HeadingMedium from "@/Components/Texts/HeadingMedium.vue";
import {PhFiles, PhForkKnife, PhListBullets, PhPlusSquare} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";

const title = 'Dashboard'
</script>

<template>
    <Head :title="title"/>

    <AuthenticatedLayout with-greeting>
        <div class="grid lg:grid-cols-3 gap-2">
            <CardContainer>
                <AppLink :href="route('menu.index')">
                    <div class="group relative block h-64">
                        <span class="absolute inset-0 border-2 border-dashed border-primary-500"></span>

                        <div
                            class="relative flex h-full transform items-end bg-gray-900 transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2"
                        >
                            <div
                                class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8"
                            >
                                <PhFiles size="32"/>

                                <HeadingMedium>Menu's</HeadingMedium>
                            </div>

                            <div
                                class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:opacity-100 sm:p-6 lg:p-8"
                            >
                                <div class="flex gap-2 items-center">
                                    <HeadingMedium>Menu's</HeadingMedium>
                                    <PhPlusSquare weight="fill" size="32"/>
                                </div>

                                <p class="mt-4 text-sm sm:text-base">
                                    Δείτε, επεξεργαστείτε και δημιουργήστε νέα μενού.
                                </p>
                            </div>
                        </div>
                    </div>
                </AppLink>
            </CardContainer>
            <CardContainer>
                <div class="group relative block h-64">
                    <span class="absolute inset-0 border-2 border-dashed border-primary-500"></span>

                    <div
                        class="relative flex h-full transform items-end bg-gray-900 transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2"
                    >
                        <div
                            class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8"
                        >
                            <PhListBullets size="32"/>

                            <HeadingMedium>Categories</HeadingMedium>
                        </div>

                        <div
                            class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:opacity-100 sm:p-6 lg:p-8"
                        >
                            <div class="flex gap-2 items-center">
                                <HeadingMedium>Categories</HeadingMedium>
                                <PhPlusSquare weight="fill" size="32"/>
                            </div>

                            <p class="mt-4 text-sm sm:text-base">
                                Δείτε, επεξεργαστείτε και δημιουργήστε νέες κατηγορίες.
                            </p>
                        </div>
                    </div>
                </div>
            </CardContainer>
            <CardContainer>
                <div class="group relative block h-64">
                    <span class="absolute inset-0 border-2 border-dashed border-primary-500"></span>

                    <div
                        class="relative flex h-full transform items-end bg-gray-900 transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2"
                    >
                        <div
                            class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8"
                        >
                            <PhForkKnife size="32"/>

                            <HeadingMedium>Products</HeadingMedium>
                        </div>

                        <div
                            class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:opacity-100 sm:p-6 lg:p-8"
                        >
                            <div class="flex gap-2 items-center">
                                <HeadingMedium>Products</HeadingMedium>
                                <PhPlusSquare weight="fill" size="32"/>
                            </div>

                            <p class="mt-4 text-sm sm:text-base">
                                Δείτε, επεξεργαστείτε και δημιουργήστε νέα προϊόντα.
                            </p>
                        </div>
                    </div>
                </div>
            </CardContainer>
        </div>
    </AuthenticatedLayout>
</template>
