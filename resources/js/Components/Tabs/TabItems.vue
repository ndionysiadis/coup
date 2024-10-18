<script setup lang="ts">
import { TabList } from "@headlessui/vue";
</script>

<template>
    <TabList class="flex flex-col gap-2 bg-gray-800 pt-2 sm:pt-4 md:flex-row">
        <slot />
    </TabList>
</template>
