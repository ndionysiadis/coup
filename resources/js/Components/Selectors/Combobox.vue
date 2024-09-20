<script setup lang="ts">
import ComboboxInput from "@/Components/Selectors/ComboboxInput.vue";
import ComboboxOptions from "@/Components/Selectors/ComboboxOptions.vue";
import axios, { AxiosResponse } from "axios";
import { ref, watch, computed, onBeforeUnmount } from "vue";

const props = withDefaults(
    defineProps<{
        displayField: string;
        label: string;
        id: string;
        type?: string;
        placeholder: string;
        route: string;
        multiple?: boolean;
        required?: boolean;
        autofocus?: boolean;
        error?: string;
        minCharsToSearch?: number;
    }>(),
    {
        multiple: false,
        minCharsToSearch: 2,
    },
);

const selectedOptions = ref<any[]>([]);
const searchTerm = ref<string>("");
const apiOptions = ref<any[]>([]);
const isOpen = ref<boolean>(false);
watch(searchTerm, (newTerm) => {
    if (newTerm.length >= props.minCharsToSearch) {
        fetchOptions(newTerm);
    }
});
const fetchOptions = (term: string) => {
    axios
        .get(props.route, { params: { term } })
        .then((response: AxiosResponse) => {
            apiOptions.value = response.data?.data || response.data;
            isOpen.value = true;
        })
        .catch(() => {
            apiOptions.value = [];
        });
};
const filteredOptions = computed(() => {
    return apiOptions.value.filter((option) => {
        return props.multiple
            ? !selectedOptions.value.includes(option)
            : selectedOptions.value !== option;
    });
});
const selectOption = (option: any) => {
    if (props.multiple) {
        if (!selectedOptions.value.includes(option)) {
            selectedOptions.value.push(option);
        } else {
            selectedOptions.value = selectedOptions.value.filter(
                (selected) => selected !== option,
            );
        }
    } else {
        selectedOptions.value = [option];
        isOpen.value = false;
    }
};

const clearSelections = () => {
    selectedOptions.value = [];
};
const handleClickOutside = (event: MouseEvent) => {
    const target = event.target as HTMLElement;
    if (!target.closest(".combobox")) {
        isOpen.value = false;
    }
};

document.addEventListener("click", handleClickOutside);

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
                selectedOptions.map((option) => option[props.displayField])
            "
            :id="props.id"
            :type="props.type"
            :label="props.label"
            :placeholder="props.placeholder"
            :autofocus="props.autofocus"
            :required="props.required"
            :error="props.error"
            @clearSelections="clearSelections"
        />

        <ComboboxOptions
            v-if="isOpen && filteredOptions.length"
            :options="filteredOptions"
            :displayField="props.displayField"
            :selectedOptions="
                selectedOptions.map((option) => option[props.displayField])
            "
            @select="selectOption"
        />
    </div>
</template>
