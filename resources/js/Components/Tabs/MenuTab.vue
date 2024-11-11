<script setup lang="ts">
import Tab from "@/Components/Tabs/Tab.vue";

const props = defineProps<{
    menu: App.Data.Menu.MenuTypeData;
}>();
</script>

<template>
    <Tab>{{ menu.name }}</Tab>
</template>
