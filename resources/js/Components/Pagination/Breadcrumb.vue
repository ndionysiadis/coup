<script setup lang="ts">
import AppLink from "@/Components/Links/AppLink.vue";
import {PhCaretRight} from "@phosphor-icons/vue";

const props = defineProps<{
    href?: string,
    first?: boolean
}>()
</script>

<template>
    <li class="flex">
        <div class="flex items-center text-sm text-white gap-1">
            <PhCaretRight v-if="!first" weight="bold"/>

            <AppLink v-if="href" :href="href" class="hover:text-gray-400 transition duration-150 ease-in-out">
                <slot/>
            </AppLink>
        </div>
    </li>
</template>
