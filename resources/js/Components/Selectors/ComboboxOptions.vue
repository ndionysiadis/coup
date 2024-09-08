<script setup lang="ts">
import { computed } from "vue";
import ComboboxOption from "@/Components/Selectors/ComboboxOption.vue";

const props = defineProps<{
    options: string[];
    selectedOptions: string[];
}>();

const emit = defineEmits(['select']);

const sortedOptions = computed(() => {
    const selected = props.options.filter(option => props.selectedOptions.includes(option));
    const unselected = props.options.filter(option => !props.selectedOptions.includes(option));
    return [...selected, ...unselected];
});

const selectOption = (option: string) => {
    emit('select', option);
};
</script>

<template>
    <ul
        v-motion-fade-visible-once
        class="absolute mt-1 max-h-60 w-full overflow-auto scrollbar bg-gray-800 ring-1 ring-inset ring-gray-600 text-white text-sm p-2">
        <ComboboxOption
            v-for="option in sortedOptions"
            :key="option"
            :option="option"
            :isSelected="selectedOptions.includes(option)"
            @select="selectOption"
        />
    </ul>
</template>
