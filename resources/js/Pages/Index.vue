<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import BackgroundLines from "@/Components/BackgroundLines.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import SecondaryButtonIcon from "@/Components/Buttons/SecondaryButtonIcon.vue";
import { PhArrowRight } from "@phosphor-icons/vue";
import Tabs from "@/Components/Tabs/Tabs.vue";
import TabItems from "@/Components/Tabs/TabItems.vue";
import TabContents from "@/Components/Tabs/TabContents.vue";
import MenuTabContent from "@/Components/Tabs/MenuTabContent.vue";
import MenuTab from "@/Components/Tabs/MenuTab.vue";

const title = "Coffee, Wine, Kitchen";

const props = defineProps<{
    menus: App.Data.Menu.MenuTypeData[];
}>();
</script>

<template>
    <Head :title="title" />

    <div class="relative min-h-screen overflow-auto p-4 scrollbar">
        <BackgroundLines class="absolute" />

        <LandingLayout>
            <div class="relative h-96">
                <div
                    class="absolute inset-0 z-10 flex flex-col items-center justify-center gap-8"
                >
                    <div class="flex flex-col items-center gap-2">
                        <HeadingLarge class="text-white">
                            Καλώς ήρθατε στο COUP
                        </HeadingLarge>

                        <div class="text-lg text-white">
                            Coffee, Wine, Kitchen
                        </div>
                    </div>

                    <SecondaryButtonIcon direction="right">
                        <template #icon>
                            <PhArrowRight size="16" />
                        </template>
                        Ανακαλύψτε τον online κατάλογο μας
                    </SecondaryButtonIcon>
                </div>

                <div class="absolute h-full w-full bg-gray-900 opacity-75" />

                <img
                    class="h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1508766917616-d22f3f1eea14?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="COUP-Coffee, Wine, Kitchen"
                />
            </div>

            <div class="bg-white p-2">
                <Tabs>
                    <TabItems>
                        <MenuTab
                            v-for="menu in menus"
                            :key="menu.id"
                            :menu="menu"
                        >
                            {{ menu.name }}
                        </MenuTab>
                    </TabItems>

                    <TabContents>
                        <MenuTabContent />
                    </TabContents>
                </Tabs>
            </div>

            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-2 bg-white p-2"></div>
                <div class="col-span-2 bg-white p-2"></div>
            </div>

            <div class="bg-white p-2"></div>
        </LandingLayout>
    </div>
</template>
