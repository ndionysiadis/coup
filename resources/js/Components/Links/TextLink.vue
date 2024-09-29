<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

const props = withDefaults(
    defineProps<{
        href: string;
        blank?: boolean;
    }>(),
    {
        blank: false,
    },
);
</script>

<template>
    <span
        class="cursor-pointer text-sm text-primary-50 underline decoration-primary-50 underline-offset-4 hover:decoration-2"
    >
        <Link
            v-if="!blank"
            :href="href"
            class="rounded-md focus:outline-none focus:ring-2 focus:ring-primary-400"
        >
            <slot />
        </Link>

        <a
            v-else
            :href="href"
            target="_blank"
            class="rounded-md focus:outline-none focus:ring-2 focus:ring-primary-400"
        >
            <slot />
        </a>
    </span>
</template>
