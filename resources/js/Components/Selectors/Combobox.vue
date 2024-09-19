<script setup lang="ts">
import { ref, computed, onMounted, onBeforeUnmount } from "vue";
import ComboboxInput from "@/Components/Selectors/ComboboxInput.vue";
import ComboboxOptions from "@/Components/Selectors/ComboboxOptions.vue";

const props = defineProps<{
    options: Array<any>;
    displayField: string;
    id: string;
    label: string;
    type: string;
    required?: boolean;
    autofocus?: boolean;
    disabled?: boolean;
    error?: string;
}>();

const emit = defineEmits(["update:selectedOptions"]);

const selectedOptions = ref<any[]>([]);
const searchTerm = ref<string>("");
const isOpen = ref<boolean>(false);

const filteredOptions = computed(() => {
    return props.options.filter((option) => {
        const value = option[props.displayField]?.toLowerCase();
        return value.includes(searchTerm.value.toLowerCase());
    });
});

const selectOption = (option: any) => {
    if (!selectedOptions.value.includes(option)) {
        selectedOptions.value.push(option);
    } else {
        selectedOptions.value = selectedOptions.value.filter(
            (opt) => opt !== option,
        );
    }
    emit("update:selectedOptions", selectedOptions.value);
};

const clearSelections = () => {
    selectedOptions.value = [];
    emit("update:selectedOptions", selectedOptions.value);
};
const handleClickOutside = (event: Event) => {
    const target = event.target as HTMLElement;
    if (!target.closest(".combobox")) {
        isOpen.value = false;
    }
};

onMounted(() => {
    document.addEventListener("click", handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener("click", handleClickOutside);
});
</script>

<template>
    <div class="combobox relative">
        <ComboboxInput
            v-model="searchTerm"
            @focus="isOpen = true"
            placeholder="Επιλέξτε ή πληκτρολογήστε για αναζήτηση..."
            :selectedOptions="
                selectedOptions.map((option) => option[props.displayField])
            "
            :id="props.id"
            :label="props.label"
            :type="props.type"
            :required="props.required"
            :autofocus="props.autofocus"
            :disabled="props.disabled"
            :error="props.error"
            @clearSelections="clearSelections"
        />
        <ComboboxOptions
            v-if="isOpen"
            :options="filteredOptions"
            :displayField="props.displayField"
            :selectedOptions="
                selectedOptions.map((option) => option[props.displayField])
            "
            @select="selectOption"
        />
    </div>
</template>
