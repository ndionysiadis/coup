<script setup lang="ts">
import { ComboboxButton, ComboboxInput } from "@headlessui/vue";
import { computed } from "vue";
import debounce from "lodash/debounce.js";
import { PhArrowDown } from "@phosphor-icons/vue";

const props = defineProps<{
    selected: any;
    required?: boolean;
    label?: string;
    error?: string;
    placeholder?: string;
    displayValue: (item: any) => string;
}>();

const emit = defineEmits<{
    (event: "change", id: any): void;
}>();

const displayFunction = (selected: any) => {
    if (!Array.isArray(selected)) {
        return props.displayValue(selected);
    }

    return "";
};

const isSelected = computed(() => {
    return Array.isArray(props.selected) && props.selected.length >= 1;
});

const handleChanged = debounce((event) => {
    emit("change", event.target.value);
}, 400);
</script>

<template>
    <div>
        <div class="w-full cursor-default overflow-hidden text-gray-700">
            <div
                :class="[
                    error ? 'form-label-error' : 'form-label',
                    isSelected
                        ? 'bg-adminPrimary-600 text-adminPrimary-50 border-adminPrimary-800 border'
                        : '',
                ]"
            >
                <div class="flex items-center gap-1">
                    {{ label }}

                    <div v-if="isSelected">({{ selected.length }})</div>

                    <div v-if="required" class="text-md mt-0.5 text-red-600">
                        *
                    </div>
                </div>
            </div>

            <div class="relative">
                <ComboboxInput
                    :placeholder="placeholder"
                    :class="[error ? 'form-input-error' : 'form-input']"
                    class="w-full pr-10 text-sm"
                    :displayValue="displayFunction"
                    @change="handleChanged"
                />

                <ComboboxButton
                    class="absolute inset-y-0 right-0 flex items-center pr-2"
                >
                    <PhArrowDown weight="bold" size="16" aria-hidden="true" />
                </ComboboxButton>
            </div>

            <div v-if="error" class="form-input-error-msg">
                {{ error }}
            </div>
        </div>
    </div>
</template>
