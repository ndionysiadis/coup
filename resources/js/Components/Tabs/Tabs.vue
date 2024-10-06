<script setup lang="ts">
import {TabGroup} from '@headlessui/vue'

const props = defineProps<{
    defaultIndex?: number
}>()
</script>

<template>
    <div class="w-full px-2 sm:px-0">
        <TabGroup :defaultIndex="defaultIndex">
            <slot/>
        </TabGroup>
    </div>
</template>
