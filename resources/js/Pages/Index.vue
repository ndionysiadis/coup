<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import BackgroundLines from "@/Components/BackgroundLines.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import SecondaryButtonIcon from "@/Components/Buttons/SecondaryButtonIcon.vue";
import {
    PhArrowRight,
    PhBookOpenText,
    PhInstagramLogo,
    PhStar,
} from "@phosphor-icons/vue";
import Tabs from "@/Components/Tabs/Tabs.vue";
import TabItems from "@/Components/Tabs/TabItems.vue";
import TabContents from "@/Components/Tabs/TabContents.vue";
import MenuTabContent from "@/Components/Tabs/MenuTabContent.vue";
import MenuTab from "@/Components/Tabs/MenuTab.vue";
import { onMounted } from "vue";
import HeadingMedium from "@/Components/Texts/HeadingMedium.vue";

const title = "Coffee, Wine, Kitchen";

const props = defineProps<{
    menus: App.Data.Menu.MenuTypeData[];
}>();

onMounted(() => {
    const script = document.createElement("script");
    script.src = "https://cdn.lightwidget.com/widgets/lightwidget.js";
    script.async = true;
    document.body.appendChild(script);
});
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

            <div
                v-if="menus.length > 0"
                class="max-h-[650px] overflow-auto bg-gray-800 p-2 scrollbar"
            >
                <Tabs>
                    <TabItems>
                        <MenuTab
                            v-for="menu in menus"
                            :key="menu.id"
                            :menu="menu"
                        />
                    </TabItems>

                    <TabContents>
                        <MenuTabContent
                            v-for="menu in menus"
                            :key="menu.id"
                            :menu="menu"
                        />
                    </TabContents>
                </Tabs>
            </div>

            <div class="grid grid-cols-4 gap-4">
                <div
                    class="col-span-2 max-h-72 overflow-auto bg-gray-800 p-2 scrollbar"
                >
                    <div class="mb-2 flex items-center gap-2">
                        <PhBookOpenText
                            weight="fill"
                            size="32"
                            class="text-primary-400"
                        />
                        <HeadingMedium id="about-us">Σχετικά</HeadingMedium>
                    </div>

                    <div class="text-white">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ab alias amet atque cum debitis deleniti dolore
                        eius esse ex excepturi exercitationem expedita facere
                        fuga, illo ipsa, magni modi nihil odio placeat possimus
                        quas quis quo repellat reprehenderit similique suscipit
                        temporibus tenetur vel vero voluptatum! Alias asperiores
                        delectus enim, incidunt ipsa numquam perspiciatis
                        provident, reiciendis similique sint sunt velit vitae
                        voluptates. A ad amet blanditiis, consequuntur
                        cupiditate eos esse excepturi, expedita hic inventore
                        ipsa, libero nobis non nulla quibusdam repellendus
                        tempora vero. Cum deserunt eligendi, eum iure molestiae
                        repellendus totam. Aliquid asperiores deleniti inventore
                        ipsum molestiae numquam quod vero voluptas.
                    </div>
                </div>

                <div
                    class="col-span-2 max-h-72 overflow-auto bg-gray-800 p-2 scrollbar"
                >
                    <div class="flex items-center gap-2">
                        <PhInstagramLogo
                            weight="fill"
                            size="32"
                            class="text-primary-400"
                        />
                        <HeadingMedium id="instagram">Instagram</HeadingMedium>
                    </div>
                    <iframe
                        src="//lightwidget.com/widgets/d2d697d22f80545fbbf4857152f2b0f9.html"
                        scrolling="no"
                        allowtransparency="true"
                        class="lightwidget-widget"
                        style="width: 100%; border: 0; overflow: hidden"
                    ></iframe>
                </div>
            </div>

            <div class="bg-gray-800 p-2">
                <div class="flex items-center gap-2">
                    <PhStar weight="fill" size="32" class="text-primary-400" />
                    <HeadingMedium id="reviews">Αξιολογήσεις</HeadingMedium>
                </div>
            </div>
        </LandingLayout>
    </div>
</template>
