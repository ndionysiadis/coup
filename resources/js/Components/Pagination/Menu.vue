<script setup lang="ts">
import ApplicationLogoFull from "@/Components/ApplicationLogoFull.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import { PhDotsSixVertical, PhSignIn } from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
</script>

<template>
    <div class="grid grid-cols-3 items-center bg-gray-800 p-1.5 md:p-4">
        <!--        Desktop Menu-->
        <div class="ml-2 hidden justify-start md:flex">
            <div class="flex items-center gap-4 text-primary-100">
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

        <!--        Mobile Menu-->
        <div class="ml-2 flex justify-start md:hidden">
            <AppLink :href="route('login')">
                <IconSecondaryButton>
                    <PhDotsSixVertical weight="bold" size="16" />
                </IconSecondaryButton>
            </AppLink>
        </div>

        <!--        Mobile Menu End-->

        <div class="mx-auto w-24 fill-primary-500 md:w-32">
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
