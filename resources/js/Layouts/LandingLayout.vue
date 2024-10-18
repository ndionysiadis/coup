<script setup lang="ts">
import Footer from "@/Components/Pagination/Footer.vue";
</script>

<template>
    <div class="relative z-10 flex flex-col gap-4">
        <slot />
        <Footer />
    </div>
</template>

<style scoped></style>
