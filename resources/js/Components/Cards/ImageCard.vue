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
    <img
        v-viewer
        v-if="fullImageUrl"
        :src="fullImageUrl"
        :alt="altText"
        class="cursor-pointer"
    />
    <div
        v-else
        class="flex size-20 items-center justify-center bg-gray-700 text-gray-400"
    >
        <PhImageSquare size="42" />
    </div>
</template>
