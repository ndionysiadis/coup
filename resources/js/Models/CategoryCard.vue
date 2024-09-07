<script setup lang="ts">
import CardContainer from "@/Components/Cards/CardContainer.vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";
import {PhChefHat, PhForkKnife} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import TextLink from "@/Components/Links/TextLink.vue";

const props = defineProps<{
    category: App.Data.CategoryData
}>()
</script>

<template>
    <AppLink :href="route('category.show', category)">
        <CardContainer>
            <div class="flex flex-col gap-1">
                <HeadingSmall>
                    {{ category.name }}
                </HeadingSmall>

                <div class="flex items-center gap-1">
                    <PhForkKnife size="16" weight="bold"/>
                    <div>Προϊόντα:</div>
                    <div>{{ category.totalProducts }}</div>
                </div>

                <div v-if="route().current('category.*')"
                    class="flex items-center gap-1">
                    <PhChefHat size="16" weight="bold"/>
                    <div>Μενού:</div>
                    <div v-if="category.menuType">
                        <TextLink :href="route('menu.show', category.menuType)">
                            {{ category.menuType.name }}
                        </TextLink>
                    </div>
                </div>
            </div>
        </CardContainer>
    </AppLink>
</template>
