<script setup lang="ts">
defineProps<{
    id?: string;
}>();
</script>

<template>
    <div class="font-heading text-4xl text-primary-300">
        <a v-if="id" :href="'#' + id">
            <h1 :id="id">
                <slot />
            </h1>
        </a>

        <h1 v-else>
            <slot />
        </h1>
    </div>
</template>
