<script setup lang="ts">
import CardContainer from "@/Components/Cards/CardContainer.vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";
import { PhArrowCounterClockwise } from "@phosphor-icons/vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps<{
    menuType: App.Data.Menu.MenuTypeData;
}>();

function restore() {
    router.post(route("menu.restore", props.menuType.id as number), {
        preserveState: true,
        preserveScroll: true,
        only: ["toast"],
    });
}
</script>

<template>
    <CardContainer>
        <div class="items-top group flex justify-between">
            <div class="flex flex-col gap-1">
                <HeadingSmall>
                    {{ menuType.name }}
                </HeadingSmall>

                <div class="text-sm text-gray-400">
                    {{ menuType.description }}
                </div>
            </div>

            <div
                @click="restore"
                title="Επαναφορά"
                class="hidden group-hover:block"
                v-motion-pop-visible
            >
                <IconSecondaryButton>
                    <PhArrowCounterClockwise weight="bold" size="16" />
                </IconSecondaryButton>
            </div>
        </div>
    </CardContainer>
</template>
