<script setup lang="ts">
import { computed } from "vue";
import ComboboxOption from "@/Components/Selectors/ComboboxOption.vue";

const props = defineProps<{
    options: Array<any>;
    selectedOptions: string[];
    displayField: string;
}>();

const emit = defineEmits(["select"]);

const sortedOptions = computed(() => {
    const selected = props.options.filter((option) =>
        props.selectedOptions.includes(option[props.displayField]),
    );
    const unselected = props.options.filter(
        (option) => !props.selectedOptions.includes(option[props.displayField]),
    );
    return [...selected, ...unselected];
});

const selectOption = (option: any) => {
    emit("select", option);
};
</script>

<template>
    <ul
        v-motion-fade-visible-once
        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto bg-gray-800 p-2 text-sm text-white ring-1 ring-inset ring-gray-600 scrollbar"
    >
        <ComboboxOption
            v-for="option in sortedOptions"
            :key="option.id || option[props.displayField]"
            :option="option"
            :isSelected="selectedOptions.includes(option[props.displayField])"
            @select="selectOption"
        >
            {{ option[props.displayField] }}
        </ComboboxOption>
    </ul>
</template>
