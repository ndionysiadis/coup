<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import BackgroundLines from "@/Components/BackgroundLines.vue";

const title = "Coffee, Wine, Kitchen";
</script>

<template>
    <Head :title="title" />

    <div class="relative min-h-screen p-4">
        <BackgroundLines class="absolute" />
        <LandingLayout> </LandingLayout>
    </div>
</template>
