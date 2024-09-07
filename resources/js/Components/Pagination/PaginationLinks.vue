<script setup lang="ts">
import {router} from "@inertiajs/vue3";

const props = defineProps<{
    links: LaravelPaginatorLink[]
}>()

const emit = defineEmits<{
    (e: 'linkClicked', id: string): void
}>()

const linkClicked = (url: string) => {
    router.get(
        url,
        {
            preserveState: true,
            preserveScroll: true,
        }
    )
}
</script>

<template>
    <div v-if="links?.length > 3" class="flex lg:justify-end text-xs">
        <div class="flex flex-wrap justify-start lg:justify-end">
            <template v-for="(link, index) in links" :key="index">
                <div v-if="!link.url"
                     class="px-4 text-gray-400 h-9 flex items-center justify-center text-center leading-4 border border-gray-600"
                     :class="[
                         index !== links?.length - 1 ? 'mr-1' : ''
                     ]"
                     v-html="link.label"/>

                <div
                    @click="linkClicked(link.url)"
                    v-else
                    class="text-gray-400 focus:border-primary-50 focus:text-primary cursor-pointer transition ease-in-out delay-20 h-9 flex items-center justify-center text-center leading-4"
                    :class="[
                        link.active ? 'bg-primary-600 text-white border border-primary-600' : 'hover:bg-gray-800 border border-gray-600',
                        parseInt(link.label) ? 'w-9' : 'px-4',
                        index !== links.length - 1 ? 'mr-1' : ''
                    ]"
                    v-html="link.label"/>
            </template>
        </div>
    </div>
</template>
