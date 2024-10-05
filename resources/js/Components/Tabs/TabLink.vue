<script setup lang="ts">
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
    <div class="flex-1">
        <Link v-if="!blank" :href="href">
            <div
                :class="[
                    'delay-50 w-full rounded-md p-1.5 text-center text-sm outline-none transition ease-in-out',
                    selected
                        ? 'bg-primary-100 text-primary-600 dark:bg-primary-900 dark:text-gray-100 dark:ring-1 dark:ring-primary-600'
                        : 'cursor-pointer hover:bg-primary-100 hover:text-primary-600 dark:text-gray-100 hover:dark:bg-primary-900 hover:dark:text-gray-100',
                ]"
            >
                <slot />
            </div>
        </Link>
        <a v-else :href="href" target="_blank">
            <div
                :class="[
                    'delay-50 w-full rounded-md p-1.5 text-center text-sm outline-none transition ease-in-out',
                    selected
                        ? 'bg-primary-100 text-primary-600 dark:bg-primary-900 dark:text-gray-100 dark:ring-1 dark:ring-primary-600'
                        : 'cursor-pointer hover:bg-primary-100 hover:text-primary-600 dark:text-gray-100 hover:dark:bg-primary-900 hover:dark:text-gray-100',
                ]"
            >
                <slot />
            </div>
        </a>
    </div>
</template>
