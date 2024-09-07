<script setup lang="ts">
import {Dialog, DialogPanel, TransitionChild, TransitionRoot} from "@headlessui/vue";
import HeadingMedium from "@/Components/Texts/HeadingMedium.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import {PhX} from "@phosphor-icons/vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";

const props = withDefaults(
    defineProps<{
        height?: string,
        open: boolean
    }>(),
    {
        height: '',
        open: false
    }
);

const emit = defineEmits(['closeModal'])
</script>

<template>
    <TransitionRoot as="template" :show="props.open">
        <Dialog as="div" class="relative z-40">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                             leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 backdrop-blur-sm bg-gray-900/50 transition-opacity"/>
            </TransitionChild>

            <div class="fixed inset-0 z-10 w-screen">
                <div class="flex items-center justify-center min-h-screen p-4 text-center sm:items-center">
                    <TransitionChild as="template" enter="ease-out duration-300"
                                     enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                     enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                                     leave-from="opacity-100 translate-y-0 sm:scale-100"
                                     leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel
                            :class="[
                                'relative transform bg-gray-800 ring-1 ring-gray-600 pl-3 pb-4 pr-0.5 text-left',
                                'shadow-gray-900 shadow-xl transition-all overflow-y-auto',
                                'max-h-screen my-8 w-full max-w-xl',
                                height
                            ]">

                            <div class="sticky top-0 py-3 bg-gray-800">

                                <div class="flex items-center justify-between">
                                    <div class="flex space-x-2 items-center">
                                        <div class="mx-auto bg-gray-600 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full sm:mx-0">
                                            <div class="h-6 w-6 text-white" aria-hidden="true">
                                                <slot name="icon"/>
                                            </div>
                                        </div>

                                        <HeadingSmall>
                                            <slot name="title"/>
                                        </HeadingSmall>
                                    </div>

                                    <div class="flex items-center space-x-2 mr-2">
                                        <IconSecondaryButton @click="emit('closeModal')">
                                            <PhX weight="bold" size="16"/>
                                        </IconSecondaryButton>
                                    </div>

                                </div>
                            </div>

                            <div class="text-white">
                                <slot name="body"/>
                            </div>

                            <div class="sm:flex space-x-2 justify-end sticky -bottom-4 bg-gray-800 py-3 -mb-4 mr-2">
                                <slot name="actions"/>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
