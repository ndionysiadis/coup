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

const props = withDefaults(
    defineProps<{
        height?: string;
        open: boolean;
    }>(),
    {
        height: "",
        open: false,
    },
);

const emit = defineEmits(["closeModal"]);
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
                    class="flex min-h-screen items-center justify-center p-4 text-center sm:items-center"
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
                            :class="[
                                'relative transform bg-gray-800 pb-4 pl-3 pr-0.5 text-left ring-1 ring-gray-600',
                                'overflow-y-auto shadow-xl shadow-gray-900 transition-all',
                                'my-8 max-h-screen w-full max-w-xl',
                                height,
                            ]"
                        >
                            <div class="sticky top-0 bg-gray-800 py-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <div
                                            class="mx-auto flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gray-600 sm:mx-0"
                                        >
                                            <div
                                                class="h-6 w-6 text-white"
                                                aria-hidden="true"
                                            >
                                                <slot name="icon" />
                                            </div>
                                        </div>

                                        <HeadingSmall>
                                            <slot name="title" />
                                        </HeadingSmall>
                                    </div>

                                    <div
                                        class="mr-2 flex items-center space-x-2"
                                    >
                                        <IconSecondaryButton
                                            @click="emit('closeModal')"
                                        >
                                            <PhX weight="bold" size="16" />
                                        </IconSecondaryButton>
                                    </div>
                                </div>
                            </div>

                            <div class="text-white">
                                <slot name="body" />
                            </div>

                            <div
                                class="sticky -bottom-4 -mb-4 mr-2 justify-end space-x-2 bg-gray-800 py-3 sm:flex"
                            >
                                <slot name="actions" />
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
