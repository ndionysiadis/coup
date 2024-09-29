<script setup lang="ts">
import { router } from "@inertiajs/vue3";

const props = defineProps<{
    links: LaravelPaginatorLink[];
}>();

const emit = defineEmits<{
    (e: "linkClicked", id: string): void;
}>();

const linkClicked = (url: string) => {
    router.get(url, {
        preserveState: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <div v-if="links?.length > 3" class="flex text-xs lg:justify-end">
        <div class="flex flex-wrap justify-start lg:justify-end">
            <template v-for="(link, index) in links" :key="index">
                <div
                    v-if="!link.url"
                    class="flex h-9 items-center justify-center border border-gray-600 px-4 text-center leading-4 text-gray-400"
                    :class="[index !== links?.length - 1 ? 'mr-1' : '']"
                    v-html="link.label"
                />

                <div
                    @click="linkClicked(link.url)"
                    v-else
                    class="delay-20 flex h-9 cursor-pointer items-center justify-center text-center leading-4 text-gray-400 transition ease-in-out focus:border-primary-50 focus:text-primary"
                    :class="[
                        link.active
                            ? 'border border-primary-600 bg-primary-600 text-white'
                            : 'border border-gray-600 hover:bg-gray-800',
                        parseInt(link.label) ? 'w-9' : 'px-4',
                        index !== links.length - 1 ? 'mr-1' : '',
                    ]"
                    v-html="link.label"
                />
            </template>
        </div>
    </div>
</template>
