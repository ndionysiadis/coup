<script setup lang="ts">
withDefaults(
    defineProps<{
        type?: "button" | "submit" | "reset";
    }>(),
    {
        type: "button",
    },
);
</script>

<template>
    <button
        :type="type"
        class="bg-primary-600 p-2.5 text-sm text-white transition duration-150 ease-in-out hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-0 active:bg-primary-500"
    >
        <slot />
    </button>
</template>
