<script setup lang="ts">
import Tab from "@/Components/Tabs/Tab.vue";

const props = defineProps<{
    menuType: App.Data.Menu.MenuTypeData;
}>();
</script>

<template>
    <Tab>{{ menuType.name }}</Tab>
</template>
