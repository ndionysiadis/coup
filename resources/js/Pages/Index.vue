<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import BackgroundLines from "@/Components/BackgroundLines.vue";
import { PhBookOpenText, PhStar } from "@phosphor-icons/vue";
import Tabs from "@/Components/Tabs/Tabs.vue";
import TabItems from "@/Components/Tabs/TabItems.vue";
import TabContents from "@/Components/Tabs/TabContents.vue";
import MenuTabContent from "@/Components/Tabs/MenuTabContent.vue";
import MenuTab from "@/Components/Tabs/MenuTab.vue";
import HeadingMedium from "@/Components/Texts/HeadingMedium.vue";
import ApplicationLogoFull from "@/Components/ApplicationLogoFull.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import HeadingTiny from "@/Components/Texts/HeadingTiny.vue";
import { useHead } from "@vueuse/head";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import CookieConsent from "@/Components/Cards/CookieConsent.vue";
import { ref } from "vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import MenuTabContentModal from "@/Components/Tabs/MenuTabContentModal.vue";

const title = "Coffee, Wine, Kitchen";

const props = defineProps<{
    menus: App.Data.Menu.MenuTypeData[];
}>();

const openMenuId = ref<number | null>(null)

const openMenuModal = (menuId: number) => {
    openMenuId.value = menuId
}

const closeMenuModal = () => {
    openMenuId.value = null
}

useHead({
    title: "COUP - Coffee, Wine, Kitchen | Aridaia, Pella, Greece",
    meta: [
        {
            name: "description",
            content:
                "Ανακαλύψτε το COUP στην Αριδαία, Πέλλας, ένα γαστρονομικό μπαρ που σερβίρει πρωινό, κοκτέιλ, καφέ, δείπνο και ποικιλία κρασιών κοντά στα Λουτρά Πόζαρ.",
        },
        {
            name: "keywords",
            content:
                "COUP, Αριδαία, Πέλλα, Ελλάδα, γαστρονομικό μπαρ, brunch, κοκτέιλ, καφές, δείπνο, κρασιά, Loutra Pozar, wine bar, coffee, cocktails, brunch, dinner, Aridaia, Pella, Greece, λουτρά πόζαρ, πρωινό",
        },
        { name: "robots", content: "index, follow" },

        {
            property: "og:title",
            content: "COUP - Coffee, Wine, Kitchen | Aridaia, Pella, Greece",
        },
        {
            property: "og:description",
            content:
                "Ανακαλύψτε το COUP, ανακάλυψε ένα γαστρονομικό μπαρ, που σερβίρει πρωινό, κοκτέιλ, καφέ και δείπνο στην Αριδαία.",
        },
        { property: "og:type", content: "website" },
        { property: "og:url", content: "https://coup.com.gr" },
        {
            property: "og:image",
            content: "http://coup.com.gr/images/coup-coffee-wine-kitchen.jpg",
        },
        { property: "og:image:width", content: "1200" },
        { property: "og:image:height", content: "630" },

        { name: "twitter:card", content: "summary_large_image" },
        {
            name: "twitter:title",
            content: "COUP - Coffee, Wine, Kitchen | Aridaia, Pella, Greece",
        },
        {
            name: "twitter:description",
            content:
                "Ανακαλύψτε το COUP, ανακάλυψε ένα γαστρονομικό μπαρ, που σερβίρει πρωινό, κοκτέιλ, καφέ και δείπνο στην Αριδαία.",
        },
        {
            name: "twitter:image",
            content: "http://coup.com.gr/images/coup-coffee-wine-kitchen.jpg",
        },

        { name: "author", content: "COUP - Coffee, Wine, Kitchen" },
        { name: "theme-color", content: "#111827" },
    ],
    link: [{ rel: "canonical", href: "https://coup.com.gr" }],
});
</script>

<template>
    <Head :title="title" />

    <div class="relative min-h-screen overflow-auto p-4 scrollbar">
        <BackgroundLines class="absolute" />

        <LandingLayout>
            <CookieConsent/>
            <div class="group relative h-96">
                <div
                    class="absolute inset-0 z-10 flex flex-col justify-center px-6"
                >
                    <div class="flex flex-col items-center gap-6 text-center">
                        <AppLink
                            :href="route('index')"
                            class="fill-white w-32"
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
                                class="col-span-6 flex flex-col items-center font-title text-3xl text-white md:text-4xl lg:text-5xl"
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

                <div class="absolute h-full w-full bg-gray-900 opacity-30" />

                <img
                    class="h-full w-full object-cover opacity-30"
                    src="/images/header-bg.jpg"
                    alt="COUP-Coffee, Wine, Kitchen"
                />
            </div>

            <div
                id="menu"
                v-if="menus.length > 0"
                class="max-h-[1240px] overflow-auto bg-gray-800 scrollbar sm:px-4 md:max-h-[950px] hidden lg:block"
            >
                <Tabs class="relative">
                    <TabItems class="sticky top-0 z-10">
                        <MenuTab
                            v-for="menu in menus"
                            :key="menu.id as PropertyKey"
                            :menu="menu"
                        />
                    </TabItems>

                    <TabContents>
                        <MenuTabContent
                            v-motion-slide-top
                            v-for="menu in menus"
                            :key="menu.id as PropertyKey"
                            :menu="menu"
                        />
                    </TabContents>
                </Tabs>
            </div>

            <div class="p-4 space-y-2 bg-gray-800 lg:hidden">
                <template v-for="menu in menus" :key="menu.id as PropertyKey">
                    <SecondaryButton
                        class="w-full"
                        @click="openMenuModal(menu.id!)"
                    >
                        {{ menu.name }}
                    </SecondaryButton>
                </template>
            </div>

            <MenuTabContentModal
                v-for="menu in menus"
                :key="menu.id as PropertyKey"
                :menu="menu"
                :open="openMenuId === menu.id"
                @closeModal="closeMenuModal"
            />

            <div class="grid gap-4 md:grid-cols-6">
                <div
                    v-motion-slide-visible-once-left
                    class="col-span-6 flex flex-col gap-4 overflow-auto bg-gray-800/70 p-4 ring-1 ring-inset ring-primary-500 scrollbar md:max-h-80 md:flex-row lg:col-span-4"
                >
                    <img
                        class="h-full w-full object-contain md:object-cover"
                        src="/images/about-us.jpg"
                        alt="COUP-Coffee, Wine, Kitchen"
                    />

                    <div>
                        <div class="mb-2 flex items-center gap-2">
                            <PhBookOpenText
                                weight="fill"
                                size="32"
                                class="text-primary-400"
                            />
                            <HeadingMedium id="about-us">Το COUP</HeadingMedium>
                        </div>

                        <div class="text-white space-y-2">
                            <p>
                                Το COUP γεννήθηκε το 2013 στην Αριδαία, μια πόλη
                                γνωστή για τα Λουτρά Πόζαρ.
                            </p>

                            <p>
                                Με πάθος για ποιότητα και αισθητική, συνδυάζει
                                εκλεκτό καφέ, ενημερωμένη λίστα κρασιών, premium
                                spirits και μοναδικά cocktails.
                            </p>
                            <p>
                                Από το 2015, εξελίχθηκε στη γαστρονομία,
                                προσφέροντας εκλεκτά τυριά, αλλαντικά και
                                συνοδευτικά για κρασί και ποτό. Σήμερα, το μενού
                                του εμπνέεται από τη μεσογειακή και διεθνή
                                κουζίνα, από brunch μέχρι premium steak και
                                ριζότο μανιταριών.
                            </p>
                            <p>
                                Με ζεστό design, φιλική εξυπηρέτηση και
                                προσεγμένη μουσική, το COUP είναι το απόλυτο
                                σημείο συνάντησης. Ανακαλύψτε το και γίνετε
                                μέρος της εμπειρίας!
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    v-motion-slide-visible-once-right
                    class="col-span-6 overflow-auto bg-gray-800/70 p-4 ring-1 ring-inset ring-primary-500 scrollbar md:max-h-80 lg:col-span-2"
                >
                    <div
                        class="flex flex-col md:mb-4 md:flex-row md:items-center md:justify-between"
                    >
                        <div class="flex items-center gap-2">
                            <PhStar
                                weight="fill"
                                size="32"
                                class="text-primary-400"
                            />
                            <HeadingMedium id="google-reviews"
                                >Reviews
                            </HeadingMedium>
                        </div>
                        <AppLink
                            blank
                            href="https://www.google.com/search?hl=el-GR&gl=gr&q=Coup+Espresso+%26+Wine+Bar,+%CE%9A%CF%8D%CF%80%CF%81%CE%BF%CF%85+14,+%CE%91%CF%81%CE%B9%CE%B4%CE%B1%CE%AF%CE%B1+584+00&ludocid=3107005031310613240&lsig=AB86z5X-J2ednnKDOnszI-1gTq4r#lrd=0x1357b288d884f787:0x2b1e4c9d469edaf8,3"
                        >
                            <PrimaryButton> Αξιολογήστε μας!</PrimaryButton>
                        </AppLink>
                    </div>

                    <div class="mt-4 aspect-video w-full lg:mt-0">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3012.3372542582574!2d22.05970867665293!3d40.97409537135539!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1357b288d884f787%3A0x2b1e4c9d469edaf8!2sCoup%20Espresso%20%26%20Wine%20Bar!5e0!3m2!1sel!2sgr!4v1739098846464!5m2!1sel!2sgr"
                            class="h-full w-full"
                            style="border: 0"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                        >
                        </iframe>
                    </div>
                </div>
            </div>
        </LandingLayout>
    </div>
</template>
