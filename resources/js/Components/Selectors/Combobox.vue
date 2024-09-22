<script setup lang="ts">
import ComboboxInput from "@/Components/Selectors/ComboboxInput.vue";
import ComboboxOptions from "@/Components/Selectors/ComboboxOptions.vue";
import axios, { AxiosResponse } from "axios";
import { ref, watch, onBeforeUnmount } from "vue";

const props = withDefaults(
    defineProps<{
        displayField: string;
        label: string;
        id: string;
        type?: string;
        placeholder: string;
        route: string;
        required?: boolean;
        autofocus?: boolean;
        error?: string;
        minCharsToSearch?: number;
    }>(),
    {
        minCharsToSearch: 2,
    },
);

const emit = defineEmits(["update:modelValue"]); // Emit event to update the v-model binding
const searchTerm = ref<string>(""); // Current search term
const apiOptions = ref<any[]>([]); // API-fetched options (categories)
const selectedOption = ref<any>(null); // The selected category
const isOpen = ref<boolean>(false); // Controls the visibility of the dropdown

// Watch search term changes and fetch options from the API if enough characters are typed
watch(searchTerm, (newTerm) => {
    if (newTerm.length >= props.minCharsToSearch) {
        fetchOptions(newTerm); // Fetch from API
    }
});

// Fetch categories from the API based on the search term
const fetchOptions = (term: string) => {
    axios
        .get(props.route, { params: { term } })
        .then((response: AxiosResponse) => {
            apiOptions.value = response.data?.data || response.data; // Store API results
            isOpen.value = true; // Open the dropdown after fetching options
        })
        .catch(() => {
            apiOptions.value = []; // Reset options on error
        });
};

// Handle selecting a category
const selectOption = (option: any) => {
    selectedOption.value = option; // Set the selected option
    emit("update:modelValue", option.id); // Emit the selected category_id to the parent
    isOpen.value = false; // Close dropdown after selection
};

// Close dropdown when clicking outside
const handleClickOutside = (event: MouseEvent) => {
    const target = event.target as HTMLElement;
    if (!target.closest(".combobox")) {
        isOpen.value = false;
    }
};

// Attach click listener for closing dropdown
document.addEventListener("click", handleClickOutside);

// Cleanup listener when component is destroyed
onBeforeUnmount(() => {
    document.removeEventListener("click", handleClickOutside);
});
</script>

<template>
    <div class="combobox relative">
        <ComboboxInput
            v-model="searchTerm"
            @focus="isOpen = true"
            :selectedOptions="
                selectedOption ? [selectedOption[props.displayField]] : []
            "
            :label="props.label"
            :placeholder="props.placeholder"
            :required="props.required"
            :error="props.error"
        />

        <ComboboxOptions
            v-if="isOpen && apiOptions.length"
            :options="apiOptions"
            :displayField="props.displayField"
            :selectedOptions="[
                selectedOption ? selectedOption[props.displayField] : '',
            ]"
            @select="selectOption"
        />
    </div>
</template>
