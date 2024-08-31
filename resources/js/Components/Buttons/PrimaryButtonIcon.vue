<script setup lang="ts">
const props = withDefaults(
    defineProps<{
        direction?: 'left' | 'right'
    }>(),
    {
        direction: 'left'
    }
)
</script>

<template>
    <button
        type="button"
        class="group relative inline-flex items-center overflow-hidden bg-primary-600 px-8 py-2 text-white
                   focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-0 active:bg-primary-500">

        <span
            v-if="direction === 'left'"
            class="absolute -start-full transition-all group-hover:start-4">
            <slot name="icon"/>
        </span>

        <span
            v-if="direction === 'right'"
            class="absolute -end-full transition-all group-hover:end-4">
            <slot name="icon"/>
        </span>

        <span
            class="text-sm font-medium transition-all"
            :class="direction === 'left' ? 'group-hover:ms-4' : 'group-hover:me-4'">
            <slot/>
        </span>

    </button>
</template>
