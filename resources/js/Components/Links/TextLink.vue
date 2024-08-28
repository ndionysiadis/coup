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
<span class="text-sm underline text-primary-50 underline-offset-4 decoration-primary-50 hover:decoration-2 cursor-pointer">
  <Link
      v-if="!blank"
      :href="href"
      class="focus:outline-none focus:ring-2 focus:ring-primary-400 rounded-md"
  >
    <slot/>
  </Link>

  <a
      v-else
      :href="href"
      target="_blank"
      class="focus:outline-none focus:ring-2 focus:ring-primary-400 rounded-md"
  >
    <slot/>
  </a>
</span>

</template>
