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
<span class="cursor-pointer">
     <Link v-if="!blank" :href="href">
        <slot/>
     </Link>

     <a v-else :href="href" target="_blank">
            <slot/>
     </a>
</span>
</template>
