<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { Tab } from "@headlessui/vue";

const props = withDefaults(
    defineProps<{
        href?: string;
        blank?: boolean;
        selected?: boolean;
    }>(),
    {
        blank: false,
    },
);
</script>

<template>
    <Tab as="div" v-slot="{ selected }" class="flex-1">
        <template v-if="href">
            <Link v-if="!blank" :href="href">
                <div
                    :class="[
                        'w-full p-2 text-center text-sm text-white transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-0',
                        selected
                            ? 'bg-primary-600'
                            : 'cursor-pointer ring-1 ring-inset ring-primary-500 hover:bg-gray-700',
                    ]"
                >
                    <slot />
                </div>
            </Link>
            <a v-else :href="href" target="_blank">
                <div
                    :class="[
                        'w-full p-2 text-center text-sm text-white transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-0',
                        selected
                            ? 'bg-primary-600'
                            : 'cursor-pointer ring-1 ring-inset ring-primary-500 hover:bg-gray-700',
                    ]"
                >
                    <slot />
                </div>
            </a>
        </template>
        <template v-else>
            <div
                :class="[
                    'w-full p-2 text-center text-sm text-white transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-0',
                    selected
                        ? 'bg-primary-600'
                        : 'cursor-pointer ring-1 ring-inset ring-primary-500 hover:bg-gray-700',
                ]"
            >
                <slot />
            </div>
        </template>
    </Tab>
</template>
