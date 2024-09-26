<script setup lang="ts">
import {Combobox} from "@headlessui/vue";
import {Component, ref, watch} from "vue";

const props = withDefaults(
    defineProps<{
        modelValue: any,
        multiple: boolean,
        as?: string | Component,
        disabled?: boolean,
        nullable?: boolean
    }>(),
    {
        multiple: false
    }
);

const emit = defineEmits<{
    (event: 'update:modelValue', id: any): void;
}>()

const selected = ref(props.modelValue)

watch(selected, () => {
    emit('update:modelValue', selected.value)
})
</script>

<template>
    <div class="w-full relative">
        <Combobox
            v-model="selected"
            :multiple="multiple"
            :as="as"
            :disabled="disabled"
            :nullable="nullable"
        >
            <slot/>
        </Combobox>
    </div>
</template>
