<script setup lang="ts">
import ApplicationLogoFull from "@/Components/ApplicationLogoFull.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import { PhDotsSixVertical, PhSignIn } from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";

const links = [
    {
        name: "Μενού",
        href: "#",
    },

    {
        name: "Σχετικά",
        href: "#",
    },

    {
        name: "Αξιολογήσεις",
        href: "#",
    },
];
</script>

<template>
    <div class="grid grid-cols-3 items-center bg-gray-800 p-1.5 md:p-4">
        <!--        Desktop Menu-->
        <div class="ml-2 hidden justify-start md:flex">
            <div class="flex items-center gap-4 text-primary-100">
                <span
                    v-for="link in links"
                    class="cursor-pointer px-4 py-1 transition duration-150 ease-in-out hover:bg-gray-600"
                >
                    {{ link.name }}
                </span>
            </div>
        </div>

        <!--        Mobile Menu-->
        <Popover class="relative block md:hidden">
            <PopoverButton class="ml-2 flex justify-start md:hidden">
                <IconSecondaryButton>
                    <PhDotsSixVertical weight="bold" size="16" />
                </IconSecondaryButton>
            </PopoverButton>

            <transition
                enter-active-class="transition ease-out duration-200"
                enter-from-class="opacity-0 translate-y-1"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition ease-in duration-150"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 translate-y-1"
            >
                <PopoverPanel
                    class="absolute left-auto z-10 mt-5 flex w-screen max-w-min -translate-x-1.5 flex-col gap-4 bg-gray-800 p-2 text-primary-100"
                >
                    <span
                        v-for="link in links"
                        class="cursor-pointer px-4 py-2 transition duration-150 ease-in-out hover:bg-gray-600"
                    >
                        {{ link.name }}
                    </span>
                </PopoverPanel>
            </transition>
        </Popover>
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
