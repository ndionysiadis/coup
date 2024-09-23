<script lang="ts" setup>
import { ref, watch, computed } from "vue";
import axios, { AxiosResponse } from "axios";
import { onClickOutside } from "@vueuse/core";
import { PhX } from "@phosphor-icons/vue";

// Define props and their default values
const props = withDefaults(
    defineProps<{
        modelValue: any;
        options?: any[];
        displayValueFunction: (item: any) => string;
        label?: string;
        placeholder?: string;
        api?: boolean;
        route?: string;
        required?: boolean;
        error?: string;
        minCharsToSearch?: number;
        id?: string;
        autofocus: boolean;
        disabled?: boolean;
        multiple?: boolean; // Prop for multi-select support
    }>(),
    {
        minCharsToSearch: 0,
        api: false,
        autofocus: false,
        required: false,
        disabled: false,
        multiple: false, // Default is single-select
    },
);

// Emit event for modelValue updates
const emit = defineEmits<{
    (event: "update:modelValue", value: any): void;
}>();

// Initialize selected.value based on single or multi-select mode
// Ensure selected.value is always an array if props.multiple is true
const selected = ref(
    props.multiple
        ? Array.isArray(props.modelValue)
            ? props.modelValue
            : []
        : props.modelValue,
);

// Query for search input
const query = ref("");

// API options if fetching from an external source
const apiOptions = ref<any[]>([]);

// Watcher for updating modelValue whenever selected changes
watch(selected, () => {
    emit("update:modelValue", selected.value);
    apiOptions.value = [];

    // For single-select, update the query to show the selected value
    if (!props.multiple && selected.value) {
        query.value = props.displayValueFunction(selected.value) || "";
    }
});

// Computed property for filtering options based on query and selected state
const filteredOptions = computed(() => {
    const isSelected = (item: any) => {
        if (props.multiple && Array.isArray(selected.value)) {
            return selected.value.includes(item);
        }
        return selected.value === item;
    };

    const sortOptions = (options: any[]) =>
        options.slice().sort((a, b) => {
            const aSelected = isSelected(a);
            const bSelected = isSelected(b);

            if (aSelected && !bSelected) return -1;
            if (!aSelected && bSelected) return 1;
            return 0;
        });

    if (props.api) {
        const availableOptions = apiOptions.value.filter((x) => !isSelected(x));
        return sortOptions(availableOptions);
    }

    if (props.options) {
        const sortedOptions = sortOptions(props.options);
        if (query.value === "") return sortedOptions;

        const normalizedQuery = query.value.toLowerCase().replace(/\s+/g, "");
        return sortedOptions.filter((option) =>
            props
                .displayValueFunction(option)
                .toLowerCase()
                .replace(/\s+/g, "")
                .includes(normalizedQuery),
        );
    }

    return [];
});

// Function to handle input change for search query
const inputChanged = (value: string) => {
    query.value = value;

    if (props.api) {
        fetchOptions(value);
    }
};

// Fetch all options when input is focused without query or fetch based on query
const fetchOptions = (term: string) => {
    if (props.route && (term.length >= props.minCharsToSearch || term === "")) {
        axios
            .get(props.route, {
                params: { term },
            })
            .then((response: AxiosResponse) => {
                apiOptions.value = response.data?.data ?? response.data;
            });
    }
};

// Function to handle option selection
const selectOption = (option: any) => {
    if (props.multiple && Array.isArray(selected.value)) {
        const index = selected.value.indexOf(option);
        if (index > -1) {
            selected.value.splice(index, 1); // Deselect option
        } else {
            selected.value.push(option); // Select option
        }
    } else {
        selected.value = option; // Single select
        query.value = props.displayValueFunction(option); // Update query to show the selected option
        dropdownOpen.value = false; // Close dropdown on single select
    }
};

// Dropdown open/close state
const dropdownOpen = ref(false);

// Open dropdown and fetch all API data if the user hasn't typed anything yet
const openDropdown = () => {
    dropdownOpen.value = true;
    if (props.api && query.value === "") {
        fetchOptions("");
    }
};

// Function to check if an option is selected
const isSelected = (item: any) => {
    if (props.multiple && Array.isArray(selected.value)) {
        return selected.value.includes(item);
    }
    return selected.value === item;
};

const clearSelected = () => {
    if (props.multiple) {
        selected.value = [];
    } else {
        selected.value = null;
        query.value = ""; // Reset the input query for single-select
    }
    dropdownOpen.value = false; // Optionally close the dropdown
};

const comboboxRef = ref<HTMLElement | null>(null);

onClickOutside(comboboxRef, () => {
    dropdownOpen.value = false;
});
</script>

<template>
    <div ref="comboboxRef">
        <div
            class="relative block border border-primary-500 text-white shadow-sm focus-within:border-primary-500 focus-within:ring-1 focus-within:ring-primary-500"
        >
            <label v-if="props.label" :for="props.id" class="sr-only">{{
                props.label
            }}</label>

            <input
                :id="props.id"
                type="text"
                :placeholder="props.label"
                v-model="query"
                @input="inputChanged(query)"
                @focus="openDropdown"
                class="peer block w-full border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                :disabled="props.disabled"
                :required="props.required"
                :autofocus="props.autofocus"
                :readonly="props.multiple"
            />

            <span
                v-if="selected.value > 0"
                @click="clearSelected"
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-gray-800 p-3 text-sm text-gray-400 hover:cursor-pointer"
            >
                <PhX weight="bold" size="16" />
            </span>

            <span
                class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-gray-800 px-2 py-0.5 text-xs text-gray-400 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
            >
                {{ props.label }}
            </span>

            <!-- Display selected items in multi-select -->
            <div
                v-if="props.multiple && selected.value && selected.value.length"
                class="mt-2 flex flex-wrap gap-1"
            >
                <span
                    v-for="item in selected.value"
                    :key="props.displayValueFunction(item)"
                    class="inline-flex items-center rounded bg-gray-700 px-2 py-1 text-white"
                >
                    {{ props.displayValueFunction(item) }}
                    <button
                        @click="selectOption(item)"
                        class="ml-2 text-red-400 hover:text-red-600"
                    >
                        &times;
                    </button>
                </span>
            </div>

            <!-- Dropdown for combobox options -->
            <ul
                v-show="dropdownOpen"
                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto bg-gray-800 py-1 text-base text-white shadow-xl ring-1 ring-inset ring-gray-600 scrollbar focus:outline-none sm:text-sm"
            >
                <li
                    v-for="option in filteredOptions"
                    :key="props.displayValueFunction(option)"
                    @click="selectOption(option)"
                    class="relative mx-1 cursor-pointer select-none py-2 pl-2 transition duration-150 ease-in-out hover:bg-gray-900"
                    :class="{ 'bg-primary-500 text-white': isSelected(option) }"
                >
                    <span
                        :class="{
                            'text-primary': isSelected(option),
                            '': !isSelected(option),
                        }"
                        class="block truncate"
                    >
                        {{ props.displayValueFunction(option) }}
                    </span>
                </li>

                <li
                    v-if="filteredOptions.length === 0"
                    class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-400"
                >
                    No results found.
                </li>
            </ul>
        </div>

        <!-- Error Message -->
        <div v-if="props.error" class="-mt-3 text-sm text-red-400">
            {{ props.error }}
        </div>
    </div>
</template>
