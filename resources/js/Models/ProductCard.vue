<script setup lang="ts">
import CardContainer from "@/Components/Cards/CardContainer.vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";
import { PhDotsSix, PhListBullets } from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import TextLink from "@/Components/Links/TextLink.vue";

const props = withDefaults(
    defineProps<{
        product: App.Data.Product.ProductData;
        isDraggable?: boolean;
    }>(),
    {
        isDraggable: false,
    },
);
</script>

<template>
    <AppLink :href="route('product.show', product)">
        <CardContainer>
            <div class="items-top flex justify-between">
                <div class="flex flex-col gap-1">
                    <HeadingSmall>
                        {{ product.name }} <span v-if="product.price">-</span>
                        {{ product.price
                        }}<span v-if="product.price">&#8364;</span>
                    </HeadingSmall>

                    <div
                        v-if="route().current('product.*')"
                        class="flex items-center gap-1"
                    >
                        <PhListBullets size="16" weight="bold" />
                        <div>Category:</div>
                        <div v-if="product.category">
                            <TextLink
                                :href="route('category.show', product.category)"
                            >
                                {{ product.category.name }}
                            </TextLink>
                        </div>
                    </div>

                    <div v-if="product.description">
                        {{ product.description }}
                    </div>
                </div>

                <div
                    v-if="isDraggable"
                    class="cursor-grab active:cursor-grabbing"
                >
                    <PhDotsSix weight="bold" size="22" />
                </div>
            </div>
        </CardContainer>
    </AppLink>
</template>
