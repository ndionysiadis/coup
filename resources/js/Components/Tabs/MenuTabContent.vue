<script setup lang="ts">
import TabContent from "@/Components/Tabs/TabContent.vue";
import HeadingMedium from "@/Components/Texts/HeadingMedium.vue";
import ImageCard from "@/Components/Cards/ImageCard.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";

const props = defineProps<{
    menu: App.Data.Menu.MenuTypeData;
}>();
</script>

<template>
    <TabContent>
        <div>
            <div class="flex flex-col text-center">
                <HeadingLarge>{{ menu.name }}</HeadingLarge>
                <div class="text-sm text-gray-400">
                    {{ menu.description }}
                </div>
            </div>

            <div v-for="category in menu.categories" :key="category.id">
                <div>
                    <HeadingMedium>{{ category.name }}</HeadingMedium>
                    <div class="text-sm text-gray-400">
                        {{ category.description }}
                    </div>
                </div>

                <div class="my-2 w-full border-t border-gray-600" />

                <ul class="text-white">
                    <li
                        v-for="product in category.products"
                        :key="product.id"
                        class="mb-2"
                    >
                        <div class="flex items-center gap-2">
                            <ImageCard
                                class="size-20"
                                :image-url="product.image"
                                :alt-text="product.name"
                            />

                            <div class="flex flex-1 flex-col">
                                <div class="flex items-center justify-between">
                                    <div>{{ product.name }}</div>
                                    <div>{{ product.price }} &#8364;</div>
                                </div>

                                <div class="text-sm text-gray-400">
                                    {{ product.description }}
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div></TabContent
    >
</template>
