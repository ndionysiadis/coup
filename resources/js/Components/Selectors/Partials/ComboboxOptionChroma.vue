<script setup lang="ts">
import {ComboboxOption} from "@headlessui/vue";

const props = defineProps<{
    as: string,
    value: any
}>()
</script>

<template>
    <ComboboxOption
        :as="as"
        :value="value"
        v-slot="{selected, active}"
    >
        <slot :active="active" :selected="selected"/>
    </ComboboxOption>
</template>
