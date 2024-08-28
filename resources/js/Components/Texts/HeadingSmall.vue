<script setup lang="ts">
defineProps<{
    id?: string,
}>()
</script>

<template>
    <div class="text-2xl font-heading text-primary-300">
        <a v-if="id" :href="'#' + id">
            <h3  :id="id">
                <slot/>
            </h3>
        </a>

        <h3 v-else>
            <slot/>
        </h3>
    </div>
</template>
