<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import BackgroundLines from "@/Components/BackgroundLines.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";

const title = "Coffee, Wine, Kitchen";
</script>

<template>
    <Head :title="title" />

    <div class="relative min-h-screen overflow-auto p-4 scrollbar">
        <BackgroundLines class="absolute" />

        <LandingLayout>
            <div class="relative h-96">
                <div
                    class="absolute inset-0 z-10 flex items-center justify-center"
                >
                    <HeadingLarge class="text-white">
                        Welcome to COUP
                    </HeadingLarge>
                </div>

                <div class="absolute h-full w-full bg-gray-900 opacity-85" />

                <img
                    class="h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1508766917616-d22f3f1eea14?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="COUP-Coffee, Wine, Kitchen"
                />
            </div>

            <div class="bg-white p-2">tabs</div>

            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-2 bg-white p-2"></div>
                <div class="col-span-2 bg-white p-2"></div>
            </div>

            <div class="bg-white p-2"></div>
        </LandingLayout>
    </div>
</template>
