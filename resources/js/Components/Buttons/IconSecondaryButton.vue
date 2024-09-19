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
        class="bg-transparent p-2.5 text-sm text-white ring-1 ring-inset ring-primary-500 transition duration-150 ease-in-out hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-0 active:bg-gray-700"
    >
        <slot />
    </button>
</template>
