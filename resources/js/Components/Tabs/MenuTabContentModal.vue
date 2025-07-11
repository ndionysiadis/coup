<script setup lang="ts">
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import { PhX } from "@phosphor-icons/vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import ImageCard from "@/Components/Cards/ImageCard.vue";
import HeadingMedium from "@/Components/Texts/HeadingMedium.vue";

const props = withDefaults(
    defineProps<{
        height?: string;
        open?: boolean;
        menu: App.Data.Menu.MenuTypeData;
    }>(),
    {
        height: "",
        open: false,
    }
);

const emit = defineEmits(["closeModal"]);

const scrollTo = (id: string) => {
    const container = document.getElementById("modal-content");
    const target = document.getElementById(id);

    if (container && target) {
        const containerTop = container.getBoundingClientRect().top;
        const targetTop = target.getBoundingClientRect().top;
        const offset = -150; // Adjusted offset for modal

        const scrollPosition = container.scrollTop + (targetTop - containerTop) + offset;

        container.scrollTo({
            top: scrollPosition,
            behavior: "smooth",
        });
    }
};
</script>

<template>
    <TransitionRoot as="template" :show="props.open">
        <Dialog as="div" class="relative z-40">
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div
                    class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity"
                />
            </TransitionChild>

            <div class="fixed inset-0 z-10 w-screen">
                <div
                    class="flex min-h-screen items-center justify-center text-center sm:items-center"
                >
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100"
                        leave="ease-in duration-200"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                        <DialogPanel
                            id="modal-content"
                            class="relative transform h-screen bg-gray-800 p-4 text-left ring-1 ring-gray-600 overflow-y-auto shadow-xl shadow-gray-900 transition-all"
                        >
                            <div class="sticky -top-5 z-10 bg-gray-800 py-2">
                                <div class="flex justify-between">
                                    <div class="flex flex-col">
                                        <HeadingMedium>{{ menu.name }}</HeadingMedium>
                                        <div class="text-sm text-gray-400">
                                            {{ menu.description }}
                                        </div>
                                    </div>

                                    <div
                                        class="mr-2 flex items-start space-x-2"
                                    >
                                        <IconSecondaryButton
                                            @click="emit('closeModal')"
                                        >
                                            <PhX weight="bold" size="16" />
                                        </IconSecondaryButton>
                                    </div>
                                </div>

                                <div class="flex overflow-y-auto w-full gap-2 pt-4 items-center">
                                    <a
                                        class="flex-shrink-0"
                                        v-for="category in menu.categories"
                                        :key="category.id"
                                        :href="'#' + category.name"
                                        @click.prevent="scrollTo(category.name)"
                                    >
                                        <SecondaryButton>{{category.name}}</SecondaryButton>
                                    </a>
                                </div>
                            </div>

                            <div v-for="category in menu.categories" :key="category.id">
                                <div>
                                    <HeadingSmall :id="category.name">{{ category.name }}</HeadingSmall>
                                    <div class="text-sm text-gray-400">
                                        {{ category.description }}
                                    </div>
                                </div>

                                <div class="my-2 w-full border-t border-gray-600" />

                                <ul class="text-white">
                                    <li
                                        v-for="product in category.products"
                                        :key="product.id"
                                        class="mb-2"
                                    >
                                        <div class="flex items-center gap-2">
                                            <ImageCard
                                                class="size-20"
                                                :image-url="product.image"
                                                :alt-text="product.name"
                                            />

                                            <div class="flex flex-1 flex-col">
                                                <div class="flex items-center justify-between">
                                                    <div class="line-clamp-1 hover:line-clamp-0">{{ product.name }}</div>
                                                    <div class="text-xs font-semibold">{{ product.price }} &#8364;</div>
                                                </div>

                                                <div class="text-sm text-gray-400">
                                                    {{ product.description }}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
