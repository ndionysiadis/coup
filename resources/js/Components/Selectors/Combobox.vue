<script setup lang="ts">
import { computed, ref, onMounted } from "vue";
import ComboboxInput from "@/Components/Selectors/ComboboxInput.vue";
import ComboboxOptions from "@/Components/Selectors/ComboboxOptions.vue";

const props = withDefaults(
    defineProps<{
        options: string[];
        label: string;
        placeholder?: string,
        id?: string;
        type?: string;
        required?: boolean;
        autofocus?: boolean;
        disabled?: boolean;
        error?: string;
    }>(),
    {
        label: '',
        autofocus: false,
        required: false,
        disabled: false,
        type: 'text',
        id: 'combobox',
        placeholder: 'Πληκτρολογήστε για αναζήτηση...'
    }
)

const emit = defineEmits(['update:selectedOptions']);

const selectedOptions = ref<string[]>([]);
const searchTerm = ref<string>('');
const isOpen = ref<boolean>(false);

const filteredOptions = computed(() => {
    return props.options.filter(option =>
        option.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
});

const selectOption = (option: string) => {
    if (!selectedOptions.value.includes(option)) {
        selectedOptions.value.push(option);
    } else {
        selectedOptions.value = selectedOptions.value.filter(opt => opt !== option);
    }
    emit('update:selectedOptions', selectedOptions.value);
};

const removeSelectedOption = (option: string) => {
    selectedOptions.value = selectedOptions.value.filter(opt => opt !== option);
    emit('update:selectedOptions', selectedOptions.value);
};

const clearSelections = () => {
    selectedOptions.value = [];
    emit('update:selectedOptions', selectedOptions.value);
};

const handleClickOutside = (event: Event) => {
    const target = event.target as HTMLElement;
    if (!target.closest('.combobox')) {
        isOpen.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});
</script>

<template>
    <div class="relative combobox">
        <ComboboxInput
            v-model="searchTerm"
            @focus="isOpen = true"
            :placeholder="props.placeholder"
            :selectedOptions="selectedOptions"
            :id="props.id"
            :label="props.label"
            :type="props.type"
            :required="props.required"
            :autofocus="props.autofocus"
            :disabled="props.disabled"
            :error="props.error"
            @removeOption="removeSelectedOption"
            @clearSelections="clearSelections"
        />
        <ComboboxOptions
            v-if="isOpen"
            :options="filteredOptions"
            @select="selectOption"
            :selectedOptions="selectedOptions"
        />
    </div>
</template>
