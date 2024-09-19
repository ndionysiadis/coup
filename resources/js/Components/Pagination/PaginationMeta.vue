<script setup lang="ts">
import { PhCards } from "@phosphor-icons/vue";

const props = defineProps<{
    meta: LaravelPaginatorMeta;
}>();
</script>

<template>
    <div
        class="flex items-center gap-2 text-sm text-white"
        v-if="meta.total > 0"
    >
        <PhCards weight="bold" />
        {{ meta.from }} - {{ meta.to }} από {{ meta.total }}
    </div>
</template>
