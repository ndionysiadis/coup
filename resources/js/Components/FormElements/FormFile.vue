<script setup lang="ts">
import { PhImageSquare, PhX } from "@phosphor-icons/vue";
import { ref } from "vue";

const props = withDefaults(
    defineProps<{
        modelValue?: string;
        attachment?: File;
    }>(),
    {},
);

const emit = defineEmits(["added", "removed"]);

const fileName = ref<string | null>(null);
const fileUrl = ref<string | null>(null);

const handleFileAdded = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        fileName.value = file.name;
        fileUrl.value = URL.createObjectURL(file);
        emit("added", file);
    }
};

const removeFile = () => {
    fileName.value = null;
    fileUrl.value = null;
    emit("removed");
};
</script>

<template>
    <div class="col-span-full">
        <div
            class="flex flex-col justify-center border border-primary-500 px-6 py-10 focus-within:border-primary-500 focus-within:ring-1 focus-within:ring-primary-500"
        >
            <div
                v-if="!fileName"
                class="flex flex-col items-center text-center"
            >
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
                            @change="handleFileAdded"
                        />
                    </label>
                </div>
                <p class="text-xs leading-5 text-gray-400">
                    PNG, JPG, GIF up to 10MB
                </p>
            </div>

            <div v-else class="mt-4 flex flex-col items-center gap-2">
                <img
                    v-if="fileUrl"
                    :src="fileUrl"
                    alt="Uploaded image"
                    class="h-32 w-32 object-cover"
                />

                <div class="flex items-center gap-1 bg-gray-700 p-2">
                    <span class="ml-1 text-sm text-gray-400">
                        {{ fileName }}
                    </span>

                    <div
                        @click="removeFile"
                        class="cursor-pointer rounded-full p-1 transition duration-150 ease-in-out hover:bg-gray-400"
                    >
                        <PhX weight="bold" size="14" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
