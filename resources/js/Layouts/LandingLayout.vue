<script setup lang="ts">
import Menu from "@/Components/Pagination/Menu.vue";
import Footer from "@/Components/Pagination/Footer.vue";
</script>

<template>
    <div class="relative z-10 flex flex-col gap-4">
        <Menu />
        <slot />
        <Footer />
    </div>
</template>

<style scoped></style>
