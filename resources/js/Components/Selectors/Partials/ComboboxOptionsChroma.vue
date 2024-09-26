<script setup lang="ts">
import { ComboboxOptions, TransitionRoot } from "@headlessui/vue";

const emit = defineEmits<{
    (event: "after-leave"): void;
}>();
</script>

<template>
    <TransitionRoot
        leave="transition ease-in duration-100"
        leaveFrom="opacity-100"
        leaveTo="opacity-0"
        @after-leave="emit('after-leave')"
    >
        <ComboboxOptions
            class="absolute z-20 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm dark:bg-primary-900"
        >
            <slot />
        </ComboboxOptions>
    </TransitionRoot>
</template>
