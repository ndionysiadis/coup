<script setup lang="ts">
defineProps<{
    id?: string,
}>()
</script>

<template>
    <div class="text-3xl font-heading text-primary-300">
        <a v-if="id" :href="'#' + id">
            <h2 :id="id">
                <slot/>
            </h2>
        </a>

        <h2 v-else>
            <slot/>
        </h2>
    </div>
</template>
