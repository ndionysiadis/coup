<script setup lang="ts">
import {Link} from "@inertiajs/vue3";

const props = withDefaults(defineProps<{
    href: string,
    blank?: boolean
}>(), {
    blank: false
})
</script>

<template>
    <Link v-if="!blank" :href="href" class="cursor-pointer">
        <slot/>
    </Link>

    <a v-else :href="href" target="_blank" class="cursor-pointer">
        <slot/>
    </a>
</template>
