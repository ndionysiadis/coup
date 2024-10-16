<script setup lang="ts">
import { PhImageSquare } from "@phosphor-icons/vue";

const props = withDefaults(
    defineProps<{
        modelValue?: string;
        attachment?: File;
    }>(),
    {},
);

const emit = defineEmits(["added", "removed"]);
</script>

<template>
    <div class="col-span-full">
        <div
            class="flex justify-center border border-primary-500 px-6 py-10 focus-within:border-primary-500 focus-within:ring-1 focus-within:ring-primary-500"
        >
            <div class="flex flex-col items-center text-center">
                <PhImageSquare size="42" />

                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                    <label
                        for="file-upload"
                        class="relative cursor-pointer font-semibold text-primary-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2 hover:text-primary-600"
                    >
                        <span>Ανέβασμα εικόνας</span>
                        <input
                            id="file-upload"
                            name="file-upload"
                            type="file"
                            class="sr-only"
                            @change="$emit('added', $event.target.files[0])"
                        />
                    </label>
                </div>
                <p class="text-xs leading-5 text-gray-400">
                    PNG, JPG, GIF up to 10MB
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
