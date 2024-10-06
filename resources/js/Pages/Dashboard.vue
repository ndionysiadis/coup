<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import HeadingMedium from "@/Components/Texts/HeadingMedium.vue";
import {
    PhFiles,
    PhForkKnife,
    PhListBullets,
    PhPlusSquare,
} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";

const title = "Πίνακας ελέγχου";
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout with-greeting>
        <HeadingLarge>{{ title }}</HeadingLarge>

        <div class="mt-2 grid gap-2 lg:grid-cols-3">
            <CardContainer>
                <AppLink :href="route('menu.index')">
                    <div class="group relative block h-64">
                        <span
                            class="absolute inset-0 border-2 border-dashed border-primary-500"
                        ></span>

                        <div
                            class="relative flex h-full transform items-end bg-gray-900 transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2"
                        >
                            <div
                                class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8"
                            >
                                <PhFiles size="32" />

                                <HeadingMedium>Κατάλογος</HeadingMedium>
                            </div>

                            <div
                                class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:opacity-100 sm:p-6 lg:p-8"
                            >
                                <div class="flex items-center gap-2">
                                    <HeadingMedium>Κατάλογος</HeadingMedium>
                                    <AppLink
                                        :href="route('menu.create')"
                                        title="Δημιουργία καταλόγου"
                                    >
                                        <PhPlusSquare weight="fill" size="32" />
                                    </AppLink>
                                </div>

                                <p class="mt-4 text-sm sm:text-base">
                                    Δείτε, επεξεργαστείτε και δημιουργήστε νέους
                                    καταλόγους.
                                </p>
                            </div>
                        </div>
                    </div>
                </AppLink>
            </CardContainer>
            <CardContainer>
                <AppLink :href="route('category.index')">
                    <div class="group relative block h-64">
                        <span
                            class="absolute inset-0 border-2 border-dashed border-primary-500"
                        ></span>

                        <div
                            class="relative flex h-full transform items-end bg-gray-900 transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2"
                        >
                            <div
                                class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8"
                            >
                                <PhListBullets size="32" />

                                <HeadingMedium>Κατηγορίες</HeadingMedium>
                            </div>

                            <div
                                class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:opacity-100 sm:p-6 lg:p-8"
                            >
                                <div class="flex items-center gap-2">
                                    <HeadingMedium>Κατηγορίες</HeadingMedium>

                                    <AppLink
                                        :href="route('category.create')"
                                        title="Δημιουργία κατηγορίας"
                                    >
                                        <PhPlusSquare weight="fill" size="32" />
                                    </AppLink>
                                </div>

                                <p class="mt-4 text-sm sm:text-base">
                                    Δείτε, επεξεργαστείτε και δημιουργήστε νέες
                                    κατηγορίες.
                                </p>
                            </div>
                        </div>
                    </div>
                </AppLink>
            </CardContainer>
            <CardContainer>
                <AppLink :href="route('product.index')">
                    <div class="group relative block h-64">
                        <span
                            class="absolute inset-0 border-2 border-dashed border-primary-500"
                        ></span>

                        <div
                            class="relative flex h-full transform items-end bg-gray-900 transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2"
                        >
                            <div
                                class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8"
                            >
                                <PhForkKnife size="32" />

                                <HeadingMedium>Προϊόντα</HeadingMedium>
                            </div>

                            <div
                                class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:opacity-100 sm:p-6 lg:p-8"
                            >
                                <div class="flex items-center gap-2">
                                    <HeadingMedium>Προϊόντα</HeadingMedium>
                                    <AppLink
                                        :href="route('product.create')"
                                        title="Δημιουργία προϊόντος"
                                    >
                                        <PhPlusSquare weight="fill" size="32" />
                                    </AppLink>
                                </div>

                                <p class="mt-4 text-sm sm:text-base">
                                    Δείτε, επεξεργαστείτε και δημιουργήστε νέα
                                    προϊόντα.
                                </p>
                            </div>
                        </div>
                    </div>
                </AppLink>
            </CardContainer>
        </div>
    </AuthenticatedLayout>
</template>
