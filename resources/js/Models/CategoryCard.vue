<script setup lang="ts">
import {formatTitleCase} from "@/Shared/globalFunctions";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";
import {PhForkKnife} from "@phosphor-icons/vue";

const props = defineProps<{
    category: App.Data.CategoryData
}>()
</script>

<template>
<!--    <AppLink :href="route('menu.show', menuType)">-->
        <CardContainer>
            <div class="flex flex-col gap-1">
                <HeadingSmall>
                    {{ formatTitleCase(category.name) }}
                </HeadingSmall>

                <div class="flex items-center gap-1">
                    <PhForkKnife size="16" weight="bold"/>
                    <div>Products:</div>
                    <div>{{ category.totalProducts }}</div>
                </div>
            </div>
        </CardContainer>
<!--    </AppLink>-->
</template>
