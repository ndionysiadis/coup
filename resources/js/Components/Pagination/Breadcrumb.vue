<script setup lang="ts">
import AppLink from "@/Components/Links/AppLink.vue";
import { PhCaretRight } from "@phosphor-icons/vue";

const props = defineProps<{
    href?: string;
    first?: boolean;
}>();
</script>

<template>
    <li class="flex">
        <div class="flex items-center gap-1 text-sm text-white">
            <PhCaretRight v-if="!first" weight="bold" />

            <AppLink
                v-if="href"
                :href="href"
                class="transition duration-150 ease-in-out hover:text-gray-400"
            >
                <slot />
            </AppLink>
        </div>
    </li>
</template>
