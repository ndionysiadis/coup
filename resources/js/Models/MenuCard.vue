<script setup lang="ts">
import {formatTitleCase} from "@/Shared/globalFunctions";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";
import {PhForkKnife, PhListBullets} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";

const props = defineProps<{
    menuType: App.Data.MenuTypeData
}>()
</script>

<template>
    <AppLink :href="route('menu.show', menuType)">
        <CardContainer>
            <div class="flex flex-col gap-1">
                <HeadingSmall>
                    {{ formatTitleCase(menuType.name) }}
                </HeadingSmall>

                <div>
                    <div class="flex items-center gap-1">
                        <PhListBullets size="16" weight="bold"/>
                        <div>Categories:</div>
                        <div>{{ menuType.totalCategories }}</div>
                    </div>
                    <div class="flex items-center gap-1">
                        <PhForkKnife size="16" weight="bold"/>
                        <div>Products:</div>
                        <div>{{ menuType.totalProducts }}</div>
                    </div>
                </div>

                <div class="text-sm text-gray-400">
                    {{ menuType.description }}
                </div>
            </div>
        </CardContainer>
    </AppLink>
</template>
