<script setup lang="ts">
import { PhCheck } from "@phosphor-icons/vue";

const props = defineProps<{
    active: boolean;
    selected: boolean;
}>();
</script>

<template>
    <li
        :class="[
            active ? 'bg-primary-100 text-primary-900' : 'text-gray-900',
            'relative cursor-pointer select-none py-2 pl-10 pr-4',
        ]"
    >
        <span
            :class="[
                selected ? 'font-medium' : 'font-normal',
                'block truncate',
            ]"
        >
            <slot />
        </span>

        <span
            v-if="selected"
            class="absolute inset-y-0 left-0 flex items-center pl-3"
            :class="{
                'text-white dark:text-primary': active,
                'text-gray-600 dark:text-primary-300': !active,
            }"
        >
            <PhCheck weight="bold" size="16" />
        </span>
    </li>
</template>
