<script setup lang="ts">
import ComboboxOptionsChroma from "@/Components/Selectors/Partials/ComboboxOptionsChroma.vue";
import ComboboxChroma from "@/Components/Selectors/Partials/ComboboxChroma.vue";
import ComboboxOptionChroma from "@/Components/Selectors/Partials/ComboboxOptionChroma.vue";
import ComboboxOptionBodyChroma from "@/Components/Selectors/Partials/ComboboxOptionBodyChroma.vue";
import ComboboxInputChroma from "@/Components/Selectors/Partials/ComboboxInputChroma.vue";
import ComboboxOptionEmptyChroma from "@/Components/Selectors/Partials/ComboboxOptionEmptyChroma.vue";
import { computed, ref, watch } from "vue";
import axios, { AxiosResponse } from "axios";

const props = withDefaults(
    defineProps<{
        modelValue: any;
        options?: any[];
        displayValueFunction: (item: any) => string;
        label?: string;
        placeholder?: string;
        multiple?: boolean;
        api?: boolean;
        route?: string;
        required?: boolean;
        error?: string;
        minCharsToSearch?: number;
        renderComponent?: any;
        componentPropName?: string;
    }>(),
    {
        minCharsToSearch: 0,
        api: false,
        componentPropName: "",
    },
);

const emit = defineEmits<{
    (event: "update:modelValue", id: any): void;
}>();

const selected = ref(props.modelValue);

watch(selected, () => {
    emit("update:modelValue", selected.value);

    apiOptions.value = [];
});

let query = ref("");

let apiOptions = ref([]);

let filteredOptions = computed(() => {
    const isMultiple = props.multiple && Array.isArray(selected.value);

    if (props.api) {
        let currentSelected = selected.value;

        let sorted = apiOptions.value
            .filter((x) => {
                return isMultiple
                    ? !selected.value.includes(x)
                    : selected.value !== x;
            })
            .slice()
            .sort((a, b) => {
                const aSelected = isMultiple
                    ? selected.value.includes(a)
                    : selected.value === a;
                const bSelected = isMultiple
                    ? selected.value.includes(b)
                    : selected.value === b;

                if (aSelected && !bSelected) {
                    return -1;
                } else if (!aSelected && bSelected) {
                    return 1;
                } else {
                    return 0;
                }
            });

        return isMultiple ? currentSelected.concat(sorted) : sorted;
    }

    if (props.options) {
        let sortedOptions = props.options.slice().sort((a, b) => {
            const isMultiple = props.multiple && Array.isArray(selected.value);

            const aSelected = isMultiple
                ? selected.value.includes(a)
                : selected.value === a;
            const bSelected = isMultiple
                ? selected.value.includes(b)
                : selected.value === b;

            if (aSelected && !bSelected) {
                return -1;
            } else if (!aSelected && bSelected) {
                return 1;
            } else {
                return 0;
            }
        });

        return query.value === ""
            ? sortedOptions
            : sortedOptions.filter((option) =>
                  props
                      .displayValueFunction(option)
                      .toLowerCase()
                      .replace(/\s+/g, "")
                      .includes(query.value.toLowerCase().replace(/\s+/g, "")),
              );
    }

    return [];
});

const inputChanged = (value: string) => {
    query.value = value;

    if (props.api) {
        return fetch(value);
    }
};

const fetch = (term: string) => {
    if (props.route && term.length >= props.minCharsToSearch) {
        axios
            .get(props.route, {
                params: { term },
            })
            .then((response: AxiosResponse) => {
                apiOptions.value = response.data?.data ?? response.data;
            });
    }
};
</script>

<template>
    <ComboboxChroma v-model="selected" :multiple="multiple">
        <ComboboxInputChroma
            :selected="selected"
            :label="label"
            :display-value="displayValueFunction"
            :placeholder="placeholder"
            :required="required"
            :error="error"
            @change="inputChanged"
        />

        <ComboboxOptionsChroma
            @after-leave="query = ''"
            v-if="query.length >= minCharsToSearch"
        >
            <ComboboxOptionEmptyChroma
                v-if="
                    query.length >= minCharsToSearch &&
                    filteredOptions.length === 0
                "
            >
                Nothing found.
            </ComboboxOptionEmptyChroma>

            <ComboboxOptionChroma
                v-slot="{ active, selected }"
                v-for="option in filteredOptions"
                :key="option.id"
                :value="option"
                as="template"
            >
                <ComboboxOptionBodyChroma :active="active" :selected="selected">
                    <component
                        v-if="renderComponent"
                        :is="renderComponent"
                        v-bind="{
                            [componentPropName]: option,
                        }"
                    />

                    <template v-else>
                        {{ displayValueFunction(option) }}
                    </template>
                </ComboboxOptionBodyChroma>
            </ComboboxOptionChroma>
        </ComboboxOptionsChroma>
    </ComboboxChroma>
</template>
