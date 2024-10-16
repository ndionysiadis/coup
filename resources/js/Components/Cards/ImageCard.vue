<script setup lang="ts">
import { computed } from "vue";
import { PhImageSquare } from "@phosphor-icons/vue";

const props = withDefaults(
    defineProps<{
        imageUrl: string | null;
        altText: string;
    }>(),
    {},
);

const fullImageUrl = computed(() => {
    return props.imageUrl ? `/storage/images/products/${props.imageUrl}` : null;
});
</script>

<template>
    <img v-if="fullImageUrl" :src="fullImageUrl" :alt="altText" />

    <div v-else class="flex items-center justify-center bg-gray-700 p-2">
        <PhImageSquare size="32" />
    </div>
</template>
