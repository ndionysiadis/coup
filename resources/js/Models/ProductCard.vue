<script setup lang="ts">
import {formatTitleCase} from "@/Shared/globalFunctions";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";
import {PhChefHat, PhListBullets} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import TextLink from "@/Components/Links/TextLink.vue";

const props = defineProps<{
    product: App.Data.ProductData
}>()
</script>

<template>
    <AppLink :href="route('product.show', product)">
        <CardContainer>
            <div class="flex flex-col gap-1">
                <HeadingSmall>
                    {{ formatTitleCase(product.name) }} - {{ product.price }} &#8364;
                </HeadingSmall>

                <div v-if="route().current('product.*')"
                    class="flex items-center gap-1">
                    <PhListBullets size="16" weight="bold"/>
                    <div>Category:</div>
                    <div v-if="product.category">
                        <TextLink :href="route('category.show', product.category)">
                            {{ product.category.name }}
                        </TextLink>
                    </div>
                </div>

                <div v-if="route().current('product.*')"
                    class="flex items-center gap-1">
                    <PhChefHat size="16" weight="bold"/>
                    <div>Menu:</div>
                    <div v-if="product.category?.menuType.name">
                        <TextLink :href="route('menu.show', product.category.menuType)">
                            {{ formatTitleCase(product.category.menuType.name) }}
                        </TextLink>
                    </div>
                </div>

                <div v-if="product.description">
                    {{product.description}}
                </div>
            </div>
        </CardContainer>
    </AppLink>
</template>
