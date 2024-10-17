<script setup lang="ts">
import ApplicationLogoFull from "@/Components/ApplicationLogoFull.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import { PhSignIn } from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
</script>

<template>
    <div class="grid grid-cols-3 items-center bg-gray-800 p-4">
        <div class="ml-2 flex justify-start">
            <div class="flex items-center gap-8 text-primary-100">
                <span
                    class="cursor-pointer px-4 py-1 transition duration-150 ease-in-out hover:bg-gray-600"
                >
                    Μενού
                </span>

                <span
                    class="cursor-pointer px-4 py-1 transition duration-150 ease-in-out hover:bg-gray-600"
                >
                    Σχετικά
                </span>

                <span
                    class="cursor-pointer px-4 py-1 transition duration-150 ease-in-out hover:bg-gray-600"
                >
                    Αξιολογήσεις
                </span>
            </div>
        </div>

        <div class="mx-auto w-32 fill-primary-500">
            <ApplicationLogoFull />
        </div>

        <div class="mr-2 flex justify-end">
            <AppLink :href="route('login')">
                <IconSecondaryButton>
                    <PhSignIn weight="bold" size="16" />
                </IconSecondaryButton>
            </AppLink>
        </div>
    </div>
</template>

<style scoped></style>
