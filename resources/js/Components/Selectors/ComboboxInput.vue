<script setup lang="ts">
import { ref, watch, defineEmits, defineProps } from "vue";
import {PhX} from "@phosphor-icons/vue";

const props = defineProps<{
    modelValue: string;
    selectedOptions: string[];
    id: string;
    label: string;
    type: string;
    required: boolean;
    autofocus: boolean;
    disabled?: boolean;
    error?: string;
    placeholder: string;
}>();

const emit = defineEmits(['update:modelValue', 'focus', 'blur', 'clearSelections']);
const inputValue = ref(props.modelValue);

watch(inputValue, (newVal) => {
    emit('update:modelValue', newVal);
});
</script>

<template>
    <div
        class="relative block text-white border border-primary-500 shadow-sm focus-within:border-primary-500 focus-within:ring-1 focus-within:ring-primary-500">
        <label :for="props.id" class="sr-only">{{ props.label }}</label>

        <div class="flex gap-2 ml-2.5 items-center">
            <div
                v-for="option in selectedOptions"
                :key="option"
                class="bg-gray-800 flex items-center gap-1 pl-2 py-1 pr-1 text-xs"
            >
                <span>{{ option }}</span>
            </div>

            <input
                :id="props.id"
                :type="props.type"
                :placeholder="props.placeholder"
                v-model="inputValue"
                @focus="$emit('focus')"
                @blur="$emit('blur')"
                :required="props.required"
                :autofocus="props.autofocus"
                :disabled="props.disabled"
                class="peer block w-full h-10 border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
            />

            <span
                v-if="selectedOptions.length >= 2"
                @click="$emit('clearSelections')"
                class="absolute right-0 p-3 text-sm text-gray-400 bg-gray-800 hover:bg-gray-700 hover:cursor-pointer transition duration-150 ease-in-out"
                title="Καθαρισμός όλων">
                <PhX weight="bold" size="16"/>
            </span>

        </div>

        <span
            class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-gray-800 py-0.5 px-2 text-xs text-gray-400 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
        >
            {{ props.label }}
        </span>

        <span
            v-if="$slots.default"
            class="absolute inset-y-0 right-0 flex items-center text-gray-400 bg-gray-800 px-3">
            <slot/>
        </span>
    </div>

    <div v-if="props.error" class="-mt-3 text-sm text-red-400">
        {{ props.error }}
    </div>
</template>

<style scoped>

</style>
