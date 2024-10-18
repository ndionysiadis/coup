<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import BackgroundLines from "@/Components/BackgroundLines.vue";
import { PhBookOpenText, PhInstagramLogo } from "@phosphor-icons/vue";
import Tabs from "@/Components/Tabs/Tabs.vue";
import TabItems from "@/Components/Tabs/TabItems.vue";
import TabContents from "@/Components/Tabs/TabContents.vue";
import MenuTabContent from "@/Components/Tabs/MenuTabContent.vue";
import MenuTab from "@/Components/Tabs/MenuTab.vue";
import { onMounted } from "vue";
import HeadingMedium from "@/Components/Texts/HeadingMedium.vue";
import ApplicationLogoFull from "@/Components/ApplicationLogoFull.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import HeadingTiny from "@/Components/Texts/HeadingTiny.vue";

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
            <div class="group relative h-96">
                <div
                    class="absolute inset-0 z-10 flex flex-col justify-center px-6"
                >
                    <div class="flex flex-col items-center gap-6 text-center">
                        <AppLink
                            :href="route('index')"
                            class="w-24 fill-white lg:w-32"
                        >
                            <ApplicationLogoFull />
                        </AppLink>

                        <div class="w-full md:grid md:grid-cols-12">
                            <div
                                v-motion-slide-visible-once-left
                                :delay="700"
                                :duration="700"
                                class="col-span-3 flex items-center gap-2"
                            >
                                <HeadingTiny class="text-white/50">
                                    ESTB
                                </HeadingTiny>
                                <div
                                    class="my-2 w-full border-t border-white/50"
                                />
                            </div>
                            <div
                                class="font-title col-span-6 flex flex-col items-center text-3xl text-white md:text-4xl lg:text-5xl"
                            >
                                <div
                                    v-motion-fade-visible-once
                                    :delay="250"
                                    :duration="800"
                                >
                                    <span class="text-primary"> Coffee </span>
                                    to start,
                                </div>
                                <div
                                    v-motion-fade-visible-once
                                    :delay="350"
                                    :duration="800"
                                >
                                    <span class="text-primary"> Wine </span>
                                    to unwind,
                                </div>
                                <div
                                    v-motion-fade-visible-once
                                    :delay="450"
                                    :duration="800"
                                >
                                    <span class="text-primary"> Dishes </span>
                                    to remember
                                </div>
                            </div>
                            <div
                                v-motion-slide-visible-once-right
                                :delay="700"
                                :duration="700"
                                class="col-span-3 flex items-center gap-2"
                            >
                                <div class="w-full border-t border-white/50" />
                                <HeadingTiny class="text-white/50">
                                    2013
                                </HeadingTiny>
                            </div>
                        </div>

                        <HeadingTiny
                            v-motion-pop-visible-once
                            :delay="700"
                            :duration="500"
                            class="text-white"
                        >
                            Ανακαλύψτε τον online κατάλογο μας
                        </HeadingTiny>
                    </div>
                </div>

                <div class="absolute h-full w-full bg-gray-900 opacity-80" />

                <img
                    class="h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1508766917616-d22f3f1eea14?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="COUP-Coffee, Wine, Kitchen"
                />
            </div>

            <div
                id="menu"
                v-if="menus.length > 0"
                class="max-h-[650px] overflow-auto bg-gray-800 scrollbar sm:px-4"
            >
                <Tabs class="relative">
                    <TabItems class="sticky top-0 z-10">
                        <MenuTab
                            v-for="menu in menus"
                            :key="menu.id"
                            :menu="menu"
                        />
                    </TabItems>

                    <TabContents>
                        <MenuTabContent
                            v-motion-slide-top
                            v-for="menu in menus"
                            :key="menu.id"
                            :menu="menu"
                        />
                    </TabContents>
                </Tabs>
            </div>

            <div class="grid gap-4 md:grid-cols-4">
                <div
                    v-motion-slide-visible-once-left
                    class="col-span-2 overflow-auto bg-gray-800/70 p-4 ring-1 ring-inset ring-primary-500 scrollbar md:max-h-80"
                >
                    <div class="mb-2 flex items-center gap-2">
                        <PhBookOpenText
                            weight="fill"
                            size="32"
                            class="text-primary-400"
                        />
                        <HeadingMedium id="about-us">Το COUP</HeadingMedium>
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
                    v-motion-slide-visible-once-right
                    class="col-span-2 overflow-auto bg-gray-800/70 p-4 ring-1 ring-inset ring-primary-500 scrollbar md:max-h-80"
                >
                    <div class="mb-4 flex items-center gap-2">
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
        </LandingLayout>
    </div>
</template>
