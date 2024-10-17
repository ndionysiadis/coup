<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogoFull.vue";
import { Link } from "@inertiajs/vue3";
import BackgroundLines from "@/Components/BackgroundLines.vue";
</script>

<template>
    <div
        class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden bg-gray-900 pb-20"
    >
        <BackgroundLines class="absolute" />

        <div class="mb-6 flex w-full justify-center">
            <Link href="/">
                <ApplicationLogo
                    class="w-32 fill-current text-primary-500 sm:w-44"
                />
            </Link>
        </div>

        <div
            class="z-10 mt-6 w-full overflow-hidden bg-gray-800 px-4 py-6 shadow-2xl shadow-gray-950/50 sm:max-w-md sm:px-6"
        >
            <slot />
        </div>

        <div class="absolute inset-x-0 bottom-3 px-4 sm:px-0">
            <slot name="bottom" />
        </div>
    </div>
</template>
