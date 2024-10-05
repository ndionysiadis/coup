<script setup lang="ts">
import { TabList } from "@headlessui/vue";
</script>

<template>
    <TabList class="flex gap-2 bg-gray-800 p-2">
        <slot />
    </TabList>
</template>
