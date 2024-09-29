<script lang="ts" setup>
import { ref, watch, computed } from "vue";
import axios, { AxiosResponse } from "axios";
import { onClickOutside } from "@vueuse/core";
import { PhX } from "@phosphor-icons/vue";

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
        autofocus?: boolean;
        disabled?: boolean;
        multiple?: boolean;
    }>(),
    {
        minCharsToSearch: 0,
        api: false,
        autofocus: false,
        required: false,
        disabled: false,
        multiple: false,
    },
);

const emit = defineEmits<{
    (event: "update:modelValue", value: any): void;
}>();

const selected = ref<any>(props.multiple ? [] : null);
const query = ref("");
const apiOptions = ref<any[]>([]);
const dropdownOpen = ref(false);
const comboboxRef = ref<HTMLElement | null>(null);
const inputRef = ref<HTMLInputElement | null>(null);

const updateQuery = () => {
    if (!props.multiple) {
        query.value = selected.value
            ? props.displayValueFunction(selected.value)
            : "";
    }
};

const fetchOptions = (term: string) => {
    if (props.route && (term.length >= props.minCharsToSearch || term === "")) {
        axios
            .get(props.route, { params: { term } })
            .then((response: AxiosResponse) => {
                apiOptions.value = response.data?.data ?? response.data;
            })
            .catch((error) => {
                console.error("Error fetching options:", error);
            });
    }
};

const inputChanged = (value: string) => {
    query.value = value;
    if (props.api) {
        fetchOptions(value);
    }
};

const selectOption = (option: any) => {
    if (props.multiple) {
        const index = (selected.value as any[]).indexOf(option);
        if (index > -1) {
            (selected.value as any[]).splice(index, 1);
        } else {
            (selected.value as any[]).push(option);
        }
        query.value = "";
    } else {
        selected.value = option;
        updateQuery();
    }
    focusInput();
};

const openDropdown = () => {
    dropdownOpen.value = true;
    if (props.api && query.value === "") {
        fetchOptions("");
    }
};

const clearSelected = () => {
    selected.value = props.multiple ? [] : null;
    query.value = "";
    dropdownOpen.value = false;
    focusInput();
};

const removeSelectedItem = (item: any) => {
    if (props.multiple) {
        const index = (selected.value as any[]).indexOf(item);
        if (index > -1) {
            (selected.value as any[]).splice(index, 1);
        }
    }
    focusInput();
};

const focusInput = () => {
    if (inputRef.value) {
        inputRef.value.focus();
    }
};

watch(
    () => props.modelValue,
    (newValue) => {
        selected.value = props.multiple
            ? Array.isArray(newValue)
                ? newValue
                : []
            : newValue;
        updateQuery();
    },
    { immediate: true },
);

watch(selected, (newValue) => {
    emit("update:modelValue", newValue);
    apiOptions.value = [];
    updateQuery();
});

const filteredOptions = computed(() => {
    const options = props.api ? apiOptions.value : props.options || [];

    if (query.value === "") return options;

    const normalizedQuery = query.value.toLowerCase().replace(/\s+/g, "");
    return options.filter((option) =>
        props
            .displayValueFunction(option)
            .toLowerCase()
            .replace(/\s+/g, "")
            .includes(normalizedQuery),
    );
});

onClickOutside(comboboxRef, () => {
    dropdownOpen.value = false;
});
</script>

<template>
    <div ref="comboboxRef" class="relative">
        <div
            class="relative flex flex-wrap items-center border border-primary-500 text-white shadow-sm focus-within:border-primary-500 focus-within:ring-1 focus-within:ring-primary-500"
        >
            <label v-if="label" :for="id" class="sr-only">{{ label }}</label>

            <div
                v-if="multiple && selected && selected.length"
                class="flex flex-wrap items-center gap-1 p-1"
            >
                <span
                    v-for="item in selected"
                    :key="displayValueFunction(item)"
                    class="inline-flex items-center bg-gray-800 px-2 py-1 text-sm text-white"
                >
                    {{ displayValueFunction(item) }}
                    <button
                        @click="removeSelectedItem(item)"
                        class="ml-2 text-red-400 hover:text-red-600"
                    >
                        <PhX weight="bold" size="12" />
                    </button>
                </span>
            </div>

            <input
                ref="inputRef"
                :id="id"
                type="text"
                :placeholder="placeholder || label"
                v-model="query"
                @input="inputChanged(query)"
                @focus="openDropdown"
                class="peer flex-grow border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
                :class="{ 'p-2': !multiple || !selected || !selected.length }"
                :disabled="disabled"
                :required="required"
                :autofocus="autofocus"
            />

            <span
                v-if="
                    selected &&
                    ((!multiple && selected) || (multiple && selected.length))
                "
                @click="clearSelected"
                class="bg-gray-800 p-3 text-sm text-gray-400 transition duration-150 ease-in-out hover:cursor-pointer hover:bg-gray-900"
            >
                <PhX weight="bold" size="16" />
            </span>

            <span
                class="pointer-events-none absolute left-2 top-0 -translate-y-2 bg-gray-800 px-2 py-0.5 text-xs text-gray-400 transition-all"
            >
                {{ label }}
            </span>
        </div>

        <ul
            v-show="dropdownOpen"
            class="absolute z-10 mt-1 max-h-60 w-full overflow-auto bg-gray-800 py-1 text-base text-white shadow-xl ring-1 ring-inset ring-gray-600 scrollbar focus:outline-none sm:text-sm"
        >
            <li
                v-for="option in filteredOptions"
                :key="displayValueFunction(option)"
                @click="selectOption(option)"
                class="relative mx-1 cursor-pointer select-none py-2 pl-2 transition duration-150 ease-in-out hover:bg-gray-900"
                :class="{
                    'bg-primary-500 text-white':
                        (!multiple && selected === option) ||
                        (multiple && selected.includes(option)),
                }"
            >
                <span class="block truncate">
                    {{ displayValueFunction(option) }}
                </span>
            </li>

            <li
                v-if="filteredOptions.length === 0"
                class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-400"
            >
                No results found.
            </li>
        </ul>

        <div v-if="error" class="mt-1 text-sm text-red-400">
            {{ error }}
        </div>
    </div>
</template>
