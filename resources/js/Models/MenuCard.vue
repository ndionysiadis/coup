<script setup lang="ts">
import CardContainer from "@/Components/Cards/CardContainer.vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";
import { PhDotsSix, PhForkKnife, PhListBullets } from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";

const props = withDefaults(
    defineProps<{
        menuType: App.Data.Menu.MenuTypeData;
        isDraggable?: boolean;
    }>(),
    {
        isDraggable: false,
    },
);
</script>

<template>
    <AppLink :href="route('menu.show', menuType)">
        <CardContainer>
            <div class="items-top flex justify-between">
                <div class="flex flex-col gap-1">
                    <HeadingSmall>
                        {{ menuType.name }}
                    </HeadingSmall>

                    <div>
                        <div class="flex items-center gap-1">
                            <PhListBullets size="16" weight="bold" />
                            <div>Κατηγορίες:</div>
                            <div>{{ menuType.totalCategories }}</div>
                        </div>
                        <div class="flex items-center gap-1">
                            <PhForkKnife size="16" weight="bold" />
                            <div>Προϊόντα:</div>
                            <div>{{ menuType.totalProducts }}</div>
                        </div>
                    </div>

                    <div class="text-sm text-gray-400">
                        {{ menuType.description }}
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
