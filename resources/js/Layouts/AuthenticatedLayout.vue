<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import HeadingTiny from "@/Components/Texts/HeadingTiny.vue";
import { PhSignOut, PhUser } from "@phosphor-icons/vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import IconPrimaryButton from "@/Components/Buttons/IconPrimaryButton.vue";
// import { computed, onUnmounted } from "vue";
// import HtmlToast from "@/Components/HtmlToast.vue";
// import { POSITION, TYPE, useToast } from "vue-toastification";
// import { router, usePage } from "@inertiajs/vue3";

const props = defineProps<{
    withGreeting?: boolean;
}>();

// const toast = useToast();
//
// const authUser = computed(() => {
//     return usePage().props.auth.user;
// });
//
// const removeFinishEvent = router.on("success", () => {
//     //@ts-ignore
//     const toastData = usePage().props?.toast;
//
//     if (toastData?.message) {
//         toast(
//             {
//                 component: HtmlToast,
//                 props: {
//                     htmlContent: toastData?.message,
//                 },
//             },
//             {
//                 //@ts-ignore
//                 type: TYPE[toastData.type],
//                 //@ts-ignore
//                 position: POSITION[toastData.position],
//             },
//         );
//     }
// });
//
// onUnmounted(() => removeFinishEvent());
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-900">
            <nav
                class="m-2 flex justify-between bg-gray-800 p-4 ring-1 ring-inset ring-gray-600"
                v-motion-slide-top
                :delay="200"
            >
                <div class="flex items-center gap-2">
                    <AppLink :href="route('dashboard')">
                        <ApplicationLogo class="block h-8 fill-primary-400" />
                    </AppLink>
                    <div class="mx-2 h-6 border-l border-gray-500" />
                    <HeadingTiny
                        v-if="withGreeting"
                        v-motion-slide-left
                        :delay="700"
                        class="hidden sm:inline-flex"
                    >
                        Καλώς ήρθες, {{ $page.props.auth.user.name }}.
                    </HeadingTiny>

                    <div v-motion-slide-left :delay="500">
                        <slot name="breadcrumbs" />
                    </div>
                </div>

                <div class="hidden gap-2 sm:ms-6 sm:flex sm:items-center">
                    <AppLink :href="route('profile.edit')">
                        <PrimaryButton direction="right" title="Προφίλ">
                            Λογαριασμός
                        </PrimaryButton>
                    </AppLink>

                    <AppLink :href="route('logout')" method="post" as="button">
                        <IconSecondaryButton title="Αποσύνδεση">
                            <PhSignOut weight="bold" size="16" />
                        </IconSecondaryButton>
                    </AppLink>
                </div>

                <div class="ms-6 flex items-center gap-2 sm:hidden">
                    <AppLink :href="route('profile.edit')">
                        <IconPrimaryButton title="Προφίλ">
                            <PhUser weight="fill" size="16" />
                        </IconPrimaryButton>
                    </AppLink>

                    <AppLink :href="route('logout')" method="post" as="button">
                        <IconSecondaryButton title="Αποσύνδεση">
                            <PhSignOut weight="bold" size="16" />
                        </IconSecondaryButton>
                    </AppLink>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="m-2" v-motion-fade-visible :delay="200">
                <slot />
            </main>
        </div>
    </div>
</template>
